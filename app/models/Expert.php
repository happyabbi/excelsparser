<?php

use Phalcon\Mvc\Model\Validator\Email as Email;

class Expert extends \Phalcon\Mvc\Model
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
     *
     * @var string
     */
    public $email;

    /**
     *
     * @var string
     */
    public $thumbnail;

    /**
     *
     * @var string
     */
    public $intro;

    /**
     * Validations and business logic
     */
    public function validation()
    {

        $this->validate(
            new Email(
                array(
                    'field'    => 'email',
                    'required' => true,
                )
            )
        );
        if ($this->validationHasFailed() == true) {
            return false;
        }
    }

    /**
     * Independent Column Mapping.
     */
    public function columnMap()
    {
        return array(
            'id' => 'id', 
            'name' => 'name', 
            'email' => 'email', 
            'thumbnail' => 'thumbnail', 
            'intro' => 'intro'
        );
    }

    public static function  getExpertId($expertName)
    {
        $expert = Expert::findFirst("name = '{$expertName}'");
        return $expert->id;
    }

}
