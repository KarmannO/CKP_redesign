<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;

$js = <<< JS
/* To initialize BS3 tooltips set this below */
$(function () { 
    $("[data-toggle='tooltip']").tooltip(); 
});;
/* To initialize BS3 popovers set this below */
$(function () { 
    $("[data-toggle='popover']").popover(); 
});
JS;
// Register tooltip/popover initialization javascript
$this->registerJs($js);
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
    .top-panel-container > div > .btn {
        background-color: lightgray;
        color: darkslategray;
    }

    .top-panel-container > div > .btn:hover {
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
            <a href="/user/data" class="btn"><?= Yii::$app->user->identity->email ?>&nbsp;<span class="glyphicon glyphicon-user"></span></a>
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
                <div class="left-subpanel-element" id="my-data">
                    <span class="glyphicon glyphicon-user"></span>&nbsp;&nbsp;Мои данные
                </div>
                <div class="left-subpanel-element">
                    <span class="glyphicon glyphicon-list-alt"></span>&nbsp;&nbsp;Мои заявки
                </div>
                <div class="left-subpanel-element">
                    <span class="glyphicon glyphicon-pencil"></span>&nbsp;&nbsp;Заполнить заявку
                </div>
            </div>
            <?php
            if(Yii::$app->user->can('ckp_admin_panel_access')) {
                ?>
                <div class="left-panel-element" id="ckp-panel">
                    Панель ЦКП
                    <span class="glyphicon glyphicon-menu-down"></span>
                </div>
                <div class="left-subpanel" id="ckp-subpanel">
                    <div class="left-subpanel-element" id="my-ckp">
                        <span class="glyphicon glyphicon-list-alt"></span>&nbsp;&nbsp;Мои ЦКП
                    </div>
                    <div class="left-subpanel-element">
                        <span class="glyphicon glyphicon-user"></span>&nbsp;&nbsp;Пользователи ЦКП
                    </div>
                    <div class="left-subpanel-element">
                        <span class="glyphicon glyphicon-list"></span>&nbsp;&nbsp;Заявки ЦКП
                    </div>
                    <div class="left-subpanel-element" id="construct-service">
                        <span class="glyphicon glyphicon-wrench"></span>&nbsp;&nbsp;Конструктор услуг
                    </div>
                    <div class="left-subpanel-element">
                        <span class="glyphicon glyphicon-hdd"></span>&nbsp;&nbsp;Оборудование ЦКП
                    </div>
                </div>
                <?php
            }
            ?>
            <?php
            if(Yii::$app->user->can('is_admin_panel_access'))
            {
                ?>
                <div class="left-panel-element" id="is-panel">
                    Панель ИС
                    <span class="glyphicon glyphicon-menu-down"></span>
                </div>
                <div class="left-subpanel" id="is-subpanel">
                    <div class="left-subpanel-element">
                        <span class="glyphicon glyphicon-user"></span>&nbsp;&nbsp;Пользователи ИС
                    </div>
                    <div class="left-subpanel-element" id="ckp-full-list">
                        <span class="glyphicon glyphicon-list"></span>&nbsp;&nbsp;Список ЦКП
                    </div>
                    <div class="left-subpanel-element">
                        <span class="glyphicon glyphicon-lock"></span>&nbsp;&nbsp;Управление правами
                    </div>
                    <div class="left-subpanel-element" id="activities">
                        <span class="glyphicon glyphicon-flag"></span>&nbsp;&nbsp;События в ИС
                    </div>
                </div>
                <?php
            }
            ?>
            <div class="left-panel-element" id="info-panel">
                Информация
                <span class="glyphicon glyphicon-menu-down"></span>
            </div>
            <div class="left-subpanel" id="info-subpanel">
                <div class="left-subpanel-element">
                    <span class="glyphicon glyphicon-book"></span>&nbsp;&nbsp;Справочники
                </div>
                <div class="left-subpanel-element">
                    <span class="glyphicon glyphicon-info-sign"></span>&nbsp;&nbsp;О системе
                </div>
                <div class="left-subpanel-element">
                    <span class="glyphicon glyphicon-earphone"></span>&nbsp;&nbsp;Контакты
                </div>
            </div>
        </div>
        <div class="content-container">
            <div class="container-fluid">
                <?= $content ?>
            </div>
        </div>
    </div>
</div>

<script>
    (function($){
        $.fn.serializeObject = function(){

            var self = this,
                json = {},
                push_counters = {},
                patterns = {
                    "validate": /^[a-zA-Z][a-zA-Z0-9_]*(?:\[(?:\d*|[a-zA-Z0-9_]+)\])*$/,
                    "key":      /[a-zA-Z0-9_]+|(?=\[\])/g,
                    "push":     /^$/,
                    "fixed":    /^\d+$/,
                    "named":    /^[a-zA-Z0-9_]+$/
                };


            this.build = function(base, key, value){
                base[key] = value;
                return base;
            };

            this.push_counter = function(key){
                if(push_counters[key] === undefined){
                    push_counters[key] = 0;
                }
                return push_counters[key]++;
            };

            $.each($(this).serializeArray(), function(){

                // skip invalid keys
                if(!patterns.validate.test(this.name)){
                    return;
                }

                var k,
                    keys = this.name.match(patterns.key),
                    merge = this.value,
                    reverse_key = this.name;

                while((k = keys.pop()) !== undefined){

                    // adjust reverse_key
                    reverse_key = reverse_key.replace(new RegExp("\\[" + k + "\\]$"), '');

                    // push
                    if(k.match(patterns.push)){
                        merge = self.build([], self.push_counter(reverse_key), merge);
                    }

                    // fixed
                    else if(k.match(patterns.fixed)){
                        merge = self.build([], k, merge);
                    }

                    // named
                    else if(k.match(patterns.named)){
                        merge = self.build({}, k, merge);
                    }
                }

                json = $.extend(true, json, merge);
            });

            return json;
        };
    })(jQuery);

    $(document).ready(function () {
        $('.left-panel-container').mCustomScrollbar({ theme: 'rounded' });
    });

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

    $('#info-panel').on('click', function () {
        if($('#info-subpanel').css('display') == 'none') {
            $('#info-subpanel').slideDown();
            $('#info-panel > span').removeClass('glyphicon-menu-down');
            $('#info-panel > span').addClass('glyphicon-menu-up');
        }
        else {
            $('#info-subpanel').slideUp();
            $('#info-panel > span').removeClass('glyphicon-menu-up');
            $('#info-panel > span').addClass('glyphicon-menu-down');
        }
    });

    $('#my-data').on('click', function () {
        window.location = '/user/data';
    });

    $('#my-ckp').on('click', function () {
        window.location = '/ckp/my';
    });

    $('#construct-service').on('click', function () {
        window.location = '/constructor/construct';
    });

    $('#activities').on('click', function () {
        window.location = '/admin/activities';
    });

    $('#ckp-full-list').on('click', function () {
        window.location = '/ckp/full';
    });
</script>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
