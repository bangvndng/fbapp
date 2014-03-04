<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'apps-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="help-block">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<?php echo $form->textFieldRow($model,'name',array('class'=>'span5','maxlength'=>255)); ?>

	<?php echo $form->textFieldRow($model,'fb_app_id',array('class'=>'span5','maxlength'=>255)); ?>

	<?php echo $form->textFieldRow($model,'fb_app_key',array('class'=>'span5','maxlength'=>255)); ?>

	<?php echo $form->textFieldRow($model,'fb_namespace',array('class'=>'span5','maxlength'=>255)); ?>


	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Create' : 'Save',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
