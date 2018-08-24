<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\User */

$this->title = $model->username;
$this->params['breadcrumbs'][] = $model->username;
?>
<div class="user-view">
    <div class="row">
        <div class="col-md-9">
            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'id',
                    'username',
                    'email:email',
                    'mobile_number',
                    'postcode',
                    'created_at:datetime',
                ],
            ]) ?>
            <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        </div>
        <div class="col-md-3">
            <?php
            if ($model->profile_picture) {
                echo Html::img('@web/uploads/profile/' . $model->profile_picture, ['style' => 'height:200px; width:200px; float: right;', 'class' => 'thumbnail float-right']);
            }
            ?>

        </div>
    </div>
</div>
