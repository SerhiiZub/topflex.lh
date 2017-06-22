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

    public function render($view, $data)
    {
        die('<h1>1234</h1>');
        ob_start();
        $content = $this->renderPartial($view, $data);
        include('views'.DS.'layout.php');
        return ob_get_clean();
    }

    public function renderPartial($view, $data)
    {
        ob_start();
        extract($data);
        include('views'.DS.$view.'.php');
        return ob_get_clean();
    }
}