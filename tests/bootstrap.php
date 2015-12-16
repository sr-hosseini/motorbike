<?php
ini_set('display_errors',1);
error_reporting(E_ALL);

/**
* Define some useful constants
*/
define('BASE_DIR', dirname(__DIR__));
define('APP_DIR', BASE_DIR . '/app');

/**
* Read the configuration
*/
$config = include APP_DIR . '/config/config.php';

$loader = new \Phalcon\Loader();

/**
 * We're a registering a set of directories taken from the configuration file
 */
$loader->registerNamespaces(array(
    'MotorBike\Models' => $config->application->modelsDir,
    'MotorBike\Controllers' => $config->application->controllersDir,
    'MotorBike\Forms' => $config->application->formsDir,
    'MotorBike' => $config->application->libraryDir,
    'Test\MotorBike' => $config->application->testsDir . 'Test'
));

$loader->register();

// Use composer autoloader to load vendor classes
require_once __DIR__ . '/../vendor/autoload.php';

/**
* Read services
*/
include APP_DIR . '/config/services.php';

//$di = FactoryDefault::getDefault();
//
//$di->remove('db');
//
//DI::reset();
//
//// Add any needed services to the DI here
//
//DI::setDefault($di);