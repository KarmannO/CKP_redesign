<?php
/**
 * Created by PhpStorm.
 * User: zenbu
 * Date: 01.03.2017
 * Time: 5:14
 */

namespace frontend\controllers;


use common\models\Ckp;
use common\models\Service;
use common\models\User;
use yii\base\Controller;
use yii\base\ErrorException;
use yii\helpers\Html;

/**
 * Class ConstructorController
 * @package frontend\controllers
 * Class for handling constructor requests.
 */
class ConstructorController extends Controller
{
    /**
     * Action for rendering constructor form.
     * @return string
     */
    public function actionConstruct()
    {
        return $this->render('construct', ['valid_ckp_list' => Ckp::getValidCkp()]);
    }

    /**
     * Ajax action for getting short name of specific ckp.
     * @return mixed Ckp short name
     */
    public function actionAjax_get_ckp()
    {
        return Ckp::getCkp($_GET['id'])->one()->short_name;
    }

    /**
     * Function for serializing complicated object TODO: add format to wiki
     * to format _f[#value] => #label
     * @param $object \stdClass object.
     * @return array formatted hash.
     */
    private static function getValuesFromObject($object)
    {
        $result = [];
        foreach ($object as $value)
        {
            $result[$value->value] = $value->label;
        }
        return $result;
    }

    /**
     * Function for converting JSON element in specific format to output HTML form control.
     * @param $json_element array form data in JSON
     * @return string|null HTML form control or null if JSON is not correct.
     */
    private static function convertJsonElement($json_element)
    {
        // In case of some type we returning some HTML, null by default.
        switch ($json_element->type)
        {
            case 'checkbox':
            {
                return Html::label(isset($json_element->label) ? $json_element->label : '').'&nbsp;&nbsp;'.
                    Html::tag('span', '', [
                        'title'=> isset($json_element->description) ? $json_element->description : '',
                        'data-toggle'=>'tooltip',
                        'class' => isset($json_element->description) ? 'glyphicon glyphicon-question-sign' : '',
                        'style' => 'cursor: pointer'
                    ]).Html::checkbox($json_element->name, isset($json_element->value) ? true : false, [
                        'class' => isset($json_element->className)  ? $json_element->className : '',
                    ]
                );
            }
            break;
            case 'checkbox-group':
            {
                $values = $json_element->values;
                $result_html = '';
                foreach ($values as $obj)
                {
                    $result_html .= Html::label(isset($obj->label) ? $obj->label : '').'&nbsp;&nbsp;'.
                        Html::checkbox($json_element->name, isset($obj->selected) ? boolval($obj->selected) : false, [
                            'class' => isset($json_element->className) ? $json_element->className : '',
                        ]).Html::tag('br', null);
                }
                return $result_html;
            }
            break;
            case 'radio-group':
            {
                $values = $json_element->values;
                $result_html = '';
                foreach ($values as $obj)
                {
                    $result_html .= Html::label(isset($obj->label) ? $obj->label : '').'&nbsp;&nbsp;'.
                        Html::radio($json_element->name, isset($obj->selected) ? boolval($obj->selected) : false, [
                            'class' => isset($json_element->className) ? $json_element->className : '',
                        ]).Html::tag('br', null);
                }
                return $result_html;
            }
                break;
            case 'date':
            {
                return Html::label(isset($json_element->label) ? $json_element->label : '').'&nbsp;&nbsp;'.
                Html::tag('span', '', [
                    'title'=> isset($json_element->description) ? $json_element->description : '',
                    'data-toggle'=>'tooltip',
                    'class' => isset($json_element->description) ? 'glyphicon glyphicon-question-sign' : '',
                    'style' => 'cursor: pointer'
                ]).
                Html::input('date', $json_element->name, isset($json_element->value) ? $json_element->value : '',[
                    'class' => isset($json_element->className)  ? $json_element->className : '',
                ]);
            }
            break;
            case 'paragraph':
            {
                return Html::tag('p', isset($json_element->label) ? $json_element->label : '');
            }
            break;
            case 'text':
            {
                return Html::label(isset($json_element->label) ? $json_element->label : '').'&nbsp;&nbsp;'.
                Html::tag('span', '', [
                    'title'=> isset($json_element->description) ? $json_element->description : '',
                    'data-toggle'=>'tooltip',
                    'class' => isset($json_element->description) ? 'glyphicon glyphicon-question-sign' : '',
                    'style' => 'cursor: pointer'
                ]).
                Html::input('text', $json_element->name, isset($json_element->value) ? $json_element->value : '',[
                    'class' => isset($json_element->className)  ? $json_element->className : ''
                ]);
            }
            break;
            case 'textarea':
            {
                return Html::label(isset($json_element->label) ? $json_element->label : '').'&nbsp;&nbsp;'.
                Html::tag('span', '', [
                    'title'=> isset($json_element->description) ? $json_element->description : '',
                    'data-toggle'=>'tooltip',
                    'class' => isset($json_element->description) ? 'glyphicon glyphicon-question-sign' : '',
                    'style' => 'cursor: pointer'
                ]).
                Html::textarea($json_element->name, isset($json_element->value) ? $json_element->value : '', [
                    'class' => isset($json_element->className)  ? $json_element->className : '',
                    'rows' => isset($json_element->rows) ? $json_element->rows : 3
                ]);
            }
            break;
            case 'select':
            {
                return Html::label(isset($json_element->label) ? $json_element->label : '').'&nbsp;&nbsp;'.
                Html::tag('span', '', [
                    'title'=> isset($json_element->description) ? $json_element->description : '',
                    'data-toggle'=>'tooltip',
                    'class' => isset($json_element->description) ? 'glyphicon glyphicon-question-sign' : '',
                    'style' => 'cursor: pointer'
                ]).
                Html::dropDownList($json_element->name, null, self::getValuesFromObject($json_element->values), ['class' => 'form-control']);
            }
            break;
            case 'number':
            {
                return Html::label(isset($json_element->label) ? $json_element->label : '').'&nbsp;&nbsp;'.
                Html::tag('span', '', [
                    'title'=> isset($json_element->description) ? $json_element->description : '',
                    'data-toggle'=>'tooltip',
                    'class' => isset($json_element->description) ? 'glyphicon glyphicon-question-sign' : '',
                    'style' => 'cursor: pointer'
                ]).
                Html::input('number', $json_element->name, isset($json_element->value) ? $json_element->value : '',[
                    'class' => isset($json_element->className)  ? $json_element->className : '',
                    'min' => isset($json_element->min) ? $json_element->min : -1000000,
                    'max' => isset($json_element->max) ? $json_element->max : 1000000
                ]);
            }
            break;
            default:
                return null;
            break;
        }
    }

