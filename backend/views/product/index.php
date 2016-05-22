<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii;
use yii\bootstrap\Modal;
use yii\helpers\Url;
use yii\widgets\Pjax;

//use yii\imagine\Image;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\ProductSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Products';
$this->params['breadcrumbs'][] = $this->title;
?>

<?= $this->render('_section') ?>
<?= $this->render('_alert') ?>
<section class="content">
<div class="box">

    <div class="box-body">
   
     <?php  echo $this->render('_search', ['model' => $searchModel]); ?>
      <p >
         
        <?= Html::button('Add new Product', ['value'=>Url::to(['product/create']),'class' => 'btn btn-success', 'id'=> 'modalButton']) ?>
    </p>
     <?php
      Modal::begin([
             'header'=>'<h4>Products</h4>',
             'id' => 'modal',
             'size' => 'modal-xm',
     ]);
     echo "<div id='modalContent'></div>";
     Modal::end();
  ?>
    
    <?php Pjax::begin(); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'pager' => [
        'firstPageLabel' => 'first',
        'lastPageLabel' => 'last',
        'prevPageLabel' => '<span class="glyphicon glyphicon-chevron-left"></span>',
        'nextPageLabel' => '<span class="glyphicon glyphicon-chevron-right"></span>',
        'maxButtonCount' => 5,
            
        // Customzing CSS class for navigating link
        'prevPageCssClass' => 'mypre',
        'nextPageCssClass' => 'mynext',
        'firstPageCssClass' => 'myfirst',
        'lastPageCssClass' => 'mylast',
            
      
    ],
        
        
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

           // 'product_id',
            'type_name',
            'name',
            'descr',
            'price',
            [
             'attribute'=>'image',
            'label'=>'Image',
            'format'=>'html',
            'value' => function ($data) {
                    $url = $data['image'];
                    $alt = $data['name'];
                    return Html::img($url, ['alt'=>$alt,'title'=>$alt,'width'=>'70','height'=>'50' ]);
             }
           ],
            // 'added_at','
            // 'updated_at',
            'views',
           'status',
            // 'reviews',
                 

            ['class' => 'yii\grid\ActionColumn'],
        ],
        'tableOptions' =>['class' => 'table table-striped table-bordered'],
    ]); ?>
    <?php Pjax::end(); ?>
    

  </div>
</div>
</section>









