<?php
/* @var $this LojaController */
/* @var $model Loja */

$this->breadcrumbs=array(
	'Lojas'=>array('index'),
	'Criar',
);

$this->menu=array(
	array('label'=>'Listar Loja', 'url'=>array('index')),
	//array('label'=>'Manage Loja', 'url'=>array('admin')),
);
?>

<h1>Criar Loja</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>