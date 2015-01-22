<?php
/**
 * Created by PhpStorm.
 * User: abraham.chen
 * Date: 2015/1/20
 * Time: 下午 01:34
 */

require_once(dirname(dirname(dirname(__FILE__))) . '/module/readQuestionXls.php');

class ImportQuestionController extends  ControllerBase{

    public function indexAction()
    {
        $path=dirname(dirname(dirname(__FILE__))). '/excels/20150108_game.xlsx';
        $arrayData=readQuestionXlsx($path,0);
        foreach($arrayData as $v ) {
            $questionId = Autoencode::generateAutoEncode('Question_ID');
            $answer=0;
            if($v['answer']=='選項一'){
                $answer=1;
            }else if($v['answer']=='選項二'){
                $answer=2;
            }else if($v['answer']=='選項三'){
                $answer=3;
            }
            $level="";
            if($v['level']=="易"){
                $level='easy';
            }elseif($v['level']=="普通"){
                $level='normal';
            }elseif($v['level']=="難") {
                $level='hard';
            }else{
                $level='easy';
            }

            UserQuestions::InsertQuestion($questionId,$v['title'],$answer,$v['content'],null,$level);
            UserQuestionItem::InsertItems($questionId,$v['item1'],1);
            UserQuestionItem::InsertItems($questionId,$v['item2'],2);
            UserQuestionItem::InsertItems($questionId,$v['item3'],3);
        }
        echo "Success!!";
        var_dump($arrayData);
    }

}