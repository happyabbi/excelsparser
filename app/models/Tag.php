<?php

class Tag extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var string
     */
    public $code;

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
            'code' => 'code', 
            'name' => 'name'
        );
    }

    public static function getCode($tagName)
    {
        try{
            $tag = Tag::findFirst("name = '{$tagName}'");
            return $tag->code;
        }
        catch (\Phalcon\Exception $e)
        {
            echo $e->getMessage();
            echo "tagName:".$tagName;
            exit();
        }

    }

}
