<?php
/**
 * Created by PhpStorm.
 * User: zenbu
 * Date: 13.03.2017
 * Time: 15:11
 */
    $this->registerJS('$("document").ready(function(){
            $("#equipment-div").on("pjax:end", function() {
            $.pjax.reload({container:"#update_equipment_box"});  //Reload GridView
        });
    });'
    );
?>

<style>
    .form-container {
        background-color: lightgrey;
        padding: 10px;
        border-radius: 5px;
        user-select: none;
        pointer-events: none;
    }

    .form-container > input {
        user-select: none;
    }

    .header-button {
        display: flex;
        justify-content: space-between;
    }
</style>

<div>
    <h3>Просмотр услуги</h3>
</div>
<table class="table table-striped">
    <tr>
        <td>Наименование услуги</td>
        <td><?= $model->title ?></td>
    </tr>
    <tr>
        <td>Описание услуги</td>
        <td><?= \yii\bootstrap\Html::encode($model->description) ?></td>
    </tr>
</table>
<h4>Форма</h4>
<div class="form-container">
    <?= \frontend\controllers\ConstructorController::getHtml($model->json_template)  ?>
</div>
<hr>
<div class="header-button">
    <h3>Оборудование, закреплённое за услугой</h3>
</div>
</div>
<?php
    \yii\widgets\Pjax::begin(['id' => 'update_equipment_box']);
?>
<div id="equipment-div">
    <?php
        echo \yii\grid\GridView::widget([
            'dataProvider' => new \yii\data\ActiveDataProvider([
                'query' => \common\models\ServiceBinding::getEquipmentByService($model->id)
            ]),
            'layout' => '{items}',
            'tableOptions' => [
                'class' => 'table table-striped'
            ],
            'columns' => [
                [
                    'attribute' => 'title',
                    'label' => 'Наименование'
                ],
                [
                    'attribute' => 'production_company',
                    'label' => 'Производитель'
                ],
                [
                    'attribute' => 'production_year',
                    'label' => 'Год выпуска'
                ],
                [
                    'label' => 'Действия',
                    'content' => function($data) use ($model) {
                        return \yii\bootstrap\Html::a(
                            \yii\bootstrap\Html::tag('span', '', ['class' => 'glyphicon glyphicon-remove']),
                            '/ckp/service?id='.$model->id.'&eq_id='.$data->id
                        );
                    }
                ]
            ]
        ]);
    ?>
</div>
<?php
    \yii\widgets\Pjax::end();
?>
