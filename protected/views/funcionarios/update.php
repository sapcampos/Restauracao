<?php
/* @var $this FuncionariosController */
/* @var $model Funcionarios */

$this->breadcrumbs=array(
	'Funcionarios'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'Listar Funcionarios', 'url'=>array('index')),
	array('label'=>'Criar Funcionarios', 'url'=>array('create')),
    //array('label'=>'View Funcionarios', 'url'=>array('view', 'id'=>$model->id)),
	//array('label'=>'Manage Funcionarios', 'url'=>array('admin')),
);
?>

<h1>Update Funcionarios <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>