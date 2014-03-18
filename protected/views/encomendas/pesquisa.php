<div style="float:left; width: 100%;">
    <?php /** @var BootActiveForm $form */
    $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
        'id'=>'verticalForm',
        'htmlOptions'=>array('class'=>'well'),
    )); ?>

        <div id="datetimepicker1" class="input-append" style="float:left; padding-right: 15px;padding-left: 15px;">
            <label for="datainicio" style="float:left; padding-right: 15px;">Data Inicio</label>
            <input data-format="yyyy-MM-dd" type="text" name="datainicio" style="width:100px;"/>
            <span class="add-on">
              <i data-time-icon="icon-time" data-date-icon="icon-calendar">
              </i>
            </span>
        </div>

        <div id="datetimepicker2" class="input-append" style="float:left; padding-right: 15px;padding-left: 15px;">
            <label for="datainicio" style="float:left; padding-right: 15px;padding-left: 15px;">Data Fim</label>
            <input data-format="yyyy-MM-dd" type="text" name="datafim" style="width:100px;"/>
                <span class="add-on">
                  <i data-time-icon="icon-time" data-date-icon="icon-calendar">
                  </i>
                </span>
        </div>
        <div style="float:left; padding-right: 15px;padding-left: 15px;">
            <select name="loja">
            <?php

            foreach($lojas as $l)
            {
                $sel = "";
                if($idLoja == $l->id)
                    $sel = " SELECTED ";
                echo "<option value=\"".$l->id."\" $sel>".$l->nome."</option>";
            }
            ?>
            </select>
        </div>
    <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'label'=>'Pesquisar')); ?>
    <a href="<?php echo $this->createUrl("print2");?>?loja=<?php echo $idLoja;?>&di=<?php echo $dataInicio;?>&df=<?php echo $dataFim;?>" target="_BLANK">Imprimir</a>
    <?php $this->endWidget(); ?>
</div>


<div style="float:left; width: 100%; overflow: scroll;">
    <table style="float:left;width:100%;" cellspacing=5>
        <thead style="margin-bottom:10px;">
            <tr style="background-color:#5e9655;color:#ffffff;font-weight:bold;height:20px;padding:5px;text-align:center;">
                <td colspan="4"></td>
                <?php
                foreach($rows2 as $_id => $val)
                {
                    $req = Requesicao::model()->findByPk($_id);
                    ?>
                    <td colspan="2" style="border-bottom: 1px solid #fff;"><?php echo (isset($req)) ? $req->data : "";?> </td>
                <?php
                }?>
            </tr>
            <tr style="background-color:#5e9655;color:#ffffff;font-weight:bold;height:40px;padding:5px;text-align:center;">
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
                    echo "<tr style=\"background-color:#bbeae6\">";
                    $color = "#ccc";
                }
                else
                {
                    echo "<tr>";
                    $color = "#e6e6e6";
                }
                echo "<td>&nbsp;".$row["Fornecedor"]."</td>";
                echo "<td>".$row["Descricao"]."<input type=\"hidden\" name=\"ID_".$row["ID"]."\"</td>";
                echo "<td>".$row["Encomenda"]."</td>";
                echo "<td>".$row["Entrega"]."</td>";
                foreach($rows2 as $oldR)
                {
                    $inv = "";
                    $enc = "";
                    if(isset($oldR["i".$row["ID"]]))
                    {
                        $inv = $oldR["i".$row["ID"]];
                    }
                    if(isset($oldR["e".$row["ID"]]))
                    {
                        $enc = $oldR["e".$row["ID"]];
                    }
                    if(isset($oldR["ue".$row["ID"]]))
                    {
                        $ue = $oldR["ue".$row["ID"]];
                    }
                    else
                    {
                        $ue = $row["Unidade Encomenda"];
                    }
                    if(isset($oldR["ui".$row["ID"]]))
                    {
                        $ui = $oldR["ui".$row["ID"]];
                    }
                    else
                    {
                        $ui = $row["Unidade Stock"];
                    }
                    echo "<td style=\"background-color:".$color.";\"><input type=\"text\" value=\"".$inv."\" style=\"width:40px; margin:5px;\" readonly/>".$ui."</td>";
                    echo "<td style=\"background-color:".$color.";\"><input type=\"text\" value=\"".$enc."\" style=\"width:40px; margin:5px;\" readonly/>".$ue."</td>";
                }

                echo "</tr>";
                $i++;
            }
        }

        ?>
        </tbody>
    </table>
</div>
<script>
    $(function() {
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