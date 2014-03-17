<?php
/* @var $this FuncionariosController */
/* @var $model Funcionarios */

$this->breadcrumbs=array(
	'Funcionarioses'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Funcionarios', 'url'=>array('index')),
	array('label'=>'Manage Funcionarios', 'url'=>array('admin')),
);
?>

<h1>Create Funcionarios</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>