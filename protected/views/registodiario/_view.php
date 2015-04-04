<?php
/* @var $this RegistodiarioController */
/* @var $data Registodiario */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('ID')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->ID), array('update', 'id'=>$data->ID)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('IDLoja')); ?>:</b>
	<?php echo CHtml::encode($data->IDLoja); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Data')); ?>:</b>
	<?php echo CHtml::encode($data->Data); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('IDUtilizador')); ?>:</b>
	<?php echo CHtml::encode($data->IDUtilizador); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Estado')); ?>:</b>
	<?php echo CHtml::encode($data->Estado); ?>
	<br />


</div>