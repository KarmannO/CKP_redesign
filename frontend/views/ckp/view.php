<?php
/**
 * Created by PhpStorm.
 * User: zenbu
 * Date: 06.03.2017
 * Time: 10:05
 */
    $this->title = 'Просмотр ЦКП';
?>

<h3><?= \yii\helpers\Html::encode($this->title) ?></h3>

<?php
    echo \yii\widgets\ListView::widget([
        'dataProvider' => $dataProvider,
        'itemView' => '_view',
        'viewParams' => ['form' => $model, 'comments' => $commentsProvider, 'servicesProvider' => $servicesProvider],
        'layout' => '{items}'
    ]);
?>
