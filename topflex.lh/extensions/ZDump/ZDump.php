<?php
/**
 * Created by PhpStorm.
 * User: Serhii Zub
 * Date: 22.06.17
 * Time: 14:34
 */

namespace ZDump;


use ZDump\printHelper\PrintManager;

class ZDump
{
    private static $instance;

    public function __construct()
    {
        defined('DS') or define('DS', DIRECTORY_SEPARATOR);
        defined('ZD_PATH') or define('ZD_PATH', dirname(__FILE__));
        require_once 'Autoloader.php';
        Autoloader::init();

    }
    
    public function test(){
        echo __CLASS__.'->'.__METHOD__.'();';
    }

    public static function debug()
    {
        if (self::$instance == null) {
            self::$instance = new self();
        }
        self::$instance->print();
    }

    public function __destruct()
    {
//        die('tut');
//        $view = new PrintManager();
//        $view->render('index', array('data' => '123'));
    }

    public function print()
    {
//        die('tut');
        $view = new PrintManager();
        echo $view->render('index', array('data' => '123456'));
    }
}