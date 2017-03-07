<?php

/**
 * Created by PhpStorm.
 * User: zenbu
 * Date: 07.03.2017
 * Time: 4:24
 */
namespace frontend\components\activities;

use common\models\Activity;

class ActivityHandler
{
    public static function handleNewCkp($ckp_id, $user_id, $ckp_title)
    {
        $json_info = [];
        $json_info['user_id'] = $user_id;
        $json_info['ckp_id'] = $ckp_id;
        $json_info['ckp_title'] = $ckp_title;
        return $json_info;
    }

    public static function handleNewUser($id, $username)
    {
        $json_info = [];
        $json_info['user_id'] = $id;
        $json_info['username'] = $username;
        return $json_info;
    }

    public static function handleChangeUserStatus($id, $status_from, $status_to)
    {

    }

    public static function register_activity($type, $json_info)
    {
        $activity = new Activity();
        $activity->type = $type;
        $activity->json_description = json_encode($json_info);
        $activity->timestamp = time();
        $activity->save();
    }
}