<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id),array('view','id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('name')); ?>:</b>
	<?php echo CHtml::encode($data->name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fb_app_id')); ?>:</b>
	<?php echo CHtml::encode($data->fb_app_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fb_app_key')); ?>:</b>
	<?php echo CHtml::encode($data->fb_app_key); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fb_namespace')); ?>:</b>
	<?php echo CHtml::encode($data->fb_namespace); ?>
	<br />

</div>