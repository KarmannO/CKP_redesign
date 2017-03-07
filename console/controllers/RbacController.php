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
        $ckp_full_list->description = 'Возможность просмотра полного списка ЦКП';

        $ckp_my_list = $auth->createPermission('ckp_my_list');
        $ckp_my_list->description = 'Возможность просмотра своего списка ЦКП';

        $is_admin_panel_access = $auth->createPermission('is_admin_panel_access');
        $is_admin_panel_access->description = 'Доступ к панели администратора';

        $ckp_admin_panel_access = $auth->createPermission('ckp_admin_panel_access');
        $ckp_admin_panel_access->description = 'Доступ к панели администрирования ЦКП';

        $user_edit_access = $auth->createPermission('user_edit_access');
        $user_edit_access->description = 'Возможность редактировать личные данные пользователя';

        $rule = new UserRoleRule();
        $auth->add($rule);

        $auth->add($ckp_full_list);
        $auth->add($is_admin_panel_access);
        $auth->add($user_edit_access);
        $auth->add($ckp_admin_panel_access);
        $auth->add($ckp_my_list);

        $user = $auth->createRole('user');
        $user->description = 'Пользователь';
        $user->ruleName = $rule->name;
        $auth->add($user);

        $ckp_moderator = $auth->createRole('ckp_moderator');
        $ckp_moderator->description = 'Модератор ЦКП';
        $ckp_moderator->ruleName = $rule->name;
        $auth->add($ckp_moderator);

        $ckp_administrator = $auth->createRole('ckp_administrator');
        $ckp_administrator->description = 'Администратор ЦКП';
        $ckp_administrator->ruleName = $rule->name;
        $auth->add($ckp_administrator);

        $is_moderator = $auth->createRole('is_moderator');
        $is_moderator->description = 'Модератор ЦКП';
        $is_moderator->ruleName = $rule->name;
        $auth->add($is_moderator);

        $is_administrator = $auth->createRole('is_administrator');
        $is_administrator->description = 'Администратор ЦКП';
        $is_administrator->ruleName = $rule->name;
        $auth->add($is_administrator);

        $auth->addChild($is_administrator, $is_moderator);
        $auth->addChild($is_administrator, $user);
        $auth->addChild($is_moderator, $user);
        $auth->addChild($ckp_administrator, $ckp_moderator);

        $auth->addChild($is_moderator, $ckp_full_list);
        $auth->addChild($is_moderator, $is_admin_panel_access);
        $auth->addChild($is_administrator, $user_edit_access);
        $auth->addChild($ckp_moderator, $ckp_admin_panel_access);
        $auth->addChild($is_moderator, $ckp_admin_panel_access);
        $auth->addChild($ckp_administrator, $ckp_my_list);
        $auth->addChild($is_moderator, $ckp_my_list);
    }
}