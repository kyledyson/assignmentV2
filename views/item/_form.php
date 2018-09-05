<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use \kartik\file\FileInput;

use yii\helpers\Url;


/* @var $this yii\web\View */
/* @var $model app\models\Item */
/* @var $form yii\widgets\ActiveForm */
// var_dump($initialPreview);die;
?>
<div class="item-form">
    <?php $form = ActiveForm::begin(['id' => 'create-form', 'options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'category_id')->dropDownList($categories, ['prompt' => 'Please select a category']) ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'condition')->dropDownList([0 => 'New', 1 => 'Old'], ['prompt' => 'Please select a condition']) ?>

    <?= $form->field($model, 'location_id')->dropDownList($locations, ['prompt' => 'Please select a location']) ?>

    <?= $form->field($model, 'price')->textInput() ?>
    <?php
    // if action is create display empty file input
    if (Yii::$app->controller->action->id === 'create') {
        echo '<label class="control-label">Add Attachments</label>';
        echo FileInput::widget([
            'model' => $image,
            'attribute' => 'imageFiles[]',
            'options' => ['multiple' => true]
        ]);
        // else display input with previews of uploaded images
        } else {
            echo FileInput::widget([
            'name' => 'imageFiles[]',
            'options'=>[
                'multiple'=>true
            ],
            'pluginOptions' => [
                'initialPreviewShowDelete' => true,
                'initialPreview'=> $initialPreview,
                'initialPreviewAsData'=>true,
                'initialCaption'=>"Add more and then remove any if needed.",
                'initialPreviewConfig' => $initialPreviewConfig,
                'overwriteInitial'=>false,
                'maxFileSize'=>2800,
                'deleteUrl' => "/item/delete-image?id={$model->id}",
            ]
        ]);            
        }
    ?>
    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
