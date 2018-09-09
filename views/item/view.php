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
    <div class="media" id="items-index">
        <div class="col-md-3" style="max-height:300px; max-width:300px">
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
        <div class="media-body">
            <p>£<?= $model->price?></p>
            <p><?= $model->description ?></p>
            <p><?= $model->itemStatus ?></p>
            <p>Conditon: <?= $model->itemCondition ?></p>
            <p><?= $model->location->county . ', ' . Yii::$app->formatter->format($model->created_at, 'date') ?>
            </p>
        </div>
    </div>
</div>