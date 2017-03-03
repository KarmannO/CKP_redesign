<?php
/**
 * Created by PhpStorm.
 * User: zenbu
 * Date: 01.03.2017
 * Time: 3:07
 */
    $this->title = 'Мои данные';
?>

<h3><?= \yii\bootstrap\Html::encode($this->title) ?></h3>

<?php \yii\widgets\Pjax::begin(); ?>

<table class="table table-striped">
    <tr>
        <td>
            Фамилия
        </td>
        <td>
            <?php
            echo \kartik\editable\Editable::widget([
                'model' => $model,
                'attribute' => 'surname',
                'name' => 'name',
                'asPopover' => false,
                'header' => 'Фамилия',
                'size'=>'md',
                'options' => ['placeholder'=>'Введите имя']
            ]);
            ?>
        </td>
    </tr>
    <tr>
        <td>
            Имя
        </td>
        <td>
            <?php
            echo \kartik\editable\Editable::widget([
                'model' => $model,
                'attribute' => 'name',
                'name'=>'name',
                'asPopover' => false,
                'header' => 'Имя',
                'size'=>'md',
                'options' => ['class'=>'form-control', 'placeholder'=>'Введите имя']
            ]);
            ?>
        </td>
    </tr>
    <tr>
        <td>
            Отчество
        </td>
        <td>
            <?php
            echo \kartik\editable\Editable::widget([
                'model' => $model,
                'attribute' => 'middle_name',
                'name'=>'middle_name',
                'asPopover' => false,
                'header' => 'Отчество',
                'size'=>'md',
                'options' => ['class'=>'form-control', 'placeholder'=>'Введите имя']
            ]);
            ?>
        </td>
    </tr>
    <tr>
        <td>
            Номер телефона
        </td>
        <td>
            <?php
            echo \kartik\editable\Editable::widget([
                'model' => $model,
                'attribute' => 'phone',
                'name'=>'phone',
                'asPopover' => false,
                'header' => 'Телефон',
                'size'=>'md',
                'options' => ['class'=>'form-control', 'placeholder'=>'Введите телефон']
            ]);
            ?>
        </td>
    </tr>
</table>
<?php \yii\widgets\Pjax::end(); ?>
