<?php
/* @var $this ProjectsController */
/* @var $model Projects */

$this->breadcrumbs=array(
	'Projects'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List Projects', 'url'=>array('index')),
	array('label'=>'Create Projects', 'url'=>array('create')),
	array('label'=>'Update Projects', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Projects', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Projects', 'url'=>array('admin')),
	array('label'=>'Upload Base', 'url'=>array('upload')),
);
?>

<h1>View Projects #<?php echo $model->id; ?></h1>

<?php echo CHtml::image(
	'http://www.rosdom.ru/projects/'.CHtml::encode(strtolower($model->id)).'/p-sm.jpg', 
	'123',
	array('width'=>200, 'height'=>150)
); ?>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		/*
		'name',
		'konkurents',
		'des',
		'book',
		'mas_des',
		'cd_des',
		'o_pl',
		'g_pl',
		'mater',
		'prev',
		'pl_z',
		'add_info',
		'important',
		'o2c',
		'is_new',
		'fs',
		'v',
		'h',
		'sflag',
		'cd',
		'dt',
		'pr0',
		'pr1',
		'pr2',
		'pr3',
		'pr4',
		'pr0_cd',
		'pr1_cd',
		'pr2_cd',
		'pr3_cd',
		'pr4_cd',
		'pr0_arch',
		'pr1_arch',
		'pr2_arch',
		'pr3_arch',
		'pr4_arch',
		'arch',
		'forum',
		'archname',
		'dillername',
		'request',
		'mas_request',
		'cd_request',
		'cz_request',
		'pk_request',
		'cz_des',
		'pk_des',
		'flores',
		'site',
		'konkurents2',
		'masterov_links',
		'lastedit',
		'lastcomment',
		'mas_lastcomment',
		'cd_lastcomment',
		'archlink',
		'comments_count',
		'sver',
		'sverdate',
		'score',
		'creator',
		*/
		'rosdom_title',
		'rosdom_h1',
		'rosdom_description',
		'rosdom_des',
	),
)); ?>
