<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
    <meta charset="UTF-8">
    <style>
        td{
            border: 1px solid #000;
            padding:0px;
            margin:0px;
            font-family:Arial, Helvetica, sans-serif;
            font-size: 11px;
        }
    </style>
</head>

<body>
<div style="float:left; width:100%; text-align:center">
    <h1>Compras</h1>
</div>
<div style="float:left; width: 100%;">


<?php

if(!isset($lojasLL))
{

?>
<div style="float:left; width: 100%; overflow: scroll;">
    <table style="float:left;width:100%;" cellspacing=5>
        <thead style="margin-bottom:10px;">
            <tr style="background-color:#ffffff;color:#000;font-weight:bold;height:40px;padding:1px;text-align:center;">
                <td style="width:20%;">Fornecedor</td>
                <td style="width:40%;">Artigo</td>
                <td style="width:10%;">Quantidade</td>
                <td style="width:10%;">Unidade</td>
                <td style="width:10%;">Preço Un.</td>
                <td style="width:10%;">Custo</td>
            </tr>
        </thead>
        <tbody>

        <?php
        $totalCusto = 0;
        if(isset($rows) && count($rows)>0)
        {
            $i = 0;
            foreach($rows as $row)
            {
                if($i%2 == 0)
                {
                    echo "<tr style=\"background-color:#fff\">";
                    $color = "#fff";
                }
                else
                {
                    echo "<tr style=\"background-color:#fff\">";
                    $color = "#fff";
                }
                echo "<td>&nbsp;".$row["Fornecedor"]."</td>";
                echo "<td>".$row["Descricao"]."</td>";
                echo "<td>".$row["Quantidade"]."</td>";
                echo "<td>".$row["Unidade"]."</td>";
                echo "<td>".$row["pun"]."</td>";
                $totalCusto = $totalCusto + $row["custo"];
                echo "<td style=\"text-align:right;\">".number_format($row["custo"],2)."</td>";
                echo "</tr>";
                $i++;
            }
        }
        echo "<tr>";
        echo "<td colspan=\"5\" style='text-align: right;'><strong>TOTAL:</strong></td>";
        echo "<td style='text-align: right;'>".number_format($totalCusto,2)."</td>";
        echo "</tr>";
        ?>
        </tbody>
    </table>
</div>
<?php
}
else
{
    //print_r($lojasLL);
    //print_r($q);
    //print_r($c);
    ?>

<div style="float:left; width: 100%; overflow: scroll;">
    <table style="float:left;width:100%;" border="1" cellspacing=0>
        <thead style="margin-bottom:10px;">
        <tr style="background-color:#fff;color:#000;font-weight:bold;height:40px;padding:0px;text-align:center;">
            <td colspan="4"></td>
            <?php
            foreach($lojasLL as $k => $l)
            {
                $loja_ = Loja::model()->findByPk($l);
                echo "<td colspan='2'>".$loja_->nome."</td>";
            }
            ?>
        </tr>
        <tr style="background-color:#fff;color:#000;font-weight:bold;height:40px;padding:0px;text-align:center;">
            <td style="width:10%;">Fornecedor</td>
            <td style="width:20%;">Artigo</td>
            <td style="width:5%;">Unidade</td>
            <td style="width:5%;">P. Un.</td>
            <?php
            foreach($lojasLL as $k => $l)
            {?>
            <td>Qt</td>
            <td>€</td>
            <?php } ?>
        </tr>
        </thead>
        <tbody>
            <?php
            $totalCusto = 0;
            if(isset($rows) && count($rows)>0)
            {
                $i = 0;
                foreach($rows as $row)
                {
                    if($i%2 == 0)
                    {
                        echo "<tr style=\"background-color:#fff;\">";
                        $color = "#ccc";
                    }
                    else
                    {
                        echo "<tr>";
                        $color = "#e6e6e6";
                    }
                    echo "<td>&nbsp;".$row["Fornecedor"]."</td>";
                    echo "<td>".$row["Descricao"]."</td>";
                    echo "<td>".$row["Unidade"]."</td>";
                    echo "<td>".$row["pun"]."</td>";
                    foreach($lojasLL as $k => $l)
                    {

                        if(isset($q[trim($l)."-".$row["idartigo"]]))
                        {
                            echo "<td style=\"align:center;\">".$q[trim($l)."-".$row["idartigo"]]."</td>";
                        }
                        else
                        {
                            echo "<td>0</td>";
                        }
                        if(isset($c[trim($l)."-".$row["idartigo"]]))
                        {
                            $totalCusto = $totalCusto + $c[trim($l)."-".$row["idartigo"]];
                            echo "<td style=\"align:center;\">".number_format($c[trim($l)."-".$row["idartigo"]],2)."</td>";
                        }
                        else
                        {
                            echo "<td>0</td>";
                        }
                    }
                    echo "</tr>";
                    $i++;
                }
            }
            echo "<tr>";
            echo "<td colspan=\"".(4 + ((count($lojasLL)-1) * 2))."\" style='text-align: right;'><strong>TOTAL:</strong></td>";
            echo "<td colspan='2' style='text-align: right;'>".number_format($totalCusto,2)."</td>";
            echo "</tr>";

            ?>

        </tbody>
    </table>
</div>
    <?php
}
    ?>


    </body>
</html>