<?php

use yii\helpers\Html;
use yii\grid\GridView;
use \yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ItemSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Items';
$this->params['breadcrumbs'][] = $this->title;
?>
<?= $this->render('_search', ['model' => $searchModel, 'categories' => $categories]) ?>
<div class="item-index">
    <h1><?= Html::encode($this->title) ?></h1>
    <p>
        <?= Html::a('Create Item', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <div class="row">
       <?php
            echo ListView::widget([
                'dataProvider' => $dataProvider,
                'itemView' => '_list_items',
            ]);
        ?>
    </div>
</div>
