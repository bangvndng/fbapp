<?php
$this->breadcrumbs=array(
	'Facebook Users',
);

$this->menu=array(
	array('label'=>'Create FacebookUsers','url'=>array('create')),
	array('label'=>'Manage FacebookUsers','url'=>array('admin')),
);
?>

<h1>Facebook Users</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
