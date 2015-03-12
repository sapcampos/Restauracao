<?php

//print_r($lojas);


?>
<div style="float: left;">
    Fornecedor:
    <select id="multiple">
        <?php
        foreach($fornecedores as $fornecedor)
        {
            $selected = "";
            if(!is_null($fornecedor1) && $fornecedor1->id == $fornecedor->id)
            {
                $selected = " selected='selected' ";
            }
            echo "<option value=\"$fornecedor->id\" $selected>$fornecedor->nome</option>";
        }
        ?>
    </select>
</div>
<div style="float: left; padding-left: 20px;">
    Loja:
    <select id="loja">
        <option value="0"></option>
        <?php
        foreach($lojas as $loja)
        {
            $selected = "";
            if(!is_null($loja1) && $loja1 > 0 && $loja1 == $loja->id)
            {
                $selected = " selected='selected' ";
            }
            echo "<option value=\"$loja->id\" $selected>$loja->nome</option>";
        }
        ?>
    </select>
</div>
<br/><br/>
<div style="float: left;">
    <div style="float:left; padding-right: 10px">Data Inicio:</div>

    <div id="datetimepicker1" class="input-append" style="float:left; padding-right: 15px;padding-left: 15px;">

        <input data-format="yyyy-MM-dd" type="text" id="inicio" style="width:100px;" value="<?php echo $inicio;?>"/>
            <span class="add-on" id="Contrato_inicio">
              <i data-time-icon="icon-time" data-date-icon="icon-calendar">
              </i>
            </span>
    </div>
    <div style="float:left; padding-right: 10px">
    Data Fim:
    </div>
    <div id="datetimepicker2" class="input-append" style="float:left; padding-right: 15px;padding-left: 15px;">

        <input data-format="yyyy-MM-dd" type="text" id="fim" style="width:100px;" value="<?php echo $fim;?>"/>
            <span class="add-on" id="Contrato_inicio">
              <i data-time-icon="icon-time" data-date-icon="icon-calendar">
              </i>
            </span>
    </div>
</div>
<br/><br/>
<div style="float:left; padding-right: 15px;" >
    <input type="button" onclick="javascript:Select();" value="Criar Link"/>
</div>
<div id="link" style="float:left;" >
    <a href="#" target="_blank">Link</a>
</div>
<script>
    function Select()
    {
        var foo = [];
        var linkparams = "";
        var loja = 0;
        linkparams = $('#multiple').val();
        loja = $('#loja').val();
        if(linkparams == "")
            alert("Escolha pelo menos um fornecedor");
        else
        {
            var fim = "";
            var inicio = "";

            inicio = $("#inicio").val();
            fim = $("#fim").val();

            if(inicio != "" && fim != "")
            {
                var html_ = "<a href='<?php echo $this->createUrl("encomendas/getEvFornecedor",array());?>/?id=" + linkparams + "&loja=" + loja + "&inicio=" + inicio + "&fim=" + fim + "' target='_blank'>Link</a>";
                $("#link").html(html_);
            }
            else
            {
                var html_ = "<a href='<?php echo $this->createUrl("encomendas/getEvFornecedor",array());?>/?id=" + linkparams + "&loja=" + loja + "' target='_blank'>Link</a>";
                $("#link").html(html_);
            }
        }

    }

    $(document).ready(function(){
        $.noConflict();
        $('#datetimepicker1').datetimepicker({
            language: 'pt-BR',
            pickTime: false

        });
        $('#datetimepicker2').datetimepicker({
            pickTime: false,
            language: 'pt-BR'
        });
    });
</script>


<?php
if(!is_null($rows0) && !is_null($rows1) && !is_null($rows2))
{
?>
<div style="width:100%; overflow-x:auto; font-size: 11px;">
<table class="table table-bordered table-hover table-condensed">
    <thead>
        <tr>
            <th>Artigo</th>
            <th>Unidade</th>
            <?php
            foreach($rows1 as $r1)
            {
                echo "<th colspan='2'>".$r1["mes"]."-".$r1["ano"]."</th>";
            }?>
        </tr>
        <tr>
            <th></th>
            <th></th>
            <?php
            foreach($rows1 as $r1)
            {
                echo "<th>Total</th><th>Média</th>";
            }?>
        </tr>
    </thead>
    <tbody>
    <?php
    foreach($rows0 as $r0 )
    {
        echo "<tr>";
        echo "<td>".$r0["artigo"]."</td>";
        echo "<td>".$r0["unidade"]."</td>";
        foreach($rows1 as $r1 )
        {
            $avg = 0;
            $soma = 0;
            foreach($rows2 as $r2)
            {
                if($r1["ano"] == $r2["ano"] && $r1["mes"] == $r2["mes"] && $r0["id"] == $r2["artigo"])
                {
                    $avg = number_format((float)$r2['AVG'],2,",","");
                    $soma = number_format((float)$r2['Qt'],2,",","");
                    break;
                }
            }
            echo "<td>".$soma."</td>";
            echo "<td>".$avg."</td>";
        }
        echo "</tr>";
    }

    ?>
    </tbody>
</table>
    </div>
<?php
}
?>