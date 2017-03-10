<?php
/**
 * Created by PhpStorm.
 * User: zenbu
 * Date: 09.03.2017
 * Time: 12:56
 */

namespace common\models;


use yii\db\ActiveRecord;

class CkpComment extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%ckp_comment}}';
    }

    public static function getByCkp($ckp_id)
    {
        return static::find()->where(['ckp_id' => $ckp_id]);
    }
}