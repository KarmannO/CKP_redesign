<style>
    .activity_container {
        background-color: lightgray;
        padding: 10px;
        border: 1px ridge grey;
        margin-bottom: 20px;
    }
</style>

<?php
/**
 * Created by PhpStorm.
 * User: zenbu
 * Date: 07.03.2017
 * Time: 5:50
 */
    $json_info = json_decode($model->json_description);
    if ($model->type == 1)
    {
        ?>
        <div class="activity_container">
            <div>
                <h4><b><?= date("d.m.Y h:i:s", $model->timestamp) ?></b> Зарегистрирован новый ЦКП</h4>
                <p>Наименование ЦКП: <a href="/ckp/view?id=<?= $json_info->ckp_id ?>"><?= $json_info->ckp_title ?></p></a>
                <p>Регистрирующий пользователь: <a href="/admin/user?id=<?= $json_info->user_id ?>"><?= \common\models\User::findById($json_info->user_id)->username ?></p></a>
            </div>
        </div>
        <?php
    }
    if($model->type == 2)
    {
        ?>
        <div class="activity_container">
            <div>
                <h4><b><?= date("d.m.Y h:i:s", $model->timestamp) ?></b> Зарегистрирован новый пользователь</h4>
                <p>Пользователь: <a href="/admin/user?id=<?= $json_info->user_id ?>"><?= \common\models\User::findById($json_info->user_id)->username ?></p></a></p>
            </div>
        </div>
        <?php
    }
?>