<?php
/* @var $this FuncionariosController */
/* @var $model Funcionarios */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'funcionarios-form',
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
        <div id="datetimepicker1" class="input-append" style="float:left; padding-right: 15px;padding-left: 15px;">
		<?php echo $form->labelEx($model,'datanascimento'); ?>
		<?php echo $form->textField($model,'datanascimento', array("data-format"=>"yyyy-MM-dd")); ?>
        <span class="add-on">
              <i data-time-icon="icon-time" data-date-icon="icon-calendar">
              </i>
        </span>
		<?php echo $form->error($model,'datanascimento'); ?>
        </div>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Criar' : 'Guardar'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
<script>
$(function() {
    $.noConflict();
    $('#datetimepicker1').datetimepicker({
        language: 'pt-BR',
        pickTime: false
    });
});

</script>