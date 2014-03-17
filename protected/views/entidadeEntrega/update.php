<?php
/* @var $this EntidadeEntregaController */
/* @var $model EntidadeEntrega */

$this->breadcrumbs=array(
	'Entidade Entregas'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'Listar Entidade Entrega', 'url'=>array('index')),
	array('label'=>'Criar Entidade Entrega', 'url'=>array('create')),
	//array('label'=>'View EntidadeEntrega', 'url'=>array('view', 'id'=>$model->id)),
	//array('label'=>'Manage EntidadeEntrega', 'url'=>array('admin')),
);
?>

<h1>Update Entidade Entrega <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>