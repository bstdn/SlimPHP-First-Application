<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Demo_list extends MY_Model {

    protected $_table = 'demo';

    public function fetch_all() {
        return DB::fetch_all('SELECT * FROM %t', [$this->_table]);
    }
}
