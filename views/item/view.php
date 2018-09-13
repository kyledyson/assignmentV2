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
    <?php
    if ($model->images) {
        echo '<div class="col-md-3" style="max-height:600px; max-width:600px">';
        $images = [];
        foreach ($model->images as $image) {
            $img = Html::img('@web/uploads/' . $image->path, ['alt' => 'some', 'class' => 'thing']);
            array_push($images, ['content' => Html::a($img, '@web/uploads/' . $image->path), 'caption' => 'Click to Zoom']);
        }
        echo yii\bootstrap\Carousel::widget(['items' => $images]);
        echo '</div>';
    }
    ?>

<!--    <div class="media" id="items-index">-->

<!--        <div class="media-body">-->
    <div class="col-md-6">
            <p>£<?= $model->price?></p>
            <p><?= $model->description ?></p>
            <p><?= $model->itemStatus ?></p>
            <p>Conditon: <?= $model->itemCondition ?></p>
            <p><?= $model->location->county . ', ' . Yii::$app->formatter->format($model->created_at, 'date') ?>
            </p>
        <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal">
            Contact Owner
        </button>
        <!-- Modal -->
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Modal title</h4>
                    </div>
                    <div class="modal-body">
                        ...
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Save changes</button>
                    </div>
                </div>
            </div>
        </div>
        </div>
</div>
<!--    </div>-->
<!--</div>-->