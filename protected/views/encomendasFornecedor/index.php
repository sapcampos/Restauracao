<h2>Encomendas a Fornecedor</h2>
<br/>
<table style="float:left;width:100%;" cellspacing=5>
    <thead style="margin-bottom:10px;">
    <tr style="background-color:#5e9655;color:#ffffff;font-weight:bold;height:40px;padding:5px;text-align:center;">
        <td>Ver</td>
        <td style="width:270px;">Data</td>
        <td>Fornecedor</td>
        <td>Estado</td>
    </tr>
    </thead>
    <tbody>
    <?php
    if(isset($rows) && count($rows)>0)
    {
        $i = 0;
        foreach($rows as $row)
        {
            if($i%2 == 0)
            {
                echo "<tr style=\"background-color:#bbeae6\">";
                $color = "#ccc";
            }
            else
            {
                echo "<tr>";
                $color = "#e6e6e6";
            }
            echo "<td style=\"width:25%; text-align:center;\">".CHtml::link(CHtml::encode("Ver"), array("encomendasFornecedor/update", "id" => $row["id"]))."</td>";
            echo "<td style=\"width:25%; text-align:center;\">".$row["data"]."</td>";
            echo "<td style=\"width:25%; text-align:center;\">".$row["nome"]."</td>";
            echo "<td style=\"width:25%; text-align:center;\">".$row["nomeEstado"]."</td>";
            echo "</tr>";
            $i++;
        }
    }
    ?>
    </tbody>
</table>