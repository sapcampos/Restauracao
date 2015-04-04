<?php
/* @var $this RegistodiarioController */
/* @var $model Registodiario */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'registodiario-form',
	'enableAjaxValidation'=>false,
)); ?>

	<?php echo $form->errorSummary($model); ?>

    <?php if(!is_null($loja) && !empty($loja)){ ?>
	<div class="row">
		<?php echo $form->labelEx($model,'IDLoja'); ?>
		<?php echo $form->textField($model,'IDLoja'); ?>
		<?php echo $form->error($model,'IDLoja'); ?>
	</div>
    <?php } ?>
	<div class="row">
		<?php echo $form->labelEx($model,'Data'); ?>
		<?php echo $form->textField($model,'Data'); ?>
		<?php echo $form->error($model,'Data'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'IDUtilizador'); ?>
		<?php echo $form->textField($model,'IDUtilizador'); ?>
		<?php echo $form->error($model,'IDUtilizador'); ?>
	</div>


    <div id="tabs" class="row">

    </div>

    <script>

    </script>
	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Criar' : 'Guardar'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->