<?php
/* @var $this EntidadeEncomendaController */
/* @var $model EntidadeEncomenda */

$this->breadcrumbs=array(
	'Entidade Encomendas'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'Listar Entidade Encomenda', 'url'=>array('index')),
	//array('label'=>'Manage EntidadeEncomenda', 'url'=>array('admin')),
);
?>

<h1>Criar Entidade Encomenda</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>