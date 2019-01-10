<?php
namespace Example\System\Core;

/**
 * Class Debug
 * @package Example\System\Core
 */
class Debug extends \Exception  {

    /**
     * @var $_message
     */
    private static $_message;

    /**
     * Catch error message
     * @param $text
     */
    public static function catchMessage($text) {
        self::$_message = $text;
        require_once(APP_DIR . "controllers/error.php");

    }

    /**
     * Get caught message
     * @return mixed
     */
    public static function getCurrentMessage()   {
        return self::$_message;
    }

    /**
     * Set session error message
     * @param $message
     */
    public static function setSessionMessage($message) {
        $_SESSION['system_message'] = $message;
    }

    /**
     * Get current session error message
     * @return bool
     */
    public static function getSessionMessage()  {
        return isset($_SESSION['system_message']) && !empty($_SESSION['system_message'])
            ? $_SESSION['system_message'] : false;
    }

    /**
     * Clear session error message
     */
    public static function clearSessionMessage()    {
        unset($_SESSION['system_message']);
    }

}