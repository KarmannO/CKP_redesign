<?php
/**
 * Created by PhpStorm.
 * User: zenbu
 * Date: 14.03.2017
 * Time: 14:52
 */

namespace frontend\controllers;


use common\models\Ckp;
use common\models\Service;
use common\models\ServiceBinding;
use yii\base\Controller;
use yii\bootstrap\Html;
use yii\helpers\ArrayHelper;

/**
 * Class RequestController
 * @package frontend\controllers
 * Class for handling user requests.
 */
class RequestController extends Controller
{
    /**
     *
     */
    public function actionList()
    {

    }

    /**
     * Action for handling request form rendering.
     * @return string Rendered request form page.
     */
    public function actionRequest()
    {
        $ckp_list = ArrayHelper::map(Ckp::getValidCkp()->all(), 'id', 'short_name');
        // Handling ajax list requests.
        if(\Yii::$app->request->isAjax)
        {
            // Get services list by ckp.
            if($_GET['type'] == 'services') {
                $ckp_id = $_GET['ckp_id'];
                return Html::label('Выберите услугу').Html::dropDownList('service-select', null, ArrayHelper::map(
                    Service::getServicesByCkp($ckp_id)->all(),
                    'id',
                    'title'),
                    [
                        'class' => 'form-control',
                        'id' => 'service-select-id'
                    ]);
            } // Get equipment list by service.
            elseif ($_GET['type'] == 'equipment') {
                $service_id = $_GET['service_id'];
                return Html::label('Выберите оборудование, на базе которого будет оказываться услуга').Html::dropDownList('equipment-select', null, ArrayHelper::map(
                    ServiceBinding::getEquipmentByService($service_id)->all(),
                    'id',
                    'title'),
                    [
                        'class' => 'form-control',
                        'id' => 'equipment-select-id'
                    ]);
            }
        }
        return $this->render('request', [
            'ckp_list' => $ckp_list
        ]);
    }
}