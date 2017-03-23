<?php
/**
 * Created by PhpStorm.
 * User: zenbu
 * Date: 07.03.2017
 * Time: 5:33
 */

namespace frontend\controllers;


use common\models\Activity;
use common\models\User;
use yii\base\Controller;
use yii\data\ActiveDataProvider;
use yii\web\ForbiddenHttpException;

/**
 * Class AdminController
 * @package frontend\controllers
 * Controller for handling administrator actions.
 */
class AdminController extends Controller
{
    /**
     * Method for checking if action can't be performed.
     *
     * @param \yii\base\Action $action action to permission check (not in use).
     * @return bool Will action be performed or not.
     * @throws ForbiddenHttpException If action can't be performed, exception rises.
     */
    public function beforeAction($action)
    {
        if(!\Yii::$app->user->can('is_admin_panel_access')) {
            throw new ForbiddenHttpException('Вы не авторизованы для доступа к панели администратора.');
        }
        else
            return true;
    }

    /**
     * Method for displaying all activities on site.
     *
     * @return string rendered activities list page.
     */
    public function actionActivities()
    {
        $dataProvider = new ActiveDataProvider(['query' => Activity::getAllActivities()]);
        return $this->render('activities', [
            'activities' => $dataProvider
        ]);
    }

    /**
     * Method for displaying all users by categories.
     *
     * @return string rendered users list.
     */
    public function actionUsers()
    {
        $label = '';
        if(\Yii::$app->request->isPjax) {
            switch ($_POST['category'])
            {
                case 'is-users':
                    $query = User::getIsUsers();
                    $label = 'Пользователи ИС';
                break;
                case 'ckp-moderators':
                    $query = User::getCkpModerators();
                    $label = 'Модераторы ЦКП';
                break;
                case 'ckp-administrators':
                    $query = User::getCkpAdministrators();
                    $label = 'Администраторы ЦКП';
                break;
                case 'is-moderators':
                    $query = User::getIsModerators();
                    $label = 'Модераторы ИС';
                break;
                case 'is-administrators':
                    $query = User::getIsAdministrators();
                    $label = 'Администраторы ИС';
                break;
                default:
                    $query = User::getAllUsers();
                break;
            }
        }
        else
            $query = User::getAllUsers();
        $usersProvider = new ActiveDataProvider([ 'query' => $query ]);
        return $this->render('users', ['users' => $usersProvider, 'label' => $label]);
    }
}