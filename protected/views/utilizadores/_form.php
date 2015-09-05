<?php
/* @var $this UtilizadoresController */
/* @var $model Utilizadores */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'utilizadores-form',
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
		<?php echo $form->labelEx($model,'username'); ?>
		<?php echo $form->textField($model,'username',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'username'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'password'); ?>
		<?php echo $form->passwordField($model,'password',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'password'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'activo'); ?>
		<?php echo $form->checkbox($model,'activo',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'activo'); ?>
	</div>

    <div class="row row2">
        <?php echo $form->labelEx($model,'tipoutilizador'); ?>
        <?php //echo $form->textField($model,'tipounidade_stock'); ?>
        <?php echo $form->dropDownList($model,'tipoutilizador', CHtml::listData(Tipoutilizador::model()->findAll(array('order' => 'nome')),'idtipoutilizador','nome'));?>
        <?php echo $form->error($model,'tipoutilizador'); ?>
    </div>

    <div class="row row2">
        <?php echo $form->labelEx($model,'loja'); ?>
        <?php //echo $form->textField($model,'tipounidade_stock'); ?>
        <?php echo $form->dropDownList($model,'loja', CHtml::listData(Loja::model()->findAll(array('order' => 'nome')),'id','nome'));?>
        <?php echo $form->error($model,'loja'); ?>
    </div>
    <br/>
	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Criar' : 'Guardar'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->