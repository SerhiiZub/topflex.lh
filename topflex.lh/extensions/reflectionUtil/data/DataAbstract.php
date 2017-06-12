<?php
/**
 * Created by PhpStorm.
 * User: Серега
 * Date: 12.06.2017
 * Time: 19:33
 */

namespace reflectionUtil\data;


abstract class DataAbstract
{
    private $type;
    private $name;
    private $value;
    private $isUserDefined;
    private $isInternal;
    private $isAbstract;
    private $isPublic;
    private $isProtected;
    private $isPrivate;
    private $isStatic;
    private $source;

    public function __set($name, $value){
        $this->$name = $value;
    }

    public function __get($name){
        if (isset($this->$name)){
            return $this->$name;
        }
        return null;
    }
    
    abstract protected function process();
    
    abstract public function init($data);
}