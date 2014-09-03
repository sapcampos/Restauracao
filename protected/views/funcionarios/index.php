<?php
/* @var $this FuncionariosController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Funcionarios',
);

$this->menu=array(
	array('label'=>'Criar Funcionarios', 'url'=>array('create')),
	//array('label'=>'Manage Funcionarios', 'url'=>array('admin')),
);
?>

<h1>Funcionarioses</h1>

<?php /*$this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
));*/

$this->widget('zii.widgets.grid.CGridView', array(
    'dataProvider' => $dataProvider,
    'id' => 'artigosGrid',
    'columns' => array(
        array(
            'name' => 'Nome',
            'type' => 'raw',
            'value' => 'CHtml::link(CHtml::encode($data->nome), array("funcionarios/update", "id" => $data->id))',
        ),
        array(
            'name' => 'Data Nascimento',
            'type' => 'raw',
            'value' => '$data->datanascimento',
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
