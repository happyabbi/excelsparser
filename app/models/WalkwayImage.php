<?php

class WalkwayImage extends \Phalcon\Mvc\Model
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
    public $walkway_id;

    /**
     *
     * @var string
     */
    public $img_name;

    /**
     * Independent Column Mapping.
     */
    public function columnMap()
    {
        return array(
            'sn' => 'sn', 
            'walkway_id' => 'walkway_id', 
            'img_name' => 'img_name'
        );
    }

    public static function InsertImage($walkwayId,$imgName){
        $image = new WalkwayImage();
        $image->walkway_id=$walkwayId;
        $image->img_name=$imgName;
        $test= $image->save();
        $image=null;
        var_dump($test);
    }
}
