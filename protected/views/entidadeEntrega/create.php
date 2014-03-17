<?php
/* @var $this EntidadeEntregaController */
/* @var $model EntidadeEntrega */

$this->breadcrumbs=array(
	'Entidade Entregas'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'Listar Entidade Entrega', 'url'=>array('index')),
	//array('label'=>'Manage EntidadeEntrega', 'url'=>array('admin')),
);
?>

<h1>Criar Entidade Entrega</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>