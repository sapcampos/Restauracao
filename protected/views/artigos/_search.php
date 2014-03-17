<?php
/* @var $this ArtigosController */
/* @var $model Artigos */
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
		<?php echo $form->label($model,'descricao'); ?>
		<?php echo $form->textField($model,'descricao',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'idfornecedor'); ?>
		<?php echo $form->textField($model,'idfornecedor'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'activo'); ?>
		<?php echo $form->textField($model,'activo'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'quant_enc'); ?>
		<?php echo $form->textField($model,'quant_enc'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'tipounidade_enc'); ?>
		<?php echo $form->textField($model,'tipounidade_enc'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'tipounidade_stock'); ?>
		<?php echo $form->textField($model,'tipounidade_stock'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->