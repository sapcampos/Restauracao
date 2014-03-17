<?php
/* @var $this ConcelhosController */
/* @var $model Concelhos */

$this->breadcrumbs=array(
	'Concelhos'=>array('index'),
	$model->nome,
);

$this->menu=array(
	array('label'=>'Listar Concelhos', 'url'=>array('index')),
	array('label'=>'Criar Concelhos', 'url'=>array('create')),
	//array('label'=>'View Concelhos', 'url'=>array('view', 'id'=>$model->id)),
	//array('label'=>'Manage Concelhos', 'url'=>array('admin')),
);
?>

<h1>Update Concelhos <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>