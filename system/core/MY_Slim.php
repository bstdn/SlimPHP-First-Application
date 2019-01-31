<?php defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Slim {

    private $var = [];

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

    /**
     * @return \Slim\Container
     */
    public function getContainer() {
        $container = new \Slim\Container($this->var);

        return $container;
    }
}
