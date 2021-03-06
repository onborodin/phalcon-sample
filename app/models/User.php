<?php

use Phalcon\Mvc\Model;

class User extends Model {

    public $id;
    public $domainId;
    public $name;
    public $gecos;
    public $password;

    public function initialize() {
        $this->setSource("user");
        $this->belongsTo("domainId", "Domain", "id");
    }

    public function getSource() {
        return 'user';
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
            'domain_id' => 'domainId',
            'name' => 'name',
            'gecos' => 'gecos',
            'password' => 'password'
        ];
    }

}
