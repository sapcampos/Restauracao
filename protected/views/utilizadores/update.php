<?php
/* @var $this UtilizadoresController */
/* @var $model Utilizadores */

$this->breadcrumbs=array(
	'Utilizadores'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'Listar Utilizadores', 'url'=>array('index')),
	array('label'=>'Criar Utilizadores', 'url'=>array('create')),
	//array('label'=>'Gerir Utilizadores', 'url'=>array('admin')),
);
?>

<h1>Update Utilizadores <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>