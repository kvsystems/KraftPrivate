<?php
namespace Example\System\Config;

/**
 * Class Config
 * @package Excel\Config
 *
 * Load config files, get values and set values
 */
class Config {

    /**
     * @var array
     */
    private static $_config = [];

    /**
     * Config Key
     * @var
     */
    private static $_key;

    /**
     * Include config file
     * @param $filePath
     * @return boolean
     * @throws \Exception
     */
    private static function _include($filePath)  {
        global $config;
        require_once($filePath);

        if ( !isset( $config ) || !is_array( $config ) )
            throw new \Exception('Your ' . $filePath . ' file does not appear to contain a valid.');

        self::Set( self::$_key, $config[ self::$_key ] );
        return self::Get( self::$_key );
    }

    /**
     * Checks for key availability
     * @param $key
     * @return null
     */
    private static function _isset($key)    {
        return isset( static::$_config[ self::$_key ][ $key ] )
            ? static::$_config[ self::$_key ][ $key ] : null;
    }

    /**
     * Get key values
     * @param bool $key
     * @return mixed|null
     */
    public static function get($key = false)    {
        return is_bool( $key )
            ? static::$_config[ self::$_key ]
            : self::_isset( $key );
    }

    /**
     * Set key values
     * @param bool $key
     * @param bool $value
     */
    public static function set($key = false, $value = false)    {
        if( !is_bool( $key ) && !is_bool( $value ) )
            static::$_config[ $key ] = $value;
    }

    /**
     * Config constructor
     * @param $name
     * @throws \Exception
     */
    public function __construct($name)   {
        self::$_key = $name;
        self::initialize($name);
    }

    /**
     * Initialize config loader
     * @param $name
     * @return null|boolean
     * @throws \Exception
     */
    public static function initialize($name) {
        $filePath = APP_DIR . 'config' . DIRECTORY_SEPARATOR;
        $filePath .= preg_replace( '/[^a-z]/ui', '', $name) . '.php';
        return is_file( $filePath ) ? self::_include( $filePath ) : false;
    }

}