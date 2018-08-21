<?php

namespace app\models;

use Yii;
use yii\behaviors\BlameableBehavior;

/**
 * This is the model class for table "image".
 *
 * @property int $id
 * @property string $path
 * @property int $item_id
 *
 * @property Item $item
 */
class Image extends \yii\db\ActiveRecord
{

    public $imageFiles;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'image';
    }

    public function rules()
    {
        return [
            [['path'], 'required'],
           [['path'], 'string', 'max' => 255],
            [['imageFiles'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg', 'maxFiles' => 4],
        ];
    }
    
    public function upload($model)
    {
       $image = new Image();
       foreach ($this->imageFiles as $file) {
            $image->path = $file->baseName . '.' . $file->extension;
            // if (Yii::$app->controller->action->id === 'create') {
            $model->link('images', $image);
            // }else {
            //     $model->unlink('images', $image);
            // }
            $image->save();
            $file->saveAs('uploads/' . $file->baseName . '.' . $file->extension);
            $image = new Image();
        } 
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'path' => 'Path',
            'item_id' => 'Item ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItem()
    {
        return $this->hasOne(Item::className(), ['id' => 'item_id']);
    }

}
