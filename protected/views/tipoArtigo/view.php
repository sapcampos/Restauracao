<?php
/* @var $this TipoArtigoController */
/* @var $model TipoArtigo */

$this->breadcrumbs=array(
	'Tipo Artigos'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List TipoArtigo', 'url'=>array('index')),
	array('label'=>'Create TipoArtigo', 'url'=>array('create')),
	array('label'=>'Update TipoArtigo', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete TipoArtigo', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage TipoArtigo', 'url'=>array('admin')),
);
?>

<h1>View TipoArtigo #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'nome',
	),
)); ?>
