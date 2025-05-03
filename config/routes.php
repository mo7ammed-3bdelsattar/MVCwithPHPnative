<?php


$router = new Framework\Router();

$router->add("/", ["controller" => "Home", "action" => "index"]);
$router->add("/home", ["controller" => "Home", "action" => "index"]);
$router->add("/users", ["controller" => "Users", "action" => "index"]);
$router->add("/users/store",["controller" => "Users", "action" => "store", "method" => "POST", 'middleware' => 'trim']);
$router->add("/{controller}/{id:\d+}/show",['action' => 'show' , 'middleware' => 'trim']);    
$router->add("/{controller}/{id:\d+}/edit",['action' => 'edit']);    
$router->add("/{controller}/{id:\d+}/update",['action' => 'update','method' => 'POST','middleware' => 'trim']);    
$router->add("/{controller}/{id:\d+}/destroy",['action' => 'destroy' ,'method' => 'POST']);    
$router->add("/{controller}/{action}");
$router->add("/admin/{controller}/{action}", ["namespace" => "Admin"]);

return $router;