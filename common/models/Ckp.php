<?php
/**
 * Created by PhpStorm.
 * User: zenbu
 * Date: 02.03.2017
 * Time: 8:01
 */

namespace common\models;


use yii\base\ErrorException;
use yii\db\ActiveRecord;
use yii\web\NotFoundHttpException;

class Ckp extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%ckp}}';
    }

    public static function getAllCkp()
    {
        return Ckp::find()->where(['<>', 'validation_status', '0']);
    }

    public static function getValidCkp()
    {
        return Ckp::find()->where(['validation_status' => '1']);
    }

    public static function getMyCkp()
    {
        $my_ckp = CkpBinding::find()->where(['user_id' => \Yii::$app->user->identity->id])->select('ckp_id');
        return Ckp::find()->where(['id' => $my_ckp]);
    }

    public static function getCkp($id)
    {
        return Ckp::find()->where(['id' => $id]);
    }
}