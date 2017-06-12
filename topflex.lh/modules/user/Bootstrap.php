<?php
/**
 * Created by PhpStorm.
 * User: Serhii Zub
 * Date: 02.06.17
 * Time: 16:36
 */

namespace app\modules\user;

use yii\base\BootstrapInterface;
use Yii;

class Bootstrap implements BootstrapInterface
{
    public function bootstrap($app)
    {
        $app->i18n->translations['modules/user/*'] = [
            'class' => 'yii\i18n\PhpMessageSource',
            'forceTranslation' => true,
            'basePath' => '@app/modules/user/messages',
            'fileMap' => [
                'modules/user/module' => 'module.php',
            ],
        ];
    }
}