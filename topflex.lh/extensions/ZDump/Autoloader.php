<?php
/**
 * Created by PhpStorm.
 * User: Serhii Zub
 * Date: 22.06.17
 * Time: 14:41
 */

namespace ZDump;

# временный костыль //TODO доделать автолоадер
require_once 'printHelper/PrintManager.php';
require_once 'printHelper/PrintHelper.php';

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
            $class = ltrim($class, '\\');
            $file = str_replace('\\', DS, $class) . '.php';
            if (!file_exists('..'.DS.$file)){
                throw new \Exception('File '.$file.'.php not found!');
            }
            require_once '..'.DS.$file;
    }
}