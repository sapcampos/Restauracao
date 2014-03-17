<?php
/* @var $this ArtigosController */
/* @var $model Artigos */

$this->breadcrumbs=array(
	'Artigoses'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Artigos', 'url'=>array('index')),
	array('label'=>'Create Artigos', 'url'=>array('create')),
	array('label'=>'Update Artigos', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Artigos', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Artigos', 'url'=>array('admin')),
);
?>

<h1>View Artigos #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'descricao',
		'idfornecedor',
		'activo',
		'quant_enc',
		'tipounidade_enc',
		'tipounidade_stock',
	),
)); ?>
