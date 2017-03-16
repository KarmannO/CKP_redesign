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

    #equipment-info {
        margin-bottom: 150px;
    }

    #basic-info {
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

    .header-button {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
</style>
<div class="tab-content">
    <div id="basic-info" class="tab-pane fade in active">
        <h3>Базовая информация</h3>
        <div>
            <table class="table table-striped">
                <tr>
                    <td><b>Полное наименование ЦКП</b></td>
                    <td><?= \kartik\editable\Editable::widget([
                            'model' => $model,
                            'attribute' => 'full_name',
                            'name'=>'full_name',
                            'header' => 'Полное наименование ЦКП',
                            'size'=>'md',
                            'options' => ['class'=>'form-control', 'placeholder' => 'Поле ввода']
                        ]); ?></td>
                </tr>
                <tr>
                    <td><b>Сокращённое наименование ЦКП</b></td>
                    <td><?= \kartik\editable\Editable::widget([
                            'model' => $model,
                            'attribute' => 'short_name',
                            'name'=>'short_name',
                            'header' => 'Сокращённое наименование ЦКП',
                            'size'=>'md',
                            'options' => ['class'=>'form-control', 'placeholder' => 'Поле ввода']
                        ]); ?></td>
                </tr>
                <tr>
                    <td><b>Организация, на базе которой оказываются услуги ЦКП</b></td>
                    <td><?= \common\models\Organization::findOne($model->organization)->full_name ?></td>
                </tr>
                <tr>
                    <td><b>Адрес</b></td>
                    <td><?= \kartik\editable\Editable::widget([
                            'model' => $model,
                            'attribute' => 'address',
                            'name'=>'address',
                            'header' => 'Адрес ЦКП',
                            'size'=>'md',
                            'options' => ['class'=>'form-control', 'placeholder' => 'Поле ввода']
                        ]); ?></td>
                </tr>
            </table>
        </div>
        <hr>
        <h3>Информация о руководителе</h3>
        <div>
            <table class="table table-striped">
                <tr>
                    <td><b>ФИО руководителя ЦКП</b></td>
                    <td><?= \kartik\editable\Editable::widget([
                            'model' => $model,
                            'attribute' => 'director_full_name',
                            'name'=>'director_full_name',
                            'asPopover' => false,
                            'header' => 'ФИО руководителя ЦКП',
                            'size'=>'md',
                            'options' => ['class'=>'form-control', 'placeholder' => 'Поле ввода']
                        ]); ?></td>
                </tr>
                <tr>
                    <td><b>Ученая степень руководителя ЦКП</b></td>
                    <td><?= \kartik\editable\Editable::widget([
                            'model' => $model,
                            'name'=>'director_degree',
                            'attribute' => 'director_degree',
                            'asPopover' => false,
                            'format' => \kartik\editable\Editable::FORMAT_BUTTON,
                            'inputType' => \kartik\editable\Editable::INPUT_DROPDOWN_LIST,
                            'data'=> \yii\helpers\ArrayHelper::map(\common\models\Degree::find()->all(), 'id', 'title'),
                            'options' => ['class'=>'form-control', 'prompt'=>'Выберите учёную степень'],
                            'editableValueOptions'=>['class'=>'text-danger']
                        ]); ?></td>
                </tr>
                <tr>
                    <td><b>Ученое звание руководителя ЦКП</b></td>
                    <td><?= \kartik\editable\Editable::widget([
                            'model' => $model,
                            'name'=>'director_rank',
                            'attribute' => 'director_rank',
                            'asPopover' => false,
                            'format' => \kartik\editable\Editable::FORMAT_BUTTON,
                            'inputType' => \kartik\editable\Editable::INPUT_DROPDOWN_LIST,
                            'data'=> \yii\helpers\ArrayHelper::map(\common\models\Rank::find()->all(), 'id', 'title'),
                            'options' => ['class'=>'form-control', 'prompt'=>'Выберите учёное звание'],
                            'editableValueOptions'=>['class'=>'text-danger']
                        ]); ?></td>
                </tr>
                <tr>
                    <td><b>Должность руководителя ЦКП</b></td>
                    <td><?= \kartik\editable\Editable::widget([
                            'model' => $model,
                            'attribute' => 'director_position',
                            'name'=>'director_position',
                            'asPopover' => false,
                            'format' => \kartik\editable\Editable::FORMAT_BUTTON,
                            'inputType' => \kartik\editable\Editable::INPUT_DROPDOWN_LIST,
                            'data'=> \yii\helpers\ArrayHelper::map(\common\models\Rank::find()->all(), 'id', 'title'),
                            'options' => ['class'=>'form-control', 'prompt'=>'Выберите учёное звание'],
                            'editableValueOptions'=>['class'=>'text-danger']
                        ]); ?></td>
                </tr>
                <tr>
                    <td><b>Контактный телефон руководителя ЦКП</b></td>
                    <td><?= \kartik\editable\Editable::widget([
                            'model' => $model,
                            'attribute' => 'director_phone',
                            'name'=>'director_phone',
                            'asPopover' => false,
                            'header' => 'Контактный телефон руководителя ЦКП',
                            'size'=>'md',
                            'options' => ['class'=>'form-control', 'placeholder' => 'Поле ввода']
                        ]); ?></td>
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
                        'attribute' => 'title',
                        'content' => function($data) {
                            return \yii\bootstrap\Html::a($data->title, ['/ckp/service?id='.$data->id]);
                        }
                    ],
                    [
                        'label' => 'Описание услуги',
                        'attribute' => 'description',
                        'content' => function($data) {
                            return \yii\bootstrap\Html::tag('p', $data->description);
                        }
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
        <?php yii\widgets\Pjax::begin(['id' => 'update_messages_box']); ?>
        <div id="pjax-messages" class="messages">
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
                $comment_form = \yii\widgets\ActiveForm::begin(['id' => 'ckp-comment-form', 'options' => ['data-pjax' => true ]]);
            ?>
            <?= $comment_form->field($form, 'comment_text')->textarea(['rows' => 5]) ?>
            <?= \yii\helpers\Html::submitButton('Отправить', ['class' => 'btn btn-primary', 'name' => 'ckp-comment-button']) ?>
            <?php
                \yii\widgets\ActiveForm::end();
            ?>
        </div>
        <?php \yii\widgets\Pjax::end(); ?>
    </div>
    <div id="equipment-info" class="tab-pane fade">
        <div class="header-button">
            <h3>Оборудование ЦКП</h3>
            <button id="modal-toggle-btn" type="button" class="btn btn-success">Добавить оборудование</button>
        </div>
        <?php \yii\widgets\Pjax::begin(['id' => 'equipment-update-block']); ?>
        <div id="equipment-update-div">
            <?php
                echo \yii\grid\GridView::widget([
                    'dataProvider' => new \yii\data\ActiveDataProvider([
                        'query' => \common\models\Equipment::getByCkp($model->id)
                    ]),
                    'formatter' => ['class' => 'yii\i18n\Formatter','nullDisplay' => '-'],
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
                        ],
                        [
                            'label' => 'Действия',
                            'content' => function($data) use ($model) {
                                return \yii\bootstrap\Html::a(
                                    \yii\bootstrap\Html::tag('span', '', ['class' => 'glyphicon glyphicon-pencil']),
                                    ['/ckp/ajax_equipment_edit']
                                ).'&nbsp;&nbsp;'.
                                    \yii\bootstrap\Html::a(
                                        \yii\bootstrap\Html::tag('span', '', ['class' => 'glyphicon glyphicon-remove']),
                                        ['/ckp/ajax_equipment_remove']
                                    );
                            }
                        ]
                    ]
                ]);
            ?>
        </div>
            <div id="myModal" class="modal fade" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Добавить оборудование</h4>
                        </div>
                        <div class="modal-body">
                            <?php
                                $equipment_add_form = \yii\bootstrap\ActiveForm::begin(['options' => ['data-pjax' => true], 'id' => 'equipment_add_form']);
                            ?>
                            <?= $equipment_add_form->field($equipment_form, 'title')->textInput() ?>
                            <?= $equipment_add_form->field($equipment_form, 'description')->textarea(['rows' => 5]) ?>
                            <?= $equipment_add_form->field($equipment_form, 'production_company')->textInput() ?>
                            <?= $equipment_add_form->field($equipment_form, 'production_year')->textInput() ?>
                            <?= $equipment_add_form->field($equipment_form, 'mark')->textInput() ?>
                            <?= $equipment_add_form->field($equipment_form, 'price')->textInput() ?>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default">Закрыть</button>
                            <?= \yii\helpers\Html::submitButton('Добавить', [
                                'id' => 'eq-add-button',
                                'class' => 'btn btn-primary',
                                'name' => 'equipment-add-button'
                            ]) ?>
                            <?php
                            \yii\bootstrap\ActiveForm::end();
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php \yii\widgets\Pjax::end(); ?>
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
    </div>
    <div id="documents-info" class="tab-pane fade">
        <h3>Список файлов</h3>
        <hr>
        <?php
            echo \yii\grid\GridView::widget([
                'dataProvider' => new \yii\data\ActiveDataProvider([
                    'query' => \common\models\CkpDocument::findByCkp($model->id)
                ]),
                'layout' => '{items}',
                'columns' => [
                    [
                        'attribute' => 'short_path',
                        'label' => 'Имя файла',
                        'content' => function($data) {
                            return \yii\bootstrap\Html::a($data->short_path, ['site/download?hash=ad55$qwe1313']);
                        }
                    ],
                    [
                        'attribute' => 'user',
                        'label' => 'Добавлен пользователем',
                        'content' => function($data) {
                            return \common\models\User::getUsername($data);
                        }
                    ],
                    [
                        'attribute' => 'time',
                        'label' => 'Дата добавления',
                        'content' => function($data) {
                            return date('d.m.Y', $data->time);
                        }
                    ]
                ],
                'tableOptions' => [
                    'class' => 'table table-striped'
                ]
            ]);
        ?>
        <hr>
        <?php $file_form = \yii\bootstrap\ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
            <?= $file_form->field($file_model, 'file')->fileInput() ?>
            <?= \yii\helpers\Html::submitButton('Загрузить', [
                'id' => 'file-add-button',
                'class' => 'btn btn-primary',
                'name' => 'file-add-button'
            ]) ?>
        <?php \yii\bootstrap\ActiveForm::end(); ?>
    </div>
</div>