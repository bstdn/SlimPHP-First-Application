<?php defined('BASEPATH') OR exit('No direct script access allowed');

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Slim\Views\PhpRenderer;

class MY_PhpView extends PhpRenderer {

    protected $_theme       = 'default';
    protected $_layout      = '';
    protected $_cached_data = [];

    /**
     * MY_PhpView constructor.
     * @param string $templatePath
     */
    public function __construct($templatePath = "") {
        parent::__construct($templatePath ?: VIEWPATH);
    }

    /**
     * @param RequestInterface $request
     * @param ResponseInterface $response
     * @param array $data
     * @param null $template
     * @return mixed|ResponseInterface
     */
    public function view(RequestInterface $request, ResponseInterface $response, array $data = [], $template = null) {
        if(is_null($template)) {
            $path = ltrim($request->getUri()->getPath(), '/');
            $_temp = explode('/', $path, 2);
            $_class = strtolower($_temp[0]);
            $_method = isset($_temp[1]) ? str_replace('/', '_', $_temp[1]) : 'index';
            $template = $_class . '/' . $_method;
        }
        if($this->_layout) {
            $content = $this->_view($response, "{$this->_theme}/{$template}", $data, true);

            return $this->_view($response, "{$this->_theme}/_layouts/{$this->_layout}", ['content' => $content]);
        } else {
            return $this->_view($response, "{$this->_theme}/{$template}", $data);
        }
    }

    /**
     * @param ResponseInterface $response
     * @param $template
     * @param array $data
     * @param bool $return
     * @return mixed|ResponseInterface
     */
    protected function _view(ResponseInterface $response, $template, array $data = [], $return = false) {
        $_ext = pathinfo($template, PATHINFO_EXTENSION);
        $template = ($_ext === '') ? $template . '.php' : $template;
        $this->_cached_data = array_merge($this->_cached_data, $data);
        if($return === true) {
            return parent::fetch($template, $this->_cached_data);
        }

        return parent::render($response, $template, $this->_cached_data);
    }
}
