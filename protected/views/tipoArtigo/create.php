<?php
/* @var $this TipoArtigoController */
/* @var $model TipoArtigo */

$this->breadcrumbs=array(
	'Tipo Artigos'=>array('index'),
	'Criar',
);

$this->menu=array(
	array('label'=>'Listar TipoArtigo', 'url'=>array('index')),
	//array('label'=>'Manage TipoArtigo', 'url'=>array('admin')),
);
?>

<h1>Create TipoArtigo</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>