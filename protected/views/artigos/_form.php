<?php
/* @var $this ArtigosController */
/* @var $model Artigos */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'artigos-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Campos com <span class="required">*</span> são obrigatorios.</p>

	<?php echo $form->errorSummary($model); ?>
    <div style="float:left;">
        <div class="row row3">
            <?php echo $form->labelEx($model,'descricao'); ?>
            <?php echo $form->textField($model,'descricao',array('size'=>90,'maxlength'=>90, "style"=>"width:455px")); ?>
            <?php echo $form->error($model,'descricao'); ?>
        </div>

        <div class="row row2">
            <?php echo $form->labelEx($model,'idfornecedor'); ?>
            <?php //echo $form->textField($model,'idfornecedor'); ?>
            <?php echo $form->dropDownList($model,'idfornecedor', CHtml::listData(Fornecedores::model()->findAll(array('order' => 'nome')),'id','nome'));?>
            <?php echo $form->error($model,'idfornecedor'); ?>
        </div>

        <div class="row row2">
            <?php echo $form->labelEx($model,'tipoartigo'); ?>
            <?php //echo $form->textField($model,'tipounidade_stock'); ?>
            <?php echo $form->dropDownList($model,'tipoartigo', CHtml::listData(TipoArtigo::model()->findAll(array('order' => 'nome')),'id','nome'));?>
            <?php echo $form->error($model,'tipoartigo'); ?>
        </div>

        <div class="row row2">
            <?php echo $form->labelEx($model,'tipounidade_enc'); ?>
            <?php //echo $form->textField($model,'tipounidade_enc'); ?>
            <?php echo $form->dropDownList($model,'tipounidade_enc', CHtml::listData(TipoUnidade::model()->findAll(array('order' => 'nome')),'id','nome'));?>
            <?php echo $form->error($model,'tipounidade_enc'); ?>
        </div>
        <div class="row row2">
            <?php echo $form->labelEx($model,'tipounidade_stock'); ?>
            <?php //echo $form->textField($model,'tipounidade_stock'); ?>
            <?php echo $form->dropDownList($model,'tipounidade_stock', CHtml::listData(TipoUnidade::model()->findAll(array('order' => 'nome')),'id','nome'));?>
            <?php echo $form->error($model,'tipounidade_stock'); ?>
        </div>

        <div class="row row2">
            <?php echo $form->labelEx($model,'precounidadeencomenda'); ?>
            <?php echo $form->textField($model,'precounidadeencomenda'); ?>
            <?php echo $form->error($model,'precounidadeencomenda'); ?>
        </div>

        <div class="row row2">
            <?php echo $form->labelEx($model,'precounidadeinventario'); ?>
            <?php echo $form->textField($model,'precounidadeinventario'); ?>
            <?php echo $form->error($model,'precounidadeinventario'); ?>
        </div>
        <div class="row row2">
            <?php echo $form->labelEx($model,'activo'); ?>
            <?php echo $form->checkbox($model,'activo'); ?>
            <?php echo $form->error($model,'activo'); ?>
        </div>

        <div class="row row2">
            <?php echo $form->labelEx($model,'tipo'); ?>
            <?php echo $form->dropDownList($model,'tipo', array("M" => "M", "P" => "P", "A" => "A", "S" => "S", "T" => "T")); ?>
            <?php echo $form->error($model,'tipo'); ?>
        </div>

        <div class="row row2">
            <?php echo $form->labelEx($model,'referencia'); ?>
            <?php echo $form->textField($model,'referencia'); ?>
            <?php echo $form->error($model,'referencia'); ?>
        </div>
    </div>
    <div>&nbsp;</div>
    <div class="row" style="width:100%; padding-top: 10px; padding-left: 20px;">
        <?php
            //print_r($arr);
            if(isset($arr))
            {
                foreach($arr as $item)
                {   echo "<div style=\"width:100%; float:left\">";
                    echo "<div style=\"float:left; padding-left: 10px;\">";
                    echo "<label for=\"Loja[".$item->idloja0->id."]\">".$item->idloja0->nome."</label>";
                    echo "<input type=\"checkbox\" id=\"Loja_".$item->idloja0->id."\" name=\"Loja[".$item->idloja0->id."]\" ".($item->activo == 1 ? " checked " : "")." />";
                    echo "</div>";
                    echo "<div style=\"float:left; padding-left: 10px;\">";
                    echo "<label for=\"LojaEnc[".$item->idloja0->id."]\">Encomenda</label>";
                    //echo "<input type=\"checkbox\" name=\"LojaEnc[".$item->idloja0->id."]\" ".($item->activo == 1 ? " checked " : "").">";
                    echo CHtml::dropDownList('LojaEnc['.$item->idloja0->id.']', $item->idencomenda,CHtml::listData(EntidadeEncomenda::model()->findAll(array('order' => 'nome')),'id','nome'));
                    echo "</div>";
                    echo "<div style=\"float:left; padding-left: 10px;\">";
                    echo "<label for=\"Loja[".$item->idloja0->id."]\">Entrega</label>";
                    echo CHtml::dropDownList('LojaEnt['.$item->idloja0->id.']', $item->identrega,CHtml::listData(EntidadeEntrega::model()->findAll(array('order' => 'nome')),'id','nome'));
                    echo "</div>";
                    echo "</div><br/>";
                }
            }

        ?>
    </div>
    <br/>
    <br/>
    <br/>
	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Criar' : 'Guardar'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->