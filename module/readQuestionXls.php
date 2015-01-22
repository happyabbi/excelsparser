<?php
/**
 * Created by PhpStorm.
 * User: abraham.chen
 * Date: 2015/1/20
 * Time: 上午 11:37
 */
/**
 * @param $filename xlsx檔案路徑
 * @param $index 分頁
 * @return array
 * @throws PHPExcel_Exception
 * @throws PHPExcel_Reader_Exception
 */
require_once(dirname(__FILE__) . '/PHPExcelClasses/PHPExcel.php');


//$arrayData=readQuestionXlsx(dirname(__FILE__) . '/excels/20150108_game.xlsx',0);
function readQuestionXlsx($filename,$index)
{
    $inputFileType = PHPExcel_IOFactory::identify($filename);
    $objReader = PHPExcel_IOFactory::createReader($inputFileType);
    $objReader->setReadDataOnly(true);

    /**  Load $inputFileName to a PHPExcel Object  **/
    $objPHPExcel = $objReader->load($filename);

    $total_sheets=$objPHPExcel->getSheetCount(); //取得幾多少張Sheets

    $allSheetName=$objPHPExcel->getSheetNames();
    $objWorksheet = $objPHPExcel->setActiveSheetIndex($index);
    $highestRow = $objWorksheet->getHighestRow();
    $highestColumn = $objWorksheet->getHighestColumn();

    $highestColumnIndex = PHPExcel_Cell::columnIndexFromString($highestColumn);
    $arrayData=array();
    $xlsxTitle=array();

    for ($col = 0; $col <$highestColumnIndex;++$col) {
        //$xlsxTitle[]=$objWorksheet->getCellByColumnAndRow($col, 1)->getValue();
        //利用正規表示式將內容的斷行(\r\n)字元去除
        $content=preg_replace( "/\s/", "" , $objWorksheet->getCellByColumnAndRow($col, 1)->getValue() );
        // 移除前後空白字
        $content= trim($content);
        // 移除非空白的間距變成一般的空白
        $content = preg_replace('/[\n\r\t]/', ' ', $content);
        // 移除重覆的空白
        $content = preg_replace('/\s(?=\s)/', '', $content);
        $xlsxTitle[]=$content;
    }

    for ($row = 2; $row <= $highestRow;++$row) {
        $value=$objWorksheet->getCellByColumnAndRow(0, $row)->getValue();
        if ($value!=null){
            for ($col = 0; $col <$highestColumnIndex;++$col) {
                $value=$objWorksheet->getCellByColumnAndRow($col, $row)->getValue();

                if ($xlsxTitle[$col]=='項次') {
                    $v='id';
                }else if($xlsxTitle[$col]=="題目敘述(35個全形字/符號以內)") {
                    $v='title';
                }else if($xlsxTitle[$col]=='選項一(10個全形字/符號以內)') {
                    $v='item1';
                }else if($xlsxTitle[$col]=='選項二(10個全形字/符號以內)') {
                    $v='item2';
                }else if($xlsxTitle[$col]=='選項三(10個全形字/符號以內)') {
                    $v='item3';
                }else if($xlsxTitle[$col]=='正解是') {
                    $v='answer';
                }else if($xlsxTitle[$col]=='作答後補充(100個全形字/符號以內)') {
                    $v='content';

                }else if($xlsxTitle[$col]=='難易度') {
                    $v='level';
                }else if($xlsxTitle[$col]=='State') {
                    $v='state';
                }
                $arrayData[$row-1][$v]=$value;
            }
        }
    }
    return $arrayData;
}

?>