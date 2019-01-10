<?php
namespace Example\System\Template;

/**
 * Class Template
 * @package Example\System\Template
 */
class Template  {

    /**
     * View template
     * @param $template
     * @param array $vars
     * @return string
     */
    public static function View( $template, $vars = [] ) {

        $expectedPath = APP_DIR . 'views' . DIRECTORY_SEPARATOR . "{$template}" . '.php';

        if(!is_file($expectedPath))   {
            die('Expected view file is corrupt');
        }

        if (!file_exists($expectedPath)) {
            die('Expected view file is missing');
        }

        extract( $vars );
        ob_start();
        require_once($expectedPath);
        echo ob_get_clean();

    }

}