<?php

use yii\helpers\Html;

?>
<div class="col-sm-6 col-md-4">
    <div class="thumbnail">
        <?php
        $images = [];
        foreach ($model->images as $image) {
            array_push($images, Html::img('@web/uploads/' . $image->path, ['alt' => 'some', 'class' => 'thing']));
        }
            echo yii\bootstrap\Carousel::widget(['items'=>$images]);
        ?>
            <div class="caption">
            <h3><?= $model->title ?></h3>
            <p><?= $model->description ?></p>
            <p><a href="#" class="btn btn-primary" role="button">Add to Basket</a>
                <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-default']) ?>
            </p>
        </div>
    </div>
</div>