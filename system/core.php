<?php
namespace Example\System;

use Example\System\Config\Config;
use Example\System\Core\Debug;

/**
 * class Core
 * @package System
 */
class Core {
    /**
     * Controller
     * @var $_class
     */
    private static $_class;

    /**
     * Action
     * @var $_action
     */
    private static $_action;

    /**
     * @var $_instance
     */
    private static $_instance;

    /**
     * Core constructor
     */
    public function __construct()   {
        self::$_instance = $this;
    }

    /**
     * Initialization
     * @throws \Exception
     */
    public static function initialize() {
        Debug::clearSessionMessage();

        $method = strtolower($_SERVER['REQUEST_METHOD']);
        $config = new Config('config');

        $controller    = $config::get( 'default_controller' );
        self::$_action = $config::get( 'default_method' );

        $className     = ucfirst($controller);
        self::$_class  = "Example\\Excel\\Controllers\\{$className}";

        $dirs = explode('\\', self::$_class);

        $filePath      = ROOT_DIR . strtolower($dirs[1]) . DIRECTORY_SEPARATOR;
        $filePath     .= 'controllers' . DIRECTORY_SEPARATOR . "{$controller}" . '.php';

        if(!in_array($method, $config::get('methods_allowed'))) {
            self::setError('Method "' . $method . '" not allowed.');
        }

        if(!is_file($filePath) || !method_exists( self::$_class, self::$_action )) {
            self::setError('File "' . $className . '"" is corrupt.');
        }

    }

    /**
     * Handle current controller and action
     */
    public static function handle() {
        die(call_user_func([new self::$_class, self::$_action]));
    }

    /**
     * Set error controller with message
     * @param $message
     * @throws \Exception
     */
    public static function setError($message)  {
        self::$_class = "Example\\Excel\\Controllers\\Error";
        throw new \Exception($message);
    }

}