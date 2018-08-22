<?php

use yii\helpers\Html;
use app\components\helpers\AccessHelper;

?>
<div class="col-sm-6 col-md-9">
    <div class="thumbnail">
        <h3><?= $model->title ?></h3>
        <?php
        if ($model->images) {
            $images = [];
            foreach ($model->images as $image) {
                array_push($images, Html::img('@web/uploads/' . $image->path, ['alt' => 'some', 'class' => 'thing']));
            }
            echo yii\bootstrap\Carousel::widget(['items' => $images]);
        }
        ?>
        <div class="caption">
            <p>Description: <?= $model->description ?></p>
            <p>Status: <?= $model->itemStatus ?></p>
            <p>Conditon: <?= $model->itemCondition ?></p>
            <p>Posted: <?=  Yii::$app->formatter->format($model->created_at, 'date')?></p>
            <?= Html::a('View', ['view', 'id' => $model->id], [
                'class' => 'btn btn-default',
            ]) ?>
            <?php
            if (!AccessHelper::hasAccessToPost($model)) {
                echo Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-default']);
            }
            ?>
            </p>
        </div>
    </div>
</div>