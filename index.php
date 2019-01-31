<?php

//define base path, root path of our application
define('BP', __DIR__ . '/');

//enable error_reporting to see php errors
error_reporting(E_ALL);
ini_set('display_errors', 1);

//set include path, this is where included classes will be found
set_include_path(implode(PATH_SEPARATOR, array(
    BP . 'app/model',
    BP . 'app/controller',
)));

//Mapping all controllers with files
$map = scandir(BP . 'app/controller');

unset($map[0]);
unset($map[1]);
$array ='';
foreach ($map as $m) {
    $m = substr($m, 0, -4);
    $mapping["$m"] = BP . "app/controller/$m.php";
}


//mapping all models with files
$map = scandir(BP . 'app/model');

unset($map[0]);
unset($map[1]);

foreach ($map as $m) {
    $m = substr($m, 0, -4);
    $mapping["$m"] = BP . "app/model/$m.php";
}

//old mapper
//spl_autoload_register(function ($class) {
//
//    $classPath = strtr($class, '\\', DIRECTORY_SEPARATOR) . '.php';
//    return include $classPath;
//});


spl_autoload_register(function ($class) use ($mapping) {
    if (isset($mapping[$class])) {
        include $mapping[$class];
    }
}, true);

//start app
App::start();
