<?php
/**
 * Created by PhpStorm.
 * User: Серега
 * Date: 12.06.2017
 * Time: 20:30
 */

namespace reflectionUtil\data;

use ReflectionClass;
use reflectionUtil\ReflectionUtil;
use yii\base\Exception;

class ObjectData extends DataAbstract
{
    protected $properties;
    protected $methods;

    public function __construct()
    {
        $this->type = 'object';
    }

    protected function process()
    {
        var_dump($this->name);

//        if(!empty($this->name)){
//            die(123);
            $reflectionClass = new ReflectionClass($this->name);
//            var_dump($reflectionClass);
            ReflectionUtil::classData($reflectionClass, $this);
            $this->source = ReflectionUtil::getClassSource($reflectionClass);
//            var_dump($this);
//        }
       
    }

    public function init($data)
    {
       if(is_object($data)){
           $this->name = get_class($data);
           $this->value = $data;
           $this->process();
//           die($this->name);
           return;
       }
        throw new Exception("is not object");
    }


}