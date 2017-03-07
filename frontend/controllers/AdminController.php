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

class AdminController extends Controller
{
    public function beforeAction($action)
    {
        if(!\Yii::$app->user->can('is_admin_panel_access')) {
            throw new ForbiddenHttpException('Вы не авторизованы для доступа к панели администратора.');
        }
        else
            return true;
    }

    public function actionActivities()
    {
        $dataProvider = new ActiveDataProvider(['query' => Activity::getAllActivities()]);
        return $this->render('activities', [
            'activities' => $dataProvider
        ]);
    }
}