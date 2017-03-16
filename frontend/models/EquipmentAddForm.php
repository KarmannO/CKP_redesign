<?php
/**
 * Created by PhpStorm.
 * User: zenbu
 * Date: 14.03.2017
 * Time: 12:25
 */

namespace frontend\models;


use common\models\Equipment;
use yii\base\Model;

class EquipmentAddForm extends Model
{
    public $title;
    public $description;
    public $production_company;
    public $production_year;
    public $price;
    public $mark;

    public function rules()
    {
        return [
            [['title', 'description'], 'required'],
            [['production_company', 'production_year', 'price', 'mark'],'default']
        ];
    }

    public function attributeLabels()
    {
        return [
            'title' => 'Наименование',
            'description' => 'Описание оборудования',
            'production_company' => 'Производитель',
            'production_year' => 'Год выпуска',
            'price' => 'Цена оказания услуги',
            'mark' => 'Марка'
        ];
    }

    public function add($ckp)
    {
        if(!$this->validate())
            return null;

        $equipment = new Equipment();
        $equipment->title = $this->title;
        $equipment->ckp_id = $ckp;
        $equipment->description = $this->description;
        $equipment->production_company = $this->production_company;
        $equipment->production_year = $this->production_year;
        $equipment->price = $this->price;
        $equipment->mark = $this->mark;

        return $equipment->save() ? $equipment : null;
    }
}