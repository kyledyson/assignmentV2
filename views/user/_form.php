<?php

use kartik\file\FileInput;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\User */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-form">

    <?php $form = ActiveForm::begin(  ['id' => 'user-update']
); ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?php echo $form->field($model, 'image')->widget(FileInput::classname(), [
        'options' => [
            'multiple' => false
        ],
        'pluginOptions' => [
            'initialPreviewShowDelete' => false,
            'initialPreview' => '/uploads/profile/' .$model->profile_picture,
            'initialPreviewAsData' => true,
            'overwriteInitial' => true,
            'maxFileSize' => 2800
        ]
    ]);
    ?>
    <?= $form->field($model, 'mobile_number')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'postcode')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
