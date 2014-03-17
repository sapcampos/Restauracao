<?php
/* @var $this TipoUnidadeController */
/* @var $model TipoUnidade */

$this->breadcrumbs=array(
	'Tipos Unidades'=>array('index'),
	$model->id=>array('update','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'Listar Tipos Unidade', 'url'=>array('index')),
	array('label'=>'Criar Tipo Unidade', 'url'=>array('create')),
	/*array('label'=>'View TipoUnidade', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage TipoUnidade', 'url'=>array('admin')),*/
);
?>

<h1>Update Tipo Unidade <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>