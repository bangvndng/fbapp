<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id),array('view','id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('app_type')); ?>:</b>
	<?php echo CHtml::encode($data->app_type); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('app_id')); ?>:</b>
	<?php echo CHtml::encode($data->app_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('title')); ?>:</b>
	<?php echo CHtml::encode($data->title); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('description')); ?>:</b>
	<?php echo CHtml::encode($data->description); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('scenario')); ?>:</b>
	<?php echo CHtml::encode($data->scenario); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('contents')); ?>:</b>
	<?php echo CHtml::encode($data->contents); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('anwser_result')); ?>:</b>
	<?php echo CHtml::encode($data->anwser_result); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('permissions')); ?>:</b>
	<?php echo CHtml::encode($data->permissions); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fb_page_id')); ?>:</b>
	<?php echo CHtml::encode($data->fb_page_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fb_page_url')); ?>:</b>
	<?php echo CHtml::encode($data->fb_page_url); ?>
	<br />

	*/ ?>

</div>