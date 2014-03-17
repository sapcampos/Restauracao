<?php
/* @var $this TipoUnidadeController */
/* @var $model TipoUnidade */

$this->breadcrumbs=array(
	'Tipo Unidades'=>array('index'),
	'Criar',
);

$this->menu=array(
	array('label'=>'Listar Tipos Unidade', 'url'=>array('index')),
	//array('label'=>'Manage TipoUnidade', 'url'=>array('admin')),
);
?>

<h1>Criar TipoUnidade</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>