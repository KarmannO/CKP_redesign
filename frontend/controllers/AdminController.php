<?php
/**
 * Created by PhpStorm.
 * User: zenbu
 * Date: 07.03.2017
 * Time: 5:33
 */

namespace frontend\controllers;


use common\models\Activity;
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
}