<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<style>
    .btn {
        background-color: lightgray;
        color: darkslategray;
    }

    .btn:hover {
        color: darkslategray;
    }
</style>
<?php $this->beginBody() ?>

<div class="main-container">
    <div class="top-panel-container">
        <div>
            <?php echo Html::img('@web/images/logo_large.png', ['width' => '150px']); ?>
        </div>
        <div>
            <a href="" class="btn"><?= Yii::$app->user->identity->email ?>&nbsp;<span class="glyphicon glyphicon-user"></span></a>
            &nbsp;&nbsp;
            <a href="/site/logout" data-method="post" class="btn">Выход &nbsp;<span class="glyphicon glyphicon-off"></span></a>
        </div>
    </div>
    <div class="right-page-container">
        <div class="left-panel-container">
            <div class="left-panel-element" id="user-panel">
                Личный кабинет
                <span class="glyphicon glyphicon-menu-down"></span>
            </div>
            <div class="left-subpanel" id="user-subpanel">
                <div class="left-subpanel-element">
                    <span class="glyphicon glyphicon-user"></span>&nbsp;&nbsp;Мои данные
                </div>
                <div class="left-subpanel-element">
                    <span class="glyphicon glyphicon-list-alt"></span>&nbsp;&nbsp;Мои заявки
                </div>
                <div class="left-subpanel-element">
                    <span class="glyphicon glyphicon-pencil"></span>&nbsp;&nbsp;Заполнить заявку
                </div>
            </div>
            <div class="left-panel-element" id="ckp-panel">
                Панель ЦКП
                <span class="glyphicon glyphicon-menu-down"></span>
            </div>
            <div class="left-subpanel" id="ckp-subpanel">
                <div class="left-subpanel-element">
                    asdsda
                </div>
                <div class="left-subpanel-element">
                    asdsda
                </div>
                <div class="left-subpanel-element">
                    asdsda
                </div>
            </div>
            <div class="left-panel-element" id="is-panel">
                Панель ИС
                <span class="glyphicon glyphicon-menu-down"></span>
            </div>
            <div class="left-subpanel" id="is-subpanel">
                <div class="left-subpanel-element">
                    asdsda
                </div>
                <div class="left-subpanel-element">
                    asdsda
                </div>
                <div class="left-subpanel-element">
                    asdsda
                </div>
            </div>
        </div>
        <div class="content-container">
            <?= $content ?>
        </div>
    </div>
</div>

<script>
    $('#user-panel').on('click', function () {
        if($('#user-subpanel').css('display') == 'none') {
            $('#user-subpanel').slideDown();
            $('#user-panel > span').removeClass('glyphicon-menu-down');
            $('#user-panel > span').addClass('glyphicon-menu-up');
        }
        else {
            $('#user-subpanel').slideUp();
            $('#user-panel > span').removeClass('glyphicon-menu-up');
            $('#user-panel > span').addClass('glyphicon-menu-down');
        }
    });

    $('#ckp-panel').on('click', function () {
        if($('#ckp-subpanel').css('display') == 'none') {
            $('#ckp-subpanel').slideDown();
            $('#ckp-panel > span').removeClass('glyphicon-menu-down');
            $('#ckp-panel > span').addClass('glyphicon-menu-up');
        }
        else {
            $('#ckp-subpanel').slideUp();
            $('#ckp-panel > span').removeClass('glyphicon-menu-up');
            $('#ckp-panel > span').addClass('glyphicon-menu-down');
        }
    });

    $('#is-panel').on('click', function () {
        if($('#is-subpanel').css('display') == 'none') {
            $('#is-subpanel').slideDown();
            $('#is-panel > span').removeClass('glyphicon-menu-down');
            $('#is-panel > span').addClass('glyphicon-menu-up');
        }
        else {
            $('#is-subpanel').slideUp();
            $('#is-panel > span').removeClass('glyphicon-menu-up');
            $('#is-panel > span').addClass('glyphicon-menu-down');
        }
    });
</script>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
