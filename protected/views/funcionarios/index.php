<?php
/* @var $this FuncionariosController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Funcionarioses',
);

$this->menu=array(
	array('label'=>'Create Funcionarios', 'url'=>array('create')),
	array('label'=>'Manage Funcionarios', 'url'=>array('admin')),
);
?>

<h1>Funcionarioses</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
