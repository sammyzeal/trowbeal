<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */?>

<div class="row">
	<div class="col-xs-12">
		<?php foreach (Yii::$app->session->getAllFlashes() as $type => $message): ?>
			<?php if (in_array($type, ['success', 'danger', 'warning', 'info'])): ?>
				<div class="alert alert-<?= $type ?> alert-dismissable">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                       <i class="icon fa fa-check">&nbsp;&nbsp;<?= $message ?></i>
				</div>
			<?php endif ?>
		<?php endforeach ?>
	</div>
</div>
