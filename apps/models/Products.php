<?php 

use Phalcon\Mvc\Model;

class Products extends Model {

    public $id;
    public $name;

    public function getSource() {
        return 'products';
    }

    public static function find($parameters = null) {
        return parent::find($parameters);
    }

    public static function findFirst($parameters = null) {
        return parent::findFirst($parameters);
    }

}
