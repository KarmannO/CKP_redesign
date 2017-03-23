<?php
/**
 * Created by PhpStorm.
 * User: zenbu
 * Date: 14.03.2017
 * Time: 16:30
 */

namespace common\models;


use yii\db\ActiveRecord;

class CkpDocument extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%ckp_document}}';
    }

    public static function findByCkp($ckp)
    {
        return static::find()->where(['ckp' => $ckp]);
    }

    public static function getByHash($hash)
    {
        return static::find()->where(['hash' => $hash])->one();
    }
}