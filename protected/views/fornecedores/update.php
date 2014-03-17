<?php
/* @var $this FornecedoresController */
/* @var $model Fornecedores */

$this->breadcrumbs=array(
	'Fornecedores'=>array('index'),
	$model->id=>array('update','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'Listar Fornecedores', 'url'=>array('index')),
	array('label'=>'Criar Fornecedores', 'url'=>array('create')),
	/*array('label'=>'View Fornecedores', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Fornecedores', 'url'=>array('admin')),*/
);
?>

<h1>Update Fornecedores <?php echo $model->nome; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model, 'arr' => $arr)); ?>