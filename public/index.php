<?php

use \Slim\Http\Request;
use \Slim\Http\Response;

define('DS', DIRECTORY_SEPARATOR);
define('TIME_ZONE', 'Asia/Shanghai');
date_default_timezone_set(TIME_ZONE);

$system_path = dirname(__DIR__) . '/system';
$application_folder = dirname(__DIR__) . '/application';
define('BASEPATH', $system_path . DS);
define('APPPATH', $application_folder . DS);
define('VIEWPATH', APPPATH . 'views' . DS);

if(file_exists(__DIR__ . DS . 'config.php')) {
    require __DIR__ . DS . 'config.php';
}

define('ENVIRONMENT', isset($_SERVER['SLIM_ENV']) ? $_SERVER['SLIM_ENV'] : 'development');

switch(ENVIRONMENT) {
    case 'development':
        error_reporting(-1);
        ini_set('display_errors', 1);
        break;
    case 'testing':
    case 'production':
        ini_set('display_errors', 0);
        if(version_compare(PHP_VERSION, '5.3', '>=')) {
            error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED & ~E_STRICT & ~E_USER_NOTICE & ~E_USER_DEPRECATED);
        } else {
            error_reporting(E_ALL & ~E_NOTICE & ~E_STRICT & ~E_USER_NOTICE);
        }
        break;
    default:
        header('HTTP/1.1 503 Service Unavailable.', true, 503);
        echo 'The application environment is not set correctly.';
        exit(1);
}

require_once BASEPATH . 'core/MY_Slim.php';

require '../vendor/autoload.php';

$container = MY_Slim::instance()->init()->get_container();

$app = new \Slim\App($container);

$app->get('/', function(Request $request, Response $response, $args) {
    return $response->write("Hello world");
});

$app->get('/home', 'MY_Application');
$app->get('/home/item', 'MY_Application');
$app->get('/home/item/first', 'MY_Application');

$app->run();
