<?php
/**
 * Created by PhpStorm.
 * User: zenbu
 * Date: 06.03.2017
 * Time: 5:17
 */
    $this->title = 'Регистрация ЦКП';
?>

<style>
    .register-form-content {
        margin-bottom: 200px;
    }
</style>

<div class="register-form-content">
    <?php $form = \yii\widgets\ActiveForm::begin(['id' => 'ckp-register-form']); ?>
    <h3>Регистрация нового ЦКП</h3>
    <hr>
    <h4>Базовая информация (обязательные поля)</h4>
    <hr>

    <?= $form->field($model, 'full_name')->textInput() ?>
    <?= $form->field($model, 'short_name')->textInput() ?>
    <?= $form->field($model, 'organization')->dropDownList($organizations) ?>
    <?= $form->field($model, 'address')->textarea() ?>

    <hr>
    <h4>Информация о руководителе ЦКП (опциональные поля)</h4>
    <hr>

    <?= $form->field($model, 'director_full_name')->textInput() ?>
    <?= $form->field($model, 'director_degree')->dropDownList($degrees) ?>
    <?= $form->field($model, 'director_rank')->dropDownList($ranks) ?>
    <?= $form->field($model, 'director_position')->dropDownList($positions) ?>
    <?= $form->field($model, 'director_phone')->widget(\yii\widgets\MaskedInput::className(), [ 'mask' => '+7(999)9999999' ]) ?>
    <?= $form->field($model, 'director_fax')->textInput() ?>

    <?= \yii\helpers\Html::submitButton('Зарегистрировать', ['class' => 'btn btn-primary', 'name' => 'ckp-register-button']) ?>

    <?php \yii\widgets\ActiveForm::end(); ?>
</div>

