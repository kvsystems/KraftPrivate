<?php
namespace Example\System\Core;
use Example\System\Core;

/**
 * Class Controller
 * @package Example\System\Core
 */
class Controller extends Core {

    /**
     * Controller constructor
     */
    public function __construct()   {
        parent::__construct();
    }

    /**
     * @param $input
     * @return bool|string
     */
    public function get($input) {
        return !empty( $_GET[$input] )
            ? strip_tags( $_GET[$input] ) : false;
    }

}