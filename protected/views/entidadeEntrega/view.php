<?php
/* @var $this EntidadeEntregaController */
/* @var $model EntidadeEntrega */

$this->breadcrumbs=array(
	'Entidade Entregas'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List EntidadeEntrega', 'url'=>array('index')),
	array('label'=>'Create EntidadeEntrega', 'url'=>array('create')),
	array('label'=>'Update EntidadeEntrega', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete EntidadeEntrega', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage EntidadeEntrega', 'url'=>array('admin')),
);
?>

<h1>View EntidadeEntrega #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'nome',
		'activo',
	),
)); ?>
