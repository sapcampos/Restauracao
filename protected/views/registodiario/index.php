<?php
/* @var $this RegistodiarioController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Registodiarios',
);

$this->menu=array(
	array('label'=>'Criar Registo diário', 'url'=>array('create')),
);
?>

<h1>Registos diários</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
