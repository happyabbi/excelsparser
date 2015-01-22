<?php
/**
 * Created by PhpStorm.
 * User: abraham.chen
 * Date: 2015/1/20
 * Time: 下午 03:29
 */
require_once(dirname(dirname(dirname(__FILE__))) . '/module/readNewsXls.php');
class ImportNewsController {

    private function checkExcelDataFormat( $arrayData){
        foreach($arrayData as $v ) {
            $tags = explode(",", $v['tag']);
            foreach($tags as $tag){
                if ($tag!=""){
                    $tagCode=Tag::getCode($tag);
                    if($tagCode=="" or $tagCode==null){
                        throw new exception("Excel Tag miss"."-[".$tag."]");
                    }
                }
            }
            $expertId= Expert::getExpertId($v['author']);
            if($expertId=="" or $expertId==null){
                throw new exception("Excel ExpertName miss"."-[".$v['author']."]");
            }
        }
    }

    public function indexAction()
    {
        $path=dirname(dirname(dirname(__FILE__))). '/excels/20150116_health.xlsx';
        $arrayData=readNewsXlsx($path,0);
        try{
            $this->checkExcelDataFormat($arrayData);
        }catch(\Phalcon\Exception $e){
            echo  $e->getMessage();
            exit();
        }




        foreach($arrayData as $v ) {
            $NewsId = Autoencode::generateAutoEncode('News_ID');
            $expertId= Expert::getExpertId($v['author']);

            $state="F";

            if (!$v['photo']='Null'){
                $thumbnail=$v['photo'];
                $photo=$v['photo'];
            }else{
                $thumbnail=null;
                $photo=null;
            }

            $title=$v['title'];
            $content=$v['content'];


            News::InsertNews($NewsId,$state,$photo,$thumbnail,$title,$content,$expertId);

            $tags = explode(",", $v['tag']);

            foreach($tags as $tag){
                if ($tag!=""){
                    $tagCode=Tag::getCode($tag);
                    if($tagCode=="" or $tagCode==null){
                        var_dump($tag);
                    }
                }
                NewsTag::InsertNewsTag($NewsId,$tagCode);
            }
            Media::insertMedia($v['audio'],"audio");
            $mediaId=Media::getMediaId($v['audio']);
            NewsMedia::insertNewsMedia($NewsId,$mediaId);

        }
        echo "Success";

    }
}