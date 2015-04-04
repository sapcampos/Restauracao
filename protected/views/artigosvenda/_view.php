<?php
/* @var $this ArtigosvendaController */
/* @var $data Artigosvenda */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('ID')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->ID), array('view', 'id'=>$data->ID)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Nome')); ?>:</b>
	<?php echo CHtml::encode($data->Nome); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('PesoIdeal')); ?>:</b>
	<?php echo CHtml::encode($data->PesoIdeal); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Activo')); ?>:</b>
	<?php echo CHtml::encode($data->Activo); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Deleted')); ?>:</b>
	<?php echo CHtml::encode($data->Deleted); ?>
	<br />


</div>