<?php
/* @var $this UtilizadoresController */
/* @var $model Utilizadores */

$this->breadcrumbs=array(
	'Utilizadores'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'Listar Utilizadores', 'url'=>array('index')),
	//array('label'=>'Gerir Utilizadores', 'url'=>array('admin')),
);
?>

<h1>Criar Utilizadores</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>