<?php
/* @var $this ArtigosController */
/* @var $model Artigos */

$this->breadcrumbs=array(
	'Artigos'=>array('index'),
	$model->descricao,
);

$this->menu=array(
	array('label'=>'Lista Artigos', 'url'=>array('index')),
	array('label'=>'Criar Artigos', 'url'=>array('create')),
);
?>

<h1>Update Artigos <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model, 'arr' => $arr)); ?>