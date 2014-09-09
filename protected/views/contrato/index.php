<?php
/* @var $this ContratoController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Contratos',
);

$this->menu=array(
	array('label'=>'Criar Contrato', 'url'=>array('create')),
	//array('label'=>'Manage Contrato', 'url'=>array('admin')),
);
?>

<h1>Contratos</h1>

<?php /*$this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>*/
$this->widget('zii.widgets.grid.CGridView', array(
    'dataProvider' => $dataProvider,
    'id' => 'ContratosGrid',
    'columns' => array(
        array(
            'name' => 'ID',
            'type' => 'raw',
            'value' => 'CHtml::link(CHtml::encode($data->id), array("contrato/update", "id" => $data->id))',
        ),
        array(
            'name' => 'Funcionario',
            'type' => 'raw',
            'value' => 'CHtml::encode($data->funcionario0->nome)',
        ),
        array(
            'name' => 'Contrato',
            'type' => 'raw',
            'value' => 'CHtml::encode($data->tipocontrato0->nome)',
        ),
        array(
            'name' => 'Regime',
            'type' => 'raw',
            'value' => 'CHtml::encode($data->regimetrabalho0->nome)',
        ),

        array(
            'name' => 'Inicio',
            'type' => 'raw',
            'value' => 'CHtml::encode($data->inicio)',
        ),

        array(
            'name' => 'P.Experimental',
            'type' => 'raw',
            'value' => 'CHtml::encode($data->ndperex)',
        ),

        array(
            'name' => 'Fim',
            'type' => 'raw',
            'value' => 'CHtml::encode($data->fim)',
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
