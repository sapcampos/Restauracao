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
		<?php echo $form->labelEx($model,'idtipocontrato'); ?>
		<?php //echo $form->textField($model,'idtipocontrato');
        echo $form->dropDownList($model,'idtipocontrato',CHtml::listData(TipoContrato::model()->findAll(array('order' => 'nome')),'id','nome'));
        ?>
		<?php echo $form->error($model,'idtipocontrato'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'idregimetrabalho'); ?>
		<?php //
        //echo $form->textField($model,'idregimetrabalho');
        echo $form->dropDownList($model,'idregimetrabalho',CHtml::listData(RegimeTrabalho::model()->findAll(array('order' => 'nome')),'id','nome'));
        ?>
		<?php echo $form->error($model,'idregimetrabalho'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'idtipofuncionario'); ?>
		<?php //echo $form->textField($model,'idtipofuncionario');
        echo $form->dropDownList($model,'idtipofuncionario',CHtml::listData(TipoFuncionario::model()->findAll(array('order' => 'nome')),'id','nome'));
        ?>
		<?php echo $form->error($model,'idtipofuncionario'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'inicio'); ?>
		<?php //echo $form->textField($model,'inicio'); ?>
        <div id="datetimepicker1" class="input-append" style="float:left; padding-right: 15px;padding-left: 15px;">

            <input data-format="yyyy-MM-dd" type="text" name="Contrato[inicio]" style="width:100px;" value="<?php try
            {
                $vars = explode(" ",$model->inicio);
                if(count($vars)>0)
                {
                    if($vars[0] != "0000-00-00")
                        echo $vars[0];
                }
            }
            catch(Exception $ex)
            {
                echo "";
            }?>"/>
            <span class="add-on" id="Contrato_inicio">
              <i data-time-icon="icon-time" data-date-icon="icon-calendar">
              </i>
            </span>
        </div>
		<?php echo $form->error($model,'inicio'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'fim'); ?>
		<?php //echo $form->textField($model,'fim'); ?>
        <div id="datetimepicker2" class="input-append" style="float:left; padding-right: 15px;padding-left: 15px;">

            <input data-format="yyyy-MM-dd" type="text" name="Contrato[fim]" style="width:100px;" value="<?php
            try
            {
                $vars = explode(" ",$model->fim);
                if(count($vars)>0)
                {
                    if($vars[0] != "0000-00-00")
                        echo $vars[0];
                }
            }
            catch(Exception $ex)
            {
                echo "";
            }
            ?>" id="Contrato_fim"/>
                <span class="add-on">
                  <i data-time-icon="icon-time" data-date-icon="icon-calendar">
                  </i>
                </span>
        </div>
		<?php echo $form->error($model,'fim'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'idloja'); ?>
		<?php //echo $form->textField($model,'idloja');
        echo $form->dropDownList($model,'idloja',CHtml::listData(Loja::model()->findAll(array('order' => 'nome')),'id','nome'));
        ?>
		<?php echo $form->error($model,'idloja'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'idutilizador'); ?>
		<?php //echo $form->textField($model,'idutilizador');
        echo $form->dropDownList($model,'idutilizador',CHtml::listData(Funcionarios::model()->findAll(array('order' => 'nome')),'id','nome'));
        ?>
		<?php echo $form->error($model,'idutilizador'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'ndperex'); ?>
		<?php echo $form->textField($model,'ndperex'); ?>
		<?php echo $form->error($model,'ndperex'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'datacontrolo1'); ?>
		<?php echo $form->textField($model,'datacontrolo1', array("readonly" => true)); ?>
		<?php echo $form->error($model,'datacontrolo1'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'datacontrolo2'); ?>
		<?php echo $form->textField($model,'datacontrolo2', array("readonly" => true)); ?>
		<?php echo $form->error($model,'datacontrolo2'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'datacontrolo3'); ?>
		<?php echo $form->textField($model,'datacontrolo3', array("readonly" => true)); ?>
		<?php echo $form->error($model,'datacontrolo3'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'activo'); ?>
		<?php echo $form->checkBox($model,'activo'); ?>
		<?php echo $form->error($model,'activo'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Criar' : 'Guardar'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
<script>
    $(document).ready(function(){
        $.noConflict();
        $('#datetimepicker1').datetimepicker({
            language: 'pt-BR',
            pickTime: false

        });
        $('#datetimepicker2').datetimepicker({
            pickTime: false,
            language: 'pt-BR'
        });
    });

</script>