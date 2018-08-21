<?php
namespace app\components\helpers;
use Yii;
class AccessHelper
{
	public static function hasAccessToPost($item)
	{
		return Yii::$app->user->id != $item->user_id;
	}
	public static function hasAccessToComment($comment)
	{
	return Yii::$app->user->id != $comment->user_id;
	}
}