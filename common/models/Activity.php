<?php
/**
 * Created by PhpStorm.
 * User: zenbu
 * Date: 07.03.2017
 * Time: 4:52
 */

namespace common\models;


use yii\db\ActiveRecord;

class Activity extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%activity}}';
    }

    public static function getAllActivities()
    {
        return Activity::find()->orderBy('timestamp DESC');
    }
}