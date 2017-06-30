<?php
/**
 * Created by PhpStorm.
 * User: Serhii Zub
 * Date: 22.06.17
 * Time: 14:52
 */

use ZDump\ZDump;
use ZDump\test\Test;

//defined('DS') or define('DS', DIRECTORY_SEPARATOR);
//defined('ZD_PATH') or define('ZD_PATH', dirname(__FILE__).DS);

/*spl_autoload_register(function ($class){
    $class = ltrim($class, '\\');
    $file = str_replace('\\', DS, $class) . '.php';
    if (!file_exists('..'.DS.$file)){
        throw new \Exception('File '.$file.'.php not found!');
    }
    require_once '..'.DS.$file;
});*/

require_once 'ZDump.php';


$d = new ZDump();
$d->test();
$t = new Test();
$t->index();