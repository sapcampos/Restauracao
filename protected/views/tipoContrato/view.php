<?php
/* @var $this TipoContratoController */
/* @var $model TipoContrato */

$this->breadcrumbs=array(
	'Tipo Contratos'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List TipoContrato', 'url'=>array('index')),
	array('label'=>'Create TipoContrato', 'url'=>array('create')),
	array('label'=>'Update TipoContrato', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete TipoContrato', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage TipoContrato', 'url'=>array('admin')),
);
?>

<h1>View TipoContrato #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'nome',
	),
)); ?>
