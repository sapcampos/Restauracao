<?php
/* @var $this FornecedoresController */
/* @var $model Fornecedores */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'fornecedores-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Campos com <span class="required">*</span> são obrigatórios.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'nome'); ?>
		<?php echo $form->textField($model,'nome',array('size'=>60,'maxlength'=>256)); ?>
		<?php echo $form->error($model,'nome'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'email'); ?>
		<?php echo $form->textField($model,'email',array('size'=>60,'maxlength'=>256)); ?>
		<?php echo $form->error($model,'email'); ?>
	</div>
    <div class="row"><h3>Entrega Lojas</h3></div>
    <?php
    $dias = array(-1 => "", 0 => "Dia Seguinte", 1 => "Segunda-Feira", 2 => "Terça-Feira", 3 => "Quarta-Feira", 4 => "Quinta-Feira", 5=>"Sexta-Feira", 6 => "Sábado", 7 => "Domingo");
    foreach ($arr as $i=>$item)
    {
        $loja = Loja::model()->findByPk($item->idloja);
        echo "<div class=\"row\">";
        echo "<div style=\"width:200px;\">";
        echo $loja->nome;
        echo "</div>";
        echo "<select name=\"Lojaentregafornecedor[".$i."][diaentrega]\">";
        foreach($dias as $dayid => $dayname)
        {
            echo $item->diaentrega;
            if($item->diaentrega == $dayid)
            {
                echo "<option value=\"".$dayid."\" selected>".$dayname."</option>";
            }
            else
            {
                echo "<option value=\"".$dayid."\">".$dayname."</option>";
            }
        }
        echo "</select>";
        echo "</div>";
    }
    ?>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Criar' : 'Guardar'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->