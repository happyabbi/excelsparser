<?php

class UserQuestionItem extends \Phalcon\Mvc\Model
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
    public $question_id;

    /**
     *
     * @var string
     */
    public $item;

    /**
     *
     * @var integer
     */
    public $sequence;

    /**
     * Independent Column Mapping.
     */
    public function columnMap()
    {
        return array(
            'sn' => 'sn', 
            'question_id' => 'question_id', 
            'item' => 'item', 
            'sequence' => 'sequence'
        );
    }

    public static function InsertItems($question_id,$item,$sequence){
        $userQuestionItem = new UserQuestionItem();
        $userQuestionItem->question_id=$question_id;
        $userQuestionItem->item=$item;
        $userQuestionItem->sequence=$sequence;
        $userQuestionItem->save();
        $userQuestionItem=null;
    }

}
