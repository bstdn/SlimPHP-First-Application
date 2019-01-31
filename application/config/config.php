<?php defined('BASEPATH') OR exit('No direct script access allowed');

$config['displayErrorDetails'] = (ENVIRONMENT !== 'production');

$config['log']['channel'] = 'my_logger';
$config['log']['path'] = APPPATH . 'logs/app.log';

$config['db']['1']['dbhost'] = '';
$config['db']['1']['dbuser'] = '';
$config['db']['1']['dbpw'] = '';
$config['db']['1']['dbcharset'] = 'utf8';
$config['db']['1']['pconnect'] = '0';
$config['db']['1']['dbname'] = '';
$config['db']['1']['tablepre'] = '';

$config['security']['querysafe']['status'] = 1;
$config['security']['querysafe']['dfunction']['0'] = 'load_file';
$config['security']['querysafe']['dfunction']['1'] = 'hex';
$config['security']['querysafe']['dfunction']['2'] = 'substring';
$config['security']['querysafe']['dfunction']['3'] = 'if';
$config['security']['querysafe']['dfunction']['4'] = 'ord';
$config['security']['querysafe']['dfunction']['5'] = 'char';
$config['security']['querysafe']['daction']['0'] = '@';
$config['security']['querysafe']['daction']['1'] = 'intooutfile';
$config['security']['querysafe']['daction']['2'] = 'intodumpfile';
$config['security']['querysafe']['daction']['3'] = 'unionselect';
$config['security']['querysafe']['daction']['4'] = '(select';
$config['security']['querysafe']['daction']['5'] = 'unionall';
$config['security']['querysafe']['daction']['6'] = 'uniondistinct';
$config['security']['querysafe']['dnote']['0'] = '/*';
$config['security']['querysafe']['dnote']['1'] = '*/';
$config['security']['querysafe']['dnote']['2'] = '#';
$config['security']['querysafe']['dnote']['3'] = '--';
$config['security']['querysafe']['dnote']['4'] = '"';
$config['security']['querysafe']['dlikehex'] = 1;
$config['security']['querysafe']['afullnote'] = '0';
