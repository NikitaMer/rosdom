<?php
/* @var $this ProjectsController */
/* @var $model Projects */

$this->breadcrumbs=array(
	'Projects'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Projects', 'url'=>array('index')),
	array('label'=>'Create Projects', 'url'=>array('create')),
	array('label'=>'Upload Base', 'url'=>array('upload')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#projects-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Projects</h1>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'projects-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
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
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
