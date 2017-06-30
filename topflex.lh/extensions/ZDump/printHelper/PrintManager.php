<?php
/**
 * Created by PhpStorm.
 * User: Serhii Zub
 * Date: 22.06.17
 * Time: 16:59
 */

namespace ZDump\printHelper;


class PrintManager
{

    public function render($view, $data, $return = false)
    {
        ob_start();
        $content = $this->renderPartial($view, $data, true);
        include('views'.DS.'layout.php');
        $page = ob_get_clean();
        if ($return) {
            return $page;
        }
        echo $page;
    }

    /**
     * @param $view
     * @param array $data
     * @param bool $return
     * @return string|void
     */
    public function renderPartial($view, $data = array(), $return = false)
    {
        ob_start();
        extract($data);
        include('views'.DS.$view.'.php');
        $content = ob_get_clean();
        if ($return) {
            return $content;
        }
        echo $content;
    }

    public function test()
    {
        echo __METHOD__;
    }
}