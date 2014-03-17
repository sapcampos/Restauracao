<?php
/* @var $this FuncionariosController */
/* @var $model Funcionarios */

$this->breadcrumbs=array(
	'Funcionarioses'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Funcionarios', 'url'=>array('index')),
	array('label'=>'Create Funcionarios', 'url'=>array('create')),
	array('label'=>'Update Funcionarios', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Funcionarios', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Funcionarios', 'url'=>array('admin')),
);
?>

<h1>View Funcionarios #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'nome',
		'datanascimento',
	),
)); ?>
