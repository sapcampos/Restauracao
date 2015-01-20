<?php

//print_r($lojas);


?>
<div style="float: left;">
    Lojas:
    <select multiple id="multiple" style="height:170px;">
        <?php
        foreach($lojas as $loja)
        {
            echo "<option value=\"$loja->id\">$loja->nome</option>";
        }
        ?>
    </select>

</div>
<div style="float: left; margin-left: 20px;">
    Data Inicio:
    <br/>
    <div id="datetimepicker1" class="input-append" style="float:left; padding-right: 15px;padding-left: 15px;">

        <input data-format="yyyy-MM-dd" type="text" id="inicio" style="width:100px;" value=""/>
            <span class="add-on" id="Contrato_inicio">
              <i data-time-icon="icon-time" data-date-icon="icon-calendar">
              </i>
            </span>
    </div>
    <br/>
    Data Fim:
    <br/>
    <div id="datetimepicker2" class="input-append" style="float:left; padding-right: 15px;padding-left: 15px;">

        <input data-format="yyyy-MM-dd" type="text" id="fim" style="width:100px;" value=""/>
            <span class="add-on" id="Contrato_inicio">
              <i data-time-icon="icon-time" data-date-icon="icon-calendar">
              </i>
            </span>
    </div>
</div>
<div>
    <input type="button" onclick="javascript:Select();" value="Escolher Lojas"/>
</div>
<div id="link" >
    <a href="#" target="_blank">Link</a>
</div>
<div id="link1" >
    <a href="#" target="_blank">Link Finanças</a>
</div>
<script>
    function Select()
    {
        var foo = [];
        var linkparams = "";
        $('#multiple :selected').each(function(i, selected){
            foo[i] = $(selected).val();
            if(linkparams != "")
            {
                linkparams += "," + $(selected).val();
            }else
            {
                linkparams += "" + $(selected).val();
            }
        });
        if(linkparams == "")
            alert("Escolha pelo menos uma loja");
        else
        {
            var fim = "";
            var inicio = "";

            inicio = $("#inicio").val();
            fim = $("#fim").val();

            if(inicio != "" && fim != "")
            {
                var html_ = "<a href='<?php echo $this->createUrl("encomendas/inventarioXls",array());?>/?id=" + linkparams + "&inicio=" + inicio + "&fim=" + fim + "' target='_blank'>Link</a>";
                $("#link").html(html_);
                var html_1 = "<a href='<?php echo $this->createUrl("encomendas/inventarioXlsTemp",array());?>/?id=" + linkparams + "&inicio=" + inicio + "&fim=" + fim + "' target='_blank'>Link Finanças</a>";
                $("#link1").html(html_1);
            }
            else
            {
                alert("Escolha data de inicio e de fim");
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