<?php
/**
 * Created by PhpStorm.
 * User: zenbu
 * Date: 07.03.2017
 * Time: 5:34
 */
    $this->title = 'События в ИС';
?>
<h3>Последние события</h3>
<?php
    echo \yii\widgets\ListView::widget([
        'dataProvider' => $activities,
        'itemView' => '_activity',
        'layout' => '{items}'
    ]);
?>
