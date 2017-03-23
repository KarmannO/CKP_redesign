<?php
/**
 * Created by PhpStorm.
 * User: zenbu
 * Date: 01.03.2017
 * Time: 3:00
 */

namespace frontend\controllers;


use common\models\User;
use yii\base\Controller;
use yii\web\Response;

class UserController extends Controller
{
    public static function chooseWidgetOutput($data, $user)
    {
        foreach ($data as $key => $val)
        {
            $user[$key] = $val;
            return ['output' => $val, 'message' => ''];
        }
    }

    public function actionData()
    {
        $user = User::getCurrentUser();
        if(isset($_POST['hasEditable']))
        {
            \Yii::$app->response->format = Response::FORMAT_JSON;
            if($user->load($_POST['User'])) {
                return static::chooseWidgetOutput($_POST['User'], $user);
            }
            else {
                return ['output' => '', 'message' => 'Ошибка подтверждения'];
            }
        }
        return $this->render('data', ['model' => $user]);
    }
}