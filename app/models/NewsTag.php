<?php

class NewsTag extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     */
    public $sn;

    /**
     *
     * @var string
     */
    public $news_id;

    /**
     *
     * @var string
     */
    public $tag_code;

    /**
     * Independent Column Mapping.
     */
    public function columnMap()
    {
        return array(
            'sn' => 'sn', 
            'news_id' => 'news_id', 
            'tag_code' => 'tag_code'
        );
    }

    public static function InsertNewsTag($news_id,$tag_code){
        $newsTag = new NewsTag();
        $newsTag->news_id=$news_id;
        $newsTag->tag_code=$tag_code;
        $test= $newsTag->save();
        $newsTag=null;
        var_dump($test);
    }

}
