<?php 

use Phalcon\Mvc\Model;

class Product extends Model {

    public $id;
    public $name;
    public $factory_id;

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
