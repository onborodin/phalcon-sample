<?php

use Phalcon\Mvc\Model;

class Suser extends Model {

    public $id;
    public $name;
    public $gecos;
    public $password;

    public function initialize() {
        $this->setSource("suser");
    }

    public function getSource() {
        return 'suser';
    }

    public static function find($parameters = null) {
        return parent::find($parameters);
    }

    public static function findFirst($parameters = null) {
        return parent::findFirst($parameters);
    }

    public function columnMap() {
        return [
            'id' => 'id',
            'name' => 'name',
            'gecos' => 'gecos',
            'password' => 'password'
        ];
    }

}
