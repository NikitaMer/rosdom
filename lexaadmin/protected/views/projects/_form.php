<?php
/* @var $this ProjectsController */
/* @var $model Projects */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'projects-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'id'); ?>
		<?php echo $form->textField($model,'id',array('size'=>9,'maxlength'=>9)); ?>
		<?php echo $form->error($model,'id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'konkurents'); ?>
		<?php echo $form->textField($model,'konkurents',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'konkurents'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'des'); ?>
		<?php echo $form->textArea($model,'des',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'des'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'book'); ?>
		<?php echo $form->textArea($model,'book',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'book'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'mas_des'); ?>
		<?php echo $form->textArea($model,'mas_des',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'mas_des'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'cd_des'); ?>
		<?php echo $form->textArea($model,'cd_des',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'cd_des'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'o_pl'); ?>
		<?php echo $form->textField($model,'o_pl'); ?>
		<?php echo $form->error($model,'o_pl'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'g_pl'); ?>
		<?php echo $form->textField($model,'g_pl'); ?>
		<?php echo $form->error($model,'g_pl'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'mater'); ?>
		<?php echo $form->textArea($model,'mater',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'mater'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'prev'); ?>
		<?php echo $form->textField($model,'prev',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'prev'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'pl_z'); ?>
		<?php echo $form->textField($model,'pl_z'); ?>
		<?php echo $form->error($model,'pl_z'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'add_info'); ?>
		<?php echo $form->textArea($model,'add_info',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'add_info'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'important'); ?>
		<?php echo $form->textArea($model,'important',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'important'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'o2c'); ?>
		<?php echo $form->textField($model,'o2c',array('size'=>1,'maxlength'=>1)); ?>
		<?php echo $form->error($model,'o2c'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'is_new'); ?>
		<?php echo $form->textField($model,'is_new',array('size'=>1,'maxlength'=>1)); ?>
		<?php echo $form->error($model,'is_new'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'fs'); ?>
		<?php echo $form->textField($model,'fs',array('size'=>15,'maxlength'=>15)); ?>
		<?php echo $form->error($model,'fs'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'v'); ?>
		<?php echo $form->textField($model,'v'); ?>
		<?php echo $form->error($model,'v'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'h'); ?>
		<?php echo $form->textField($model,'h'); ?>
		<?php echo $form->error($model,'h'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'sflag'); ?>
		<?php echo $form->textField($model,'sflag',array('size'=>1,'maxlength'=>1)); ?>
		<?php echo $form->error($model,'sflag'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'cd'); ?>
		<?php echo $form->textField($model,'cd',array('size'=>1,'maxlength'=>1)); ?>
		<?php echo $form->error($model,'cd'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'dt'); ?>
		<?php echo $form->textField($model,'dt',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'dt'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'pr0'); ?>
		<?php echo $form->textField($model,'pr0'); ?>
		<?php echo $form->error($model,'pr0'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'pr1'); ?>
		<?php echo $form->textField($model,'pr1'); ?>
		<?php echo $form->error($model,'pr1'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'pr2'); ?>
		<?php echo $form->textField($model,'pr2'); ?>
		<?php echo $form->error($model,'pr2'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'pr3'); ?>
		<?php echo $form->textField($model,'pr3'); ?>
		<?php echo $form->error($model,'pr3'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'pr4'); ?>
		<?php echo $form->textField($model,'pr4'); ?>
		<?php echo $form->error($model,'pr4'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'pr0_cd'); ?>
		<?php echo $form->textField($model,'pr0_cd'); ?>
		<?php echo $form->error($model,'pr0_cd'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'pr1_cd'); ?>
		<?php echo $form->textField($model,'pr1_cd'); ?>
		<?php echo $form->error($model,'pr1_cd'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'pr2_cd'); ?>
		<?php echo $form->textField($model,'pr2_cd'); ?>
		<?php echo $form->error($model,'pr2_cd'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'pr3_cd'); ?>
		<?php echo $form->textField($model,'pr3_cd'); ?>
		<?php echo $form->error($model,'pr3_cd'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'pr4_cd'); ?>
		<?php echo $form->textField($model,'pr4_cd'); ?>
		<?php echo $form->error($model,'pr4_cd'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'pr0_arch'); ?>
		<?php echo $form->textField($model,'pr0_arch'); ?>
		<?php echo $form->error($model,'pr0_arch'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'pr1_arch'); ?>
		<?php echo $form->textField($model,'pr1_arch'); ?>
		<?php echo $form->error($model,'pr1_arch'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'pr2_arch'); ?>
		<?php echo $form->textField($model,'pr2_arch'); ?>
		<?php echo $form->error($model,'pr2_arch'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'pr3_arch'); ?>
		<?php echo $form->textField($model,'pr3_arch'); ?>
		<?php echo $form->error($model,'pr3_arch'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'pr4_arch'); ?>
		<?php echo $form->textField($model,'pr4_arch'); ?>
		<?php echo $form->error($model,'pr4_arch'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'arch'); ?>
		<?php echo $form->textField($model,'arch'); ?>
		<?php echo $form->error($model,'arch'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'forum'); ?>
		<?php echo $form->textField($model,'forum'); ?>
		<?php echo $form->error($model,'forum'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'archname'); ?>
		<?php echo $form->textField($model,'archname',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'archname'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'dillername'); ?>
		<?php echo $form->textField($model,'dillername',array('size'=>6,'maxlength'=>6)); ?>
		<?php echo $form->error($model,'dillername'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'request'); ?>
		<?php echo $form->textField($model,'request',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'request'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'mas_request'); ?>
		<?php echo $form->textField($model,'mas_request',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'mas_request'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'cd_request'); ?>
		<?php echo $form->textField($model,'cd_request',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'cd_request'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'cz_request'); ?>
		<?php echo $form->textField($model,'cz_request',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'cz_request'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'pk_request'); ?>
		<?php echo $form->textField($model,'pk_request',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'pk_request'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'cz_des'); ?>
		<?php echo $form->textArea($model,'cz_des',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'cz_des'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'pk_des'); ?>
		<?php echo $form->textArea($model,'pk_des',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'pk_des'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'flores'); ?>
		<?php echo $form->textField($model,'flores',array('size'=>3,'maxlength'=>3)); ?>
		<?php echo $form->error($model,'flores'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'site'); ?>
		<?php echo $form->textField($model,'site',array('size'=>8,'maxlength'=>8)); ?>
		<?php echo $form->error($model,'site'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'konkurents2'); ?>
		<?php echo $form->textField($model,'konkurents2',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'konkurents2'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'masterov_links'); ?>
		<?php echo $form->textField($model,'masterov_links'); ?>
		<?php echo $form->error($model,'masterov_links'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'lastedit'); ?>
		<?php echo $form->textField($model,'lastedit'); ?>
		<?php echo $form->error($model,'lastedit'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'lastcomment'); ?>
		<?php echo $form->textArea($model,'lastcomment',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'lastcomment'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'mas_lastcomment'); ?>
		<?php echo $form->textArea($model,'mas_lastcomment',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'mas_lastcomment'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'cd_lastcomment'); ?>
		<?php echo $form->textArea($model,'cd_lastcomment',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'cd_lastcomment'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'archlink'); ?>
		<?php echo $form->textField($model,'archlink',array('size'=>60,'maxlength'=>500)); ?>
		<?php echo $form->error($model,'archlink'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'comments_count'); ?>
		<?php echo $form->textField($model,'comments_count',array('size'=>5,'maxlength'=>5)); ?>
		<?php echo $form->error($model,'comments_count'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'sver'); ?>
		<?php echo $form->textField($model,'sver',array('size'=>1,'maxlength'=>1)); ?>
		<?php echo $form->error($model,'sver'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'sverdate'); ?>
		<?php echo $form->textField($model,'sverdate'); ?>
		<?php echo $form->error($model,'sverdate'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'score'); ?>
		<?php echo $form->textField($model,'score',array('size'=>18,'maxlength'=>18)); ?>
		<?php echo $form->error($model,'score'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'creator'); ?>
		<?php echo $form->textField($model,'creator'); ?>
		<?php echo $form->error($model,'creator'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'rosdom_title'); ?>
		<?php echo $form->textField($model,'rosdom_title',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'rosdom_title'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'rosdom_h1'); ?>
		<?php echo $form->textField($model,'rosdom_h1',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'rosdom_h1'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'rosdom_description'); ?>
		<?php echo $form->textArea($model,'rosdom_description',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'rosdom_description'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'rosdom_des'); ?>
		<?php echo $form->textArea($model,'rosdom_des',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'rosdom_des'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->