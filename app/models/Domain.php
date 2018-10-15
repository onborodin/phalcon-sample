<?php

use Phalcon\Mvc\Model;

class Domain extends Model {

    public $id;
    public $name;

    public function initialize() {
        $this->setSource("domain");
        $this->hasMany("id", "User", "domain_id");
    }

    public function getSource() {
        return 'domain';
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
            'name' => 'name'
        ];
    }

}
