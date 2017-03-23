<?php
/**
 * Created by PhpStorm.
 * User: zenbu
 * Date: 17.03.2017
 * Time: 15:01
 */
    $this->title = 'Заполнить заявку';
?>

<ul class="nav nav-tabs">
    <li class="active"><a id="info-tab" data-toggle="tab" href="#basic-info">Базовая информация</a></li>
    <li><a data-toggle="tab" href="#common-info">Общая информация о заявке</a></li>
    <li><a data-toggle="tab" href="#technic-info">Техническая информация о заявке</a></li>
    <li><a data-toggle="tab" href="#confirm">Подтверждение</a></li>
</ul>

<style>
    .tab-pane {
        margin-top: 30px;
    }
</style>

<div class="tab-content">
    <div id="basic-info" class="tab-pane fade in active">
        <div>
            <label>Выберите ЦКП</label>
            <?= \yii\bootstrap\Html::dropDownList('ckp-select', null, $ckp_list, ['id' => 'ckp-select-id', 'class' => 'form-control']) ?>
        </div>
        <br>
        <div id="service-container">

        </div>
        <br>
        <div id="equipment-container">

        </div>
    </div>
    <div id="common-info">

    </div>
    <div id="technic-info">

    </div>
    <div id="confirm">

    </div>
</div>

<script>
    var alertedEquipmentMessage = '<div class="alert alert-danger">Для данной услуги не прикреплено оборудование.</div>';
    var alertedServiceMessage = '<div class="alert alert-danger">Данный ЦКП не оказывает услуг.</div>';

    function ProcessEmpty() {
        if($('#service-select-id').has('option').length == 0) {
            $('#service-container').html(alertedServiceMessage);
            $('#equipment-container').empty();
            return;
        }
        if($('#equipment-select-id').has('option').length == 0) {
            $('#equipment-container').html(alertedEquipmentMessage);
        }
    }
    
    function GetServices() {
        $.ajax({
            async: false,
            type: 'get',
            url: '/request/request',
            data: {
                type: 'services',
                ckp_id: $('#ckp-select-id').val()
            },
            success: function (data) {
                $('#service-container').empty();
                $('#service-container').html(data);
                ProcessEmpty();
                GetEquipment();
            }
        });
    }

    GetServices();
    
    function GetEquipment() {
        $.ajax({
            async: false,
            type: 'get',
            url: '/request/request',
            data: {
                type: 'equipment',
                service_id: $('#service-select-id').val()
            },
            success: function (data) {
                $('#equipment-container').empty();
                $('#equipment-container').html(data);
                ProcessEmpty();
            }
        });
    }

    $('#ckp-select-id').on('change', function () {
        GetServices();
    });

    $('#service-select-id').on('change', function () {
        GetEquipment();
    });
</script>
