<?php
    if($not == 0)
    {
        echo "<h2>Lista Compras Loja</h2><br/>";
    }
    else
    {
        echo "<h2>Lista Compras - Restantes Entregas</h2><br/>";
    }
?>

<h4>
    <?php
    if(isset($loja))
    {
        echo $loja->nome . " - ";
    }

    echo $req->data;

    ?>
</h4>
<style>
    table td
    {
        border: solid 1px #000000;
        padding: 1px;
        font-size: 12px;
    }
    table thead td{
        background-color: #666;
        color:#fff;
        font-weight: bold;
    }
</style>
<table style="border-collapse:collapse; border: solid 1px #000000; width:100%">
    <thead>
    <tr>
        <td style="width:10%">Fornecedor</td>
        <td style="width:60%">Artigo</td>
        <td style="width:10%">Quantidade</td>
        <td style="width:15%">Unidade</td>
        <td style="width:5%"></td>
    </tr>
    </thead>
    <tbody>
    <?php
    if(count($linhas) > 0)
    {
    foreach($linhas as $row)
    {
        echo "<tr>";
        echo "<td>".$row["fornecedor"]."</td>";
        echo "<td>".$row["descricao"]."</td>";
        echo "<td>".$row["encomenda"]."</td>";
        echo "<td>".$row["nome"]."</td>";
        echo "<td style='text-align: center;'><input type='checkbox'/></td>";
        echo "</tr>";
    }
    }
    ?>
    </tbody>
</table>