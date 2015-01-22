<?php

class Media extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     */
    public $id;

    /**
     *
     * @var string
     */
    public $filename;

    /**
     *
     * @var string
     */
    public $type;

    /**
     * Independent Column Mapping.
     */
    public function columnMap()
    {
        return array(
            'id' => 'id', 
            'filename' => 'filename', 
            'type' => 'type'
        );
    }

    public static function insertMedia($filename,$type){
        $media = new Media();
        $media->filename=$filename;
        $media->type=$type;
        $test=$media->save();
        var_dump($test);
        $media=null;
    }

    public static function getMediaId($filename){
        $media = Media::findFirst("filename = '{$filename}'");
        return $media->id;
    }
}
