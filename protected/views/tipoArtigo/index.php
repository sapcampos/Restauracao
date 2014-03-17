<?php
/* @var $this TipoArtigoController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Tipos Artigo',
);

$this->menu=array(
	array('label'=>'Criar TipoArtigo', 'url'=>array('create')),
	//array('label'=>'Manage TipoArtigo', 'url'=>array('admin')),
);
?>

<h1>Tipos Artigo</h1>

<?php /*$this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
));*/


$this->widget('zii.widgets.grid.CGridView', array(
    'dataProvider' => $dataProvider,
    'id' => 'tiposartigoGrid',
    'columns' => array(
        array(
            'name' => 'Tipo Artigo',
            'type' => 'raw',
            'value' => 'CHtml::link(CHtml::encode($data->nome), array("tipoArtigo/update", "id" => $data->id))',
        ),
        array(
            'class'=>'CButtonColumn',
            'template'=>'{delete}',
            'htmlOptions' => array('class'=>'MyDeleteBtn'),
            'headerHtmlOptions'=>array('class'=>'MyDeleteBtn'),
        ),
    ),
));?>
