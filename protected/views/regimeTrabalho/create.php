<?php
/* @var $this RegimeTrabalhoController */
/* @var $model RegimeTrabalho */

$this->breadcrumbs=array(
	'Regime Trabalhos'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List RegimeTrabalho', 'url'=>array('index')),
	array('label'=>'Manage RegimeTrabalho', 'url'=>array('admin')),
);
?>

<h1>Create RegimeTrabalho</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>