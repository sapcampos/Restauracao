<?php
/* @var $this LojaController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Lojas',
);

$this->menu=array(
	array('label'=>'Criar Loja', 'url'=>array('create')),
	//array('label'=>'Manage Loja', 'url'=>array('admin')),
);
?>

<h1>Lojas</h1>

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
            'value' => 'CHtml::link(CHtml::encode($data->nome), array("loja/update", "id" => $data->id))',
        ),
        array(
            'name' => 'Concelho',
            'type' => 'raw',
            'value' => 'CHtml::encode(Concelhos::model()->findByPk($data->idconcelho)->nome)',
        ),
        array(
            'name' => 'Activo',
            'type' => 'raw',
            'value' => 'CHtml::CheckBox("Activo",$data->activo, array("disabled"=>true,))',
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
