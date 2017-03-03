<?php
/**
 * Created by PhpStorm.
 * User: zenbu
 * Date: 02.03.2017
 * Time: 8:02
 */

namespace common\models;


use yii\db\ActiveRecord;

class Service extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%service}}';
    }

    public static function getServicesByCkp($ckp)
    {
        return Service::find()->where(['id' => $ckp]);
    }
}