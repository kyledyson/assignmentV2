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
<div class="filter_form">
    <?= $this->render('_search', ['model' => $searchModel, 'categories' => $categories, 'locations' => $locations]) ?>
</div>
<div class="item-index col-md-4">
        <?php
        echo ListView::widget([
            'dataProvider' => $dataProvider,
            'itemView' => '_list_items',
        ]);
        ?>
    </div>
<?php Pjax::end(); ?>
