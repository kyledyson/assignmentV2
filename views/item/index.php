<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ActiveForm;
use \yii\widgets\ListView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ItemSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Items';
$this->params['breadcrumbs'][] = $this->title;
?>
<?php Pjax::begin(); ?>

<div >
    <div class="col-md-3">
        <div class="filter_form">
            <?= $this->render('_search', ['model' => $searchModel, 'categories' => $categories, 'locations' => $locations]); ?>
        </div>
    </div>
    <span class="text-sm text-muted">Filter By:</span>
    <?php
    echo $sort->link('created_at') . ' | ' . $sort->link('location_id'). ' | ' . $sort->link('category_id');
    echo ListView::widget([
        'dataProvider' => $dataProvider,
        'itemView' => '_list_items',
        'layout' => "{pager}\n{items}\n{summary}",

    ]);
    ?>
</div>
<?php Pjax::end(); ?>
