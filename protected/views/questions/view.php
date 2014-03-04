<?php
$this->breadcrumbs=array(
	'Questions'=>array('index'),
	$model->title,
);

$this->menu=array(
	array('label'=>'List Questions','url'=>array('index')),
	array('label'=>'Create Questions','url'=>array('create')),
	array('label'=>'Update Questions','url'=>array('update','id'=>$model->id)),
	array('label'=>'Delete Questions','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Questions','url'=>array('admin')),
);
?>

<h1>View Questions #<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'app_type',
		'app_id',
		'title',
		'description',
		'scenario',
		'contents',
		'anwser_result',
		'permissions',
		'is_publish',
		'image',
		'count',
		'count_today',
		'count_month',
		'fb_page_id',
		'fb_page_url',
	),
)); ?>
