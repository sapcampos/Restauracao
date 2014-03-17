<?php
/* @var $this LojaController */
/* @var $model Loja */

$this->breadcrumbs=array(
	'Lojas'=>array('index'),
	$model->id=>array('update','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'Listar Lojas', 'url'=>array('index')),
	array('label'=>'Criar Loja', 'url'=>array('create')),
	//array('label'=>'View Loja', 'url'=>array('view', 'id'=>$model->id)),
	//array('label'=>'Manage Loja', 'url'=>array('admin')),
);
?>

<h1>Update Loja <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>