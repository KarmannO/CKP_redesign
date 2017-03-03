<?php
/**
 * Created by PhpStorm.
 * User: zenbu
 * Date: 01.03.2017
 * Time: 5:14
 */

namespace frontend\controllers;


use common\models\Ckp;
use yii\base\Controller;
use yii\helpers\Html;

class ConstructorController extends Controller
{
    public function actionConstruct()
    {
        $valid_ckp_list = Ckp::getValidCkp();
        return $this->render('construct', ['valid_ckp_list' => $valid_ckp_list]);
    }

    private function getValuesFromObject($object)
    {
        $result = [];
        foreach ($object as $value)
        {
            $result[$value->value] = $value->label;
        }
        return $result;
    }

    private function convertJsonElement($json_element)
    {
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
                return 'Группа чекбоксов';
            }
            break;
            case 'radio-group':
            {
                return 'Группа радио кнопок';
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
                Html::dropDownList($json_element->name, null, $this->getValuesFromObject($json_element->values), ['class' => 'form-control']);
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
        }
    }

    public function actionAjax_get_html()
    {
        $raw_data = $_POST['raw_data'];
        if($raw_data)
        {
            $json_data = json_decode($raw_data);
            $final_html = '';
            foreach ($json_data as $key => $value)
            {
                $final_html .= $this->convertJsonElement($value).'<br>';
            }
            echo $final_html;
        }
    }

    public function actionAjax_add_service()
    {

    }
}