<?php
/* @var $this ConcelhosController */
/* @var $model Concelhos */

$this->breadcrumbs=array(
	'Concelhoses'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Concelhos', 'url'=>array('index')),
	array('label'=>'Create Concelhos', 'url'=>array('create')),
	array('label'=>'Update Concelhos', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Concelhos', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Concelhos', 'url'=>array('admin')),
);
?>

<h1>View Concelhos #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'nome',
	),
)); ?>
