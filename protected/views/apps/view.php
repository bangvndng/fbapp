<?php
$this->breadcrumbs=array(
	'Apps'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List Apps','url'=>array('index')),
	array('label'=>'Create Apps','url'=>array('create')),
	array('label'=>'Update Apps','url'=>array('update','id'=>$model->id)),
	array('label'=>'Delete Apps','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Apps','url'=>array('admin')),
);
?>

<h1>View Apps #<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
		'fb_app_id',
		'fb_app_key',
	),
)); ?>
