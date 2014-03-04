<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<?php echo $form->textFieldRow($model,'gender',array('class'=>'span2','maxlength'=>10)); ?>

	<?php echo $form->textFieldRow($model,'age',array('class'=>'span2','maxlength'=>5)); ?>

	<?php echo $form->textFieldRow($model,'location',array('class'=>'span5','maxlength'=>255)); ?>

	<label for="FacebookUsers_created">Created</label>
	<?php
	    $this->widget('zii.widgets.jui.CJuiDatePicker', array(
	        'id'=>CHtml::activeId($model, 'created'),
	        'model'=>$model,
	        'attribute'=> 'created',
		    'options'=>array(
		        'dateFormat'=>'yy-mm-dd',//Date format 'mm/dd/yy','yy-mm-dd','d M, y','d MM, y','DD, d MM, yy'
		    ),

	    )); 

	 ?>
	<label for="FacebookUsers_dateFrom">From</label>
	<?php
	    $this->widget('zii.widgets.jui.CJuiDatePicker', array(
	        'id'=>CHtml::activeId($model, 'dateFrom'),
	        'model'=>$model,
	        'attribute'=> 'dateFrom',
		    'options'=>array(
		        'dateFormat'=>'yy-mm-dd',//Date format 'mm/dd/yy','yy-mm-dd','d M, y','d MM, y','DD, d MM, yy'
		    ),

	    )); 

	 ?>
	 <label for="FacebookUsers_dateTo">To</label>
	 <?php
	    $this->widget('zii.widgets.jui.CJuiDatePicker', array(
	        'id'=>CHtml::activeId($model, 'dateTo'),
	        'model'=>$model,
	        'attribute'=> 'dateTo',
	        'options'=>array(
		        'dateFormat'=>'yy-mm-dd',//Date format 'mm/dd/yy','yy-mm-dd','d M, y','d MM, y','DD, d MM, yy'
		    ),
	    )); 

	 ?>


	<label for="FacebookUsers_created">Finished</label>
	<?php
	    $this->widget('zii.widgets.jui.CJuiDatePicker', array(
	        'id'=>CHtml::activeId($model, 'finished'),
	        'model'=>$model,
	        'attribute'=> 'finished',
		    'options'=>array(
		        'dateFormat'=>'yy-mm-dd',//Date format 'mm/dd/yy','yy-mm-dd','d M, y','d MM, y','DD, d MM, yy'
		    ),

	    )); 

	 ?>
	<?php echo $form->textFieldRow($model,'question_id',array('class'=>'span5','maxlength'=>11)); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>'Search',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
