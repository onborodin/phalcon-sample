<?php

use Phalcon\Mvc\Model;

class Alias extends Model {

    public $id;
    public $domainId;
    public $name;
    public $list;

    public function initialize() {
        $this->setSource("alias");
        $this->belongsTo("domainId", "Domain", "id");
    }

    public function getSource() {
        return 'alias';
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
            'list' => 'list'
        ];
    }

}
