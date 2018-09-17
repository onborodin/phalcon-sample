<?php

use Phalcon\DI;
use Phalcon\Loader;
use Phalcon\Di\FactoryDefault;


use Phalcon\Mvc\Url as UrlProvider;

use Phalcon\Mvc\Router;
use Phalcon\Mvc\Dispatcher;
use Phalcon\Mvc\View;

use Phalcon\Http\Response;
use Phalcon\Http\Request;

use Phalcon\Db\Adapter\Pdo\Sqlite as Database;

use Phalcon\Mvc\Application as Application;
use Phalcon\Mvc\Model\Metadata\Memory as MemoryMetadata;
use Phalcon\Mvc\Model\Manager as ModelsManager;

use Phalcon\Cache\Backend\File as BackFile;
use Phalcon\Cache\Frontend\Data as FrontData;

use Phalcon\Config;

define('BASE_PATH', realpath(dirname(__FILE__) . '/../'));
define('APP_PATH', BASE_PATH . '/app');


class MyApplication extends Application {

    protected function registerServices() {

        $di = new FactoryDefault();

        $di->set('viewCache', 
            function () {
                $frontCache = new FrontData([ 
                        'lifetime' => 172800 
                ]);

                $cache = new BackFile(
                        $frontCache, [
                        'cacheDir' => BASE_PATH . '/cache/',
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
                $viewsDir = APP_PATH . "/views/";
                $view->setViewsDir($viewsDir);
                    return $view;
            }
        );

        $di->set("db",
            function () {
                return new Database(                    [
                        "dbname" => BASE_PATH . "/phalcon.db",
                ]);
            }
        );

        $this->setDI($di);
    }

    protected function registerAutoloaders() {
        $loader = new Loader();
        $loader->registerDirs([
                APP_PATH . "/controllers/",
                APP_PATH . "/models/",
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
    $response->setContentType('text/html', 'UTF-8');
    $response->setStatusCode(404);
    $response->setContent("<html><pre>Exeption: " . $e->getMessage() . "</pre></html>");
    $response->send();
}
#EOF
