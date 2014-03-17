<?php
/* @var $this TipoContratoController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Tipo Contratos',
);

$this->menu=array(
	array('label'=>'Create TipoContrato', 'url'=>array('create')),
	array('label'=>'Manage TipoContrato', 'url'=>array('admin')),
);
?>

<h1>Tipo Contratos</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
