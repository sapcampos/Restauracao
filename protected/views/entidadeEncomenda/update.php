<?php
/* @var $this EntidadeEncomendaController */
/* @var $model EntidadeEncomenda */

$this->breadcrumbs=array(
	'Entidade Encomendas'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'Listar Entidade Encomenda', 'url'=>array('index')),
	array('label'=>'Criar Entidade Encomenda', 'url'=>array('create')),
	//array('label'=>'View EntidadeEncomenda', 'url'=>array('view', 'id'=>$model->id)),
	//array('label'=>'Manage EntidadeEncomenda', 'url'=>array('admin')),
);
?>

<h1>Update Entidade Encomenda <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>