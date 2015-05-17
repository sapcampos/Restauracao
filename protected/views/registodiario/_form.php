<?php
/* @var $this RegistodiarioController */
/* @var $model Registodiario */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'registodiario-form',
	'enableAjaxValidation'=>false,
)); ?>

	<?php echo $form->errorSummary($model); ?>

    <div class="row">
        <?php echo $form->labelEx($model,'IDLoja'); ?>
        <?php //echo $form->textField($model,'idloja');
        echo $form->dropDownList($model,'IDLoja',CHtml::listData(Loja::model()->findAll(array('order' => 'nome')),'id','nome'));
        ?>
        <?php echo $form->error($model,'IDLoja'); ?>
    </div>
	<div class="row">
		<?php echo $form->labelEx($model,'Data'); ?>
		<?php echo $form->textField($model,'Data'); ?>
		<?php echo $form->error($model,'Data'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'IDUtilizador'); ?>
		<?php echo $form->textField($model,'IDUtilizador'); ?>
		<?php echo $form->error($model,'IDUtilizador'); ?>
	</div>


    <div role="tabpanel">

        <!-- Nav tabs -->
        <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" class="active"><a href="#gelados" aria-controls="gelados" role="tab" data-toggle="tab">Gelados</a></li>
            <li role="presentation"><a href="#outros" aria-controls="outros" role="tab" data-toggle="tab">Outros</a></li>
            </ul>

        <!-- Tab panes -->
        <div class="tab-content">
            <div role="tabpanel" class="tab-pane active" id="gelados">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Nome</th>
                            <th>Inicial</th>
                            <th>Final</th>
                            <th>Variação</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    $totalGelado = 0;
                    $totalPastelaria = 0;
                    if(isset($gelados) && $model->isNewRecord) {
                        foreach ($gelados as $gld) {
                            echo "<tr>";
                            echo "<td>" . $gld->Nome . "</td>";
                            echo "<td> <input value=\"0.000\" type=\"text\" class=\"inicio number\" name=\"ArtigoVenda[" . $gld->ID . "inicio]\" /> </td>";
                            echo "<td> <input value=\"0.000\" type=\"text\" class=\"fim number\" name=\"ArtigoVenda[" . $gld->ID . "fim]\" /> </td>";
                            echo "<td> <input value=\"0.000\" type=\"text\" readonly class=\"total number\" name=\"ArtigoVenda[" . $gld->ID . "total]\" /> </td>";
                            echo "</tr>";
                        }
                    }
                    if(isset($model->registogelados) && $model->ID > 0) {
                        foreach ($model->registogelados as $gld) {
                            echo "<tr>";
                            echo "<td>" . $gld->iDArtigo->Nome . "</td>";
                            echo "<td> <input value=\"" . number_format($gld->PesoInicial,3) . "\" type=\"text\" class=\"inicio number\" name=\"ArtigoVenda[" . $gld->ID . "inicio]\" /> </td>";
                            echo "<td> <input value=\"" . number_format($gld->PesoFinal,3) . "\" type=\"text\" class=\"fim number\" name=\"ArtigoVenda[" . $gld->ID . "fim]\" /> </td>";
                            echo "<td> <input value=\"" . number_format($gld->Variacao,3) . "\" type=\"text\" readonly class=\"total number\" name=\"ArtigoVenda[" . $gld->ID . "total]\" /> </td>";
                            echo "</tr>";
                            $totalGelado += $gld->Variacao;
                        }
                    }
                    ?>
                        <tr>
                            <td>Totais Gelado</td>
                            <td></td>
                            <td></td>
                            <td><input id="TotalGelado" value='<?php echo number_format($totalGelado, 2); ?>' type="text" readonly class="number" /></td>
                        </tr>

                    </tbody>
                </table>
            </div>
            <div role="tabpanel" class="tab-pane" id="outros">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Montra/Balcão</th>
                        <th>Quebras</th>
                        <th>Vendidos</th>
                        <th>Peso Unitário</th>
                        <th>Peso Ideal</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                        if(isset($pastelaria) && $model->isNewRecord) {
                            foreach ($pastelaria as $pstl) {
                                echo "<tr>";
                                echo "<td>" . $pstl->Nome . "</td>";
                                echo "<td> <input value=\"0.000\" type=\"text\" class=\"balcao number1\" name=\"ArtigoPst[" . $pstl->ID . "montra]\" /> </td>";
                                echo "<td> <input value=\"0.000\" type=\"text\" class=\"quebras number1\" name=\"ArtigoPst[" . $pstl->ID . "quebras]\" /> </td>";
                                echo "<td> <input value=\"0.000\" type=\"text\" class=\"vendidos number1\" name=\"ArtigoPst[" . $pstl->ID . "vendidos]\" /> </td>";
                                echo "<td> " . number_format($pstl->PesoIdeal,2) . "gr <input value=\"" . number_format($pstl->PesoIdeal,2) . "\" type=\"hidden\" readonly class=\"pesounitario number1\" name=\"ArtigoPst[" . $pstl->ID . "pesounitario]\" /></td>";
                                echo "<td> <input value=\"0.000\" type=\"text\" readonly class=\"pesoideal number1\" name=\"ArtigoPst[" . $pstl->ID . "pesoideal]\" /> </td>";
                                echo "</tr>";
                            }
                        }

                        if(isset($model->registopastelaria) && $model->ID > 0) {
                            foreach ($model->registopastelaria as $pstl) {
                                echo "<tr>";
                                echo "<td>" . $pstl->iDArtigoVenda->Nome . "</td>";
                                echo "<td> <input value=\"" . number_format($pstl->Montra,0) . "\" type=\"text\" class=\"balcao number1\" name=\"ArtigoPst[" . $pstl->ID . "montra]\" /> </td>";
                                echo "<td> <input value=\"" . number_format($pstl->Quebras,0) . "\" type=\"text\" class=\"quebras number1\" name=\"ArtigoPst[" . $pstl->ID . "quebras]\" /> </td>";
                                echo "<td> <input value=\"" . number_format($pstl->Vendidos,0) . "\" type=\"text\" class=\"vendidos number1\" name=\"ArtigoPst[" . $pstl->ID . "vendidos]\" /> </td>";
                                echo "<td> " . number_format($pstl->PesoUnitario,0) . "gr <input value=\"" . number_format($pstl->PesoUnitario,3) . "\" type=\"hidden\" readonly class=\"pesounitario number1\" name=\"ArtigoPst[" . $pstl->ID . "pesounitario]\" /></td>";
                                echo "<td> <input value=\"" . number_format($pstl->PesoIdeal,3) . "\" type=\"text\" readonly class=\"pesoideal number1\" name=\"ArtigoPst[" . $pstl->ID . "pesoideal]\" /> </td>";
                                echo "</tr>";
                                $totalPastelaria += $pstl->PesoIdeal;
                            }
                        }
                    ?>
                    <tr>
                        <td colspan="5"><strong>Totais</strong></td>
                        <td><input readonly type="text" class="ptotal number1" value="<?php echo number_format($totalPastelaria,3);?>"/> </td>
                    </tr>
                    <tr>
                        <td colspan="5"><strong>Desperdicio</strong></td>
                        <?php
                            $total_ = 0;
                            $total_ = $totalGelado - $totalPastelaria;
                        ?>
                        <td><input readonly type="text" class="desperdicio number1" value="<?php echo number_format($total_,3);?>"/></td>
                    </tr>
                    </tbody>
                </table>
            </div>
            </div>

    </div>


	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Criar' : 'Guardar'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->

