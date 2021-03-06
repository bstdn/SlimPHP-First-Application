<?php defined('BASEPATH') OR exit('No direct script access allowed');

use \Slim\Http\Request;
use \Slim\Http\Response;

class Home extends MY_Controller {

    public function index(Request $request, Response $response) {
        return $response->write('home index');
    }

    public function item() {
        $data = Demo_list::caller()->fetch_all();
        pr('$data', $data);
    }

    public function item_first(Request $request, Response $response) {
        $view_data = [
            'head_title' => 'item_first',
            'title'      => 'item_first',
        ];

        return $this->view($request, $response, $view_data);
    }
}
