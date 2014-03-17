<?php
/* @var $this TipoContratoController */
/* @var $model TipoContrato */

$this->breadcrumbs=array(
	'Tipo Contratos'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List TipoContrato', 'url'=>array('index')),
	array('label'=>'Create TipoContrato', 'url'=>array('create')),
	array('label'=>'View TipoContrato', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage TipoContrato', 'url'=>array('admin')),
);
?>

<h1>Update TipoContrato <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>