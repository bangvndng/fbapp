<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'facebook-users-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="help-block">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<?php echo $form->textFieldRow($model,'facebook_id',array('class'=>'span5','maxlength'=>255)); ?>

	<?php echo $form->textFieldRow($model,'name',array('class'=>'span5','maxlength'=>255)); ?>

	<?php echo $form->textFieldRow($model,'email',array('class'=>'span5','maxlength'=>45)); ?>

	<?php echo $form->textFieldRow($model,'gender',array('class'=>'span5','maxlength'=>10)); ?>

	<?php echo $form->textFieldRow($model,'relationship',array('class'=>'span5','maxlength'=>45)); ?>

	<?php echo $form->textFieldRow($model,'age',array('class'=>'span5','maxlength'=>5)); ?>

	<?php echo $form->textFieldRow($model,'birthday',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'hometown',array('class'=>'span5','maxlength'=>255)); ?>

	<?php echo $form->textFieldRow($model,'location',array('class'=>'span5','maxlength'=>255)); ?>

	<?php echo $form->textFieldRow($model,'created',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'finished',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'app_id',array('class'=>'span5','maxlength'=>255)); ?>

	<?php echo $form->textFieldRow($model,'question_id',array('class'=>'span5','maxlength'=>11)); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Create' : 'Save',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
