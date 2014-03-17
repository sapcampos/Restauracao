<?php
/* @var $this TipoUnidadeController */
/* @var $model TipoUnidade */

$this->breadcrumbs=array(
	'Tipo Unidades'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List TipoUnidade', 'url'=>array('index')),
	array('label'=>'Create TipoUnidade', 'url'=>array('create')),
	array('label'=>'Update TipoUnidade', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete TipoUnidade', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage TipoUnidade', 'url'=>array('admin')),
);
?>

<h1>View TipoUnidade #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'nome',
	),
)); ?>
