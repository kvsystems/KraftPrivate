<?php
namespace Example\Excel\Models;

use Example\System\Core\Model;

/**
 * Class File
 * Model for working with the file system
 * @package Example\Excel\Models
 */
class File extends Model    {

    /**
     * @const MAX_FILE_SIZE
     */
    const MAX_FILE_SIZE = 10000000;

    /**
     * @const VALID_EXTENSIONS
     */
    const VALID_EXTENSIONS = [
        'xls',
        'xlsx'
    ];

    /**
     * File model constructor.
     */
    public function __construct()   {
        parent::__construct();
    }

    /**
     * File availability check
     * @param $file
     * @return bool
     */
    public function fileAvailable($file)    {
        return file_exists($file) && is_file($file) && is_readable($file)
            ? true : false;
    }

    /**
     * File validation
     * @param $file
     * @return bool
     */
    public function fileValid($file) {
        return
            @filesize($file) <= self::MAX_FILE_SIZE &&
            in_array(pathinfo($file)['extension'], self::VALID_EXTENSIONS)
                ? true : false;
    }

}