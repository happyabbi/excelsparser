<?php
/**
 * Created by PhpStorm.
 * User: abraham.chen
 * Date: 2015/1/21
 * Time: 上午 11:25
 */
require_once(dirname(dirname(dirname(__FILE__))) . '/module/readWalkwayXls.php');
class ImportWalkwayController extends  ControllerBase{

    private function checkExcelDataFormat( $arrayData){
        foreach($arrayData as $v ) {
            $this->areaCheck($v['walkway_area']);
            $this->fullyDistanceCheck($v['fully_distance']);
            $this->featureCheck( $v['feature']);
        }
    }

    private function featureCheck($name){
        $feature = explode(",", $name);
        foreach($feature as $f){
            if ($f!=""){
                $fid=Feature::getId($f);
                if($fid=="" or $fid==null){
                    throw new exception("Excel feature miss"."-[".$f."]");
                }
            }
        }
    }

    private function fullyDistanceCheck($name){
        if ($name=="1-3公里"){
            $area="true";
        }else if ($name=="5公里以上"){
            $area="true";
        }else if ($name=="3-5公里"){
            $area="true";
        }else{
            throw new \Phalcon\Exception("No This areaName"."-[".$name."]");
        }
    }

    private function areaCheck($name){
        $part="";
        $N=array("台北市","臺北市","新北市","基隆市","桃園市","桃園縣","新竹縣","新竹市","苗栗縣");
        $C=array("臺中市","台中市","彰化縣","南投縣","雲林縣");
        $S=array("嘉義縣","嘉義市","臺南市","高雄市","屏東縣","台南市","台南縣");
        $E=array("花蓮縣","臺東縣","宜蘭縣","台東縣");
        $O=array("金門縣","馬祖縣","連江縣","澎湖縣");

        if(in_array($name, $N)){
            $part="北台灣";
        }else if(in_array($name, $C)) {
            $part="中台灣";
        }else if(in_array($name, $S)) {
            $part="南台灣";
        }else if(in_array($name, $E)) {
            $part="東台灣";
        }else if(in_array($name, $O)){
            $part="離島";
        }else {
            throw new \Phalcon\Exception("No This Area"."-[".$name."]");
        }
        return $part;
    }


    public function indexAction()
    {
        $path=dirname(dirname(dirname(__FILE__))). '/excels/20150119_walkway.xlsx';
        $arrayData=readWalkwayXlsx($path,0);
        try{
            $this->checkExcelDataFormat($arrayData);
        }catch(\Phalcon\Exception $e){
            echo  $e->getMessage();
            exit();
        }


        foreach($arrayData as $v ) {
            $walkwayId = Autoencode::generateAutoEncode('walkway_id');
            $walkway_part_area=$this->areaCheck($v['walkway_area']);

            $level="";
            if($v['level']=="易"){
                $level='easy';
            }elseif($v['level']=="普通"){
                $level='normal';
            }elseif($v['level']=="難") {
                $level='hard';
            }else{
                $level='easy';
            }
            Walkway::insertWalkway($walkwayId,$walkway_part_area,$level,$v['reference'],
                                $v['walkway_area'],$v['admin_area'],$v['walkway_name'],
                                $v['walkway_title'],$v['walkway_address'],$v['location_lat'],
                                $v['location_lng'],$v['parking'],$v['fully_distance'],$v['kilometers'],
                                $v['description'],'N',$v['traffic'],$v['walk_hours'],$v['rule_description'],
                                $v['altitude_meters'],$v['tip'],$v['roadMap'],$v['titlePage']);

            $feature = explode(",",  $v['feature']);
            foreach($feature as $f){
                if ($f!=""){
                    $fid=Feature::getId($f);

                    if($fid=="" or $fid==null){
                        throw new exception("Excel feature miss"."-[".$f."]");
                    }else{
                        WalkwayFeature::InsertFeature($walkwayId,$fid);
                    }
                }
            }

            if($v['Photo1']!="" AND $v['Photo1']!=null){
                WalkwayImage::InsertImage($walkwayId,$v['Photo1']);
            }
            if($v['Photo2']!="" AND $v['Photo2']!=null){
                WalkwayImage::InsertImage($walkwayId,$v['Photo2']);
            }
            if($v['Photo3']!="" AND $v['Photo3']!=null){
                WalkwayImage::InsertImage($walkwayId,$v['Photo3']);
            }
            if($v['Photo4']!="" AND $v['Photo4']!=null){
                WalkwayImage::InsertImage($walkwayId,$v['Photo4']);
            }
            if($v['Photo5']!="" AND $v['Photo5']!=null){
                WalkwayImage::InsertImage($walkwayId,$v['Photo5']);
            }
        }
        echo 'Success';
    }
}