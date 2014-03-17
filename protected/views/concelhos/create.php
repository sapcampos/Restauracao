<?php
/* @var $this ConcelhosController */
/* @var $model Concelhos */

$this->breadcrumbs=array(
	'Concelhos'=>array('index'),
	'Criar',
);

$this->menu=array(
	array('label'=>'Listar Concelhos', 'url'=>array('index')),
	//array('label'=>'Manage Concelhos', 'url'=>array('admin')),
);
?>

<h1>Criar Concelhos</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>