<?php defined('BASEPATH') OR exit('No direct script access allowed');

use \Slim\Http\Request;
use \Slim\Http\Response;

class MY_Application {

    private static $instance;

    public function __invoke(Request $request, Response $response, $args) {
        $path = ltrim($request->getUri()->getPath(), '/');
        $_temp = explode('/', $path, 2);
        $_class = ucfirst($_temp[0]);
        $_method = isset($_temp[1]) ? str_replace('/', '_', $_temp[1]) : 'index';
        require_once APPPATH . 'Controllers' . DS . $_class . '.php';
        if(self::$instance === null) {
            self::$instance = new $_class();
        }
        self::$instance->$_method($request, $response, $args);
    }
}
