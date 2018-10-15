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


use Phalcon\Mvc\Dispatcher as MvcDispatcher;
use Phalcon\Events\Event;
use Phalcon\Events\Manager as EventsManager;

require "..//app/lib.php";

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
                        'action' => 'hello' 
                ]);


                $router->add('/domain/list', [
                        'controller' => 'domain',
                        'action' => 'list'
                ]);
                $router->add('/domain/add/form', [
                        'controller' => 'domain',
                        'action' => 'addForm'
                ]);
                $router->add('/domain/add/handler', [
                        'controller' => 'domain',
                        'action' => 'addHandler'
                ]);


                $router->add('/domain/update/form', [
                        'controller' => 'domain',
                        'action' => 'updateForm'
                ]);
                $router->add('/domain/update/handler', [
                        'controller' => 'domain',
                        'action' => 'updateHandler'
                ]);


                $router->add('/domain/delete/form', [
                        'controller' => 'domain',
                        'action' => 'deleteForm'
                ]);
                $router->add('/domain/delete/handler', [
                        'controller' => 'domain',
                        'action' => 'deleteHandler'
                ]);


                $router->add('/user/list', [
                        'controller' => 'user',
                        'action' => 'list'
                ]);
                $router->add('/user/add/form', [
                        'controller' => 'user',
                        'action' => 'addForm'
                ]);
                $router->add('/user/add/handler', [
                        'controller' => 'user',
                        'action' => 'addHandler'
                ]);

                $router->add('/user/update/form', [
                        'controller' => 'user',
                        'action' => 'updateForm'
                ]);
                $router->add('/user/update/handler', [
                        'controller' => 'user',
                        'action' => 'updateHandler'
                ]);

                $router->add('/user/delete/form', [
                        'controller' => 'user',
                        'action' => 'deleteForm'
                ]);
                $router->add('/user/delete/handler', [
                        'controller' => 'user',
                        'action' => 'deleteHandler'
                ]);



                $router->add('/alias/list', [
                        'controller' => 'alias',
                        'action' => 'list'
                ]);
                $router->add('/alias/add/form', [
                        'controller' => 'alias',
                        'action' => 'addForm'
                ]);
                $router->add('/alias/add/handler', [
                        'controller' => 'alias',
                        'action' => 'addHandler'
                ]);


                $router->add('/alias/update/form', [
                        'controller' => 'alias',
                        'action' => 'updateForm'
                ]);
                $router->add('/alias/update/handler', [
                        'controller' => 'alias',
                        'action' => 'updateHandler'
                ]);

                $router->add('/alias/delete/form', [
                        'controller' => 'alias',
                        'action' => 'deleteForm'
                ]);
                $router->add('/alias/delete/handler', [
                        'controller' => 'alias',
                        'action' => 'deleteHandler'
                ]);

                $router->add('/suser/list', [
                        'controller' => 'suser',
                        'action' => 'list'
                ]);
                $router->add('/suser/add/form', [
                        'controller' => 'suser',
                        'action' => 'addForm'
                ]);
                $router->add('/suser/add/handler', [
                        'controller' => 'suser',
                        'action' => 'addHandler'
                ]);

                $router->add('/suser/update/form', [
                        'controller' => 'suser',
                        'action' => 'updateForm'
                ]);
                $router->add('/suser/update/handler', [
                        'controller' => 'suser',
                        'action' => 'updateHandler'
                ]);

                $router->add('/suser/delete/form', [
                        'controller' => 'suser',
                        'action' => 'deleteForm'
                ]);
                $router->add('/suser/delete/handler', [
                        'controller' => 'suser',
                        'action' => 'deleteHandler'
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
        $pluginsDir = $this->config->application->pluginsDir;
        $utilsDir = $this->config->application->utilsDir;


        $loader->registerDirs([
                $controllersDir,
                $modelsDir,
                $pluginsDir,
                $utilsDir
        ]);
        $loader->register();
    }

    public function registerDispatchService() {

        $this->di->set('dispatcher',
                function () {
                    $eventsManager = new EventsManager();

                    //$eventsManager->attach('dispatch',
                    //    function (Event $event, $dispatcher) {
                    //        // ...
                    //    }
                    //);

                    $eventsManager->attach('dispatch:beforeExecuteRoute', new SecurityPlugin);

                    $dispatcher = new MvcDispatcher();
                    $dispatcher->setEventsManager($eventsManager);
                    return $dispatcher;
                },
                true
        );
    }

    public function main() {
        $this->registerServices();
        $this->registerAutoloaders();
        $this->registerDispatchService();

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
