<?php

namespace app\modules\user;

use yii\console\Application as ConsoleApplication;
use Yii;
use yii\base\BootstrapInterface;

/**
 * user module definition class
 */
class Module extends \yii\base\Module
{
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'app\modules\user\controllers';

    /**
     * @var int
     */
    public $passwordResetTokenExpire = 3600;

    /**
     * @var int
     */
    public $emailConfirmTokenExpire = 259200; // 3 days
/*    public function bootstrap($app)
    {
        $app->i18n->translations['modules/user/*'] = [
            'class' => 'yii\i18n\PhpMessageSource',
            'sourceLanguage' => 'en-US',
            'forceTranslation' => true,
            'basePath' => '@app/modules/user/messages',
            'fileMap' => [
                'modules/user/module' => 'module.php',
            ],
        ];
    }*/

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        if (Yii::$app instanceof ConsoleApplication) {
            $this->controllerNamespace = 'app\modules\user\commands';
        }
    }

    public static function t($category, $message, $params = [], $language = null)
    {
        return Yii::t('modules/user/' . $category, $message, $params, $language);
    }
}
