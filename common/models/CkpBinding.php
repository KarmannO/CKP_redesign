<?php
/**
 * Created by PhpStorm.
 * User: zenbu
 * Date: 07.03.2017
 * Time: 10:11
 */

namespace common\models;


use yii\db\ActiveRecord;

class CkpBinding extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%ckp_binding}}';
    }
}