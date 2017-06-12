<?php
namespace reflectionUtil;

/**
 * Created by PhpStorm.
 * User: Серега
 * Date: 12.06.2017
 * Time: 22:22
 */


class ClassAutoloader {
    public function __construct() {
//        set_include_path(__DIR__.'data');
        set_include_path('data');
        spl_autoload_register(array($this, 'loader'));
    }
    private function loader($className) {
//        echo 'Trying to load ', $className, ' via ', __METHOD__, "()\n";
//        (str_replace("\\", "/", $pClassName));
        include str_replace("\\", "/", '../'.$className) . '.php';
//        include $className . '.php';
    }
}

use reflectionUtil\data\ArrayData;

//set_include_path(__DIR__.'data');
//spl_autoload_extensions('.php,.class.php');
//spl_autoload_register();

/*class Autoloader
{
    public static function Register() {
        set_include_path(__DIR__.'data');
        return spl_autoload_register(array('Autoloader', 'Load'));
    }

    public static function Load($strObjectName) {
        if(class_exists($strObjectName) === false) {
            return false;
        }

        $strObjectFilePath = BASE_PATH . $strObjectName . '.php';

        if((file_exists($strObjectFilePath) === false) || (is_readable($strObjectFilePath) === false)) {
            return false;
        }

        require($strObjectFilePath);
    }
}

if(!defined('BASE_PATH')) {
    define('BASE_PATH', dirname(__FILE__) . DIRECTORY_SEPARATOR);
    require BASE_PATH . 'Autoloader.php';
    Autoloader::Register();
}*/
error_reporting(E_ALL);
ini_set("display_errors", 1);


$autoloader = new ClassAutoloader();
$data = new ArrayData();
$discovery = new DiscoverDataFactory($data);
var_dump($discovery->obj);

//var_dump(new \ReflectionClass('reflectionUtil\data\ArrayData'));
