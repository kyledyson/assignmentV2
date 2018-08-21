<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ItemSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="item-search">
    <div class="row">
    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>
  <!--   <div class="col-md-3">
        <?= $form->field($model, 'category_id') ?>        
    </div> -->
    <div class="col-md-3">
        <?= $form->field($model, 'title') ?>        
    </div>
    <div class="col-md-3">
        <?= $form->field($model, 'description') ?>
    </div>
    <div class="col-md-3">
        <?= $form->field($model, 'category_id')->dropDownList($categories, ['prompt' => 'Please select a category']) ?>
    </div>

</div>
    <?php // echo $form->field($model, 'condition') ?>

    <?php // echo $form->field($model, 'price') ?>
<div class="row">
    <div class="col-md-3">
        <div class="form-group">
            <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
            <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>
</div>
</div>
