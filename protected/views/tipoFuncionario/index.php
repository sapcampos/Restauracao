<?php
/* @var $this TipoFuncionarioController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Tipo Funcionarios',
);

$this->menu=array(
	array('label'=>'Create TipoFuncionario', 'url'=>array('create')),
	array('label'=>'Manage TipoFuncionario', 'url'=>array('admin')),
);
?>

<h1>Tipo Funcionarios</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
