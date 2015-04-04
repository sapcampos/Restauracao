<?php
/* @var $this ArtigosvendaController */
/* @var $model Artigosvenda */
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
		<?php echo $form->label($model,'Nome'); ?>
		<?php echo $form->textField($model,'Nome',array('size'=>60,'maxlength'=>150)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'PesoIdeal'); ?>
		<?php echo $form->textField($model,'PesoIdeal',array('size'=>18,'maxlength'=>18)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'Activo'); ?>
		<?php echo $form->textField($model,'Activo'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'Deleted'); ?>
		<?php echo $form->textField($model,'Deleted'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->