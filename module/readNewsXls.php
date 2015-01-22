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

function readNewsXlsx($filename,$index)
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
                }else if($xlsxTitle[$col]=="健康新知標題(30個全形字/符號以內)") {
                    $v='title';
                }else if($xlsxTitle[$col]=='Tag(醫療保健,慢性病保養,吃出健康,飲食安全,低卡飲食,防癌飲食,預防疾病飲食,抗老飲食,養生之道,中醫調理,舒壓,養生保健迷思,運動保健,心靈健康).複選,請用逗號隔開') {
                    $v='tag';
                }else if($xlsxTitle[$col]=='健康新知內文(150個全形字/符號以內)') {
                    $v='content';
                }else if($xlsxTitle[$col]=='健康新知作者(8個全形字/符號以內)') {
                    $v='author';
                }else if($xlsxTitle[$col]=='健康新知圖片(Null，不顯示圖片)') {
                    $v='photo';
                }else if($xlsxTitle[$col]=='ShortUrl(為系統自動帶入)') {
                    $v='ShortUrl';
                }else if($xlsxTitle[$col]=='有聲播放') {
                    $v='audio';
                }else if($xlsxTitle[$col]=='State') {
                    $v='state';
                }else if($xlsxTitle[$col]=='連載文章延伸閱讀') {
                    $v='reading';
                }
                $arrayData[$row-1][$v]=$value;

            }
        }
    }
    return $arrayData;
}

?>