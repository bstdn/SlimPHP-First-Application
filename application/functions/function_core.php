<?php defined('BASEPATH') OR exit('No direct script access allowed');

define('MY_CLIM_CORE_FUNCTION', true);

if(!function_exists('p')) {
    function p() {
        $argc = func_get_args();
        echo '<pre>';
        foreach($argc as $var) {
            print_r($var);
            echo '<br/>';
        }
        echo '</pre>';
        exit;

        return;
    }
}

if(!function_exists('pr')) {
    function pr() {
        $argc = func_get_args();
        echo '<pre>';
        foreach($argc as $var) {
            print_r($var);
            echo '<br/>';
        }
        echo '</pre>';
    }
}

function getglobal($key, $group = null) {
    global $_G;
    $key = explode('/', $group === null ? $key : $group.'/'.$key);
    $v = &$_G;
    foreach($key as $k) {
        if(!isset($v[$k])) {
            return null;
        }
        $v = &$v[$k];
    }

    return $v;
}

function dintval($int, $allowarray = false) {
    $ret = intval($int);
    if($int == $ret || !$allowarray && is_array($int)) return $ret;
    if($allowarray && is_array($int)) {
        foreach($int as &$v) {
            $v = dintval($v, true);
        }

        return $int;
    } elseif($int <= 0xffffffff) {
        $l = strlen($int);
        $m = substr($int, 0, 1) == '-' ? 1 : 0;
        if(($l - $m) === strspn($int,'0987654321', $m)) {
            return $int;
        }
    }

    return $ret;
}
