<?php
/**
 * Created by PhpStorm.
 * User: zenbu
 * Date: 22.02.2017
 * Time: 10:46
 */

namespace common\models;


use yii\db\ActiveRecord;

class NewsItem extends ActiveRecord
{
    public static function tableName()
    {
        return "{{%new}}";
    }
}