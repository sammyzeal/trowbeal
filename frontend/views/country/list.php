<?php
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use yiimodules\categories\models\Categories;
?>

<?= $dataCategory=ArrayHelper::map(Yii::$app->getModule('categories')->getAll(), 'id', 'name');
     $form->field($model, 'type_id')->dropDownList($dataCategory, 
             ['prompt'=>'-Choose a Category-',
              'onchange'=>'
                $.post( "'.Yii::$app->urlManager->createUrl('post/lists?id=').'"+$(this).val(), function( data ) {
                  $( "select#title" ).html( data );
                });
            ']); 
 ?>
<?=
    $dataPost=ArrayHelper::map(Yii::$app->getModule('categories')->getAll(), 'id', 'name');
     $form->field($model, 'name')
        ->dropDownList(
            $dataPost,           
            ['id'=>'name']
        );
    ?>