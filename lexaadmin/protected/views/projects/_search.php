<?php
/* @var $this ProjectsController */
/* @var $model Projects */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id'); ?>
		<?php echo $form->textField($model,'id',array('size'=>9,'maxlength'=>9)); ?>
	</div>
<? /*
	<div class="row">
		<?php echo $form->label($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'konkurents'); ?>
		<?php echo $form->textField($model,'konkurents',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'des'); ?>
		<?php echo $form->textArea($model,'des',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'book'); ?>
		<?php echo $form->textArea($model,'book',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'mas_des'); ?>
		<?php echo $form->textArea($model,'mas_des',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'cd_des'); ?>
		<?php echo $form->textArea($model,'cd_des',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'o_pl'); ?>
		<?php echo $form->textField($model,'o_pl'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'g_pl'); ?>
		<?php echo $form->textField($model,'g_pl'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'mater'); ?>
		<?php echo $form->textArea($model,'mater',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'prev'); ?>
		<?php echo $form->textField($model,'prev',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'pl_z'); ?>
		<?php echo $form->textField($model,'pl_z'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'add_info'); ?>
		<?php echo $form->textArea($model,'add_info',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'important'); ?>
		<?php echo $form->textArea($model,'important',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'o2c'); ?>
		<?php echo $form->textField($model,'o2c',array('size'=>1,'maxlength'=>1)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'is_new'); ?>
		<?php echo $form->textField($model,'is_new',array('size'=>1,'maxlength'=>1)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'fs'); ?>
		<?php echo $form->textField($model,'fs',array('size'=>15,'maxlength'=>15)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'v'); ?>
		<?php echo $form->textField($model,'v'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'h'); ?>
		<?php echo $form->textField($model,'h'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'sflag'); ?>
		<?php echo $form->textField($model,'sflag',array('size'=>1,'maxlength'=>1)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'cd'); ?>
		<?php echo $form->textField($model,'cd',array('size'=>1,'maxlength'=>1)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'dt'); ?>
		<?php echo $form->textField($model,'dt',array('size'=>20,'maxlength'=>20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'pr0'); ?>
		<?php echo $form->textField($model,'pr0'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'pr1'); ?>
		<?php echo $form->textField($model,'pr1'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'pr2'); ?>
		<?php echo $form->textField($model,'pr2'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'pr3'); ?>
		<?php echo $form->textField($model,'pr3'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'pr4'); ?>
		<?php echo $form->textField($model,'pr4'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'pr0_cd'); ?>
		<?php echo $form->textField($model,'pr0_cd'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'pr1_cd'); ?>
		<?php echo $form->textField($model,'pr1_cd'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'pr2_cd'); ?>
		<?php echo $form->textField($model,'pr2_cd'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'pr3_cd'); ?>
		<?php echo $form->textField($model,'pr3_cd'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'pr4_cd'); ?>
		<?php echo $form->textField($model,'pr4_cd'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'pr0_arch'); ?>
		<?php echo $form->textField($model,'pr0_arch'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'pr1_arch'); ?>
		<?php echo $form->textField($model,'pr1_arch'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'pr2_arch'); ?>
		<?php echo $form->textField($model,'pr2_arch'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'pr3_arch'); ?>
		<?php echo $form->textField($model,'pr3_arch'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'pr4_arch'); ?>
		<?php echo $form->textField($model,'pr4_arch'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'arch'); ?>
		<?php echo $form->textField($model,'arch'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'forum'); ?>
		<?php echo $form->textField($model,'forum'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'archname'); ?>
		<?php echo $form->textField($model,'archname',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'dillername'); ?>
		<?php echo $form->textField($model,'dillername',array('size'=>6,'maxlength'=>6)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'request'); ?>
		<?php echo $form->textField($model,'request',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'mas_request'); ?>
		<?php echo $form->textField($model,'mas_request',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'cd_request'); ?>
		<?php echo $form->textField($model,'cd_request',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'cz_request'); ?>
		<?php echo $form->textField($model,'cz_request',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'pk_request'); ?>
		<?php echo $form->textField($model,'pk_request',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'cz_des'); ?>
		<?php echo $form->textArea($model,'cz_des',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'pk_des'); ?>
		<?php echo $form->textArea($model,'pk_des',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'flores'); ?>
		<?php echo $form->textField($model,'flores',array('size'=>3,'maxlength'=>3)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'site'); ?>
		<?php echo $form->textField($model,'site',array('size'=>8,'maxlength'=>8)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'konkurents2'); ?>
		<?php echo $form->textField($model,'konkurents2',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'masterov_links'); ?>
		<?php echo $form->textField($model,'masterov_links'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'lastedit'); ?>
		<?php echo $form->textField($model,'lastedit'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'lastcomment'); ?>
		<?php echo $form->textArea($model,'lastcomment',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'mas_lastcomment'); ?>
		<?php echo $form->textArea($model,'mas_lastcomment',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'cd_lastcomment'); ?>
		<?php echo $form->textArea($model,'cd_lastcomment',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'archlink'); ?>
		<?php echo $form->textField($model,'archlink',array('size'=>60,'maxlength'=>500)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'comments_count'); ?>
		<?php echo $form->textField($model,'comments_count',array('size'=>5,'maxlength'=>5)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'sver'); ?>
		<?php echo $form->textField($model,'sver',array('size'=>1,'maxlength'=>1)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'sverdate'); ?>
		<?php echo $form->textField($model,'sverdate'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'score'); ?>
		<?php echo $form->textField($model,'score',array('size'=>18,'maxlength'=>18)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'creator'); ?>
		<?php echo $form->textField($model,'creator'); ?>
	</div>
*/ ?>
	<div class="row">
		<?php echo $form->label($model,'rosdom_title'); ?>
		<?php echo $form->textField($model,'rosdom_title',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'rosdom_h1'); ?>
		<?php echo $form->textField($model,'rosdom_h1',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'rosdom_description'); ?>
		<?php echo $form->textArea($model,'rosdom_description',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'rosdom_des'); ?>
		<?php echo $form->textArea($model,'rosdom_des',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->