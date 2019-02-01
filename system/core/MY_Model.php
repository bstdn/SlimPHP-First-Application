<?php defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Model {

    public $config = [];

    protected $_model = [];
    protected $_table;

    public function __construct() {
        global $_G;
        $this->config = $_G['settings'];
        $this->_init_db();
        $this->_init_table();
    }

    private function _init_db() {
        if(!class_exists('DB')) {
            require_once BASEPATH . 'database/DB.php';
            $driver = 'db_driver_mysqli';
            DB::init($driver, $this->config['db']);
        }

        global $container;
        if(!isset($container['db'])) {
            $container['db'] = function() {
                $capsule = new \Illuminate\Database\Capsule\Manager;
                $capsule->addConnection($this->config['db']);
                $capsule->setAsGlobal();
                $capsule->bootEloquent();

                return $capsule;
            };
        }
    }

    protected function _init_table() {
        global $container;
        if($this->_table && !isset($this->_model[$this->_table])) {
            $this->_model[$this->_table] = $container->get('db')->table($this->_table);
        }
    }

    /**
     * @param string $table
     * @return mixed|\Illuminate\Database\Query\Builder
     */
    public function model($table = '') {
        return $this->_model[$table ?: $this->_table];
    }

    /**
     * @return self|$this
     */
    final public static function caller() {
        static $object;
        if(empty($object)) {
            $class = get_called_class();
            $object = new $class;
        }

        return $object;
    }
}
