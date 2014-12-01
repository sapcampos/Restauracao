<h2>Documentos</h2>
<?php
$this->widget('zii.widgets.grid.CGridView', array(
    'dataProvider' => $dataProvider,
    'id' => 'ConcelhosGrid',
    'columns' => array(
        array(
            'name' => 'Loja',
            'type' => 'raw',
            'value' => 'CHtml::encode($data->nome)',
        ),
        array(
            'name' => 'Requisição Inventario',
            'type' => 'raw',
            'value' => 'CHtml::link("Abrir", array("site/printInv", "id" => $data->id), array("target" => "_BLANK")) ',
        ),
        array(
            'name' => 'Requisição Encomenda',
            'type' => 'raw',
            'value' => 'CHtml::link("Abrir", array("site/printEnc", "id" => $data->id), array("target" => "_BLANK"))',
        ),
        array(
            'name' => 'Inventario',
            'type' => 'raw',
            'value' => 'CHtml::link("Abrir", array("site/xlsinv", "id" => $data->id), array("target" => "_BLANK")) ',
        ),
    ),
));
?>
<br/>
<?php
echo CHtml::link("Inventario Geral", array("site/xlsinv", "id" => 0), array("target" => "_BLANK"))
?>