<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use app\components\widgets\Alert;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title = Yii::$app->name) ?></title>
<!--    <title>--><?//= Html::encode($this->title) ?><!--</title>-->
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => Yii::$app->name,
//        'brandLabel' => 'My Company',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    /*echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => [
            ['label' => 'Home', 'url' => ['/main/default/index']],
            ['label' => 'About', 'url' => ['/main/default/about']],
            ['label' => 'Contact', 'url' => ['/main/contact/index']],
            Yii::$app->user->isGuest ? (
                ['label' => 'Login', 'url' => ['/user/default/login']]
            ) : (
                '<li>'
                . Html::beginForm(['/user/default/logout'], 'post')
                . Html::submitButton(
                    'Logout (' . Yii::$app->user->identity->username . ')',
                    ['class' => 'btn btn-link logout']
                )
                . Html::endForm()
                . '</li>'
            )
        ],
    ]);*/
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => array_filter([
            ['label' => Yii::t('app', 'NAV_HOME'), 'url' => ['/main/default/index']],
            ['label' => Yii::t('app', 'NAV_ABOUT'), 'url' => ['/main/default/about']],
            ['label' => Yii::t('app', 'NAW_CONTACT'), 'url' => ['/main/contact/index']],
            Yii::$app->user->isGuest ?
                ['label' => Yii::t('app', 'NAV_SIGNUP'), 'url' => ['/user/default/signup']] :
                false,
            !Yii::$app->user->isGuest ?
                ['label' => Yii::t('app', 'NAV_PROFILE'), 'url' => ['/user/profile/index']] :
                false,
            Yii::$app->user->isGuest ?
                ['label' => Yii::t('app', 'NAV_LOGIN'), 'url' => ['/user/default/login']] :
                ['label' => Yii::t('app', 'NAV_LOGOUT').': ' . Yii::$app->user->identity->username ,
                    'url' => ['/user/default/logout'],
                    'linkOptions' => ['data-method' => 'post']],
            !Yii::$app->user->isGuest ?
                ['label' => Yii::t('app', 'NAV_ADMIN'), 'items' => [
                    ['label' => Yii::t('app', 'NAV_ADMIN'), 'url' => ['/admin/default/index']],
                    ['label' => Yii::t('app', 'NAV_ADMIN_USERS'), 'url' => ['/admin/users/index']],
                ]] :
                false,
        ]),
    ]);
    NavBar::end();
    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; <?= Yii::$app->name ?> <?= date('Y') ?></p>
<!--        <p class="pull-left">&copy; My Company --><?//= date('Y') ?><!--</p>-->

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
