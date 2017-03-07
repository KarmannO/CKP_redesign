<?php
/**
 * Created by PhpStorm.
 * User: zenbu
 * Date: 06.03.2017
 * Time: 8:48
 */

namespace common\models;


use yii\db\ActiveRecord;

class Rank extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%rank}}';
    }
}