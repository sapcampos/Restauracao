<?php
/* @var $this ContratoController */
/* @var $model Contrato */

$this->breadcrumbs=array(
	'Contratos'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'Listar Contratos', 'url'=>array('index')),
	//array('label'=>'Manage Contrato', 'url'=>array('admin')),
);
?>

<h1>Criar Contrato</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>