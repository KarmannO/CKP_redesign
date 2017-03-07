<?php
/**
 * Created by PhpStorm.
 * User: zenbu
 * Date: 06.03.2017
 * Time: 5:43
 */

namespace common\models;


use yii\db\ActiveRecord;

class Organization extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%organization}}';
    }
}