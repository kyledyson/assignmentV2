<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\components\helpers\AccessHelper;

/* @var $this yii\web\View */
/* @var $model app\models\Item */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Items', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="item-view">

    <h1><?= Html::encode($this->title) ?></h1>
    <p>
        <?php
        if (!AccessHelper::hasAccessToPost($model)) {
            echo Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']);
            echo Html::a('Delete', ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => 'Are you sure you want to delete this item?',
                    'method' => 'post',
                ],
            ]);
        }
        ?>
    </p>
    <div class="col-sm-6 col-md-10 col-md-offset-1 thumbnail">
        <div class="col-md-6 col-md-offset-3">
            <?php
            if ($model->images) {
                $images = [];
                foreach ($model->images as $image) {
                   $img = Html::img('@web/uploads/' . $image->path, ['alt' => 'some', 'class' => 'thing']);
                    array_push($images, Html::a($img, '@web/uploads/' . $image->path));
                }
                echo yii\bootstrap\Carousel::widget(['items' => $images]);
            }
            ?>
        </div>
        <div class="col-md-10">
            <div class="caption">
                <p><?= $model->description ?></p>
                <p>£<?= $model->price ?></p>
                <p><?= $model->location->county ?></p>
                </p>
            </div>
        </div>
    </div>
</div>