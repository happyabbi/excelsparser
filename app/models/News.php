<?php

class News extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var string
     */
    public $news_id;

    /**
     *
     * @var string
     */
    public $created;

    /**
     *
     * @var string
     */
    public $modified;

    /**
     *
     * @var string
     */
    public $state;

    /**
     *
     * @var string
     */
    public $news_photo_thumbnail;

    /**
     *
     * @var string
     */
    public $news_title;

    /**
     *
     * @var string
     */
    public $news_content;

    /**
     *
     * @var string
     */
    public $news_photo;

    /**
     *
     * @var string
     */
    public $news_published_date;

    /**
     *
     * @var integer
     */
    public $news_author;

    /**
     *
     * @var string
     */
    public $shortUrl;

    /**
     *
     * @var string
     */
    public $articletype;

    /**
     * Independent Column Mapping.
     */
    public function columnMap()
    {
        return array(
            'news_id' => 'news_id', 
            'created' => 'created', 
            'modified' => 'modified', 
            'state' => 'state', 
            'news_photo_thumbnail' => 'news_photo_thumbnail', 
            'news_title' => 'news_title', 
            'news_content' => 'news_content', 
            'news_photo' => 'news_photo', 
            'news_published_date' => 'news_published_date', 
            'news_author' => 'news_author', 
            'shortUrl' => 'shortUrl', 
            'articletype' => 'articletype'
        );
    }

    public function notSave()
    {
        //Obtain the flash service from the DI container
        $flash = $this->getDI()->getFlash();

        //Show validation messages
        foreach ($this->getMessages() as $message) {
            $flash->error($message);
        }
    }

    public static function InsertNews($news_id,$state,$news_photo,$news_photo_thumbnail,$news_title,$news_content,$news_author){
      try{
            $news = new News();
            $news->news_id=$news_id;
            $news->created=null;
            $news->modified=null;
            $news->state=$state;
            $news->news_photo_thumbnail=$news_photo_thumbnail;
            $news->news_title=$news_title;
            $news->news_content=$news_content;
            $news->news_photo=$news_photo;
            $news->news_published_date=null;
            $news->news_author=$news_author;
            $news->shortUrl="";
            $news->articletype=new \Phalcon\Db\RawValue('default');
            $test= $news->save();
            var_dump($test);
            $news=null;
        } catch (\Phalcon\Exception $e) {
            echo $e->getMessage();
          exit();
        }
    }
}
