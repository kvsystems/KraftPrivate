<?php
namespace Example\System\Core;

/**
 * Class Loader
 * @package Excel\Main
 */
class Loader {

    /**
     * Check file for existence
     * @param $file
     * @param $class
     * @return bool
     * @throws \Exception
     */
    private static function _validate($file, $class)    {
        try {

            if (!file_exists($file)) {
                throw new \Exception('File "' . $class . '" not exist.');
            }

            if(!is_file($file))   {
                throw new \Exception('File "' . $file . '" is corrupt.');
            }

        } catch (\Exception $e)  {
            Debug::setSessionMessage($e->getMessage());
        }

        return Debug::getSessionMessage() ? false : true;
    }

    /**
     * Check class for existence
     * @param $class
     * @return bool
     * @throws \Exception
     */
    private static function _isset($class)    {
        try {

            if (!class_exists($class)) {
                throw new \Exception('Class "' . $class . '" not exist.');
            }

        } catch (\Exception $e)  {
            Debug::setSessionMessage($e->getMessage());
        }

        return Debug::getSessionMessage() ? false : true;
    }

    /**
     * Connect application model
     * @param $name
     * @return mixed
     * @throws \Exception
     */
    public static function Model($name) {
        $file = APP_DIR . 'models' . DIRECTORY_SEPARATOR . $name . '.php';
        $class = "Example\\Excel\\Models\\" . ucfirst($name);

        if(self::_validate($file, $class))  {
            require_once $file;
        }

        return self::_isset($class) ? new $class : false;
    }

    /**
     * Connect application library
     * @param mixed
     * @return mixed
     * @throws \Exception
     */
    public static function Library() {
        $params = func_get_args();
        $file = APP_DIR . 'libraries' . DIRECTORY_SEPARATOR . $params[0] . '.php';

        $class = $params[1] ? "Example\\Excel\\Libraries\\" . ucfirst($params[0]) : ucfirst($params[0]);

        if(self::_validate($file, $class))  {
            require_once $file;
        }

        return self::_isset($class) ? new $class : false;
    }

}