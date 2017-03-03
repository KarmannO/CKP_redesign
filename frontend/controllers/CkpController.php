<?php
/**
 * Created by PhpStorm.
 * User: zenbu
 * Date: 02.03.2017
 * Time: 7:21
 */

namespace frontend\controllers;


use common\models\Ckp;
use yii\base\Controller;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\web\ForbiddenHttpException;

class CkpController extends Controller
{
    public function actionList()
    {
        if(\Yii::$app->user->can('ckp_full_list'))
        {
            $dataProvider = new ActiveDataProvider(['query' => Ckp::find()]);
            return $this->render('list', ['dataProvider' => $dataProvider]);
        }
        else
            throw new ForbiddenHttpException('Доступ запрещён');
    }
}