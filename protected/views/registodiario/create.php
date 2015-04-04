<?php
/* @var $this RegistodiarioController */
/* @var $model Registodiario */

$this->breadcrumbs=array(
	'Registodiarios'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'Listar Registo diário', 'url'=>array('index')),
);
?>

<h1>Criar Registo diário</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model, 'loja' => $loja)); ?>