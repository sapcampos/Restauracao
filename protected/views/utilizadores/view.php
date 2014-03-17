<?php
/* @var $this UtilizadoresController */
/* @var $model Utilizadores */

$this->breadcrumbs=array(
	'Utilizadores'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Utilizadores', 'url'=>array('index')),
	array('label'=>'Create Utilizadores', 'url'=>array('create')),
	array('label'=>'Update Utilizadores', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Utilizadores', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Utilizadores', 'url'=>array('admin')),
);
?>

<h1>View Utilizadores #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'nome',
		'username',
		'password',
		'activo',
	),
)); ?>
