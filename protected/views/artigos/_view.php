<?php
/* @var $this ArtigosController */
/* @var $data Artigos */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('descricao')); ?>:</b>
	<?php echo CHtml::encode($data->descricao); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('idfornecedor')); ?>:</b>
	<?php echo CHtml::encode($data->idfornecedor); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('activo')); ?>:</b>
	<?php echo CHtml::encode($data->activo); ?>

	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('tipounidade_enc')); ?>:</b>
	<?php echo CHtml::encode($data->tipounidade_enc); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('tipounidade_stock')); ?>:</b>
	<?php echo CHtml::encode($data->tipounidade_stock); ?>
	<br />


</div>