<?php
/* @var $this RegistodiarioController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Registodiarios',
);

$this->menu=array(
	array('label'=>'Criar Registo diário', 'url'=>array('create')),
);
?>

<h4>Registos diários</h4>

<?php
/*$this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
));*/


$this->widget('zii.widgets.grid.CGridView', array(
    'dataProvider' => $dataProvider,
    'id' => 'artigosVendaGrid',
    'columns' => array(
        array(
            'name' => 'Data',
            'type' => 'raw',
            'value' => 'CHtml::link(CHtml::encode($data->Data), array("registodiario/update", "id" => $data->ID))',
        ),
        array(
            'name' => 'Loja',
            'type' => 'raw',
            'value' => '$data->iDLoja->nome',
        ),
    ),
));
?>
