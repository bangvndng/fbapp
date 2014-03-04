<?php
$this->breadcrumbs=array(
	'Facebook Users'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List FacebookUsers','url'=>array('index')),
	array('label'=>'Create FacebookUsers','url'=>array('create')),
	array('label'=>'Update FacebookUsers','url'=>array('update','id'=>$model->id)),
	array('label'=>'Delete FacebookUsers','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage FacebookUsers','url'=>array('admin')),
);
?>

<h1>View FacebookUsers #<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'facebook_id',
		'name',
		'email',
		'gender',
		'relationship',
		'age',
		'birthday',
		'hometown',
		'location',
		'created',
		'finished',
		'app_id',
		'question_id',
	),
)); ?>
