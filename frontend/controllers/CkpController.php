<?php
/**
 * Created by PhpStorm.
 * User: zenbu
 * Date: 02.03.2017
 * Time: 7:21
 */

namespace frontend\controllers;


use common\models\Ckp;
use common\models\CkpComment;
use common\models\CkpDocument;
use common\models\Degree;
use common\models\Position;
use common\models\Organization;
use common\models\Rank;
use common\models\Service;
use common\models\ServiceBinding;
use common\models\User;
use frontend\models\CkpCommentForm;
use frontend\models\CkpRegisterForm;
use frontend\models\CkpUploadForm;
use frontend\models\EquipmentAddForm;
use yii\helpers\BaseFileHelper;
use yii\web\UploadedFile;
use yii\base\Controller;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
use yii\web\ForbiddenHttpException;
use yii\web\Response;

/**
 * Class CkpController
 * @package frontend\controllers
 * Controller for handling actions performed in CKP.
 */
class CkpController extends Controller
{
    /**
     * Displays all ckp in list.
     *
     * @return string Rendered ckp list page.
     * @throws ForbiddenHttpException If access is denied.
     */
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

    /**
     * Displays ckp list of specific user.
     *
     * @return string Rendered ckp list page.
     * @throws ForbiddenHttpException If access is denied.
     */
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

    /**
     * Register new CKP.
     *
     * @return $this|string Renders register form or if register is success redirects to main page.
     */
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

    /**
     * Shows service of the specific CKP.
     *
     * @return string Rendered service page.
     */
    public function actionService()
    {
        $service_id = $_GET['id'];
        if(\Yii::$app->request->isPjax)
        {
            $eq_id = $_GET['eq_id'];
            ServiceBinding::removeFromModel($service_id, $eq_id);
        }
        $service = new ActiveDataProvider([ 'query' => Service::getService($service_id) ]);
        return $this->render('service', ['service' => $service]);
    }


    /**
     * Shows the current state of specific CKP.
     *
     * @return string Rendered ckp view page.
     */
    public function actionView()
    {
        $ckp_id = $_GET['id'];
        $comments_provider = new ActiveDataProvider([ 'query' => CkpComment::getByCkp($ckp_id), 'pagination' => [ 'pageSize' => CkpComment::find()->count() ] ]);
        $model = new CkpCommentForm();
        $equipment_form = new EquipmentAddForm();
        $file_model = new CkpUploadForm();

        // Handle file upload.
        if($model->load($_POST) && $model->send($ckp_id))
            return $this->renderPartial('__messages', ['form' => $model]);
        // Handle info edit with kartik\Editable.
        elseif(isset($_POST['hasEditable'])) {
            \Yii::$app->response->format = Response::FORMAT_JSON;
            $ckp = Ckp::getCkp($ckp_id)->one();
            if($ckp->load($_POST['Ckp'])) {
                return UserController::chooseWidgetOutput($_POST['Ckp'], $ckp);
            }
            else {
                return ['output' => '', 'message' => 'Ошибка подтверждения'];
            }
        }
        // Handle equipment add.
        elseif ($equipment_form->load(\Yii::$app->request->post()) && $equipment_form->add($ckp_id))
            return $this->renderPartial('__equipment', ['ckp_id' => $ckp_id]);
        elseif (isset($_FILES['CkpUploadForm']))
        {
            $file_model->upload($ckp_id);
            return \Yii::$app->response->redirect('/ckp/view?id='.$ckp_id);
        }
        else {
            $data_provider = new ActiveDataProvider(['query' => Ckp::getCkp($ckp_id)]);
            $services_provider = new ActiveDataProvider(['query' => Service::getServicesByCkp($ckp_id)]);
            return $this->render('view', [
                'model' => $model,
                'dataProvider' => $data_provider,
                'commentsProvider' => $comments_provider,
                'servicesProvider' => $services_provider,
                'equipment_form' => $equipment_form,
                'file_model' => $file_model
            ]);
        }
    }
}