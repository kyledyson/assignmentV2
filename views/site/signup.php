<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */

/* @var $model \frontend\models\SignupForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use \kartik\file\FileInput;

$this->title = 'Signup';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-signup">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>Please fill out the following fields to signup:</p>

    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'form-signup', 'options' => ['enctype' => 'multipart/form-data']]); ?>

            <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>
            <?php
            echo '<label class="control-label">Add Attachments</label>';
            echo FileInput::widget([
                'model' => $model,
                'attribute' => 'image',
                'options' => ['multiple' => false]
            ]);
            ?>
            <?= $form->field($model, 'email') ?>

            <?= $form->field($model, 'postcode') ?>

            <?= $form->field($model, 'mobile_number') ?>

            <?= $form->field($model, 'password')->passwordInput() ?>

            <div class="form-group">
                <?= Html::submitButton('Signup', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>