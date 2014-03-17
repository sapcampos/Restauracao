<?php
ini_set("memory_limit","128M");

/*
$this->widget('zii.widgets.grid.CGridView', array(
    'dataProvider' => $dataProvider,
    'id' => 'artigosGrid',
    'columns' => array(
        array(
            'name' => 'Artigo',
            'type' => 'raw',
            'value' => 'CHtml::encode($data->descricao)',
        ),
        array(
            'name' => 'Fornecedor',
            'type' => 'raw',
            'value' => 'isset($data->fornecedor0) ? $data->fornecedor0->nome : ""',
        ),
        array(
            'name' => 'Tipo Artigo',
            'type' => 'raw',
            'value' => 'isset($data->tipoartigo0) ? $data->tipoartigo0->nome : ""',
        ),
        array(
            'name' => 'Preço Enc.',
            'type' => 'raw',
            'value' => '$data->precounidadeencomenda',
        ),
        array(
            'name' => 'Preço Inv.',
            'type' => 'raw',
            'value' => '$data->precounidadeinventario',
        ),
        array(
            'name' => 'Unidade Inv.',
            'type' => 'raw',
            'value' => 'isset($data->unidadeInv0) ? $data->unidadeInv0->nome : ""',
        ),
        array(
            'name' => 'Unidade Enc.',
            'type' => 'raw',
            'value' => 'isset($data->unidadeEnc0) ? $data->unidadeEnc0->nome : ""',
        ),

    ),
));*/

?>
<style>
    table {
        font-size: 12px;
    }

    thead tr{
        background-color: #59c3e2;
        padding-bottom: 5px;

    }
    thead td{
        color:#fff;
        font-weight: bold;

    }
    tbody tr:nth-child(odd)
    {
        background-color: #bbecec;
        padding-bottom: 2px;
    }

    tbody tr:nth-child(even)
    {
        background-color: #fff;
        padding-bottom: 2px;
    }

</style>

<table>
    <thead>
    <tr>
        <td style="width=35%">Artigo</td>
        <td style="width=15%">Fornecedor</td>
        <td style="width=8%">Tp Artigo</td>
        <td style="width=10%">Pr. Enc.</td>
        <td style="width=10%">Un. Enc.</td>
        <td style="width=10%">Pr. Inv.</td>
        <td style="width=10%">Un. Inv.</td>
        <td>Activo</td>
    </tr>
    </thead>
    <tbody>
    <?php
        $i = 1;
        foreach($dataProvider->getData() as $data)
        {

            echo "<tr>";
            echo "<td>".CHtml::encode($data->descricao)."</td>";
            echo "<td>".(isset($data->fornecedor0) ? $data->fornecedor0->nome : "")."</td>";
            echo "<td>".(isset($data->tipoartigo0) ? $data->tipoartigo0->nome : "")."</td>";
            echo "<td>".$data->precounidadeencomenda."</td>";
            echo "<td>".(isset($data->unidadeEnc0) ? $data->unidadeEnc0->nome : "")."</td>";
            echo "<td>".$data->precounidadeinventario."</td>";
            echo "<td>".(isset($data->unidadeInv0) ? $data->unidadeInv0->nome : "")."</td>";
            echo "<td style=\"text-align:center;\">".(($data->activo == 1) ? "X" : "")."</td>";
            echo "</tr>";
            $i++;
        }
    ?>
    </tbody>
</table>