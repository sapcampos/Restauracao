<?php
/* @var $this RegistodiarioController */
/* @var $model Registodiario */

$this->breadcrumbs=array(
	'Registos diarios'=>array('index'),
	$model->ID=>array('view','id'=>$model->ID),
	'Update',
);

$this->menu=array(
	array('label'=>'Listar Registos diário', 'url'=>array('index')),
	array('label'=>'Criar Registo diário', 'url'=>array('create')),
);
?>

<h1>Update Registo diário <?php echo $model->ID; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model, 'loja' => $loja, 'gelados' => $gelados, 'pastelaria' => $pastelaria)); ?>