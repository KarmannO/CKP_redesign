<?php
use kartik\editable\Editable;
$this->title = 'Главная страница';
?>

<?php
    $user = Yii::$app->user->identity;
    echo Editable::widget([
        'model' => $user,
        'attribute' => 'phone',
        'size' => 'lg',
        'inputType' => Editable::INPUT_TEXT
    ]);
?>