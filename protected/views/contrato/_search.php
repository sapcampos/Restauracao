<?php
/* @var $this ContratoController */
/* @var $model Contrato */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id'); ?>
		<?php echo $form->textField($model,'id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'idtipocontrato'); ?>
		<?php echo $form->textField($model,'idtipocontrato'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'idregimetrabalho'); ?>
		<?php echo $form->textField($model,'idregimetrabalho'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'idtipofuncionario'); ?>
		<?php echo $form->textField($model,'idtipofuncionario'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'inicio'); ?>
		<?php echo $form->textField($model,'inicio'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'fim'); ?>
		<?php echo $form->textField($model,'fim'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'idloja'); ?>
		<?php echo $form->textField($model,'idloja'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->