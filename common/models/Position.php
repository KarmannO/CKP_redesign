<?php
/**
 * Created by PhpStorm.
 * User: zenbu
 * Date: 06.03.2017
 * Time: 8:35
 */

namespace common\models;


use yii\db\ActiveRecord;

class Position extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%position}}';
    }
}