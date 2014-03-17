<?php
/* @var $this EntregaFornecedorController */
/* @var $model EntregaFornecedor */

$this->breadcrumbs=array(
	'Entrega Fornecedors'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'Listar Entregas Fornecedor', 'url'=>array('index')),
	//array('label'=>'Manage EntregaFornecedor', 'url'=>array('admin')),
);
?>

<h1>Criar Entrega Fornecedor</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>