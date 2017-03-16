<?php
/**
 * Created by PhpStorm.
 * User: zenbu
 * Date: 13.03.2017
 * Time: 17:24
 */

namespace common\models;


use yii\db\ActiveRecord;

class ServiceBinding extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%service_binding}}';
    }

    public static function getEquipmentByService($service)
    {
        $equipment_ids = static::find()->where(['service' => $service])->select('equipment');
        return Equipment::find()->where(['id' => $equipment_ids]);
    }

    public static function removeFromModel($service, $equipment)
    {
        $binding_id = static::find()->where(['service' => $service, 'equipment' => $equipment])->select('id');
        $binding = static::find()->where(['id' => $binding_id])->one();
        $binding->delete();
    }
}