<script>
    $('#myTab a').click(function (e) {
        e.preventDefault()
        $(this).tab('show')
    })

    $(".total").on("change", function()
    {
        var sum = 0;
        $('.total').each(function(){
            sum += parseFloat(this.value);
        });

        $("#TotalGelado").val(parseFloat(sum).toFixed(3));
        var total = $(".ptotal").val();
        var tt = parseFloat(sum) - total;
        $(".desperdicio").val(parseFloat(tt).toFixed(3));
    }
    );

    $(".inicio").on("change", function()
    {
        var fim = $(this).parent().parent().find(".fim");
        if(fim === "")
        {
            $(fim).val(0);
        }
        if($(this).val() === "")
            $(this).val(0);
        var total = $(this).parent().parent().find(".total");
        var tt = parseFloat(parseFloat($(this).val()) - parseFloat($(fim).val()));
        $(total).val(parseFloat(tt).toFixed(3));
        $(total).trigger("change");
    });

    $(".fim").on("change", function()
    {
        var inicio = $(this).parent().parent().find(".inicio");
        if(inicio === "")
        {
            $(inicio).val(0);
        }
        if($(this).val() === "")
            $(this).val(0);
        var total = $(this).parent().parent().find(".total");
        var tt = parseFloat(parseFloat($(inicio).val()) - parseFloat($(this).val()));
        $(total).val(parseFloat(tt).toFixed(3));
        $(total).trigger("change");
    });

    $(".vendidos").on("change", function()
    {
        var pesounit = $(this).parent().parent().find(".pesounitario");
        if(pesounit === "")
        {
            $(pesounit).val(0);
        }
        if($(this).val() === "")
            $(this).val(0);
        var ideal = $(this).parent().parent().find(".pesoideal");
        var tt = parseFloat((parseFloat($(pesounit).val())/1000) * parseFloat($(this).val()));
        $(ideal).val(parseFloat(tt).toFixed(3));
        $(ideal).trigger("change");
    });

    $(".pesoideal").on("change", function(){
        var total = 0;
        $(".pesoideal").each(function(){
            total += parseFloat($(this).val());
        });
        $(".ptotal").val(parseFloat(total).toFixed(3));
        var tt = parseFloat($("#TotalGelado").val()) - total;
        $(".desperdicio").val(parseFloat(tt).toFixed(3));
    });
</script>