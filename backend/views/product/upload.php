<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Product */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="product-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    

    <?= $form->field($model, 'image')->fileInput() ?>

    

    

    <div class="form-group">
        <?= Html::submitButton( 'Create',  ['class'=>  'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
