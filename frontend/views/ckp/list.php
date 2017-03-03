<?php
/**
 * Created by PhpStorm.
 * User: zenbu
 * Date: 02.03.2017
 * Time: 9:32
 */
    $this->title = 'Список ЦКП';
    echo '<h3>'.\yii\bootstrap\Html::encode($this->title).'</h3>';
    echo \yii\grid\GridView::widget([
        'dataProvider' => $dataProvider
    ]);
?>