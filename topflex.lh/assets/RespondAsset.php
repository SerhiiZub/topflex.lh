<?php
/**
 * Created by PhpStorm.
 * User: Serhii Zub
 * Date: 01.06.17
 * Time: 17:42
 */

namespace app\assets;


use yii\web\AssetBundle;
use yii\web\View;

class RespondAsset extends AssetBundle
{
    public $sourcePath = '@bower/respond/dest';
    public $js = [
        'respond.min.js',
    ];
    public $jsOptions = [
        'condition'=>'lt IE 9',
        'position' => View::POS_HEAD,
    ];
}