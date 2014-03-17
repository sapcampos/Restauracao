<?php
/* @var $this ArtigosController */
/* @var $model Artigos */

$this->breadcrumbs=array(
	'Artigos'=>array('index'),
	'Criar',
);

$this->menu=array(
	array('label'=>'Lista Artigos', 'url'=>array('index')),
);
?>

<h1>Criar Artigos</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model, 'arr'=>$arr)); ?>