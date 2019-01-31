<?php defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Model {

    public $config = [];

    public function __construct() {
        global $_G;
        $this->config = $_G['settings'];
        $this->_init_db();
    }

    private function _init_db() {
        require_once BASEPATH . 'database/DB.php';
        $driver = 'db_driver_mysqli';
        DB::init($driver, $this->config['db']);
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
