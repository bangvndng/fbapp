<?php
$this->breadcrumbs=array(
	'Facebook Users'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List FacebookUsers','url'=>array('index')),
	array('label'=>'Create FacebookUsers','url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('facebook-users-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Facebook Users</h1>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button btn')); ?>
<?php echo CHtml::button('Export CSV', array('id'=>'export-button','class'=>'btn')); ?>

<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->


<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'facebook-users-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		// 'id',
		'facebook_id',
		'name',
		'gender',
		'age',
		'location',
		'question_id',
		 array(
            'name'=>'created',
            'filter'=>false, // Set the filter to false when date range searching
        ),
		array(
            'name'=>'finished',
            'filter'=>false, // Set the filter to false when date range searching
        ),
		/*
		'age',
		'birthday',
		'hometown',
		'created',
		'finished',
		'app_id',
		'question_id',
		*/
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
		),
	),
)); ?>

<?php 

Yii::app()->clientScript->registerScript('export-csv', "
$('#export-button').on('click',function() {
    $.fn.yiiGridView.export();
});
$.fn.yiiGridView.export = function() {
    $.fn.yiiGridView.update('facebook-users-grid',{ 
        success: function() {
            $('#facebook-users-grid').removeClass('grid-view-loading');
            window.location = '". $this->createUrl('exportFile')  . "';
            alert('done');
        },
        data: $('.search-form form').serialize() + '&export=true'
    });
}

");


?>