<?php 
#
# $Id$
#
use Phalcon\Config;

define('BASE_PATH', realpath(dirname(__FILE__) . '/../..'));
define('APP_PATH', BASE_PATH . '/app');

return new Config([
    'database' => [
        'adapter'     => 'Mysql',
        'host'        => 'localhost',
        'username'    => 'phalcon',
        'password'    => 'pazzword',
        'dbname'      => 'phalcon',
        'charset'     => 'utf8',
    ],
    'application' => [
        'appDir'         => APP_PATH . '/',
        'controllersDir' => APP_PATH . '/controllers/',
        'modelsDir'      => APP_PATH . '/models/',
        'migrationsDir'  => APP_PATH . '/migrations/',
        'viewsDir'       => APP_PATH . '/views/',
        'pluginsDir'     => APP_PATH . '/plugins/',
        'libraryDir'     => APP_PATH . '/library/',
        'cacheDir'       => BASE_PATH . '/cache/',
    ]
]);
#EOF

