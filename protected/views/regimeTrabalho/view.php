<?php
/* @var $this RegimeTrabalhoController */
/* @var $model RegimeTrabalho */

$this->breadcrumbs=array(
	'Regime Trabalhos'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List RegimeTrabalho', 'url'=>array('index')),
	array('label'=>'Create RegimeTrabalho', 'url'=>array('create')),
	array('label'=>'Update RegimeTrabalho', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete RegimeTrabalho', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage RegimeTrabalho', 'url'=>array('admin')),
);
?>

<h1>View RegimeTrabalho #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'nome',
	),
)); ?>
