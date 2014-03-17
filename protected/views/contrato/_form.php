<?php
/* @var $this ContratoController */
/* @var $model Contrato */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'contrato-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Campos com <span class="required">*</span> são obrigatórios.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'id'); ?>
		<?php echo $form->textField($model,'id'); ?>
		<?php echo $form->error($model,'id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'idtipocontrato'); ?>
		<?php echo $form->textField($model,'idtipocontrato'); ?>
		<?php echo $form->error($model,'idtipocontrato'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'idregimetrabalho'); ?>
		<?php echo $form->textField($model,'idregimetrabalho'); ?>
		<?php echo $form->error($model,'idregimetrabalho'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'idtipofuncionario'); ?>
		<?php echo $form->textField($model,'idtipofuncionario'); ?>
		<?php echo $form->error($model,'idtipofuncionario'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'inicio'); ?>
		<?php echo $form->textField($model,'inicio'); ?>
		<?php echo $form->error($model,'inicio'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'fim'); ?>
		<?php echo $form->textField($model,'fim'); ?>
		<?php echo $form->error($model,'fim'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'idloja'); ?>
		<?php echo $form->textField($model,'idloja'); ?>
		<?php echo $form->error($model,'idloja'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Criar' : 'Guardar'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->