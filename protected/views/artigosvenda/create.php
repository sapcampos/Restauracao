<?php
/* @var $this ArtigosvendaController */
/* @var $model Artigosvenda */

$this->breadcrumbs=array(
	'Artigosvendas'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'Listar Artigos Venda', 'url'=>array('index')),
);
?>

<h1>Criar Artigos Venda</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model, 'lojas' => $lojas)); ?>