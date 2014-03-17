<?php
/* @var $this TipoUnidadeController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Tipo Unidades',
);

$this->menu=array(
	array('label'=>'Criar Tipo Unidade', 'url'=>array('create')),
	//array('label'=>'Manage TipoUnidade', 'url'=>array('admin')),
);
?>

<h1>Tipos Unidades</h1>

<?php /*$this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
));*/

$this->widget('zii.widgets.grid.CGridView', array(
    'dataProvider' => $dataProvider,
    'id' => 'tiposunidadeGrid',
    'columns' => array(
        array(
            'name' => 'Tipo Unidade',
            'type' => 'raw',
            'value' => 'CHtml::link(CHtml::encode($data->nome), array("tipoUnidade/update", "id" => $data->id))',
        ),
        array(
            'class'=>'CButtonColumn',
            'template'=>'{delete}',
            'htmlOptions' => array('class'=>'MyDeleteBtn'),
            'headerHtmlOptions'=>array('class'=>'MyDeleteBtn'),
        ),
    ),
));?>
