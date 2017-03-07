<ul class="nav nav-tabs">
    <li class="active"><a id="info-tab" data-toggle="tab" href="#basic-info">Базовая информация</a></li>
    <li><a id="confirm-tab" data-toggle="tab" href="#service-info">Информация об оказываемых услугах</a></li>
    <li><a id="confirm-tab" data-toggle="tab" href="#administrators-info">Администрирование и поддержка</a></li>
    <li><a id="confirm-tab" data-toggle="tab" href="#equipment-info">Оборудование</a></li>
</ul>

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

    </div>
    <div id="administrators-info"></div>
    <div id="equipment-info"></div>
</div>