    /**
     * General function for getting HTML form control from request's raw data.
     * @param $raw_data string Json encoded data from request.
     * @return string HTML form control.
     */
    public static function getHtml($raw_data)
    {
        $json_data = json_decode($raw_data);
        $final_html = '';
        foreach ($json_data as $key => $value)
        {
            $final_html .= self::convertJsonElement($value).'<br>';
        }
        return $final_html;
    }

    /**
     * Action for handling HTML form getting.
     * @return null|string HTML form control if data is set, null if not.
     */
    public function actionAjax_get_html()
    {
        $raw_data = $_POST['raw_data'];
        if($raw_data)
        {
            return self::getHtml($raw_data);
        }
        return null;
    }

    /**
     * Ajax action for adding new service. TODO: move adding to model.
     * @throws ErrorException Throw if system cant add new service.
     */
    public function actionAjax_add_service()
    {
        $service_info = json_decode($_POST['service_info']);
        $service = new Service();
        $service->ckp = $service_info->ckp;
        $service->title = $service_info->name;
        $service->description = $service_info->description;
        $service->json_template = $_POST['form_json'];
        $service->html = $_POST['form_html'];
        $service->validation_status = 2;
        $service->author_id = User::getCurrentUser()->id;
        if(!$service->save())
            throw new ErrorException('Не удалось сохранить услугу.');
        return;
    }
}