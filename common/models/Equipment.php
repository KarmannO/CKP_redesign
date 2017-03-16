<?php
/**
 * Created by PhpStorm.
 * User: zenbu
 * Date: 13.03.2017
 * Time: 16:13
 */

namespace common\models;


use yii\db\ActiveRecord;

/**
 * Class Equipment
 * @package common\models
 * Model for representing equipment database table.
 */
class Equipment extends ActiveRecord
{
    /**
     * Function for table name dispatching.
     *
     * @return string Database table name.
     */
    public static function tableName()
    {
        return '{{%equipment}}';
    }

    public static function getByCkp($ckp)
    {
        return static::find()->where(['ckp_id' => $ckp]);
    }

    public static function removeItem($id)
    {
        $eq = Equipment::find()->where(['id' => $id])->one();
        return $eq->delete();
    }
}