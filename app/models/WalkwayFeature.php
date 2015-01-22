<?php

class WalkwayFeature extends \Phalcon\Mvc\Model
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
     * @var integer
     */
    public $feature_id;

    /**
     * Independent Column Mapping.
     */
    public function columnMap()
    {
        return array(
            'sn' => 'sn', 
            'walkway_id' => 'walkway_id', 
            'feature_id' => 'feature_id'
        );
    }

    public static function InsertFeature($walkway_id,$feature_id){
        $feature = new WalkwayFeature();
        $feature->walkway_id=$walkway_id;
        $feature->feature_id=$feature_id;
        $test= $feature->save();
        $feature=null;
        var_dump($test);
    }

}
