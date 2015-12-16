<?php
use Phalcon\DI;
use Phalcon\DI\FactoryDefault;

ini_set('display_errors',1);
error_reporting(E_ALL);

define('ROOT_PATH', __DIR__);
define('PATH_LIBRARY', __DIR__ . '/../app/library/');
define('PATH_SERVICES', __DIR__ . '/../app/services/');
define('PATH_RESOURCES', __DIR__ . '/../app/resources/');

set_include_path(
    ROOT_PATH . PATH_SEPARATOR . get_include_path()
);

// Required for phalcon/incubator
include __DIR__ . "/../vendor/autoload.php";

// Use the application autoloader to autoload the classes
// Autoload the dependencies found in composer
$loader = new \Phalcon\Loader();
//
//$loader->registerDirs(
//    array(
//        ROOT_PATH
//    )
//);

$loader->registerNamespaces(array(
    'MotorBike\Test' => ROOT_PATH . DIRECTORY_SEPARATOR . 'Test'
));

$loader->register();

$di = new FactoryDefault();
DI::reset();

// Add any needed services to the DI here

DI::setDefault($di);