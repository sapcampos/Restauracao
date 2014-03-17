<?php
/* @var $this TipoFuncionarioController */
/* @var $model TipoFuncionario */

$this->breadcrumbs=array(
	'Tipo Funcionarios'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List TipoFuncionario', 'url'=>array('index')),
	array('label'=>'Manage TipoFuncionario', 'url'=>array('admin')),
);
?>

<h1>Create TipoFuncionario</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>