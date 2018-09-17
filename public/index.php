<?php

use Phalcon\DI;

use Phalcon\Loader;
use Phalcon\Mvc\Router;

use Phalcon\Mvc\Url as UrlProvider;

use Phalcon\Mvc\Dispatcher;
use Phalcon\Http\Response;
use Phalcon\Http\Request;
use Phalcon\Mvc\View;

use Phalcon\Db\Adapter\Pdo\Mysql as Database;
use Phalcon\Mvc\Application as Application;
use Phalcon\Mvc\Model\Metadata\Memory as MemoryMetadata;
use Phalcon\Mvc\Model\Manager as ModelsManager;

use Phalcon\Cache\Backend\File as BackFile;
use Phalcon\Cache\Frontend\Data as FrontData;


class MyApplication extends Application {

    protected function registerServices() {
        $di = new DI();

        //$di->set('config', function () {
        //    $config = require '../app/config/config.php';
        //    return $config;
        //});

        $di->set('viewCache', 
            function () {
                $frontCache = new FrontData([ 
                        'lifetime' => 172800 
                ]);

                $cache = new BackFile(
                        $frontCache, [
                        'cacheDir' => '../app/cache/',
                ]);
                return $cache;
            }
        );


        $di->set("router", 
            function () {
                $router = new Router();
                $router->removeExtraSlashes(true);

                $router->add('/', [ 
                        'controller' => 'index', 
                        'action' => 'index' 
                ]);

                $router->add('/hello', [
                        'controller' => 'index',
                        'action' => 'index' 
                ]);

                //$router->add('/products/list', [
                //        'controller' => 'products',
                //        'action' => 'list'
                //]);

                $router->notFound([
                        'controller' => 'index',
                        'action' => 'notfound'
                ]);
                $router->setDefaults([
                        'controller' => 'index',
                        'action'     => 'index'
                ]);
                return $router;
        });

        $di->set("dispatcher", 
            function () {
                return new Dispatcher();
            }
        );

        $di->set("response", 
            function () {
                return new Response();
            }
        );

        $di->set("request",
            function () {
                return new Request();
            }
        );

        $di->set('url',
            function () {
                $url = new UrlProvider();
                $url->setBaseUri('/');
                return $url;
            }
        );

        $di->set("view",
            function () {
                $view = new View();
                $viewsDir = "../app/views/";
                $view->setViewsDir($viewsDir);
                    return $view;
            }
        );

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

        $di->set("modelsMetadata",
            function () {
                return new MemoryMetaData();
            }
        );

        $di->set("modelsManager",
            function () {
                return new ModelsManager();
            }
        );

        $this->setDI($di);
    }

    protected function registerAutoloaders() {
        $loader = new Loader();
        $loader->registerDirs([
                "../app/controllers/",
                "../app/models/",
        ]);
        $loader->register();
    }

    public function main() {
        $this->registerServices();
        $this->registerAutoloaders();
        $response = $this->handle();
        $response->send();
    }
}

try {
    $app = new MyApplication();
    $app->main();
} catch (\Exception $e) {
    $response = new Response();
    $response->setContentType('text/plain', 'UTF-8');
    $response->setStatusCode(404);
    $response->setContent("Exeption: " . $e->getMessage());
    $response->send();
}
#EOF
