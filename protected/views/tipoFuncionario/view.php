<?php
/* @var $this TipoFuncionarioController */
/* @var $model TipoFuncionario */

$this->breadcrumbs=array(
	'Tipo Funcionarios'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List TipoFuncionario', 'url'=>array('index')),
	array('label'=>'Create TipoFuncionario', 'url'=>array('create')),
	array('label'=>'Update TipoFuncionario', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete TipoFuncionario', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage TipoFuncionario', 'url'=>array('admin')),
);
?>

<h1>View TipoFuncionario #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'nome',
	),
)); ?>
