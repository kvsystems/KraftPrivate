<?php
namespace Example\Excel\Controllers;

use Example\System\Core\Controller;
use Example\System\Template\Template;
use Example\System\Config\Config;
use Example\System\Core\Debug;

/**
 * Class Error
 * @package Example\Excel\Controllers
 */
class Error extends Controller {

    /**
     * @var $_config
     */
    private $_config;

    /**
     * Error constructor
     * @throws \Exception
     */
    public function __construct()   {
        parent::__construct();
    }

    /**
     * Handle error
     * @throws \Exception
     */
    public function index() {
        $config = $config = new Config('config');
        $data['title'] = $config::get('app_name');
        $data['message'] = Debug::getCurrentMessage();
        Template::view('error/default', $data);
    }

}