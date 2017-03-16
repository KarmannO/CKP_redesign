<?php
/**
 * Created by PhpStorm.
 * User: zenbu
 * Date: 13.03.2017
 * Time: 14:58
 */
    $this->title = 'Просмотр услуги';

    echo \yii\widgets\ListView::widget([
        'dataProvider' => $service,
        'itemView' => '_service',
        'layout' => '{items}'
    ]);
?>