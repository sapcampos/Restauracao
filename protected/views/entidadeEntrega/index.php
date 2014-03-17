<?php
/* @var $this EntidadeEntregaController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Entidade Entregas',
);

$this->menu=array(
	array('label'=>'Criar EntidadeEntrega', 'url'=>array('create')),
	//array('label'=>'Manage EntidadeEntrega', 'url'=>array('admin')),
);
?>

<h1>Entidade Entregas</h1>

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
            'value' => 'CHtml::link(CHtml::encode($data->nome), array("entidadeEntrega/update", "id" => $data->id))',
        ),
        array(
            'class'=>'CButtonColumn',
            'template'=>'{delete}',
            'htmlOptions' => array('class'=>'MyDeleteBtn'),
            'headerHtmlOptions'=>array('class'=>'MyDeleteBtn'),
        ),
    ),
));?>
