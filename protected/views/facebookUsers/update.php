<?php
$this->breadcrumbs=array(
	'Facebook Users'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List FacebookUsers','url'=>array('index')),
	array('label'=>'Create FacebookUsers','url'=>array('create')),
	array('label'=>'View FacebookUsers','url'=>array('view','id'=>$model->id)),
	array('label'=>'Manage FacebookUsers','url'=>array('admin')),
);
?>

<h1>Update FacebookUsers <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>