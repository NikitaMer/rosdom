<?php
/* @var $this PagesController */
/* @var $model Pages */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'pages-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>200)); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'menu'); ?>
		<?php echo $form->textField($model,'menu',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'menu'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'lastedit'); ?>
		<?php echo $form->textField($model,'lastedit'); ?>
		<?php echo $form->error($model,'lastedit'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'keyw'); ?>
		<?php echo $form->textArea($model,'keyw',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'keyw'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'des'); ?>
		<?php echo $form->textArea($model,'des',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'des'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'dir'); ?>
		<?php echo $form->textField($model,'dir',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'dir'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'content'); ?>
		<?php echo $form->textArea($model,'content',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'content'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'parent'); ?>
		<?php echo $form->textField($model,'parent'); ?>
		<?php echo $form->error($model,'parent'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'type'); ?>
		<?php echo $form->textField($model,'type',array('size'=>1,'maxlength'=>1)); ?>
		<?php echo $form->error($model,'type'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'num'); ?>
		<?php echo $form->textField($model,'num'); ?>
		<?php echo $form->error($model,'num'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'title1'); ?>
		<?php echo $form->textArea($model,'title1',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'title1'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'funcname'); ?>
		<?php echo $form->textField($model,'funcname',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'funcname'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'site'); ?>
		<?php echo $form->textField($model,'site'); ?>
		<?php echo $form->error($model,'site'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->