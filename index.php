<?php

define('DIR', __DIR__);

function my_autoloader($class) { 
    // Заменяем обратные слэши на прямые
    $class = str_replace('\\', DIRECTORY_SEPARATOR, $class);
    $file = DIR . DIRECTORY_SEPARATOR . $class . '.php';
    
    if (file_exists($file)) {
        include $file; 
    } else {
        throw new Exception("Файл не найден: " . $file);
    }
}

spl_autoload_register("my_autoloader");
session_start();

require_once './modul/Helpers.php';

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
if(file_exists(DIR . str_replace('\\', DIRECTORY_SEPARATOR, $class) . '.php')) {
    $obj = new $class();
    $obj->index();
} else {
    http_response_code(404);
    include './views/error.php';
}