<form method="post">
<div style="width: 100%">
<div style="float:left;">
    <?php
    $lojas = Loja::model()->findAll();
    echo "<select id=\"loja\" name=\"loja\">";
    /*if($id !=0 )
        echo "<option value=\"0\">Todas</option>";
    else
        echo "<option value=\"0\" SELECTED>Todas</option>";*/
    foreach($lojas as $l)
    {
        //if($l->id == 6 || $l->id == 7)
        if($l->id == 7)
        {}
        else{
            $sel = "";
            if($id == $l->id)
                $sel = " SELECTED ";
            echo "<option value=\"".$l->id."\" $sel>".$l->nome."</option>";
        }
    }
    echo "</select>";
    ?>

</div>

<?php /*<div style="float:left; padding-left:25px;">
    <input type="submit" value="Encomendar"/>
</div> */ ?>
</div>
<div style="width:100%;float: left; margin: 20px;">
    <strong>NOTA:</strong>&nbsp;<comment>Deve usar . para as casas décimais.</comment>
</div>
<div style="float:left">
<table style="float:left;width:100%; font-size: 12px;" cellspacing=5>
    <thead style="margin-bottom:10px;">
        <tr style="background-color:#5e9655;color:#ffffff;font-weight:bold;height:40px;padding:5px;text-align:center;">
            <td>Fornecedor</td>
            <td style="width:270px;">Artigo</td>
            <td>Prç. Inv.</td>
            <td>Prç. Enc</td>
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
                if(isset($rows2["i".$row["ID"]]))
                {
                    $inv = $rows2["i".$row["ID"]];
                }
                if(isset($rows2["e".$row["ID"]]))
                {
                    $enc = $rows2["e".$row["ID"]];
                }
                echo "<td>&nbsp;".$row["Fornecedor"]."</td>";
                echo "<td>".$row["Descricao"]."<input type=\"hidden\" name=\"ID_".$row["ID"]."\"</td>";
                echo "<td>".number_format($row["precounidadeinventario"],2)."</td>";
                echo "<td>".number_format($row["precounidadeencomenda"],2)."</td>";
                echo "<td>".$row["Encomenda"]."</td>";
                echo "<td>".$row["Entrega"]."</td>";
                echo "<td style=\"background-color:".$color.";\"><input type=\"text\" value=\"".$inv."\" style=\"width:40px; margin:5px;\" readonly/>".$row["Unidade Stock"]."</td>";
                echo "<td style=\"background-color:".$color.";\"><input type=\"text\" value=\"".$enc."\" style=\"width:40px; margin:5px;\" readonly/>".$row["Unidade Encomenda"]."</td>";
                echo "<td><input type=\"text\" style=\"width:40px; margin:5px;\" class=\"inpt\" name=\"stock".$row["ID"]."\"/>".$row["Unidade Stock"]."</td>";
                echo "<td><input type=\"text\" style=\"width:40px; margin:5px;\" class=\"inpt\" name=\"enc".$row["ID"]."\"/>".$row["Unidade Encomenda"]."</td>";
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
    <input type="button" value="Encomendar" onclick="javascript:validate();"/>
    <input type="submit" value="Encomendar" style="display: none;" id="subbtn" />
</div>
</form>
<script>

    $( "#loja" ).change(function() {
        idf = $( "#loja" ).val();
        window.location = "<?php $url=$this->createUrl('site/encomenda'); echo $url;?>?id="+idf;
    });
</script>

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
</script>