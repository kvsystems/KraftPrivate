<?php
namespace Example;

use Example\System\Core\Debug;

/** PHP debug configuration */
ini_set( 'error_reporting', E_ALL );
ini_set( 'display_errors', 1 );
ini_set( 'display_startup_errors', 1 );
date_default_timezone_set( 'Asia/Yekaterinburg' );

/** Start session */
session_start();

/** PHPExcel root directory */
define( 'ROOT_DIR', realpath( dirname(__FILE__) ) . '/' );
define( 'APP_DIR', ROOT_DIR . 'excel/' );

/** Connection autoload */
require( ROOT_DIR . 'system/init.php' );

/** Trying to execution of the main script */
try {
    System\Core::initialize();
} catch (\Exception $e) {
    Debug::catchMessage($e->getMessage());
} finally {
    System\Core::handle();
}