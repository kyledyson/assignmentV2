<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;
use yii\helpers\VarDumper;
use yii\web\UploadedFile;

/**
 * This is the model class for table "item".
 *
 * @property int $id
 * @property int $user_id
 * @property int $category_id
 * @property string $title
 * @property string $description
 * @property string $condition
 * @property string $location_id
 * @property string $mobile_number
 * @property string $image_path
 * @property double $price
 * @property int $created_at
 * @property int $updated_at
 *
 * @property Category $category
 * @property User $user
 */
class Item extends ActiveRecord
{

    const STATUS_FOR_SALE = 0;
    const STATUS_SOLD = 1;

    const STATUS_NEW = 0;
    const STATUS_OLD = 1;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'item';
    }


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'description', 'condition', 'price', 'location_id', 'category_id'], 'required'],
            [['location_id', 'status', 'created_at', 'updated_at'], 'integer'],
            [['created_at'], 'safe'],
            [['description'], 'string'],
            [['price'], 'number'],
            [['status'], 'in', 'range' => [0, 1]],
            [['condition'], 'in', 'range' => [0, 1]],
            [['title', 'condition'], 'string', 'max' => 255],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Category::className(), 'targetAttribute' => ['category_id' => 'id']],
            [['location_id'], 'exist', 'skipOnError' => true, 'targetClass' => Area::className(), 'targetAttribute' => ['location_id' => 'id']],
        ];
    }

    // add timestamp and blameable behaviours
    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
                ],
            ],
            [
                'class' => BlameableBehavior::className(),
                'createdByAttribute' => 'user_id',
                'updatedByAttribute' => 'user_id'
            ],
        ];
    }

    public function getItemStatus()
    {
        if ($this->status === 0) {
            return 'For Sale';
        } else {
            return 'Sold';
        }
    }

    public function getItemCondition()
    {
        if ($this->condition === 0) {
            return 'New';
        } else {
            return 'Old';
        }
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User',
            'category_id' => 'Category',
            'title' => 'Title',
            'description' => 'Description',
            'condition' => 'Condition',
            'location_id' => 'Location',
            'image_path' => 'Image(s)',
            'price' => 'Price',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    public function getImages()
    {
        return $this->hasMany(Image::className(), ['item_id' => 'id']);
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['id' => 'category_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLocation()
    {
        return $this->hasOne(Area::className(), ['id' => 'location_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAllForUser()
    {
        return $this->andWhere(['user_id' => Yii::$app->user->id]);

    }


    public static function find()
    {
        return new ItemQuery(get_called_class());
    }

}
