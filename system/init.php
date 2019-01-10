<?
spl_autoload_register( "autoloader" );

/**
 * Autoload function
 * @param $className
 */
function autoloader( $className ) {
    $fileName = strtolower(
        ROOT_DIR . str_replace('\\', '/',
            str_replace( 'Example\\', '', $className ) ) . ".php"
    );
    if ( is_readable( $fileName ) ) require_once( $fileName );
}