<?php

use Phalcon\Di;
use Phalcon\Mvc\Model;
use Phalcon\Mvc\Model\Manager as ModelsManager;
#use Phalcon\Db\Adapter\Pdo\Sqlite as Database;
use Phalcon\Db\Adapter\Pdo\Mysql as Database;
use Phalcon\Mvc\Model\Metadata\Memory as MetaData;

$di = new Di();

#$di->set('db',
#    new Connection([
#            'dbname' => 'sample.db',
#    ])
#);

$di->set("db",
    function () {
        return new Database(                    [
                "adapter"  => "Mysql",
                "host"     => "localhost",
                "username" => "phalcon",
                "password" => "pazzword",
                "dbname"   => "phalcon",
        ]);
    }
);

$di->set(
    'modelsManager',
    new ModelsManager()
);

$di->set(
    'modelsMetadata',
    new MetaData()
);

class Products extends Model {
    public $id;
    public $name;
}


$products = new Products;

//$products->name = "zurg";
$products->save([ name => "zurb"]);

echo $products->count();

$p = $products->find();

foreach ($p as $product) {
    echo $product->id . " " . $product->name . "\n";
}

#EOF
