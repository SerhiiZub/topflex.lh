<?php
/**
 * Created by PhpStorm.
 * User: Serhii Zub
 * Date: 22.06.17
 * Time: 14:41
 */

namespace ZDump;


class Autoloader
{

    public static $loader;

    public static function init()
    {
        if (self::$loader == NULL)
            self::$loader = new self();

        return self::$loader;
    }

    public function __construct()
    {
        spl_autoload_register(array($this, 'autoload'));
    }

    public function autoload($class)
    {
        //echo $className."\n";

/*        $path = str_replace('\\', DS, $className);
        require_once(ZD_PATH.DS.$path);*/
/*        $className = ltrim($className, '\\');
        $fileName  = '';
        $namespace = '';
        if ($lastNsPos = strrpos($className, '\\')) {
            $namespace = substr($className, 0, $lastNsPos);
            $className = substr($className, $lastNsPos + 1);
            $fileName  = str_replace('\\', DIRECTORY_SEPARATOR, $namespace) . DIRECTORY_SEPARATOR;
        }
        $fileName .= str_replace('_', DIRECTORY_SEPARATOR, $className) . '.php';
echo $fileName;
        require $fileName;*/

//        spl_autoload_register(function ($class){
            $class = ltrim($class, '\\');
            $file = str_replace('\\', DS, $class) . '.php';
            if (!file_exists('..'.DS.$file)){
                throw new \Exception('File '.$file.'.php not found!');
            }
            require_once '..'.DS.$file;
//        });

    }
}