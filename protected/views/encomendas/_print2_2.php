<?php
for($i = $start; $i<$end; $i++)
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
    echo "<td>&nbsp;".$row[$i]["Fornecedor"]."</td>";
    echo "<td>".$row[$i]["Descricao"]."</td>";
    echo "<td>".$row[$i]["Encomenda"]."</td>";
    echo "<td>".$row[$i]["Entrega"]."</td>";
    if(count($rows2) > 0)
    {
        foreach($rows2 as $oldR)
        {
            $inv = "";
            $enc = "";
            if(isset($oldR["i".$row[$i]["ID"]]))
            {
                $inv = $oldR["i".$row[$i]["ID"]];
            }
            if(isset($oldR["e".$row[$i]["ID"]]))
            {
                $enc = $oldR["e".$row[$i]["ID"]];
            }
            echo "<td style=\"background-color:".$color.";\">".$inv." ".$row[$i]["Unidade Stock"]."</td>";
            echo "<td style=\"background-color:".$color.";\">".$enc." ".$row[$i]["Unidade Encomenda"]."</td>";
        }
    }
    echo "</tr>";
}
?>