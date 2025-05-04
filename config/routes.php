<?php


$router = new Framework\Router();

$router->add("/", ["controller" => "Home", "action" => "index"]);
$router->add("/home", ["controller" => "Home", "action" => "index"]);
$router->add("/users", ["controller" => "Users", "action" => "index" , "middleware" => 'auth']);
$router->add("/users/store",["controller" => "Users", "action" => "store", "method" => "POST", 'middleware' => 'trim|auth']);
$router->add("/{controller}/{id:\d+}/show",['action' => 'show' , 'middleware' => 'trim|auth']);    
$router->add("/{controller}/{id:\d+}/edit",['action' => 'edit' ,'middleware' => 'trim|auth']);    
$router->add("/{controller}/{id:\d+}/update",['action' => 'update','method' => 'POST','middleware' => 'trim|auth']);    
$router->add("/{controller}/{id:\d+}/destroy",['action' => 'destroy' ,'method' => 'POST' ,'middleware' => 'trim|auth']);  
$router->add("/login",["controller"=> "Authenticate", "action" => "index" , "namespace" => "Auth"]);
$router->add("/login/auth",["controller"=> "Authenticate", "action" => "authenticate", "method" => "POST" , "namespace" => "Auth" ,'middleware' => 'trim']);
$router->add("/logout",["controller"=> "Authenticate", "action" => "destroy", "method" => "POST" , "namespace" => "Auth" ,"middleware" => 'auth']);
$router->add("/register",["controller"=> "Register", "action" => "index" , "namespace" => "Auth"]);
$router->add("/register/store",["controller"=> "Register", "action" => "store" ,"method"=>"POST", "namespace" => "Auth",'middleware' => 'trim']);
$router->add("/{controller}/{action}");
$router->add("/admin/{controller}/{action}", ["namespace" => "Admin"]);

return $router;