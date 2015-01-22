<?php

class UserQuestions extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var string
     */
    public $question_id;

    /**
     *
     * @var string
     */
    public $question;

    /**
     *
     * @var integer
     */
    public $answer;

    /**
     *
     * @var string
     */
    public $content;

    /**
     *
     * @var string
     */
    public $state;

    /**
     *
     * @var string
     */
    public $level;

    public static function InsertQuestion($question_id,$question,$answer,$content,$state,$level){
        $userQuestions = new UserQuestions();
        $userQuestions->question_id=$question_id;
        $userQuestions->question=$question;
        $userQuestions->answer=$answer;
        $userQuestions->content=$content;
        $userQuestions->state=$state;
        $userQuestions->level=$level;
        $userQuestions->save();
        $userQuestions=null;
    }

    /**
     * Independent Column Mapping.
     */
    public function columnMap()
    {
        return array(
            'question_id' => 'question_id', 
            'question' => 'question', 
            'answer' => 'answer', 
            'content' => 'content', 
            'state' => 'state', 
            'level' => 'level'
        );
    }
}

?>
