<?php

class NewsMedia extends \Phalcon\Mvc\Model
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
     * @var integer
     */
    public $media_id;

    /**
     * Independent Column Mapping.
     */
    public function columnMap()
    {
        return array(
            'sn' => 'sn', 
            'news_id' => 'news_id', 
            'media_id' => 'media_id'
        );
    }

    public static function insertNewsMedia($news_id,$media_id){
        $newsMedia = new NewsMedia();
        $newsMedia->news_id=$news_id;
        $newsMedia->media_id=$media_id;
        $test= $newsMedia->save();
        $newsMedia=null;
        var_dump($test);
    }

}
