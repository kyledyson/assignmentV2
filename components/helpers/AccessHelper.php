<?php

namespace app\components\helpers;

use Yii;

class AccessHelper
{
    public static function hasAccessToPost($item)
    {
        return Yii::$app->user->id !== $item->user_id;
    }

    public static function hasAccess($user = null,$id = null)
    {
        $user_id  = isset($user->id) ?: $id;
        return Yii::$app->user->id != $user_id;
    }
}