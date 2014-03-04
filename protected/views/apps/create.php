<?php
$this->breadcrumbs=array(
	'Apps'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Apps','url'=>array('index')),
	array('label'=>'Manage Apps','url'=>array('admin')),
);
?>

<h1>Create Apps</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>