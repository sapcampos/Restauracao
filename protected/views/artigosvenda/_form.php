<?php
/* @var $this ArtigosvendaController */
/* @var $model Artigosvenda */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'artigosvenda-form',
	'enableAjaxValidation'=>false,
)); ?>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'Nome'); ?>
		<?php echo $form->textField($model,'Nome',array('size'=>60,'maxlength'=>150)); ?>
		<?php echo $form->error($model,'Nome'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'PesoIdeal'); ?>
		<?php echo $form->textField($model,'PesoIdeal',array('size'=>18,'maxlength'=>18)); ?>
		<?php echo $form->error($model,'PesoIdeal'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Activo'); ?>
		<?php echo $form->checkbox($model,'Activo'); ?>
		<?php echo $form->error($model,'Activo'); ?>
	</div>

    <div class="row">
        <table class="table table-striped">
            <thead>
                <th>
                   Loja
                </th>
                <th>Activo</th>
            </thead>
            <tbody>
            <?php
            foreach($lojas as $loja)
            {
                if($loja->activo == 1 && $loja->id != 6 && $loja->id != 7){
                ?>
                <tr>
                    <td>
                        <?php echo $loja->nome;?>
                    </td>
                    <td>
                        <input type="checkbox" name="Loja["<?php echo $loja->id;?>"]" />
                    </td>
                </tr>
            <?php
            }
            }
            ?>
            </tbody>
        </table>
    </div>
	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->