<?php
/**
 * Created by PhpStorm.
 * User: sapc
 * Date: 23/11/13
 * Time: 23:35
 */
/*
?>
<table style="float:left;width:100%;" cellspacing=5>
    <thead style="margin-bottom:10px;">
    <tr style="background-color:#5e9655;color:#ffffff;font-weight:bold;height:40px;padding:5px;text-align:center;">
        <td>Fornecedor</td>
        <td style="width:270px;">Artigo</td>
        <td>Encomenda</td>
        <td>Entrega</td>
        <td>Inv.</td>
        <td>Enc.</td>
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
            echo "<td>&nbsp;".$row["Fornecedor"]."</td>";
            echo "<td>".$row["descricao"]."<input type=\"hidden\" name=\"ID_".$row["ID"]."\"</td>";
            echo "<td>".$row["Encomenda"]."</td>";
            echo "<td>".$row["Entrega"]."</td>";
            echo "<td><input type=\"text\" style=\"width:40px; margin:5px;\" name=\"stock".$row["ID"]."\" value=\"".$row["inventario"]."\"/>".$row["Unidade Stock"]."</td>";
            echo "<td><input type=\"text\" style=\"width:40px; margin:5px;\" name=\"enc".$row["ID"]."\" value=\"".$row["encomenda"]."\"/>".$row["Unidade Encomenda"]."</td>";
            echo "</tr>";
            $i++;
        }
    }

    ?>
    </tbody>
</table>
*/?>

<?php
//print_r($rows1);
//print_r($rows2);
?>
<div style="width:100%">
    <strong>NOTA:</strong>&nbsp;<comment>Deve usar . para as casas décimais.</comment>
</div>

<form method="post">
    <div style="width:100%;">
        <h4>Data:</h4><?php echo $req->data;?>
        <br/>
        <h4>Utilizador:</h4><?php
        $user = Utilizadores::model()->findByPk($req->iduser);
        if(isset($user))
        {
            echo $user->nome;
        }
        ?>

    </div>
    <br/>
    <br/>
    <?php

    if(isset($resLog) && count($resLog) > 0)
    {
        echo "<div style=\"\">Actualizado pela ultima vez em <strong>".$resLog[0]["data"]."</strong> por <strong>".$resLog[0]["nome"]."</strong>.<div>";
    }
    ?>
    <div style="width:40%; float:left;">
        <strong>Loja</strong>
        <br/>
        <a href="<?php echo $this->createUrl("print4", array("id" => $req->id));?>" target="_BLANK">Imprimir Lista Compras Loja</a>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <a href="<?php echo $this->createUrl("print4", array("id" => $req->id, 'not' => 1));?>" target="_BLANK">Imprimir Restantes Compras</a>

    </div>
    <div style="width:60%; float:left;">
        <strong>Outras</strong>
        <br/>
        <a href="<?php echo $this->createUrl("print", array("id" => $req->id));?>" target="_BLANK">Imprimir S/Inventário</a>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <a href="<?php echo $this->createUrl("print3", array("id" => $req->id));?>" target="_BLANK">Imprimir C/Inventário</a>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    </div>



    <br/><br/>
    <?php /*<div style="width: 100%">
        <div style="float:left; padding-left:25px;padding-bottom: 20px;">
            <input type="submit" value="Encomendar"/>
        </div>
    </div>
<br/> */?>
    <div style="float:left">
        <table style="float:left;width:100%;" cellspacing=5>
            <thead style="margin-bottom:10px;">
            <tr style="background-color:#5e9655;color:#ffffff;font-weight:bold;height:20px;padding:5px;text-align:center;">
                <td colspan="4"></td>
                <td colspan="2" style="border-bottom: 1px solid #fff;"><?php echo (isset($oldReq)) ? $oldReq->data : "";?> </td>
                <td></td>
                <td></td>
            </tr>
            <tr style="background-color:#5e9655;color:#ffffff;font-weight:bold;height:40px;padding:5px;text-align:center;">
                <td>Fornecedor</td>
                <td style="width:270px;">Artigo</td>
                <td>Encomenda</td>
                <td>Entrega</td>
                <td>Inv. Ant.</td>
                <td>Enc. Ant.</td>
                <td>Inv.</td>
                <td>Enc.</td>
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
                    $inv = "";
                    $enc = "";
                    $uinv = "";
                    $uenc = "";
                    $inv1 = "";
                    $enc1 = "";
                    $uinv1 = "";
                    $uenc1 = "";
                    if(isset($rows2["i".$row["ID"]]))
                    {
                        $inv = $rows2["i".$row["ID"]];
                    }
                    if(isset($rows2["e".$row["ID"]]))
                    {
                        $enc = $rows2["e".$row["ID"]];
                    }
                    if(isset($rows2["ui".$row["ID"]]))
                    {
                        $uinv = $rows2["ui".$row["ID"]];
                    }
                    else
                    {
                        $uinv = $row["Unidade Stock"];
                    }
                    if(isset($rows2["ue".$row["ID"]]))
                    {
                        $uenc = $rows2["ue".$row["ID"]];
                    }
                    else
                    {
                        $uenc = $row["Unidade Encomenda"];
                    }

                    if(isset($rows1["i".$row["ID"]]))
                    {
                        $inv1 = $rows1["i".$row["ID"]];
                    }

                    if(isset($rows1["e".$row["ID"]]))
                    {
                        $enc1 = $rows1["e".$row["ID"]];
                    }

                    if(isset($rows1["ui".$row["ID"]]))
                    {
                        $uinv1 = $rows1["ui".$row["ID"]];
                    }
                    else
                    {
                        $uinv1 = $row["Unidade Stock"];
                    }
                    if(isset($rows1["ue".$row["ID"]]))
                    {
                        $uenc1 = $rows1["ue".$row["ID"]];
                    }
                    else
                    {
                        $uenc1 = $row["Unidade Encomenda"];
                    }
                    echo "<td>&nbsp;".$row["Fornecedor"]."</td>";
                    echo "<td>".$row["Descricao"]."<input type=\"hidden\" name=\"ID_".$row["ID"]."\"</td>";
                    echo "<td>".$row["Encomenda"]."</td>";
                    echo "<td>".$row["Entrega"]."</td>";
                    echo "<td style=\"background-color:".$color.";\"><input type=\"text\" value=\"".$inv."\" style=\"width:40px; margin:5px;\" readonly/>".$uinv."</td>";
                    echo "<td style=\"background-color:".$color.";\"><input type=\"text\" value=\"".$enc."\" style=\"width:40px; margin:5px;\" readonly/>".$uenc."</td>";
                    echo "<td><input type=\"text\" style=\"width:40px; margin:5px;\" name=\"stock".$row["ID"]."\" class=\"inpt stock\" value=\"".$inv1."\"/>".$uinv1."</td>";
                    echo "<td><input type=\"text\" style=\"width:40px; margin:5px;\" name=\"enc".$row["ID"]."\" class=\"inpt order\" value=\"".$enc1."\"/>".$uenc1."</td>";
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
    <div style="float:left;width:100%; padding-top: 25px; padding-bottom: 30px;">
        <input type="button" value="Encomendar" style="padding-left: 30px;" onclick="javascript:validate();"/>
        <input id="subbtn" type="submit" value="Encomendar" style="padding-left: 30px; display:none;"/>
    </div>
