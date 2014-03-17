<style>
    td{
        font-size: 10px;
    }
</style>

<table style="float:left;width:100%;">
    <thead style="margin-bottom:10px; background-color: #666">
    <tr style="font-weight:bold;height:20px;padding:5px;text-align:center; background-color: #e6e6e6;">
        <td colspan="4" style="text-align: center;"><?php
        $loja = Loja::model()->findByPk($idloja);
            if(isset($loja))
            {
                echo "<strong>".$loja->nome."</strong>";
            }

            ?></td>
        <?php
        foreach($rows2 as $_id => $val)
        {
            $req = Requesicao::model()->findByPk($_id);
            ?>
            <td colspan="2" style="border-bottom: 1px solid #fff;"><?php echo (isset($req)) ? $req->data : "";?> </td>
        <?php
        }?>
    </tr>
    <tr style="font-weight:bold;height:40px;padding:5px;text-align:center; background-color: #e6e6e6">
        <td>Fornecedor</td>
        <td style="width:270px;">Artigo</td>
        <td>Encomenda</td>
        <td>Entrega</td>
        <?php
        foreach($rows2 as $_id => $val)
        {?>
            <td>Inv.</td>
            <td>Enc.</td>
        <?php }?>
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
                echo "<tr style=\"background-color:#bbeae6; font-size: 9px;\">";
                $color = "#ccc";
            }
            else
            {
                echo "<tr style='font-size: 9px;'>";
                $color = "#e6e6e6";
            }
            echo "<td>&nbsp;".$row["Fornecedor"]."</td>";
            echo "<td>".$row["Descricao"]."</td>";
            echo "<td>".$row["Encomenda"]."</td>";
            echo "<td>".$row["Entrega"]."</td>";
            foreach($rows2 as $oldR)
            {
                $inv = "";
                $enc = "";
                if(isset($oldR["i".$row["ID"]]) && $oldR["i".$row["ID"]] > 0)
                {
                    $inv = $oldR["i".$row["ID"]];
                    echo "<td>".$inv." ".$row["Unidade Stock"]."</td>";
                }
                else
                {
                    echo "<td></td>";
                }
                if(isset($oldR["e".$row["ID"]]) && $oldR["e".$row["ID"]] > 0)
                {
                    $enc = $oldR["e".$row["ID"]];
                    echo "<td>".$enc." ".$row["Unidade Encomenda"]."</td>";
                }
                else
                {
                    echo "<td></td>";
                }
            }
            echo "</tr>";
            $i++;
        }
    }

    ?>
    </tbody>
</table>