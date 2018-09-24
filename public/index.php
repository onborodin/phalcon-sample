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

use Phalcon\Http\Response\Cookies;

use Phalcon\Session\Adapter\Files as Session;
use Phalcon\Crypt;
use Phalcon\Security;
use Phalcon\Config;
use Phalcon\Config\Adapter\Ini as ConfigAdapter;

function varDump($var = null) {
    echo '<html>';
    echo '<body>';
    echo '<pre>';
    var_dump($di);
    echo '</pre>';
    echo '</body>';
    echo '</html>';
}


class MyApplication extends Application {

    protected function registerServices() {

        $di = new FactoryDefault();
        $this->setDI($di);

        $this->di->setShared('config',
            function () {
                $filename = realpath(dirname(__FILE__) . '/../app/config/config.ini');
                $config = new ConfigAdapter($filename);
                return $config;
            }
        );


        $cacheDir = $this->config->application->cacheDir;
        $this->di->set('viewCache',
            function () use ($cacheDir) {
                $frontCache = new FrontData([ 
                        'lifetime' => 172800 
                ]);

                $cache = new BackFile(
                        $frontCache, [
                        'cacheDir' => $cacheDir,
                ]);
                return $cache;
            }
        );

        $this->di->set('crypt',
            function () {
                $crypt = new Crypt();
                $crypt->setCipher('aes-256-ctr');
                $key = "thesuperkey";
                $crypt->setKey($key);
                return $crypt;
            }
        );

        $this->di->set('cookies',
            function () {
                $cookies = new Cookies();
                $cookies->useEncryption(false);
                return $cookies;
            }
        );

        $this->di->setShared('session',
            function () {
                $session = new Session([
                    'uniqueId' => 'AppID',
                    'persistent' => false,
                    'lifetime'   => 3600
                ]);
                session_name('sessID');
                $session->start();
                return $session;
            }
        );

        $this->di->set('security',
            function () {
                $security = new Security();
                $security->setWorkFactor(12);
                return $security;
            },
            true
        );

        $this->di->setShared("router", 
            function () {
                $router = new Router(false);
                $router->removeExtraSlashes(true);

                $router->setDefaults([
                        'controller' => 'index',
                        'action'     => 'hello'
                ]);

                $router->add('/', [ 
                        'controller' => 'index', 
                        'action' => 'index' 
                ]);

                $router->add('/hello', [
                        'controller' => 'index',
                        'action' => 'index' 
                ]);

                $router->add('/login', [
                        'controller' => 'index',
                        'action' => 'login' 
                ]);

                $router->add('/logout', [
                        'controller' => 'index',
                        'action' => 'logout'
                ]);

                $router->add('/download', [
                        'controller' => 'index',
                        'action' => 'download'
                ]);

                $router->add('/factory/list', [
                        'controller' => 'factory',
                        'action' => 'list'
                ]);

                $router->add('/factory/add', [
                        'controller' => 'factory',
                        'action' => 'add'
                ]);

                $router->add('/factory/drop', [
                        'controller' => 'factory',
                        'action' => 'drop'
                ]);


                $router->add('/product/list', [
                        'controller' => 'product',
                        'action' => 'list'
                ]);

                $router->add('/product/add', [
                        'controller' => 'product',
                        'action' => 'add'
                ]);

                $router->add('/product/drop', [
                        'controller' => 'product',
                        'action' => 'drop'
                ]);

                $router->notFound([
                        'controller' => 'index',
                        'action' => 'notfound'
                ]);


                return $router;
        });

        $this->di->set('url',
            function () {
                $url = new UrlProvider();
                $url->setBaseUri('/');
                return $url;
            }
        );

        $viewsDir = $this->config->application->viewsDir;
        $this->di->setShared("view",
            function () use ($viewsDir) {
                $view = new View();
                $view->setViewsDir($viewsDir);
                return $view;
            }
        );


        $dbname = $this->config->database->dbname;
        $db = $this->config->database->dbname;

        $this->di->set("db",
            function () use ($dbname) {
                return new Database([
                        "dbname" => $dbname,
                ]);
            }
        );

    }

    protected function registerAutoloaders() {
        $loader = new Loader();

        $controllersDir = $this->config->application->controllersDir;
        $modelsDir = $this->config->application->modelsDir;

        $loader->registerDirs([
                $controllersDir,
                $modelsDir
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
    //$app->useImplicitView(false); // Disable automatic rendering
    $app->main();

} catch (\Exception $e) {
    $response = new Response();
    $response->setContentType('text/html', 'UTF-8');
    $response->setStatusCode(404);
    $response->setContent("<html><body><pre>Exeption: " . $e->getMessage() . "</pre></body></html>");
    $response->send();
}
#EOF
