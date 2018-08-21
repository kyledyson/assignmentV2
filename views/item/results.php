<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\ListView;

//var_dump($dataProvider);die;
//\yii\helpers\VarDumper::dump($dataProvider);
?>
<?php
//foreach ($data as $item){
//    print_r($item);
//}
//die;
?>
<div class="col-sm-6 col-md-4">
    <div class="thumbnail">
        <div class="caption">
            <h3><?php
                var_dump($data);
//                echo ListView::widget([
//                    'dataProvider' => $data,
//                ]);
//                DetailView::widget([
//                    'model' => $model,
//                    'attributes' => [
//                        'title',
//                        'description',
//                    ]
//                ]);


                ?></h3>

            <!--                --><?php //var_dump( $data); ?>
            <!--            <p>--><? //= $dataProvider->description ?><!--</p>-->
            <!--            <p><a href="#" class="btn btn-primary" role="button">Add to Basket</a>-->
            <!--                --><? //= Html::a('Update', ['update', 'id' => $dataProvider->id], ['class' => 'btn btn-default']) ?>
            <!--            </p>-->
        </div>
    </div>
</div>