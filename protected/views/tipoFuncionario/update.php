<?php
/* @var $this TipoFuncionarioController */
/* @var $model TipoFuncionario */

$this->breadcrumbs=array(
	'Tipo Funcionarios'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List TipoFuncionario', 'url'=>array('index')),
	array('label'=>'Create TipoFuncionario', 'url'=>array('create')),
	array('label'=>'View TipoFuncionario', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage TipoFuncionario', 'url'=>array('admin')),
);
?>

<h1>Update TipoFuncionario <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>