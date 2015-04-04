<?php
/* @var $this ArtigosvendaController */
/* @var $model Artigosvenda */

$this->breadcrumbs=array(
	'Artigosvendas'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Artigosvenda', 'url'=>array('index')),
	array('label'=>'Manage Artigosvenda', 'url'=>array('admin')),
);
?>

<h1>Create Artigosvenda</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model, 'lojas' => $lojas)); ?>