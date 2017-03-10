
<div class="message-container <?= \common\models\User::isMyId($model->user_id) ? 'my-message' : 'other-message' ?>">
    <b><?= \common\models\User::getUsername($model->user_id) ?></b>[<?= date('d-m-Y H:i:s' ,$model->timestamp) ?>]&nbsp;&nbsp;
    <p><?= $model->message_text ?></p>
</div>
