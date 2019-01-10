<?php
namespace Example\Excel\Models;

use Example\System\Core\Model;

/**
 * Class Parse
 * @package Example\Excel\Models
 */
class Parse extends Model    {

    /**
     * Parse constructor.
     */
    public function __construct()   {
        parent::__construct();
    }

    /**
     * Parse elements from Excel
     * @param \PHPExcel $object
     * @param array $default
     * @return array|bool
     * @throws \PHPExcel_Exception
     */
    public function parseValidSheets(\PHPExcel &$object, $default = [])  {
        $response = []; $result = [];

        for($i = 0; $i < $object->getSheetCount(); $i++) {

            $arrayCounter = 0;

            foreach ($object->getSheet($i)->getRowIterator() as $row) {

                $rowCounter = 0; $temp = null; $tempArray = [];
                foreach($row->getCellIterator() as $key => $cell) {

                    if(is_null($temp) && !is_null($cell->getCalculatedValue())) {
                        $temp = $cell->getCalculatedValue();
                    }

                    if(!is_null($temp) && is_null($cell->getCalculatedValue())) {
                        $rowCounter = 0;
                    }


                    if(!is_null($cell->getCalculatedValue())) {
                        $tempArray[] = $cell->getCalculatedValue();
                        $rowCounter++;
                    }

                }

                $arrayCounter++;

                if($rowCounter < 3) continue;
                $result[$i][] = $tempArray;

            }

        }

        $response['fields'] = $default;

        foreach($result as $sheet)  {

            $example = [];

            foreach($default as $defaultValue) {
                $example[] = [
                    'key'  => array_search ($defaultValue, $sheet[0]),
                    'name' => $defaultValue
                ];
            }

            for($i = 1; $i < count($sheet); $i++)   {

                $temp = [];

                for($j = 0; $j < count($sheet[$i]); $j++)   {
                    $temp[] = $sheet[$i][$example[$j]['key']];
                }

                $response['values'][] = $temp;
            }


        }

        return isset($response['values']) && !empty($response['fields']) ? $response : false;
    }

}