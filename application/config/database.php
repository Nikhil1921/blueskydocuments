<?php defined('BASEPATH') OR exit('No direct script access allowed');

$active_group = 'default';
$query_builder = TRUE;

switch ($_SERVER['SERVER_NAME']) {
    case 'www.bluesky.com':
    case 'bluesky.com':
    case 'https://www.bluesky.com':
    case 'https://bluesky.com':
        $db['default'] = array(
            'dsn'   => '',
            'hostname' => 'localhost',
            'username' => 'carefajd_cft',
            'password' => '(+TF?d.wOluY',
            'database' => 'carefajd_cft',
            'dbdriver' => 'mysqli',
            'dbprefix' => '',
            'pconnect' => (ENVIRONMENT !== 'production'),
            'db_debug' => (ENVIRONMENT !== 'production'),
            'cache_on' => FALSE,
            'cachedir' => '',
            'char_set' => 'utf8',
            'dbcollat' => 'utf8_general_ci',
            'swap_pre' => '',
            'encrypt' => FALSE,
            'compress' => FALSE,
            'stricton' => FALSE,
            'failover' => array(),
            'save_queries' => TRUE
        );
        break;
    case 'www.demo.denseteklearning.com':
    case 'demo.denseteklearning.com':
    case 'https://www.demo.denseteklearning.com':
    case 'https://demo.denseteklearning.com':
        $db['default'] = array(
            'dsn'   => '',
            'hostname' => 'localhost',
            'username' => 'denseeqq_demo',
            'password' => 'demo@321',
            'database' => 'denseeqq_bluesky_documents',
            'dbdriver' => 'mysqli',
            'dbprefix' => '',
            'pconnect' => (ENVIRONMENT !== 'production'),
            'db_debug' => (ENVIRONMENT !== 'production'),
            'cache_on' => FALSE,
            'cachedir' => '',
            'char_set' => 'utf8',
            'dbcollat' => 'utf8_general_ci',
            'swap_pre' => '',
            'encrypt' => FALSE,
            'compress' => FALSE,
            'stricton' => FALSE,
            'failover' => array(),
            'save_queries' => TRUE
        );
        break;
    
    default:
        $db['default'] = array(
            'dsn'   => '',
            'hostname' => 'localhost',
            'username' => 'root',
            'password' => '',
            'database' => 'bluesky_documents',
            'dbdriver' => 'mysqli',
            'dbprefix' => '',
            'pconnect' => (ENVIRONMENT !== 'production'),
            'db_debug' => (ENVIRONMENT !== 'production'),
            'cache_on' => FALSE,
            'cachedir' => '',
            'char_set' => 'utf8',
            'dbcollat' => 'utf8_general_ci',
            'swap_pre' => '',
            'encrypt' => FALSE,
            'compress' => FALSE,
            'stricton' => FALSE,
            'failover' => array(),
            'save_queries' => TRUE
        );
        break;
}