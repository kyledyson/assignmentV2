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
<div style="float: left">
<?php if (Yii::$app->controller->action->id != 'your-items') { ?>
    <div class="col-md-3">
        <div class="filter_form">
            <?= $this->render('_search', ['model' => $searchModel, 'categories' => $categories, 'locations' => $locations]); ?>
        </div>
    </div>
<?php } ?>
<?php
echo ListView::widget([
    'dataProvider' => $dataProvider,
    'itemView' => '_list_items',
]);
?>
</div>
<?php Pjax::end(); ?>
