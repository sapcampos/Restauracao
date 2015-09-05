<?php
/* @var $this LojaController */
/* @var $model Loja */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'loja-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Campos com <span class="required">*</span> são obrigatórios.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'nome'); ?>
		<?php echo $form->textField($model,'nome',array('size'=>60,'maxlength'=>128)); ?>
		<?php echo $form->error($model,'nome'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'idconcelho'); ?>
		<?php echo $form->dropDownList($model,'idconcelho',CHtml::listData(Concelhos::model()->findAll(array('order'=>'nome')),'id', 'nome')); ?>
		<?php echo $form->error($model,'idconcelho'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'activo'); ?>
		<?php echo $form->checkbox($model,'activo'); ?>
		<?php echo $form->error($model,'activo'); ?>
	</div>

    <div class="row">
        <?php echo $form->labelEx($model,'corloja'); ?>
        <?php echo $form->textField($model,'corloja',array('size'=>60,'maxlength'=>128)); ?>
        <?php echo $form->error($model,'corloja'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'registo'); ?>
        <?php echo $form->checkbox($model,'registo'); ?>
        <?php echo $form->error($model,'registo'); ?>
    </div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Criar' : 'Guardar'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->