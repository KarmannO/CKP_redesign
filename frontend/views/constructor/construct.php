<?php
    $this->title = 'Конструктор услуг';
    $ckps = \common\models\Ckp::getValidCkp()->all();
    $ckp_items = \yii\helpers\ArrayHelper::map($ckps, 'id', 'short_name');
?>

<style>
    .build-wrap {
        height: 100%;
        margin-bottom: 200px;
    }

    #constructor-form {
        height: 100%;
    }

    .build-wrap {
        background-color: whitesmoke;
    }

    .preview {
        overflow-y: auto;
        background-color: lightgray;
        border: 1px groove grey;
        border-radius: 3px;
        padding: 10px;
        margin-bottom: 10px;
    }

    .confirm {
        display: flex;
        flex-direction: row;
        justify-content: flex-end;
        margin-bottom: 200px;
    }
</style>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>

<ul class="nav nav-tabs">
    <li class="active"><a id="info-tab" data-toggle="tab" href="#home">Информация об услуге</a></li>
    <li><a id="constructor-tab" data-toggle="tab" href="#constructor-form">Форма услуги</a></li>
    <li><a id="confirm-tab" data-toggle="tab" href="#menu2">Подтверждение</a></li>
</ul>

<div class="tab-content">
    <div id="home" class="tab-pane fade in active">
        <h3>Информация об услуге</h3>
        <hr>
       <div>
           <form id="info-form">
               <label>Введите название услуги</label>
               <input name="name" type="text" class="form-control">
               <label>Введите описание услуги</label>
               <textarea name="description" rows="5" class="form-control"></textarea>
               <hr>
               <label>Выберите ЦКП, на базе которого будет оказываться услуга</label>
               <?= \yii\helpers\Html::dropDownList('ckp', isset($_GET['on_ckp']) ? $_GET['on_ckp'] : null, $ckp_items, ['class' => 'form-control', 'id' => 'ckp_select']) ?>
               <br>
           </form>
       </div>
    </div>
    <div id="constructor-form" class="tab-pane fade">
        <h3>Форма услуги</h3>
        <hr>
        <div class="build-wrap"></div>
    </div>
    <div id="menu2" class="tab-pane fade">
        <h3>Информация об услуге</h3>
        <hr>
        <div class="service-info">
            <table class="table table-striped">
                <tr>
                    <td>Наименование услуги:</td>
                    <td id="service-name"></td>
                </tr>
                <tr>
                    <td>Описание услуги:</td>
                    <td id="service-description"></td>
                </tr>
                <tr>
                    <td>ЦКП:</td>
                    <td id="ckp-selected"></td>
                </tr>
            </table>
        </div>
        <h3>Предпросмотр формы</h3>
        <hr>
        <div class="preview">
        </div>
        <div class="confirm">
            <button id="submit-button" class="btn btn-success">Добавить услугу</button>
        </div>
    </div>
</div>

<div id="myModall" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Ошибка заполнения</h4>
            </div>
            <div class="modal-body">
                <p id="error"></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
            </div>
        </div>
    </div>
</div>

