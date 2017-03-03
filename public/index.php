<?php

use vendor\core\Router;
$query =trim($_SERVER['QUERY_STRING'], '/');


define('WWW', __DIR__);
define('ROOT', dirname(__DIR__));
define('CORE', dirname(__DIR__).'vendor/core');
define('LIBS', dirname(__DIR__).'/vendor/libs');
define('APP', dirname(__DIR__).'/app');
define('LAYOUT', 'default');

//require '../vendor/core/Router.php';
require '../vendor/libs/functions.php';


spl_autoload_register(function ($class){
    $file = ROOT . '/' . str_replace('\\','/',$class). '.php';
    if(is_file($file)){
        require_once $file;
    }
});

//defaults routes
Router::add('^$', ['controller' => 'Main', 'action' => 'index']);
Router::add('^(?P<controller>[a-z-]+)/?(?P<action>[a-z-]+)?$');
//Router::add('^(?P<controller>[a-z-]+)/?$', ['action' => 'index']);

Router::dispatch($query);


