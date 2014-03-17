<?php
/* @var $this TipoArtigoController */
/* @var $model TipoArtigo */

$this->breadcrumbs=array(
	'Tipos Artigo'=>array('index'),
	$model->id=>array('update','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'Listar Tipo Artigo', 'url'=>array('index')),
	array('label'=>'Criar Tipo Artigo', 'url'=>array('create')),
	/*array('label'=>'View TipoArtigo', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage TipoArtigo', 'url'=>array('admin')),*/
);
?>

<h1>Update Tipos Artigo <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>