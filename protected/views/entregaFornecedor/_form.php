<?php
/* @var $this EntregaFornecedorController */
/* @var $model EntregaFornecedor */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'entrega-fornecedor-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'idfornecedor'); ?>
		<?php //echo $form->textField($model,'idfornecedor'); ?>
        <?php echo $form->dropDownList($model,'idfornecedor', CHtml::listData(Fornecedores::model()->findAll(array('order' => 'nome')),'id','nome'));?>
		<?php echo $form->error($model,'idfornecedor'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'idloja'); ?>
		<?php //echo $form->textField($model,'idloja'); ?>
        <?php echo $form->dropDownList($model,'idloja', CHtml::listData(Loja::model()->findAll(array('order' => 'nome')),'id','nome'));?>
		<?php echo $form->error($model,'idloja'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'data'); ?>
		<?php echo $form->textField($model,'data'); ?>
		<?php echo $form->error($model,'data'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->