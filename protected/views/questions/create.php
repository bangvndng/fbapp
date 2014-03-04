<?php
$this->breadcrumbs=array(
	'Questions'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Questions','url'=>array('index')),
	array('label'=>'Manage Questions','url'=>array('admin')),
);
?>

<h1>Create Questions</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>