</form>

<script>
    function validate()
    {
        var ok = 0;
        $('.inpt').each(function() {
            var currentElement = $(this);

            var value = currentElement.val(); // if it is an input/select/textarea field
            if (value.indexOf(",") >= 0)
            {
                ok = ok +1;
            }
            // TODO: do something with the value
        });
        if(ok != 0)
        {
            alert("Tem que usar . para separar as casas decimais");
        }
        else
        {
            $("#subbtn").click();
        }
    }

    var propertyChangeUnbound = false;
    $(".inpt").on("propertychange", function(e) {
        if (e.originalEvent.propertyName == "value") {
            //alert("Value changed!");
            var currentElement = $(this);
            var value = currentElement.val(); // if it is an input/select/textarea field
            if (value.indexOf(",") >= 0)
            {
                currentElement.val('');
                alert("Tem que usar . para separar as casas decimais");
            }
        }
    });

    $(".inpt").on("input", function() {
        if (!propertyChangeUnbound) {
            $(".inpt").unbind("propertychange");
            propertyChangeUnbound = true;
        }
        //alert("Value changed!");
        var currentElement = $(this);
        var value = currentElement.val(); // if it is an input/select/textarea field
        if (value.indexOf(",") >= 0)
        {
            currentElement.val('');
            alert("Tem que usar . para separar as casas decimais");
        }
    });

    $('.stock').live("keypress", function(e) {
        /* ENTER PRESSED*/
        if (e.keyCode == 13) {
            /* FOCUS ELEMENT */
            var inputs = $(this).parents("form").eq(0).find(".stock");
            var idx = inputs.index(this);

            if (idx == inputs.length - 1) {
                inputs[0].select()
            } else {
                inputs[idx + 1].focus(); //  handles submit buttons
                inputs[idx + 1].select();
            }
            return false;
        }
    });

    $('.order').live("keypress", function(e) {
        /* ENTER PRESSED*/
        if (e.keyCode == 13) {
            /* FOCUS ELEMENT */
            var inputs = $(this).parents("form").eq(0).find(".order");
            var idx = inputs.index(this);

            if (idx == inputs.length - 1) {
                inputs[0].select()
            } else {
                inputs[idx + 1].focus(); //  handles submit buttons
                inputs[idx + 1].select();
            }
            return false;
        }
    });
</script>
<?php //print_r($rows1);?>