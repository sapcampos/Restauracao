<h2>
    <?php echo $loja->nome;?>
</h2>
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
        <td style="width:65%">Artigo</td>
        <td style="width:7%">Inventario</td>
        <td style="width:9%">Unidade</td>
        <td style="width:9%">Encomenda</td>
        <td style="width:9%">Unidade</td>
    </tr>
    </thead>
    <tbody>
    <?php
    foreach($artigos as $row)
    {
        echo "<tr>";
        echo "<td>".$row["Descricao"]."</td>";
        echo "<td></td>";
        echo "<td>".$row["Unidade Stock"]."</td>";
        echo "<td></td>";
        echo "<td>".$row["Unidade Encomenda"]."</td>";
        echo "</tr>";
    }
    ?>
    </tbody>
</table>