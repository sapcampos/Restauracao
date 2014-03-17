<?php
/* @var $this EntidadeEncomendaController */
/* @var $model EntidadeEncomenda */

$this->breadcrumbs=array(
	'Entidade Encomendas'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List EntidadeEncomenda', 'url'=>array('index')),
	array('label'=>'Create EntidadeEncomenda', 'url'=>array('create')),
	array('label'=>'Update EntidadeEncomenda', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete EntidadeEncomenda', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage EntidadeEncomenda', 'url'=>array('admin')),
);
?>

<h1>View EntidadeEncomenda #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'nome',
		'activo',
	),
)); ?>
