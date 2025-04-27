<?php
$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
spl_autoload_register(function ($class_name) {
    require_once('src/'.str_replace("\\", "/",  $class_name) . ".php");
});


$router = new Framework\Router();

$router->add("/admin/{controller}/{action}",["namespace"=>"Admin"]);
$router->add("/users/{slug:[/w-]+}", ["controller" => "Users", "action" => "index"]);
$router->add("/", ["controller" => "Home", "action" => "index"]);
$router->add("/home", ["controller" => "Home", "action" => "index"]);
$router->add("/users", ["controller" => "Users", "action" => "index"]);
$router->add("/users/{id}/show", ["controller" => "Users", "action" => "show"]);
$router->add("/{controller}/{id:\d+}/{action}");

$dispatcher = new Framework\Dispatcher($router);
$dispatcher->handle($path);