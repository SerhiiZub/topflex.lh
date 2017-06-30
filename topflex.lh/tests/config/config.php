<?php
/**
 * Created by PhpStorm.
 * User: Serhii Zub
 * Date: 30.06.17
 * Time: 13:54
 */
//$db = require(__DIR__ . '/../../config/db.php');
//$db['dsn'] = 'sqlite:../_data;';
return [
    'components' => [
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'sqlite:../_data/test.db;'
        ]
    ]
];