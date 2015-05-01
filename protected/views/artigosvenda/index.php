<?php
/* @var $this ArtigosvendaController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Artigosvendas',
);

$this->menu=array(
	array('label'=>'Criar Artigos Venda', 'url'=>array('create')),
);
?>

<h1>Artigos Vendas</h1>

<?php /*$this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
));*/

//echo count($dataProvider->getData());

$this->widget('zii.widgets.grid.CGridView', array(
    'dataProvider' => $dataProvider,
    'id' => 'artigosVendaGrid',
    'columns' => array(
        array(
            'name' => 'Artigo',
            'type' => 'raw',
            'value' => 'CHtml::link(CHtml::encode($data->Nome), array("artigosVenda/update", "id" => $data->ID))',
        ),
        array(
            'name' => 'Activo',
            'type' => 'raw',
            'value' => 'CHtml::CheckBox("Activo",$data->Activo, array("disabled"=>true,))',
        ),
        array(
            'name' => 'Tem Lojas',
            'type' => 'raw',
            'value' => '$data->TemLoja()',
        ),
        array(
            'class'=>'CButtonColumn',
            'template'=>'{delete}',
            'htmlOptions' => array('class'=>'MyDeleteBtn'),
            'headerHtmlOptions'=>array('class'=>'MyDeleteBtn'),
        ),
    ),
));

?>
