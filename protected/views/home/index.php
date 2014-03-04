<div id="fb-root"></div>

<div id="container" class="container" >

<div class="container-fluid">
    <div id="content-inner">
        
        <?php $this->widget('bootstrap.widgets.TbGridView', array(
		    'type'=>'striped bordered condensed',
		    'dataProvider'=>$dataProvider,
		    'template'=>"{items}\n{pager}",
		    'columns'=>array(
		        array('name'=>'id', 'header'=>'ID'),
		        array( 'type'=>'raw', 'header'=>'Title', 'value' => 'CHtml::link(CHtml::encode($data->title),array("question","id"=>$data->id))' ),
		    ),
		)); ?>

    </div>
</div>
</div>


