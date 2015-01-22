<?php

class Autoencode extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var string
     */
    public $code_type;

    /**
     *
     * @var integer
     */
    public $code_max;

    /**
     *
     * @var integer
     */
    public $code_count;

    /**
     *
     * @var string
     */
    public $code_head;

    /**
     * Independent Column Mapping.
     */
    public function columnMap()
    {
        return array(
            'code_type' => 'code_type', 
            'code_max' => 'code_max', 
            'code_count' => 'code_count', 
            'code_head' => 'code_head'
        );
    }

    public static function generateAutoEncode($type){
        $autoencode=Autoencode::findFirst("code_type='{$type}'");

        if (!$autoencode)
            throw new \Phalcon\Exception('no data');

        $codeMax=$autoencode->code_max;
        $codeCount = $autoencode->code_count + 1;
        $codeHead = $autoencode->code_head;

        $value = str_pad($codeCount, $codeMax-strlen($codeHead), '0', STR_PAD_LEFT);    //補零
        $value = $codeHead . $value;
        $autoencode->code_count = $codeCount;
        $autoencode->save();
        return $value;
    }

}
