<?php
$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
spl_autoload_register(function ($class_name) {
    require_once(str_replace("\\", "/",  $class_name) . ".php");
});


$router = new Src\FrameWork\Router();
$router->add("/admin/{controller}/{action}",["namespace"=>"Admin"]);
$router->add("/", ['controller' => 'Home', 'action' => 'index']);
$router->add("/users/{id:[0-9]+}/show", ['controller' => 'User', 'action' => 'show']);
$router->add("/users", ['controller' => 'User', 'action' => 'index']);
$router->add("/{controller}/{action}");



$dispatcher = new Src\FrameWork\Dispatching($router);
$dispatcher->handle($path);