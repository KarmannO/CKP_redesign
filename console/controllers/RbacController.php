<?php

/**
 * Created by PhpStorm.
 * User: zenbu
 * Date: 22.02.2017
 * Time: 5:25
 */
namespace console\controllers;
use Yii;
use yii\console\Controller;
use common\components\rbac\UserRoleRule;

class RbacController extends Controller
{
    public function actionInit()
    {
        $auth = Yii::$app->authManager;
        $auth->removeAll();
        $admin_panel = $auth->createPermission('admin_panel');
        $admin_panel->description = 'Панель администратора';
        $auth->add($admin_panel);

        $rule = new UserRoleRule();
        $auth->add($rule);

        $user = $auth->createRole('user');
        $user->description = 'Пользователь';
        $user->ruleName = $rule->name;
        $auth->add($user);

        $moder = $auth->createRole('moderator');
        $moder->description = 'Модератор';
        $moder->ruleName = $rule->name;
        $auth->add($moder);

        $auth->addChild($moder, $user);
        $auth->addChild($moder, $admin_panel);
        $admin = $auth->createRole('administrator');
        $admin->description = 'Администратор';
        $admin->ruleName = $rule->name;
        $auth->add($admin);
        $auth->addChild($admin, $moder);
    }
}