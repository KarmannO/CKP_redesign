<ul class="nav nav-tabs">
    <li class="active"><a id="info-tab" data-toggle="tab" href="#basic-info">Базовая информация</a></li>
    <li><a id="confirm-tab" data-toggle="tab" href="#service-info">Информация об оказываемых услугах</a></li>
    <li><a id="confirm-tab" data-toggle="tab" href="#administrators-info">Администрирование и поддержка</a></li>
    <li><a id="confirm-tab" data-toggle="tab" href="#equipment-info">Оборудование</a></li>
    <li><a id="confirm-tab" data-toggle="tab" href="#documents-info">Документы</a></li>
</ul>
<style>

    #administrators-info {
        margin-bottom: 150px;
    }

    .message-container {
        display: flex;
        flex-direction: row;
        background-color: gainsboro;
        padding: 10px;
    }

    .my-message {
        justify-content: flex-end;
    }

    .other-message {
        justify-content: flex-start;
    }

    .messages {
        margin-left: 80px;
        margin-right: 80px;
        margin-top: 10px;
        margin-bottom: 10px;
    }

</style>
<div class="tab-content">
    <div id="basic-info" class="tab-pane fade in active">
        <h3>Базовая информация</h3>
        <div>
            <table class="table table-striped">
                <tr>
                    <td><b>Полное наименование ЦКП</b></td>
                    <td><?= $model->full_name ?></td>
                </tr>
                <tr>
                    <td><b>Сокращённое наименование ЦКП</b></td>
                    <td><?= $model->short_name ?></td>
                </tr>
                <tr>
                    <td><b>Организация, на базе которой оказываются услуги ЦКП</b></td>
                    <td><?= \common\models\Organization::findOne($model->organization)->full_name ?></td>
                </tr>
                <tr>
                    <td><b>Адрес</b></td>
                    <td><?= $model->address ?></td>
                </tr>
            </table>
        </div>
        <hr>
        <h3>Информация о руководителе</h3>
        <div>
            <table class="table table-striped">
                <tr>
                    <td><b>ФИО руководителя ЦКП</b></td>
                    <td><?= $model->director_full_name ?></td>
                </tr>
                <tr>
                    <td><b>Ученая степень руководителя ЦКП</b></td>
                    <td><?= $model->director_degree ?></td>
                </tr>
                <tr>
                    <td><b>Ученое звание руководителя ЦКП</b></td>
                    <td><?= $model->director_rank ?></td>
                </tr>
                <tr>
                    <td><b>Должность руководителя ЦКП</b></td>
                    <td><?= $model->director_position ?></td>
                </tr>
                <tr>
                    <td><b>Контактный телефон руководителя ЦКП</b></td>
                    <td><?= $model->director_phone ?></td>
                </tr>
            </table>
        </div>
    </div>
    <div id="service-info" class="tab-pane fade">
        <?php
            echo \yii\grid\GridView::widget([
                'dataProvider' => $servicesProvider,
                'tableOptions' => [
                    'class' => 'table table-striped'
                ],
                'layout' => '{items}',
                'columns' => [
                    [
                        'label' => 'Наименование услуги',
                        'attribute' => 'title'
                    ],
                    [
                        'label' => 'Автор',
                        'attribute' => 'author_id',
                        'content' => function($data) {
                            return \common\models\User::getUsername($data->author_id);
                        }
                    ],
                    [
                        'label' => 'Статус',
                        'attribute' => 'validation_status',
                        'content' => function($data) {
                            if($data->validation_status == 1) {
                                return \yii\bootstrap\Html::label('Подтверждена', null, ['class' => 'label label-success']);
                            }
                            elseif ($data->validation_status == 2) {
                                return \yii\bootstrap\Html::label('На рассмотрении', null, ['class' => 'label label-warning']);
                            }
                        }
                    ]
                ]
            ]);
        ?>
    </div>
    <div id="administrators-info" class="tab-pane fade">
        <?php
            if($model->validation_status == 1)
            {
                echo \yii\bootstrap\Html::tag('h3', \yii\bootstrap\Html::label('Подтверждён', null, ['class' => 'label label-success']));
                ?>
                    <p>Ваш ЦКП подтверждён и пользователи могут заполнять заявки на его услуги.</p>
                <?php
            }
            elseif($model->validation_status == 2)
            {
                echo \yii\bootstrap\Html::tag('h3', \yii\bootstrap\Html::label('На рассмотрении', null, ['class' => 'label label-warning']));
                ?>
                <p>Ваш ЦКП находится на рассмотрении, пользователи не могут заполнять заявки. Ожидайте сообщения от администрации ИС.</p>
                <?php
            }
            elseif($model->validation_status == 3)
            {
                echo \yii\bootstrap\Html::tag('h3', \yii\bootstrap\Html::label('Заблокирован', null, ['class' => 'label label-danger']));
                ?>
                <p>Ваш ЦКП заблокирован в связи с прекращением деятельности или нарушением правил ИС. Для разблокировки свяжитесь с администрацией.</p>
                <?php
            }
        ?>
        <hr>
        <h4>Обратная связь</h4>
        <br>
        <div class="messages">
                <?php
                echo \yii\widgets\ListView::widget([
                    'dataProvider' => $comments,
                    'itemView' => '__message',
                    'layout' => '{items}'
                ]);
                ?>
        </div>
        <hr>
        <div class="leave-message">
            <h4>Оставить комментарий</h4>
            <?php
                $comment_form = \yii\widgets\ActiveForm::begin(['id' => 'ckp-comment-form']);
            ?>
            <?= $comment_form->field($form, 'comment_text')->textarea(['rows' => 5]) ?>
            <?= \yii\helpers\Html::submitButton('Отправить', ['class' => 'btn btn-primary', 'name' => 'ckp-comment-button']) ?>
            <?php
                \yii\widgets\ActiveForm::end();
            ?>
        </div>
    </div>
    <div id="equipment-info" class="tab-pane fade"></div>
    <div id="documents-info" class="tab-pane fade"></div>
</div>