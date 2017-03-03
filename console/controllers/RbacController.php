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

        $ckp_full_list = $auth->createPermission('ckp_full_list');
        $ckp_full_list->description = 'Список всех ЦКП и возможность их редактирования.';
        $auth->add($ckp_full_list);

        $rule = new UserRoleRule();
        $auth->add($rule);

        $user = $auth->createRole('user');
        $user->description = 'Пользователь';
        $user->ruleName = $rule->name;
        $auth->add($user);

        $moder = $auth->createRole('moderator');
        $moder->description = 'Администратор ЦКП';
        $moder->ruleName = $rule->name;
        $auth->add($moder);

        $auth->addChild($moder, $user);
        $auth->addChild($moder, $ckp_full_list);
        $admin = $auth->createRole('administrator');
        $admin->description = 'Администратор';
        $admin->ruleName = $rule->name;
        $auth->add($admin);
        $auth->addChild($admin, $moder);
    }
}