<?php

//print_r($lojas);


?>
<div style="float: left;">
    Fornecedor:
    <select id="multiple">
        <?php
        foreach($fornecedores as $fornecedor)
        {
            echo "<option value=\"$fornecedor->id\">$fornecedor->nome</option>";
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
            echo "<option value=\"$loja->id\">$loja->nome</option>";
        }
        ?>
    </select>
</div>
<br/><br/>
<div style="float: left;">
    <div style="float:left; padding-right: 10px">Data Inicio:</div>

    <div id="datetimepicker1" class="input-append" style="float:left; padding-right: 15px;padding-left: 15px;">

        <input data-format="yyyy-MM-dd" type="text" id="inicio" style="width:100px;" value=""/>
            <span class="add-on" id="Contrato_inicio">
              <i data-time-icon="icon-time" data-date-icon="icon-calendar">
              </i>
            </span>
    </div>
    <div style="float:left; padding-right: 10px">
    Data Fim:
    </div>
    <div id="datetimepicker2" class="input-append" style="float:left; padding-right: 15px;padding-left: 15px;">

        <input data-format="yyyy-MM-dd" type="text" id="fim" style="width:100px;" value=""/>
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
                var html_ = "<a href='<?php echo $this->createUrl("encomendas/evolucaoFornecedor",array());?>/?id=" + linkparams + "&loja=" + loja + "&inicio=" + inicio + "&fim=" + fim + "' target='_blank'>Link</a>";
                $("#link").html(html_);
            }
            else
            {
                var html_ = "<a href='<?php echo $this->createUrl("encomendas/evolucaoFornecedor",array());?>/?id=" + linkparams + "&loja=" + loja + "' target='_blank'>Link</a>";
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