<?php
/* @var $this FuncionariosController */
/* @var $model Funcionarios */

$this->breadcrumbs=array(
	'Funcionarios'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'Listar Funcionarios', 'url'=>array('index')),
	//array('label'=>'Manage Funcionarios', 'url'=>array('admin')),
);
?>

<h1>Criar Funcionarios</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>