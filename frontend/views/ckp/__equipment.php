<?php
/**
 * Created by PhpStorm.
 * User: zenbu
 * Date: 14.03.2017
 * Time: 12:57
 */
?>
<script>
    $(document).on('click', '#modal-toggle-btn', function () {
        $('#myModal').modal('hide');
        $('#myModal').modal('show');
    });

    $(document).on('click', '#eq-add-button', function () {
        $('#myModal').modal('show');
        $('#myModal').modal('hide');
    });
</script>
<?php
echo \yii\grid\GridView::widget([
    'dataProvider' => new \yii\data\ActiveDataProvider([
        'query' => \common\models\Equipment::getByCkp($ckp_id)
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
        ]
    ]
]);
?>