<script>
    var russian = {
        addOption: 'Добавить опцию',
        allFieldsRemoved: 'Все поля удалены',
        allowSelect: 'Разрешить выбор',
        autocomplete: 'Автозаполнение',
        button: 'Кнопка',
        cannotBeEmpty: 'Не может быть пустым',
        checkboxGroup: 'Група чекбоксов',
        checkbox: 'Чекбокс',
        checkboxes: 'Чекбоксы',
        className: 'Имя класса',
        clearAllMessage: 'Очистить все поля?',
        clearAll: 'Очистить всё',
        close: 'Свернуть',
        copy: 'Скопировать',
        dateField: 'Поле даты',
        description: 'Описание',
        descriptionField: 'Поле описания',
        devMode: 'Режим разработки',
        editNames: 'Редактировать имена',
        editorTitle: 'Название редактора',
        editXML: 'Редактировать XML',
        fieldDeleteWarning: true,
        fieldVars: 'Переменные полей',
        fieldNonEditable: 'Нередактируемое поле',
        fieldRemoveWarning: 'Предупреждение при удалении поля',
        fileUpload: 'Загрузка файла',
        formUpdated: 'Форма обновлена',
        getStarted: 'Перетащите сюда нужные Вам элементы формы',
        hide: 'Спрятать',
        hidden: 'Спрятанное поле',
        label: 'Надпись',
        labelEmpty: 'Пустая надпись',
        limitRole: 'Ограничить доступ',
        mandatory: 'Mandatory',
        maxlength: 'Максимальная длина',
        minOptionMessage: 'Минимальная опция сообщение',
        name: 'ID',
        no: 'Нет',
        off: 'Выкл',
        on: 'Вкл',
        optional: 'Опционально',
        optionLabelPlaceholder: 'Название опции',
        optionValuePlaceholder: 'Значение опции',
        paragraph: 'Параграф',
        placeholder: 'Подсказка',
        preview: 'Предпросмотр',
        radioGroup: 'Группа радио кнопок',
        radio: 'Радио кнопка',
        removeMessage: 'Удалить сообщение',
        remove: 'x',
        required: 'Обязательное',
        richText: 'Богатый текст',
        roles: 'Роли',
        save: 'Сохранить',
        selectOptions: 'Выбрать опции',
        select: 'Выпадающий список',
        selectColor: 'Цвет списка',
        selectionsMessage: 'Сообщение',
        size: 'Размер',
        sizes: {
            xs: 'XS',
            sm: 'S',
            m: 'M',
            lg: 'L'
        },
        style: 'Стиль',
        subtype: 'Подтип',
        subtypes: {
            text: ['text', 'password', 'email', 'color'],
            button: ['button', 'submit']
        },
        text: 'Линия текста',
        textArea: 'Многострочный текст',
        toggle: 'Скрытый блок',
        warning: 'Предупреждение!',
        viewXML: '&lt;/&gt;',
        number: 'Число',
        yes: 'Да'
    };

    var options = {
        disableFields: ['autocomplete', 'button', 'header', 'hidden', 'file'],
        messages: russian,
        dataType: 'json',
        showActionButtons: true
    };

    var fb = null;
    var service_info = null;
    var form_html = null;
    var form_json = null;

    $(document).ready(function () {
        fb = $('.build-wrap').formBuilder(options).data('formBuilder');
        
    });
    
    function GetHtmlFromServer(data) {
        $.ajax({
            type: 'post',
            async: false,
            url: '/constructor/ajax_get_html',
            data: {
                raw_data: JSON.stringify(data)
            },
            success: function (html_data) {
                form_json = data;
                form_html = html_data;
                $('.preview').html(html_data);
            }
        });
    }

    function GetCkp() {
        var dt = null;
        $.ajax({
            async: false,
            type: 'get',
            url: '/constructor/ajax_get_ckp',
            data: {
                id: $('#ckp_select').val()
            },
            success: function (data) {
                dt = data;
            }
        });
        return dt;
    }

    function GetDataFromInfoFields() {
        service_info = $('#info-form').serializeObject();
        $('#service-name').html(service_info['name']);
        $('#service-description').html(service_info['description']);
        $('#ckp-selected').html(GetCkp(service_info['ckp']));
    }
    
    function ValidateInput() {
        if(service_info == null)
            return { result: false, message: 'Заполните пожалуйста информацию об услуге.'};
        if(service_info['name'] == null || service_info['name'] == '')
            return { result: false, message: 'Заполните пожалуйста наименование услуги.'};
        if(!service_info['description'] == null || service_info['description'] == '')
            return { result: false, message: 'Заполните пожалуйста описание услуги.'};
        if(fb.formData == '[]')
            return { result: false, message: 'Форма услуги должна содержать хотя бы одно поле.'};
        return { result: true, message: ''};
    }

    $('#confirm-tab').on('click', function (event) {
        var json_form_data = JSON.parse(fb.formData);
        GetDataFromInfoFields();
        var validated = ValidateInput();
        if(!validated.result) {
            $('#error').html(validated.message);
            $('#myModall').modal('show');
            event.stopPropagation();
            return;
        }
        GetHtmlFromServer(json_form_data);
    });
    
    $('#submit-button').on('click', function () {
        $.ajax({
            type: 'post',
            async: false,
            url: '/constructor/ajax_add_service',
            data: {
                form_json: JSON.stringify(form_json),
                form_html: JSON.stringify(form_html),
                service_info: JSON.stringify(service_info)
            },
            success: function (data) {
                window.location = '/site/index';
            }
        });
    });

</script>