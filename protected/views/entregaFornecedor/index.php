<?php
/* @var $this EntregaFornecedorController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Entrega Fornecedors',
);

$this->menu=array(
	array('label'=>'Criar Entrega Fornecedor', 'url'=>array('create')),
	//array('label'=>'Manage EntregaFornecedor', 'url'=>array('admin')),
);
?>

<h1>Entrega Fornecedores</h1>

<?php /*$this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); */


$this->widget('zii.widgets.grid.CGridView', array(
    'dataProvider' => $dataProvider,
    'id' => 'entregafornecedoresGrid',
    'columns' => array(
        array(
            'name' => 'Data',
            'type' => 'raw',
            'value' => 'CHtml::link(CHtml::encode($data->data), array("entregaFornecedor/update", "id" => $data->id))',
        ),
        array(
            'name' => 'Loja',
            'type' => 'raw',
            'value' => '$data->idloja0->nome',
        ),
        array(
            'name' => 'Fornecedor',
            'type' => 'raw',
            'value' => '$data->idfornecedor0->nome',
        ),

        array(
            'class'=>'CButtonColumn',
            'template'=>'{delete}',
            'htmlOptions' => array('class'=>'MyDeleteBtn'),
            'headerHtmlOptions'=>array('class'=>'MyDeleteBtn'),
        ),
    ),
));?>
