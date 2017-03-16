<div id="pjax-messages" class="messages">
    <?php
    echo \yii\widgets\ListView::widget([
        'dataProvider' => new \yii\data\ActiveDataProvider([
            'query' => \common\models\CkpComment::find(),
            'pagination' => [
                'pageSize' => \common\models\CkpComment::find()->count()
            ]
        ]),
        'itemView' => '__message',
        'layout' => '{items}'
    ]);
    ?>
</div>
<hr>
<div class="leave-message">
    <h4>Оставить комментарий</h4>
    <?php
    $comment_form = \yii\widgets\ActiveForm::begin(['id' => 'ckp-comment-form', 'options' => ['data-pjax' => true ]]);
    ?>
    <?= $comment_form->field($form, 'comment_text')->textarea(['rows' => 5]) ?>
    <?= \yii\helpers\Html::submitButton('Отправить', ['class' => 'btn btn-primary', 'name' => 'ckp-comment-button']) ?>
    <?php
    \yii\widgets\ActiveForm::end();
    ?>
</div>