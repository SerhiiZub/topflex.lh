<?php
///*$params = require(__DIR__ . '/params.php');
//$dbParams = require(__DIR__ . '/_test_db.php');
//
///**
// * Application configuration shared by all test types
// */
//return [
//    'id' => 'basic-tests',
//    'basePath' => dirname(__DIR__),
//    'language' => 'en-US',
//    'components' => [
//        'db' => $dbParams,
//        'mailer' => [
//            'useFileTransport' => true,
//        ],
//        'assetManager' => [
//            'basePath' => __DIR__ . '/../web/assets',
//        ],
//        'urlManager' => [
//            'showScriptName' => true,
//        ],
//        'user' => [
//            'identityClass' => 'app\modules\user\models\User',
//        ],
//        'request' => [
//            'cookieValidationKey' => 'test',
//            'enableCsrfValidation' => false,
//            // but if you absolutely need it set cookie domain to localhost
//            /*
//            'csrfCookie' => [
//                'domain' => 'localhost',
//            ],
//            */
//        ],
//    ],
//    'params' => $params,
//];*/

return [
    'basePath' => dirname(__DIR__),
    'id' => 'basic-tests',
    'language' => 'en-US',
    'components' => [
        'mailer' => [
            'useFileTransport' => true,
        ],
        'urlManager' => [
            'showScriptName' => true,
        ],
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'sqlite:../_data;'
        ],
    ],
];
