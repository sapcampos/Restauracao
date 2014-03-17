<?php
/* @var $this FornecedoresController */
/* @var $model Fornecedores */

$this->breadcrumbs=array(
	'Fornecedores'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'Listar Fornecedores', 'url'=>array('index')),
	//array('label'=>'Manage Fornecedores', 'url'=>array('admin')),
);
?>

<h1>Criar Fornecedores</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model, 'arr' => $arr)); ?>