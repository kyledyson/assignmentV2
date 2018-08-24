<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\daterange\DateRangePicker;

/* @var $this yii\web\View */
/* @var $model app\models\SearchItem */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="div col-md-3" style="float: left;">
    <div class="item-search">

        <?php
        $form = ActiveForm::begin([
            'action' => ['index'],
            'method' => 'get',
            'options' => [
                'data-pjax' => 1
            ],
        ]); ?>

        <?= $form->field($model, 'category_id')->dropDownList($categories, ['prompt' => 'Search by category']) ?>

        <?= $form->field($model, 'location_id')->dropDownList($locations, ['prompt' => 'Search by location']) ?>

        <?= $form->field($model, 'title') ?>

        <?= $form->field($model, 'description') ?>
        <?php
        //    // DateRangePicker in a dropdown format (uneditable/hidden input) and uses the preset dropdown.
        echo '<label class="control-label">Date Range</label>';
        echo '<div class="drp-container">';
        echo '<div class="input-group drp-container">';
        echo DateRangePicker::widget([
            'model' => $model,
            'attribute' => 'created_at',
            'useWithAddon' => false,
            'presetDropdown' => true,
            'convertFormat' => true,
            'startAttribute' => 'start',
            'endAttribute' => 'end',
            'pluginOptions' => [
                'locale' => ['format' => 'Y-m-d'],
            ]
        ]);
        echo '</div>';
        ?>
        <div class="form-group">
            <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
            <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>
</div>