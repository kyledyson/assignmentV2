<?php

use yii\helpers\Html;
use app\components\helpers\AccessHelper;

?>
<div class="col-md-9" style="float: right">
    <div class="media" id="items-index">
        <div class="media-left">
            <?php
            if ($model->images) {
                $img = Html::img('@web/uploads/' . $model->images[0]->path, [
                    'alt' => 'some', 'class' => 'thing',
                    'style' => 'max-height:175px; max-width:175px'
                ]);
                echo Html::a($img, ['view', 'id' => $model->id]);
            }
            ?>
        </div>
        <div class="media-body">
            <div style="float: right">
                <?php

                if (!AccessHelper::hasAccessToPost($model)) {
                    echo Html::a('<span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>', ['update', 'id' => $model->id], ['class' => 'btn btn-default']);
                }
                ?>
            </div>
            <h4 class="media-heading">  <?= Html::a($model->title, ['view', 'id' => $model->id]); ?>
            </h4>

            <p><?= $model->description ?></p>
            <p><?= $model->itemStatus ?></p>
            <p>Conditon: <?= $model->itemCondition ?></p>
            <p><?= $model->location->county . ', ' . Yii::$app->formatter->format($model->created_at, 'date') ?>
            </p>

        </div>
    </div>
    <hr>
</div>