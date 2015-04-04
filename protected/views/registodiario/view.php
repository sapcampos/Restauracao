<?php
/* @var $this RegistodiarioController */
/* @var $model Registodiario */

$this->breadcrumbs=array(
	'Registodiarios'=>array('index'),
	$model->ID,
);

$this->menu=array(
	array('label'=>'List Registodiario', 'url'=>array('index')),
	array('label'=>'Create Registodiario', 'url'=>array('create')),
	array('label'=>'Update Registodiario', 'url'=>array('update', 'id'=>$model->ID)),
	array('label'=>'Delete Registodiario', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->ID),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Registodiario', 'url'=>array('admin')),
);
?>

<h1>View Registodiario #<?php echo $model->ID; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'ID',
		'IDLoja',
		'Data',
		'IDUtilizador',
		'Estado',
	),
)); ?>
