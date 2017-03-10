<?php
/**
 * Created by PhpStorm.
 * User: zenbu
 * Date: 02.03.2017
 * Time: 9:32
 */
    if (Yii::$app->user->can('ckp_full_list')) {
        $this->title = 'Полный список ЦКП';
    }
    else {
        $this->title = 'Мои ЦКП';
    }
?>

<style>
    .button-header {
        display: flex;
        flex-direction: row;
        justify-content: space-between;
    }
</style>

<div class="button-header">
    <div>
        <h3><?= \yii\helpers\Html::encode($this->title) ?></h3>
    </div>
    <div>
        <?php
            echo \yii\helpers\Html::a('Регистрация нового ЦКП', ['/ckp/register'], ['class' => 'btn btn-success']);
        ?>
    </div>
</div>

<?php
    echo \yii\grid\GridView::widget([
        'dataProvider' => $dataProvider,
        'layout'=>"\n{pager}\n{items}",
        'columns' => [
            [
                'attribute' => 'id',
                'label' => '#',
            ],
            [
                'attribute' => 'short_name',
                'label' => 'Наименование ЦКП',
                'content' => function($data) {
                    return \yii\helpers\Html::a($data->short_name, ['/ckp/view?id='.$data->id]);
                }
            ],
            [
                'attribute' => 'organization',
                'label' => 'Организация',
                'content' => function($data) {
                    return \common\models\Organization::findOne($data)->short_name;
                }
            ],
            [
                'attribute' => 'director_full_name',
                'label' => 'ФИО руководителя',
                'content' => function($data) {
                    if(!$data->director_full_name)
                        return '-';
                    else
                        return $data->director_full_name;
                }
            ],
            [
                'attribute' => 'validation_status',
                'label' => 'Статус',
                'content' => function($data) {
                    if($data->validation_status == 1)
                    {
                        return \yii\bootstrap\Html::label('Подтверждён', null, ['class' => 'label label-success']);
                    }
                    elseif ($data->validation_status == 2)
                    {
                        return \yii\bootstrap\Html::label('На рассмотрении', null, ['class' => 'label label-warning']);
                    }
                    elseif ($data->validation_status == 3)
                    {
                        return \yii\bootstrap\Html::label('Заблокирован', null, ['class' => 'label label-danger']);
                    }
                }
            ]
        ],
        'tableOptions' => [
            'class' => 'table table-striped'
        ]
    ]);
?>
