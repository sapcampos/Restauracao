<?php
/* @var $this UtilizadoresController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Utilizadores',
);

$this->menu=array(
	array('label'=>'Criar Utilizadores', 'url'=>array('create')),
	//array('label'=>'Gerir Utilizadores', 'url'=>array('admin')),
);
?>

<h1>Utilizadores</h1>

<?php /*$this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
));*/

$this->widget('zii.widgets.grid.CGridView', array(
    'dataProvider' => $dataProvider,
    'id' => 'utilizadoresGrid',
    'columns' => array(
        array(
            'name' => 'Utilizador',
            'type' => 'raw',
            'value' => 'CHtml::link(CHtml::encode($data->nome), array("utilizadores/update", "id" => $data->id))',
        ),
        array(
            'name' => 'Username',
            'type' => 'raw',
            'value' => 'CHtml::encode($data->username)',
        ),
        array(
            'name' => 'Activo',
            'type' => 'raw',
            'value'=> 'CHtml::CheckBox("Activo",$data->activo, array("disabled"=>true,))',
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
