<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'questions-form',
	'enableAjaxValidation'=>false,
    'htmlOptions' => array('enctype' => 'multipart/form-data'),

)); 
	
	$dropData = Apps::model()->findAll();
	$tmpArr = array();
	foreach ($dropData as $item) {
		$tmpArr[$item->id] = $item->name;
	}


?>

	<p class="help-block">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<?php echo $form->dropDownListRow($model,'app_type', array( 0 => 'TEXT' , 1 => 'IMAGE')); ?>

	<?php echo $form->checkboxRow($model, 'is_publish', array('value'=>1, 'uncheckValue'=>0)); ?>

	<?php echo $form->fileFieldRow($model, 'image'); ?>

	<?php
		if (! empty($model->image)) {
			echo '<img src="/uploads/' . $model->image . '" alt="facebook wall"/>';
		}
	 ?>

	<?php echo $form->dropDownListRow($model,'app_id', $tmpArr); ?>

	<?php echo $form->textFieldRow($model,'title',array('class'=>'span5','maxlength'=>255)); ?>

	<?php echo $form->textAreaRow($model,'description',array('rows'=>4, 'cols'=>50,'class'=>'span5','maxlength'=>255)); ?>

	<label for="Questions_intro">Intro<span class="required">*</span></label>
	<?php
	$this->widget('ext.tinymce.TinyMce', array(
		    'model' => $model,
		    'attribute' => 'intro',
		    // Optional config
		    'compressorRoute' => 'tinyMce/compressor',
		    //'spellcheckerUrl' => array('tinyMce/spellchecker'),
		    // or use yandex spell: http://api.yandex.ru/speller/doc/dg/tasks/how-to-spellcheck-tinymce.xml
		    'spellcheckerUrl' => false,
		    'settings' => array(
		    	'templates' => array(
		    		array('title' => 'Image', 'description' => 'Image content' , 'content' => '<div class="image"><h1><img src="/uploads/01contents.png" alt="alt" width="100%"></h1><p>ゔらゞき餯 䋥嫧リョ礯䨦 骧ぎゅ槚䏦奥 䋥嫧リョ 儦饪</p></div>'),
		    		array('title' => 'Horror', 'description' => 'Horror content' , 'content' => '<div class="black"><div class="textarea"><h1>骣みゅ しゃ䏨わヴェん 㧦びゅ稞訣雦 楃椺ニョ</h1><p>骣みゅ しゃ䏨わヴェん 㧦びゅ稞訣雦 楃椺ニョ </p><p></p><p></p><div class="white"><p>骣みゅ しゃ䏨わヴェん 㧦びゅ稞訣雦 楃椺ニョ <br>骣みゅ しゃ䏨わヴェん 㧦びゅ稞訣雦 楃椺ニョ </p><p class="text_red">骣みゅ しゃ䏨わヴェん 㧦びゅ稞訣雦 楃椺ニョ <br>骣みゅ しゃ䏨わヴェん 㧦びゅ稞訣雦 楃椺ニョ </p></div></div></div>'),
		    		array('title' => 'Other', 'description' => 'Other content' , 'content' => '<div class="textarea"><h1>骣みゅ しゃ䏨わヴェん 㧦びゅ稞訣雦 楃椺ニョ</h1><p>骣みゅ しゃ䏨わヴェん 㧦びゅ稞訣雦 楃椺ニョ<br>骣みゅ しゃ䏨わヴェん 㧦びゅ稞訣雦 楃椺ニョ</p><p></p><p></p></div>'),
		    	),
			),
		    'fileManager' => array(
		        'class' => 'ext.elFinder.TinyMceElFinder',
		        'connectorRoute'=>'elfinder/connector',
		    ),
		    'htmlOptions' => array(
		        'rows' => 6,
		        'cols' => 60,
		    ),
		));

	 ?>

	<div id='hidden_group' style="display:<?php if($model->app_type == 1) echo 'none;' ?>">
	<?php echo $form->textAreaRow($model,'scenario',array('rows'=>4, 'cols'=>50,'class'=>'span8','maxlength'=>255)); ?>

	<?php echo $form->textAreaRow($model,'contents',array('rows'=>6, 'cols'=>50, 'class'=>'span8')); ?>
	</div>
	<?php echo $form->textAreaRow($model,'anwser_result',array('rows'=>6, 'cols'=>50, 'class'=>'span8')); ?>

	<?php echo $form->checkBoxListRow($model,'permissions', Yii::app()->params['perms']);?>

	<?php echo $form->textFieldRow($model,'fb_page_id',array('class'=>'span5','maxlength'=>255)); ?>

	<?php echo $form->textFieldRow($model,'fb_page_url',array('class'=>'span5','maxlength'=>255)); ?>

	<?php echo $form->textFieldRow($model,'fb_page_title',array('class'=>'span5','maxlength'=>255)); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Create' : 'Save',
		)); ?>
	</div>

<?php $this->endWidget(); ?>

<script type="text/javascript">
jQuery(document).ready(function($) {
	$("#Questions_app_type").change(function(event) {
		if($(this).val() == "1")
			$("#hidden_group").hide();
		else
			$("#hidden_group").show();
	});
});
</script>

