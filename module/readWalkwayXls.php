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

function readWalkwayXlsx($filename,$index)
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

                if ($xlsxTitle[$col]=='WalkWayID') {
                    $v='walkway_id';
                }else if($xlsxTitle[$col]=="資料來源") {
                    $v='reference';
                }else if($xlsxTitle[$col]=='地區1') {
                    $v='walkway_area';
                }else if($xlsxTitle[$col]=='地區2') {
                    $v='admin_area';
                }else if($xlsxTitle[$col]=='照片') {
                    $v='titlePage';
                }else if($xlsxTitle[$col]=='步道名稱') {
                    $v='walkway_name';
                }else if($xlsxTitle[$col]=='步道副標題') {
                    $v='walkway_title';
                }else if($xlsxTitle[$col]=='步道難易度(輕鬆型、專家型、勇腳型)單選') {
                    $v='level';
                }else if($xlsxTitle[$col]=='步道特色(山景,水景,人文,生態,地理,季節,宗教)複選,請用逗號隔開') {
                    $v='feature';
                }else if($xlsxTitle[$col]=='特色介紹') {
                    $v='description';
                }else if($xlsxTitle[$col]=='附設停車場') {
                    $v='parking';
                }else if($xlsxTitle[$col]=='大眾交通') {
                    $v='traffic';
                }else if($xlsxTitle[$col]=='location_lat') {
                    $v='location_lat';
                }else if($xlsxTitle[$col]=='location_lng') {
                    $v='location_lng';
                }else if($xlsxTitle[$col]=='步行時間') {
                    $v='walk_hours';
                }else if($xlsxTitle[$col]=='健走路線') {
                    $v='rule_description';
                }else if($xlsxTitle[$col]=='地理位置') {
                    $v='walkway_address';
                }else if($xlsxTitle[$col]=='路徑長度') {
                    $v='kilometers';
                }else if($xlsxTitle[$col]=='路徑長度分類(1-3公里/3-5公里/5公里以上)單選') {
                    $v='fully_distance';
                }else if($xlsxTitle[$col]=='海拔高度(單行文字)+公尺') {
                    $v='altitude_meters';
                }else if($xlsxTitle[$col]=='行程小叮嚀') {
                    $v='tip';
                }else if($xlsxTitle[$col]=='路線圖') {
                    $v='roadMap';
                }else if($xlsxTitle[$col]=='封面照片') {
                    $v='photo';
                }else if($xlsxTitle[$col]=='步道寫真1') {
                    $v='Photo1';
                }else if($xlsxTitle[$col]=='步道寫真2') {
                    $v='Photo2';
                }else if($xlsxTitle[$col]=='步道寫真3') {
                    $v='Photo3';
                }else if($xlsxTitle[$col]=='步道寫真4') {
                    $v='Photo4';
                }else if($xlsxTitle[$col]=='步道寫真5') {
                    $v='Photo5';
                }else if($xlsxTitle[$col]=='State') {
                    $v='state';
                }
                 //$v= $xlsxTitle[$col];
                $arrayData[$row-1][$v]=$value;

            }
        }
    }
    return $arrayData;
}

?>