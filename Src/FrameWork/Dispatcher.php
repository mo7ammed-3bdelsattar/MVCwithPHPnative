<?php

namespace Framework;

use ReflectionMethod;

class Dispatcher
{
    public function __construct(private Router $router) {}
    public function handle(string $path)
    {
        $params = $this->router->match($path);

        if ($params === false) {
            echo "404";
            exit;
        }

        $controller = $this->getControllerName($params);
        $action = $this->getActionName($params);
        $controller_obj = new $controller;

        $args = $this->getActionArguments($controller, $action, $params);
        $controller_obj->$action(...$args);
    }
    private function getActionArguments(string $controller, string $action, array $params): array
    {
        $args = [];
        $method = new ReflectionMethod($controller, $action);
        foreach ($method->getParameters() as $parameter) {
            $name = $parameter->getName();
            $args[$name] = $params[$name];
        }
        return $args;
    }
    private function getControllerName(array $params): string
    {
        $controller = str_replace('-','',ucwords(strtolower($params['controller']) ,'-'));
        $namespace="App\Controllers";
        if (array_key_exists("namespace", $params)) { 
            $namespace .= $params['namespace'];
        }
        return  $namespace."\\". $controller;
    }
    private function getActionName(array $params):string{
        $action = $params['action'];
        $action =lcfirst(str_replace("-","",ucwords(strtolower($action), '-')));
        return $action;
    }
}
