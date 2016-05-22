<?php

use yii\helpers\Url;
use yii\helpers\Html;
?>

<section class="content-header">
    
          <h1>
            <?= Html::encode($this->title) ?>
            <small>advanced tables</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="<?= Yii::$app->urlManager->createUrl(['site']) ?>"><i class="fa fa-dashboard"></i> Home</a></li>
            <?php if(Yii::$app->controller->action->id !='index'): ?>
                 <li><a href="<?= Yii::$app->urlManager->createUrl(['product']) ?>"><?= Yii::$app->controller->id.'s' ?></a></li>
            <?php endif; ?>
            <?php if(Yii::$app->controller->action->id !='index'):?>
                 <li class="active"><?= Yii::$app->controller->action->id ?></li>
                 
            <?php else: ?>
                 <li class="active"><?= Yii::$app->controller->id ?></li>
            <?php endif; ?>
          </ol>
        </section>


