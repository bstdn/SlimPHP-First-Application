<?php defined('BASEPATH') OR exit('No direct script access allowed');

use \Slim\Http\Request;
use \Slim\Http\Response;

class MY_Slim {

    private $var = [];

    protected $initiated = false;

    /** @var \Slim\Container $container */
    protected $container;

    public function __construct() {
        spl_autoload_register(function($classname) {
            $file = BASEPATH . 'core' . DS . $classname . '.php';
            if(file_exists($file)) {
                require_once $file;
            }
            $class_info = explode('_', $classname);
            $name = strtolower(current($class_info));
            $file = APPPATH . 'models' . DS . $name . DS . $classname . '.php';
            if(file_exists($file)) {
                require_once $file;
            }
        });
        $this->_init_env();
        $this->_init_config();
    }

    public static function &instance() {
        static $object;
        if(empty($object)) {
            $object = new self();
        }

        return $object;
    }

    public function init() {
        if(!$this->initiated) {
            $this->_init_container();
            $this->_init_noFound();
            $this->_init_logger();
        }
        $this->initiated = true;

        return $this;
    }

    private function _init_env() {
        if(!defined('MY_CLIM_CORE_FUNCTION')) {
            include APPPATH . 'functions' . DS . 'function_core.php';
        }

        global $_G;
        $_G = array(
            'settings' => [],
        );

        $this->var = & $_G;
    }

    private function _init_config() {
        $config = [];
        require APPPATH . 'config' . DS . 'config.php';
        if(file_exists($file_path = APPPATH.'config/'.ENVIRONMENT.'/config.php')) {
            require $file_path;
        }
        $this->var['settings'] = & $config;
    }

    private function _init_container() {
        if(!$this->container) {
            $this->container = new \Slim\Container($this->var);
        }
    }

    private function _init_noFound() {
        $this->container['notFoundHandler'] = function() {
            return function(Request $request, Response $response) {
                $view_data = [
                    'home_url' => (string)$request->getUri()->withPath('')->withQuery('')->withFragment(''),
                ];
                return (new MY_PhpView())->view($request, $response, $view_data, 'notfound');
            };
        };
    }

    private function _init_logger() {
        $this->container['logger'] = function(\Slim\Container $c) {
            $logger = null;
            if($c->get('settings')['log']['channel'] && $c->get('settings')['log']['path']) {
                $logger = new \Monolog\Logger($c->get('settings')['log']['channel']);
                $file_handler = new \Monolog\Handler\StreamHandler($c->get('settings')['log']['path']);
                $logger->pushHandler($file_handler);
            }

            return $logger;
        };
    }

    public function get_container() {
        return $this->container;
    }
}
