<?php
/* @var $this ProjectsController */
/* @var $model Projects */

$this->breadcrumbs=array(
	'Projects'=>array('index'),
	'Upload',
);

$this->menu=array(
	array('label'=>'List Projects', 'url'=>array('index')),
	array('label'=>'Create Projects', 'url'=>array('create')),
	array('label'=>'View Projects', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Projects', 'url'=>array('admin')),
);
?>

<h1>Upload Base</h1>

