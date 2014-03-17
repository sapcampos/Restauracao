<?php
/* @var $this EntidadeEncomendaController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Entidade Encomendas',
);

$this->menu=array(
	array('label'=>'Criar Entidade Encomenda', 'url'=>array('create')),
	//array('label'=>'Manage EntidadeEncomenda', 'url'=>array('admin')),
);
?>

<h1>Entidade Encomendas</h1>

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
            'value' => 'CHtml::link(CHtml::encode($data->nome), array("entidadeEncomenda/update", "id" => $data->id))',
        ),
        array(
            'class'=>'CButtonColumn',
            'template'=>'{delete}',
            'htmlOptions' => array('class'=>'MyDeleteBtn'),
            'headerHtmlOptions'=>array('class'=>'MyDeleteBtn'),
        ),
    ),
));?>
