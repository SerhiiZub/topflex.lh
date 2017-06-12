<?php

namespace reflectionUtil;

use reflectionUtil\data\ScalarData;
use reflectionUtil\data\ArrayData;
use reflectionUtil\data\ObjectData;
use reflectionUtil\data\ResourceData;

/**
 * Created by PhpStorm.
 * User: Серега
 * Date: 10.06.2017
 * Time: 21:10
 */
class DiscoverDataFactory
{
    public $obj;
    public function __construct($data){
        $type = gettype($data);
        $obj = $this->getObject($type);
        $obj->init($data);
        $this->obj = $obj;
    }
    
    public function getObject($type){
        switch ($type){
            case 'boolean':
            case 'integer':
            case 'float':
            case 'string':
            case 'NULL':
                return new ScalarData();
                break;
            case 'array':
                return new ArrayData();
                break;
            case 'object':
                return new ObjectData();
                break;
            case 'resource':
                return new ResourceData();
                break;
            case 'mixed':
                break;
            case 'number':
                break;
            case 'callback':
                break;
            default:
                return null;
        }
        return null;
    }

}