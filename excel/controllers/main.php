<?php
namespace Example\Excel\Controllers;

use Example\System\Core\Controller;
use Example\System\Template\Template;
use Example\System\Config\Config;
use Example\System\Core\Loader;
use Example\System\Core\Debug;

/**
 * Class Main
 * @package Example\Excel\Controllers
 */
class Main extends Controller {

    /**
     * @var $file
     */
    protected $file;

    /**
     * @var $parser
     */
    protected $parser;

    /**
     * Main controller constructor.
     * @throws \Exception
     */
    public function __construct()   {
        parent::__construct();
        $this->file = Loader::Model('file');
        $this->parser = Loader::Model('parse');
        Loader::Library('PHPExcel', false);

    }

    /**
     * Handle request
     * @throws \Exception
     */
    public function index() {

        $file = APP_DIR . 'upload' . DIRECTORY_SEPARATOR . 'Example.xlsx';
        $config = $config = new Config('config');

        try {
            if(!$this->file->fileAvailable($file)) {
                Debug::setSessionMessage('File "' . $file . '" not available');
            }

            if(!$this->file->fileValid($file) || !$fileType = \PHPExcel_IOFactory::identify($file))  {
                Debug::setSessionMessage('File "' . $file . '" not valid');
            }

            if(!$reader = \PHPExcel_IOFactory::createReader($fileType))    {
                Debug::setSessionMessage('File "' . $file . '" cannot be read');
            }

            if(!$object = $reader->load($file)) {
                Debug::setSessionMessage('File "' . $file . '" cannot be load');
            }

            if(!Debug::getSessionMessage()) {
                $parsed = $this->parser->parseValidSheets(
                    $object, $config::get('default_array')
                );

                $data['parsed'] = $parsed ? $parsed : Debug::setSessionMessage(
                    'File "' . $file . '" contains no results'
                );
            }

        } catch(\Exception $e)  {
            if(!Debug::getSessionMessage()) {
                Debug::setSessionMessage('Runtime error: ' . $e->getMessage());
            }
        }

        $data['title'] = $config::get('app_name');
        Template::view('web/main', $data);
    }

}