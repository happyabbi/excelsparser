<?php

class Feature extends \Phalcon\Mvc\Model
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
    public $name;

    /**
     * Independent Column Mapping.
     */
    public function columnMap()
    {
        return array(
            'id' => 'id', 
            'name' => 'name'
        );
    }

    public static function getId($Name)
    {
        try{
            $feature = Feature::findFirst("name = '{$Name}'");
            return $feature->id;
        }
        catch (\Phalcon\Exception $e)
        {
            echo $e->getMessage();
            echo "$Name:".$Name;
            exit();
        }

    }

}
