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

        $n_data = Demo_query::caller()->fetch_all();
        pr('$n_data', $n_data);

        $i_data = Demo_item::caller()->fetch_all();
        pr('$i_data', $i_data);
    }

    public function item_first(Request $request, Response $response) {
        $view_data = [
            'head_title' => 'item_first',
            'title'      => 'item_first',
        ];

        return $this->view($request, $response, $view_data);
    }
}
