<?php

/**
 * Created by PhpStorm.
 * User: Серега
 * Date: 10.06.2017
 * Time: 20:10
 */
class ReflectionUtil
{
    
    public function getArgs(ReflectionClass $class, $methodName)
    {
        $details = array();
        $method = $class->getMethod($methodName);
        $params = $method->getParameters();
        foreach ($params as $param){
            $details[] = $this->argData($param);
        }
        return $details;
    }

    public function argData(ReflectionParameter $arg)
    {
        $details = array();
        $declaringClass = $arg->getDeclaringClass();
        $name = $arg->getName();
        $class = $arg->getClass();
        $position = $arg->getPosition();
        $details[] = "\$$name position $position";
        if (!empty($class)){
            $className = $class->getName();
            $details[] = "\$$name must be object type of $className";
        }

        if ($arg->isPassedByReference()){
            $details[] = "\$$name passed by reference";
        }

        if ($arg->isDefaultValueAvailable()){
            $def = $arg->getDefaultValue();
            $details[] = "\$$name default value: $def";
        }
        return $details;
    }

    public static function getMethodSource(ReflectionMethod $method)
    {
        $path = $method->getFileName();
        $lines = @file($path);
        $from = $method->getStartLine();
        $to = $method->getEndLine();
        $len = $to - $from + 1;
        return implode(array_slice($lines, $from-1, $len));
    }

    public function getMethods(ReflectionClass $class)
    {
        $details = array();
        $methods = $class->getMethods();

        foreach ($methods as $method){
            $details[] = $this->methodData($method);
        }

        return $details;
    }

    public function methodData(ReflectionMethod $method)
    {
        $details = array();

        $name = $method->getName();

        if ($method->isUserDefined()){
            $details[] = $name.' -- method user defined';
        }
        if ($method->isInternal()){
            $details[] = $name.' -- internal method';
        }
        if ($method->isAbstract()){
            $details[] = $name.' -- abstract method';
        }
        if ($method->isPublic()){
            $details[] = $name.' -- public method';
        }
        if ($method->isProtected()){
            $details[] = $name.' -- protected method';
        }
        if ($method->isPrivate()){
            $details[] = $name.' -- private method';
        }
        if ($method->isStatic()){
            $details[] = $name.' -- static method';
        }
        if ($method->isFinal()){
            $details[] = $name.' -- final method';
        }
        if ($method->isConstructor()){
            $details[] = $name.' -- constructor method';
        }
        if ($method->returnsReference()){
            $details[] = $name.' -- method returns reference';
        }
        return $details;
    }

    public static function getClassSource(ReflectionClass $class)
    {
        $path = $class->getFileName();
        $lines = @file($path);
        $from = $class->getStartLine();
        $to = $class->getEndLine();
        $len = $to - $from + 1;
        return implode(array_slice($lines, $from-1, $len));
    }

    public function classData(ReflectionClass $class)
    {
        $details = array();
        $name = $class->getName();

        if ($class->isUserDefined()){
            $details[] = "$name -- класс определен пользователем";
        }
        if ($class->isInternal()){
            $details[] = "$name -- встроенный класс";
        }
        if ($class->isInterface()){
            $details[] = "$name -- интерфейс";
        }
        if ($class->isAbstract()){
            $details[] = "$name -- абстрактный класс";
        }
        if ($class->isFinal()){
            $details[] = "$name -- финальный класс";
        }
        if ($class->isInstantiable()){
            $details[] = "$name -- можно создать экземпляр класса";
        } else {
            $details[] = "$name -- нельзя создать экземпляр класса";
        }
        if ($class->isCloneable()){
            $details[] = "$name -- можно клонировать";
        } else {
            $details[] = "$name -- нельзя клонировать";
        }
        return $details;
    }
}