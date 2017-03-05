<?php
use vendor\core\Router;

$query =trim($_SERVER['QUERY_STRING'], '/');

define('WWW', __DIR__);
define('ROOT', dirname(__DIR__));
define('CORE', dirname(__DIR__).'vendor/core');
define('LIBS', dirname(__DIR__).'/vendor/libs');
define('APP', dirname(__DIR__).'/app');
define('IMG',  '/img');
define('LAYOUT', 'default');

require '../vendor/libs/functions.php';

spl_autoload_register(function ($class){
    $file = ROOT . '/' . str_replace('\\','/',$class). '.php';
    if(is_file($file)){
        require_once $file;
    }
});

//defaults routes
Router::add('^admin/index/(?P<order>[a-z-]+)/?(?P<asc>[a-z-]+)?/?$', ['controller' => 'Admin', 'action' => 'index']);
Router::add('^create/?$', ['controller' => 'Main', 'action' => 'create']);
Router::add('^$', ['controller' => 'Main', 'action' => 'index']);
Router::add('^(?P<controller>[a-z-]+)/?(?P<action>[a-z-]+)?$');

Router::dispatch($query);


