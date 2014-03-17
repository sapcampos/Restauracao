<?php
/* @var $this LojaController */
/* @var $model Loja */

$this->breadcrumbs=array(
	'Lojas'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Loja', 'url'=>array('index')),
	array('label'=>'Create Loja', 'url'=>array('create')),
	array('label'=>'Update Loja', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Loja', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Loja', 'url'=>array('admin')),
);
?>

<h1>View Loja #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'nome',
		'idconcelho',
		'activo',
	),
)); ?>
