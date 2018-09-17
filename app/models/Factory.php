<?php

use Phalcon\Mvc\Model;

class Factory extends Model {

    public $id;
    public $name;

    public function initialize() {
        $this->setSource("factory");
    }

    public function getSource() {
        return 'factory';
    }

    public static function find($parameters = null) {
        return parent::find($parameters);
    }

    public static function findFirst($parameters = null) {
        return parent::findFirst($parameters);
    }

}
