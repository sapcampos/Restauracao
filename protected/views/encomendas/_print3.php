
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
                $inv = "";
                $enc = "";

                if(isset($rows1["i".$row["ID"]]))
                {
                    $inv1 = $rows1["i".$row["ID"]];
                }
                if(isset($rows1["e".$row["ID"]]))
                {
                    $enc1 = $rows1["e".$row["ID"]];
                }
                echo "<td>&nbsp;".$row["Fornecedor"]."</td>";
                echo "<td>".$row["Descricao"]."<input type=\"hidden\" name=\"ID_".$row["ID"]."\"</td>";
                echo "<td>".$row["Encomenda"]."</td>";
                echo "<td>".$row["Entrega"]."</td>";
                echo "<td>".$inv." ".$row["Unidade Stock"]."</td>";
                echo "<td>".$enc." ".$row["Unidade Encomenda"]."</td>";
                echo "</tr>";
                $i++;
            }
        }
        ?>
        </tbody>
    </table>
    <?php

    ?>
</div>