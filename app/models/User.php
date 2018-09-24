<?php
#
# $Id$
#
use \Phalcon\Mvc\Model;

class User extends Model {

    public $id;
    public $login;
    public $password;
    public $name;

    public function initialize() {
        $this->setSource("user");
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

}
#EOF

