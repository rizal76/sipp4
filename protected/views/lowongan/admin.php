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

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->
<hr>

<?php echo CHtml::link('Create Lowongan',array('lowongan/create'), array('class'=>'btn btn-primary btn-sm')); ?>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'lowongan-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'nama',
		'deskripsi',
		'persyaratan',
		'departemen',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
