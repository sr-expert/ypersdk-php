<?php
/**
 * Sahadina
 *
 * @category YperSDK
 * @package  Yper\SDK
 * @author   rajafallah@gmail.com
 */
namespace Yper\SDK\Helper;

use InvalidArgumentException;
use Yper\SDK\Exceptions\YperException;

/**
 * Class ValidateToken
 */
class ValidateToken
{
    /**
     * The API access token
     *
     * @var string
     */
    private static $token = null;

    /**
     * The instance token, settable once per new instance
     *
     * @var string
     */
    private $instanceToken;

    /**
     * @param  string|null $token The API access token
     * @throws YperException When no token is provided
     */
    public function __construct($token = null)
    {
        if ($token === null) {
            if (self::$token === null) {
                $msg = 'No token provided, and none is globally set. ';
                $msg .= 'Use validateToken::setToken, or instantiate the validateToken class with a $token parameter.';
                throw new YperException($msg);
            }
        } else {
            self::validateToken($token);
            $this->instanceToken = $token;
        }
    }
    /**
     * Sets the token for all future new instances
     *
     * @param  $token string The API access token
     * @return void
     */
    public static function setToken($token)
    {
        self::validateToken($token);
        self::$token = $token;
    }

    private static function validateToken($token)
    {
        if (!is_string($token)) {
            throw new InvalidArgumentException('Token is not a string.');
        }
        if (strlen($token) < 4) {
            throw new InvalidArgumentException('Token "' . $token . '" is too short, and thus invalid.');
        }
        return true;
    }
}
