<?php
/**
 * Created by PhpStorm.
 * User: Serhii Zub
 * Date: 01.06.17
 * Time: 17:41
 */

namespace app\assets;


use yii\web\AssetBundle;
use yii\web\View;

class Html5ShivAsset extends AssetBundle
{
    public $sourcePath = '@bower/html5shiv/dist';
    public $js = [
        'html5shiv.min.js',
    ];
    public $jsOptions = [
        'condition'=>'lt IE 9',
        'position' => View::POS_HEAD,
    ];
}