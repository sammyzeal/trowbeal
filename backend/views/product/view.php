<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;
use yii;


/* @var $this yii\web\View */
/* @var $model backend\models\Product */

$this->title = $model->name;
//$this->params['breadcrumbs'][] = ['label' => 'Products', 'url' => ['index']];
//$this->params['breadcrumbs'][] = $this->title;
?>

<?= $this->render('_section', [
        
    ]) ?>
<section class="content">
<div class="box box-primary">
      <div class="box-body">
    <p>
        <?= Html::a('Update', ['update', 'id' => $model->product_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->product_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>
   <div class="col-md-9">
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'product_id',
            'type_id',
            'type_name',
            'name',
            'descr',
            'status',
            'price',
            //'image',
            [
             'attribute'=>'image',
            //'label'=>'Image',
            'format'=>   ['image',['width'=>'120', 'height'=>'100']],
            'value' =>  $model->image,
             ],
            
            //'added_at',
            [
                'attribute'=> 'added_at',
                'value' => ($model->added_at !='') ? date('d -M -Y   h:i   a') : ('Not set'),
                'format'=> 'raw',
            ],
            [
                'attribute'=> 'updated_at',
                'value' => ($model->updated_at !='') ? date('d -M -Y   h:i   a ') : ('Not set'),
                'format'=> 'raw',
            ],
            //'updated_at',
            'views',
            'reviews',
        ],
    ]) ?>
     </div>
   </div>
 </div>
</section>