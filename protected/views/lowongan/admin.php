<?php
/* @var $this LowonganController */
/* @var $model Lowongan */

$this->breadcrumbs=array(
	'Lowongans'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Lowongan', 'url'=>array('index')),
	array('label'=>'Create Lowongan', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#lowongan-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Lowongans</h1>


<?php echo CHtml::link('Create Lowongan',array('lowongan/create'), array('class'=>'btn btn-primary btn-sm')); ?>
<hr>
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'lowongan-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'nama',
		'deskripsi',
		'persyaratan',
		'departemen',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
