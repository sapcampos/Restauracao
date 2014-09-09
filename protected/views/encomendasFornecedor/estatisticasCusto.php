<div style="float:left; width: 100%;">
    <?php /** @var BootActiveForm $form */
    $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
        'id'=>'verticalForm',
        'htmlOptions'=>array('class'=>'well'),
        'method' => 'post',
    )); ?>

    <div id="datetimepicker1" class="input-append" style="float:left; padding-right: 15px;padding-left: 15px;">
        <label for="datainicio" style="float:left; padding-right: 15px;">Data Inicio</label>
        <input data-format="yyyy-MM-dd" type="text" name="dataInicio" style="width:100px;" value="<?php echo $dataI; ?>"/>
            <span class="add-on">
              <i data-time-icon="icon-time" data-date-icon="icon-calendar">
              </i>
            </span>
    </div>

    <div id="datetimepicker2" class="input-append" style="float:left; padding-right: 15px;padding-left: 15px;">
        <label for="datainicio" style="float:left; padding-right: 15px;padding-left: 15px;">Data Fim</label>
        <input data-format="yyyy-MM-dd" type="text" name="dataFim" style="width:100px;" value="<?php echo $dataF; ?>"/>
                <span class="add-on">
                  <i data-time-icon="icon-time" data-date-icon="icon-calendar">
                  </i>
                </span>
    </div>
    <div style="float:left; padding-right: 15px;padding-left: 15px;">
        <select name="loja">
            <?php
            $lojas = Loja::model()->findAllByAttributes(array('activo' => 1));
            $sel = "";
            if(!isset($loja) || empty($loja))
            {
                echo "<option value=\"0\" SELECTED></option>";
            }
            else
            {
                echo "<option value=\"0\"></option>";
            }
            foreach($lojas as $l)
            {

                if($loja == $l->id)
                    $sel = " SELECTED ";
                echo "<option value=\"".$l->id."\" $sel>".$l->nome."</option>";
            }
            ?>
        </select>
    </div>
    <div style="float:left; padding-right: 15px;padding-left: 15px;">
        <select name="fornecedor">
            <?php
            $fornecedores = Fornecedores::model()->findAll();
            $sel = "";
            if(!isset($fornecedor) || empty($fornecedor))
            {
                echo "<option value=\"0\" SELECTED></option>";
            }
            else
            {
                echo "<option value=\"0\"></option>";
            }
            foreach($fornecedores as $l)
            {
                $sel = "";
                if($fornecedor == $l->id)
                    $sel = " SELECTED ";
                echo "<option value=\"".$l->id."\" $sel>".$l->nome."</option>";
            }
            ?>
        </select>
    </div>
    <div style="float:left; padding-right: 15px;padding-left: 15px;">
        <label for="artigo" style="float:left; padding-right: 15px;">Artigo</label>
        <input type="text" name="artigo" style="width:100px;" value="<?php if(isset($artigo)){echo $artigo;}else{echo "";} ?>"/>
    </div>
    <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'label'=>'Pesquisar')); ?>
    <?php /*<a href="<?php echo $this->createUrl("print2");?>?loja=<?php echo $idLoja;?>&di=<?php echo $dataInicio;?>&df=<?php echo $dataFim;?>" target="_BLANK">Imprimir</a> */?>
    <?php $this->endWidget(); ?>
</div>

<?php
if(!isset($lojasLL) || count($lojasLL) == 0)
{

?>
<div style="float:left; width: 100%; overflow: scroll;">
    <table style="float:left;width:100%;" cellspacing=5>
        <thead style="margin-bottom:10px;">
            <tr style="background-color:#5e9655;color:#ffffff;font-weight:bold;height:40px;padding:5px;text-align:center;">
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
                    echo "<tr style=\"background-color:#bbeae6\">";
                    $color = "#ccc";
                }
                else
                {
                    echo "<tr>";
                    $color = "#e6e6e6";
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
    <table style="float:left;width:100%;" cellspacing=5>
        <thead style="margin-bottom:10px;">
        <tr style="background-color:#5e9655;color:#ffffff;font-weight:bold;height:40px;padding:5px;text-align:center;font-size:10px;">
            <td colspan="4"></td>
            <?php
            foreach($lojasLL as $k => $l)
            {
                $loja_ = Loja::model()->findByPk($l);
                echo "<td colspan='2'>".$loja_->nome."</td>";
            }
            ?>
        </tr>
        <tr style="background-color:#5e9655;color:#ffffff;font-weight:bold;height:40px;padding:5px;text-align:center;font-size:10px;">
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
                        echo "<tr style=\"background-color:#bbeae6;font-size:10px;\">";
                        $color = "#ccc";
                    }
                    else
                    {
                        echo "<tr style='font-size:10px;'>";
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
<div style="margin: 10px; width: 100%; text-align: right;">
    <a href="<?php echo $this->createUrl("estatisticasCustoPrint",array("loja" => $loja, "fornecedor" => $fornecedor, "dataInicio"=> $dataI, "dataFim" => $dataF, "artigo" => $artigo )); ?>" TARGET="_blank">Print</a>
</div>
<script>
    $(function() {
        $("td").css("border","1px solid #000");
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