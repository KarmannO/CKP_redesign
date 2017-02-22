<?php

/**
 * Created by PhpStorm.
 * User: zenbu
 * Date: 22.02.2017
 * Time: 5:19
 */
namespace common\components\rbac;
use Yii;
use yii\rbac\Rule;
use yii\helpers\ArrayHelper;
use common\models\User;

class UserRoleRule extends Rule
{
    public $name = 'userRole';

    public function execute($user, $item, $params)
    {
        $user = ArrayHelper::getValue($params, 'user', User::findOne($user));
        if($user)
        {
            $role = $user->role;
            if($item->name == 'administrator')
            {
                return $role == User::ROLE_ADMINISTRATOR;
            } elseif ($item->name == 'moderator')
            {
                return $role == User::ROLE_ADMINISTRATOR || $role == User::ROLE_MODERATOR;
            }
            elseif ($item->name == 'user')
            {
                return $role == User::ROLE_ADMINISTRATOR || $role == User::ROLE_MODERATOR || $role == User::ROLE_USER;
            }
        }
        return false;
    }
}