 <?php
        if(isset($rows) && count($rows)>0)
        {

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
                $inv = "";
                $enc = "";
                if(isset($rows1["i".$rows[$i]["ID"]]))
                {
                    $inv = $rows1["i".$rows[$i]["ID"]];
                }
                if(isset($rows1["e".$rows[$i]["ID"]]))
                {
                    $enc = $rows1["e".$rows[$i]["ID"]];
                }
                if((!isset($enc) || empty($enc)) && $enc == "")
                {
                    $enc = "--";
                }
                if((!isset($inv) || empty($inv)) && $inv == "")
                {
                    $inv = "--";
                }
                echo "<td>&nbsp;".$rows[$i]["Fornecedor"]."</td>";
                echo "<td>".$rows[$i]["Descricao"]."</td>";
                //echo "<td>".$rows[$i]["Encomenda"]."</td>";
                //echo "<td>".$rows[$i]["Entrega"]."</td>";
                echo "<td>".$inv." ".$rows[$i]["Unidade Stock"]."</td>";
                echo "<td>".$enc." ".$rows[$i]["Unidade Encomenda"]."</td>";
                echo "</tr>";

            }
        }
        ?>