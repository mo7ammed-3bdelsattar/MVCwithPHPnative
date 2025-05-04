<?php

declare(strict_types=1);
session_start();
define("ROOT_PATH", dirname(__DIR__));
spl_autoload_register(function ($class_name) {
    require_once (ROOT_PATH . "/src/" . str_replace("\\", "/",  $class_name) . ".php");
});
$dotenv = new Framework\Dotenv();
$dotenv->load(ROOT_PATH. "/.env");
// print_r($_ENV);
set_error_handler("Framework\ErrorHandler::handleError");
set_exception_handler("Framework\ErrorHandler::handleException");


$router=require_once(ROOT_PATH."/config/routes.php");
$container = require_once(ROOT_PATH."/config/services.php");
$middlewares=require_once(ROOT_PATH."/config/middleware.php");
$dispatcher = new Framework\Dispatcher($router, $container , $middlewares);
$request= Framework\Request::createFromGlobals();
$respose = $dispatcher->handle($request);

$respose->send();
