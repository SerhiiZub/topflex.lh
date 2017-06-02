<?php
/**
 * Created by PhpStorm.
 * User: Serhii Zub
 * Date: 02.06.17
 * Time: 13:50
 */

namespace app\components\grid;


//use yii\grid\ActionColumn;

class ActionColumn extends \yii\grid\ActionColumn
{
    public $contentOptions = [
        'class' => 'action-column',
    ];
}