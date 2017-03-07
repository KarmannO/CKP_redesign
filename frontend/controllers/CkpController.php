<?php
/**
 * Created by PhpStorm.
 * User: zenbu
 * Date: 02.03.2017
 * Time: 7:21
 */

namespace frontend\controllers;


use common\models\Ckp;
use common\models\Degree;
use common\models\Position;
use common\models\Organization;
use common\models\Rank;
use frontend\models\CkpRegisterForm;
use yii\base\Controller;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
use yii\web\ForbiddenHttpException;

class CkpController extends Controller
{
    public function actionFull()
    {
        if(\Yii::$app->user->can('ckp_full_list'))
        {
            $dataProvider = new ActiveDataProvider(['query' => Ckp::getAllCkp()]);
            return $this->render('list', ['dataProvider' => $dataProvider]);
        }
        else
            throw new ForbiddenHttpException('Доступ запрещён');
    }

    public function actionMy()
    {
        if (\Yii::$app->user->can('ckp_my_list'))
        {
            $dataProvider = new ActiveDataProvider(['query' => Ckp::getMyCkp()]);
            return $this->render('list', ['dataProvider' => $dataProvider]);
        }
        else
            throw new ForbiddenHttpException('Доступ запрещён');
    }

    public function actionRegister()
    {
        $model = new CkpRegisterForm();
        if($model->load(\Yii::$app->request->post()) && $model->register())
            return \Yii::$app->response->redirect(['/site/index']);
        else {
            $organization_items = ArrayHelper::map(Organization::find()->all(), 'id', 'short_name');
            $position_items = ArrayHelper::map(Position::find()->orderBy('id')->all(), 'id', 'title');
            $degree_items = ArrayHelper::map(Degree::find()->orderBy('id')->all(), 'id', 'title');
            $rank_items = ArrayHelper::map(Rank::find()->orderBy('id')->all(), 'id', 'title');
            return $this->render('register', [
                'model' => $model,
                'organizations' => $organization_items,
                'positions' => $position_items,
                'degrees' => $degree_items,
                'ranks' => $rank_items
            ]);
        }
    }

    public function actionView()
    {
        $ckp_id = $_GET['id'];
        $data_provider = new ActiveDataProvider([ 'query' => Ckp::getCkp($ckp_id) ]);
        return $this->render('view', ['dataProvider' => $data_provider]);
    }
}