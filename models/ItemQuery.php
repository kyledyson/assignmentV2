<?php
namespace app\models;
use Yii;
/**
 * This is the ActiveQuery class for [[Item]].
 *
 * @see Item
 */
class ItemQuery extends \yii\db\ActiveQuery
{
    public function active()
    {
        return $this->andWhere('[[status]]=2');
    }
    public function draft()
    {
        return $this->andWhere('[[status]]=1');
    }
    public function owner(){
        return $this->andWhere(['user_id' => Yii::$app->user->id]);
    }
    /**
     * @inheritdoc
     * @return Item[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }
    /**
     * @inheritdoc
     * @return Item|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}