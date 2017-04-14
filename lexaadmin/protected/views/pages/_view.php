<?php
/* @var $this PagesController */
/* @var $data Pages */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('name')); ?>:</b>
	<?php echo CHtml::encode($data->name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('menu')); ?>:</b>
	<?php echo CHtml::encode($data->menu); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('lastedit')); ?>:</b>
	<?php echo CHtml::encode($data->lastedit); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('keyw')); ?>:</b>
	<?php echo CHtml::encode($data->keyw); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('des')); ?>:</b>
	<?php echo CHtml::encode($data->des); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('dir')); ?>:</b>
	<?php echo CHtml::encode($data->dir); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('content')); ?>:</b>
	<?php echo CHtml::encode($data->content); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('parent')); ?>:</b>
	<?php echo CHtml::encode($data->parent); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('type')); ?>:</b>
	<?php echo CHtml::encode($data->type); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('num')); ?>:</b>
	<?php echo CHtml::encode($data->num); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('title1')); ?>:</b>
	<?php echo CHtml::encode($data->title1); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('funcname')); ?>:</b>
	<?php echo CHtml::encode($data->funcname); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('site')); ?>:</b>
	<?php echo CHtml::encode($data->site); ?>
	<br />

	*/ ?>

</div>