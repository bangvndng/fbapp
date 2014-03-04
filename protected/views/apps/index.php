<?php
$this->breadcrumbs=array(
	'Apps',
);

$this->menu=array(
	array('label'=>'Create Apps','url'=>array('create')),
	array('label'=>'Manage Apps','url'=>array('admin')),
);
?>

<h1>Apps</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
