<?php
$this->breadcrumbs=array(
	'Apps'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Apps','url'=>array('index')),
	array('label'=>'Create Apps','url'=>array('create')),
	array('label'=>'View Apps','url'=>array('view','id'=>$model->id)),
	array('label'=>'Manage Apps','url'=>array('admin')),
);
?>

<h1>Update Apps <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>