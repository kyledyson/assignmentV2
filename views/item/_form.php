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
    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'category_id')->dropDownList($categories, ['prompt' => 'Please select a category']) ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'condition')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'location')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'price')->textInput() ?>
    <?php 
    if (Yii::$app->controller->action->id === 'create') {
        echo '<label class="control-label">Add Attachments</label>';
        echo FileInput::widget([
            'model' => $image,
            'attribute' => 'imageFiles[]',
            'options' => ['multiple' => true]
        ]);
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
