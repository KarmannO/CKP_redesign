<?php
        \yii\widgets\Pjax::begin(['id' => 'user-category']);
    $this->title = 'Пользователи ИС';
?>

<h4>Категории пользователей</h4>
<div style="display: flex; flex-direction: row; justify-content: space-around; margin-top: 30px; margin-bottom: 50px;">
    <button class="btn btn-default">Пользователи ИС</button>
    <button class="btn btn-info">Модераторы ЦКП</button>
    <button class="btn btn-primary">Администраторы ЦКП</button>
    <button class="btn btn-success">Модераторы ИС</button>
    <button class="btn btn-warning">Администраторы ИС</button>
</div>

<div style="overflow: auto;">
    <?php
        echo \yii\bootstrap\Html::tag('h4', $label);
        echo '<br>';
        echo \yii\grid\GridView::widget([
            'dataProvider' => $users,
            'layout' => '{items}'
        ]);
    ?>
</div>

<script>
    $('.btn').on('click', function () {
        var classes = $(this).attr('class').split(' ')[1];
        var category = null;
        switch (classes){
            case 'btn-default':
                category = 'is-users';
            break;
            case 'btn-info':
                category = 'ckp-moderators';
            break;
            case 'btn-primary':
                category = 'ckp-administrators';
            break;
            case 'btn-success':
                category = 'is-moderators';
            break;
            case 'btn-warning':
                category = 'is-administrators';
            break;
        }
        $.pjax({
            type: 'post',
            url: '/admin/users',
            container: '#user-category',
            data: {
                category: category
            }
        });
    });
</script>

<?php
    \yii\widgets\Pjax::end();
?>