<?php
/* @var $this ConcelhosController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Concelhos',
);

$this->menu=array(
	array('label'=>'Criar Concelhos', 'url'=>array('create')),
	//array('label'=>'Manage Concelhos', 'url'=>array('admin')),
);
?>

<h1>Concelhos</h1>

<?php /*$this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
));*/

$this->widget('zii.widgets.grid.CGridView', array(
    'dataProvider' => $dataProvider,
    'id' => 'ConcelhosGrid',
    'columns' => array(
        array(
            'name' => 'Nome',
            'type' => 'raw',
            'value' => 'CHtml::link(CHtml::encode($data->nome), array("concelhos/update", "id" => $data->id))',
        ),
        array(
            'class'=>'CButtonColumn',
            'template'=>'{delete}',
            'htmlOptions' => array('class'=>'MyDeleteBtn'),
            'headerHtmlOptions'=>array('class'=>'MyDeleteBtn'),
        ),
    ),
));?>
