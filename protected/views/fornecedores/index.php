<?php
/* @var $this FornecedoresController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Fornecedores',
);

$this->menu=array(
	array('label'=>'Criar Fornecedores', 'url'=>array('create')),
	//array('label'=>'Manage Fornecedores', 'url'=>array('admin')),
);
?>

<h1>Fornecedores</h1>

<?php /*$this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); */


$this->widget('zii.widgets.grid.CGridView', array(
    'dataProvider' => $dataProvider,
    'id' => 'fornecedoresGrid',
    'columns' => array(
        array(
            'name' => 'Fornecedor',
            'type' => 'raw',
            'value' => 'CHtml::link(CHtml::encode($data->nome), array("fornecedores/update", "id" => $data->id))',
        ),
        array(
            'name' => 'Email',
            'type' => 'raw',
            'value' => '$data->email',
        ),

        array(
            'class'=>'CButtonColumn',
            'template'=>'{delete}',
            'htmlOptions' => array('class'=>'MyDeleteBtn'),
            'headerHtmlOptions'=>array('class'=>'MyDeleteBtn'),
        ),
    ),
));?>
