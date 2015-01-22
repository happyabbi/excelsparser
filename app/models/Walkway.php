<?php

class Walkway extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var string
     */
    public $walkway_id;

    /**
     *
     * @var string
     */
    public $walkway_part_area;

    /**
     *
     * @var string
     */
    public $level;

    /**
     *
     * @var string
     */
    public $reference;

    /**
     *
     * @var string
     */
    public $walkway_area;

    /**
     *
     * @var string
     */
    public $admin_area;

    /**
     *
     * @var string
     */
    public $walkway_name;

    /**
     *
     * @var string
     */
    public $walkway_title;

    /**
     *
     * @var string
     */
    public $walkway_address;

    /**
     *
     * @var double
     */
    public $location_lat;

    /**
     *
     * @var double
     */
    public $location_lng;

    /**
     *
     * @var string
     */
    public $parking;

    /**
     *
     * @var string
     */
    public $fully_distance;

    /**
     *
     * @var string
     */
    public $kilometers;

    /**
     *
     * @var string
     */
    public $description;

    /**
     *
     * @var string
     */
    public $state;

    /**
     *
     * @var string
     */
    public $traffic;

    /**
     *
     * @var integer
     */
    public $walk_hours;

    /**
     *
     * @var string
     */
    public $rule_description;

    /**
     *
     * @var string
     */
    public $altitude_meters;

    /**
     *
     * @var string
     */
    public $tip;

    /**
     *
     * @var string
     */
    public $roadmap;

    /**
     *
     * @var string
     */
    public $titlepage;

    /**
     * Independent Column Mapping.
     */
    public function columnMap()
    {
        return array(
            'walkway_id' => 'walkway_id', 
            'walkway_part_area' => 'walkway_part_area', 
            'level' => 'level', 
            'reference' => 'reference', 
            'walkway_area' => 'walkway_area', 
            'admin_area' => 'admin_area', 
            'walkway_name' => 'walkway_name', 
            'walkway_title' => 'walkway_title', 
            'walkway_address' => 'walkway_address', 
            'location_lat' => 'location_lat', 
            'location_lng' => 'location_lng', 
            'parking' => 'parking', 
            'fully_distance' => 'fully_distance', 
            'kilometers' => 'kilometers', 
            'description' => 'description', 
            'state' => 'state', 
            'traffic' => 'traffic', 
            'walk_hours' => 'walk_hours', 
            'rule_description' => 'rule_description', 
            'altitude_meters' => 'altitude_meters', 
            'tip' => 'tip', 
            'roadmap' => 'roadmap', 
            'titlepage' => 'titlepage'
        );
    }



    public static function insertWalkway($walkway_id,$walkway_part_area,$level,$reference,
                                        $walkway_area,$admin_area,$walkway_name,$walkway_title,
                                        $walkway_address,$location_lat,$location_lng,$parking,
                                        $fully_distance,$kilometers,$description,$state,$traffic,
                                        $walk_hours,$rule_description,$altitude_meters,$tip,
                                        $roadmap,$titlepage){
        try{
            $news = new Walkway();
            $news->walkway_id=$walkway_id;
            $news->walkway_part_area=$walkway_part_area;
            $news->level=$level;
            $news->reference=$reference;
            $news->walkway_area=$walkway_area;
            $news->admin_area=$admin_area;
            $news->walkway_name=$walkway_name;
            $news->walkway_title=$walkway_title;
            $news->walkway_address=$walkway_address;
            $news->location_lat=$location_lat;
            $news->location_lng=$location_lng;
            $news->parking=$parking;
            $news->fully_distance=$fully_distance;
            $news->kilometers=$kilometers;
            $news->description=$description;
            $news->state=$state;
            $news->traffic=$traffic;
            $news->walk_hours=$walk_hours;
            $news->rule_description=$rule_description;
            $news->altitude_meters=$altitude_meters;
            $news->tip=$tip;
            $news->roadmap=$roadmap;
            $news->titlepage=$titlepage;

            //$news->articletype=new \Phalcon\Db\RawValue('default');
            $test= $news->save();
            var_dump($test);
            $news=null;
        } catch (\Phalcon\Exception $e) {
            echo $e->getMessage();
            exit();
        }
    }

}
