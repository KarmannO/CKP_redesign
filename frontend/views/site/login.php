<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>

<style>
    .login-container {
        display: flex;
        flex-direction: column;
        margin-top: 100px;
    }

    .login-form {
        width: 350px;
        text-align: center;
    }

    .login-img {
        width: 350px;
        margin-bottom: 60px;
    }

    .btn-container {
        display: flex;
        flex-direction: row;
        justify-content: space-around;
    }

    .btn {
        width: 140px;
    }

</style>

<div class="login-container">
    <div class="login-label">
        <?php echo Html::img('@web/images/logo_large.png', ['class' => 'login-img']); ?>
    </div>
    <div class="login-form">
        <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>
        <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>
        <?= $form->field($model, 'password')->passwordInput() ?>
        <hr>
        <?= $form->field($model, 'rememberMe')->checkbox() ?>
        Забыли пароль? <?= Html::a('Восстановить', ['site/request-password-reset']) ?>.
        <hr>
        <div class="btn-container">
            <?= Html::submitButton('Вход', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
            <?= Html::a('Регистрация', ['site/signup'], ['class' => 'btn btn-success']) ?>
        </div>
        <?php ActiveForm::end(); ?>
    </div>
</div>
