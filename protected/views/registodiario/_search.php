<?php
/* @var $this RegistodiarioController */
/* @var $model Registodiario */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'ID'); ?>
		<?php echo $form->textField($model,'ID'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'IDLoja'); ?>
		<?php echo $form->textField($model,'IDLoja'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'Data'); ?>
		<?php echo $form->textField($model,'Data'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'IDUtilizador'); ?>
		<?php echo $form->textField($model,'IDUtilizador'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'Estado'); ?>
		<?php echo $form->textField($model,'Estado'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->