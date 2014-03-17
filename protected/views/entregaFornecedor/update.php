<?php
/* @var $this EntregaFornecedorController */
/* @var $model EntregaFornecedor */

$this->breadcrumbs=array(
	'Entrega Fornecedors'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'Listar Entregas Fornecedor', 'url'=>array('index')),
	/*array('label'=>'Create EntregaFornecedor', 'url'=>array('create')),
	array('label'=>'View EntregaFornecedor', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage EntregaFornecedor', 'url'=>array('admin')),*/
);
?>

<h1>Update Entrega Fornecedor <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>