<?php

require_once './modul/Helpers.php';

function my_autoloader($class) { 
    $class = str_replace('\\', DIRECTORY_SEPARATOR, $class);
    $file = __DIR__ . DIRECTORY_SEPARATOR . $class . '.php';
    
    if (file_exists($file)) {
        include $file; 
    } else {
        throw new Exception("Файл не найден: " . $file);
    }
}

spl_autoload_register("my_autoloader");
session_start();

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$segments = explode('/', trim($uri, '/'));

$class = '\controllers\\';
$segmentLastCount = count($segments)-1;
foreach($segments as $key => $segment)
{
    if($key == $segmentLastCount) {    
        $class .= ucfirst($segment);
    } else {
        $class .= $segment . '\\';
    }
}

if($segments[$segmentLastCount] == '') {
    $class .= 'Index';
}

$class .= 'Controller';
if(file_exists(__DIR__ . str_replace('\\', DIRECTORY_SEPARATOR, $class) . '.php')) {
    $obj = new $class();
    $obj->index();
} else {
    http_response_code(404);
    include './views/error.php';
}