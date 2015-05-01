<?php
/* @var $this ArtigosvendaController */
/* @var $model Artigosvenda */

$this->breadcrumbs=array(
	'Artigosvendas'=>array('index'),
	$model->ID=>array('view','id'=>$model->ID),
	'Update',
);

$this->menu=array(
	array('label'=>'Listar Artigos venda', 'url'=>array('index')),
	array('label'=>'Criar Artigos venda', 'url'=>array('create')),
);
?>

<h1>Update Artigos venda <?php echo $model->ID; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model, 'lojas' => $lojas)); ?>