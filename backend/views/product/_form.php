<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\models\ProductType;
use yii\helpers\Url;
use yiimodules\categories\models\Categories;
use yii\helpers\ArrayHelper;
//use kartik\select2\Select2;


/* @var $this yii\web\View */
/* @var $model backend\models\Product */
/* @var $form yii\widgets\ActiveForm */
?>
<?php //echo $this->render('_section') ?>
    <section class="content">
     <div class="box box-primary">
         <div class="box-header with-border">
                  <h3 class="box-title"><?= $model->isNewRecord ? 'Add New Product' : 'Update Product'?></h3>
                </div>
     <div class="box-body" >
    <?php $items = ArrayHelper::map(Yii::$app->getModule('categories')->getAll(),'id','name');  ?>
    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
     
      <div class="col-lg-12" >
    <?= $form->field($model, 'cat_id')->dropDownList($items,
            ['prompt'=>'-Choose a Category-',
              'onchange'=> '
                $.post( "index.php?r=product/lists&id='.'"+$(this).val(), function( data ) {
                  $( "select#products-type_id" ).html( data );
                });
            '])?>
          
          <?= $form->field($model, 'type_id')->dropDownList($items,
            ['prompt'=>'-Choose SubCategory-',
              
            ])?>
          
          
     
    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'descr')->textarea(['maxlength' => true]) ?>
    
    <?= $form->field($model, 'price')->textInput() ?>
         
    <?= $model->isNewRecord ? '' : Html::img($model->image, ['alt'=>$model->name,'title'=>$model->name,'width'=>'150','height'=>'120' ]);?>
   
    <?= $form->field($model, 'image')->fileInput() ?>

    

    

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-primary' : 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>
     </div>
    
    <?php ActiveForm::end(); ?>
   </div>
         
   </div>
 </section>       

