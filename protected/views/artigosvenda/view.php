<?php
/* @var $this ArtigosvendaController */
/* @var $model Artigosvenda */

$this->breadcrumbs=array(
	'Artigosvendas'=>array('index'),
	$model->ID,
);

$this->menu=array(
	array('label'=>'List Artigosvenda', 'url'=>array('index')),
	array('label'=>'Create Artigosvenda', 'url'=>array('create')),
	array('label'=>'Update Artigosvenda', 'url'=>array('update', 'id'=>$model->ID)),
	array('label'=>'Delete Artigosvenda', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->ID),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Artigosvenda', 'url'=>array('admin')),
);
?>

<h1>View Artigosvenda #<?php echo $model->ID; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'ID',
		'Nome',
		'PesoIdeal',
		'Activo',
		'Deleted',
	),
)); ?>
