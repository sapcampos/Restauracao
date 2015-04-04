<?php
/* @var $this ArtigosvendaController */
/* @var $model Artigosvenda */

$this->breadcrumbs=array(
	'Artigosvendas'=>array('index'),
	$model->ID=>array('view','id'=>$model->ID),
	'Update',
);

$this->menu=array(
	array('label'=>'List Artigosvenda', 'url'=>array('index')),
	array('label'=>'Create Artigosvenda', 'url'=>array('create')),
	array('label'=>'View Artigosvenda', 'url'=>array('view', 'id'=>$model->ID)),
	array('label'=>'Manage Artigosvenda', 'url'=>array('admin')),
);
?>

<h1>Update Artigosvenda <?php echo $model->ID; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>