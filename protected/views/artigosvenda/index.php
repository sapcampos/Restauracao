<?php
/* @var $this ArtigosvendaController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Artigosvendas',
);

$this->menu=array(
	array('label'=>'Create Artigosvenda', 'url'=>array('create')),
	array('label'=>'Manage Artigosvenda', 'url'=>array('admin')),
);
?>

<h1>Artigosvendas</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
