<?php
/* @var $this RegimeTrabalhoController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Regime Trabalhos',
);

$this->menu=array(
	array('label'=>'Create RegimeTrabalho', 'url'=>array('create')),
	array('label'=>'Manage RegimeTrabalho', 'url'=>array('admin')),
);
?>

<h1>Regime Trabalhos</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
