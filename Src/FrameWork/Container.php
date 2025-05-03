<?php
declare(strict_types=1);
namespace Framework;

use Closure;
use ReflectionClass;
use ReflectionNamedType;
use InvalidArgumentException;

class Container{
    private array $registry=[];
    public function set(string $name,Closure $value){
        $this->registry[$name] = $value;
    }
    public function get(string $class_name): object
    {
        if (array_key_exists($class_name, $this->registry)) {
            return $this->registry[$class_name]();
        }
        $dependencies = [];
        $class = new ReflectionClass($class_name);
        $constractor = $class->getConstructor();
        if ($constractor === null){
            return new $class_name;
        }
        foreach ($constractor->getParameters() as $parameter) {
            $type =$parameter->getType();
            if($type === null){
                throw new InvalidArgumentException("No type hint for parameter {$parameter->getName()} in {$class_name} constructor.");
            }
            if( ! ($type instanceof ReflectionNamedType)){
                throw new InvalidArgumentException("Parameter {$parameter->getName()} in {$class_name} constructor is not a class type.");
            }
            if($type->isBuiltin()){
                throw new InvalidArgumentException("Parameter {$parameter->getName()} in {$class_name} constructor is a built-in type.");
            }
            $dependencies[] = $this->get((string)$type);
        }
        // var_dump($dependencies, $class);
        return  new $class_name(...$dependencies);
    }
}