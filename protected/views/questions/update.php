<?php
$this->breadcrumbs=array(
	'Questions'=>array('index'),
	$model->title=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Questions','url'=>array('index')),
	array('label'=>'Create Questions','url'=>array('create')),
	array('label'=>'View Questions','url'=>array('view','id'=>$model->id)),
	array('label'=>'Manage Questions','url'=>array('admin')),
);
?>

<h1>Update Questions <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>