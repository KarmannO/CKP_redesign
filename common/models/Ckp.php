<?php
/**
 * Created by PhpStorm.
 * User: zenbu
 * Date: 02.03.2017
 * Time: 8:01
 */

namespace common\models;


use yii\db\ActiveRecord;

class Ckp extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%ckp}}';
    }

    public static function getValidCkp()
    {
        return Ckp::find()->where(['validation_status' => '1']);
    }
}