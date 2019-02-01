<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Demo_item extends MY_Model {

    protected $_table = 'demo';

    public function fetch_all() {
        return $this->model()->get();
    }
}
