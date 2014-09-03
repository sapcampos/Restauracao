<?php
/* @var $this ContratoController */
/* @var $data Contrato */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('idtipocontrato')); ?>:</b>
	<?php echo CHtml::encode($data->idtipocontrato); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('idregimetrabalho')); ?>:</b>
	<?php echo CHtml::encode($data->idregimetrabalho); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('idtipofuncionario')); ?>:</b>
	<?php echo CHtml::encode($data->idtipofuncionario); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('inicio')); ?>:</b>
	<?php echo CHtml::encode($data->inicio); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fim')); ?>:</b>
	<?php echo CHtml::encode($data->fim); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('idloja')); ?>:</b>
	<?php echo CHtml::encode($data->idloja); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('idutilizador')); ?>:</b>
	<?php echo CHtml::encode($data->idutilizador); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ndperex')); ?>:</b>
	<?php echo CHtml::encode($data->ndperex); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('datacontrolo1')); ?>:</b>
	<?php echo CHtml::encode($data->datacontrolo1); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('datacontrolo2')); ?>:</b>
	<?php echo CHtml::encode($data->datacontrolo2); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('datacontrolo3')); ?>:</b>
	<?php echo CHtml::encode($data->datacontrolo3); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('activo')); ?>:</b>
	<?php echo CHtml::encode($data->activo); ?>
	<br />

	*/ ?>

</div>