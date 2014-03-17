<?php
/* @var $this RegimeTrabalhoController */
/* @var $model RegimeTrabalho */

$this->breadcrumbs=array(
	'Regime Trabalhos'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List RegimeTrabalho', 'url'=>array('index')),
	array('label'=>'Create RegimeTrabalho', 'url'=>array('create')),
	array('label'=>'View RegimeTrabalho', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage RegimeTrabalho', 'url'=>array('admin')),
);
?>

<h1>Update RegimeTrabalho <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>