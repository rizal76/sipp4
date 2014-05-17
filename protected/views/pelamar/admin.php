<?php
/* @var $this PelamarController */
/* @var $model Pelamar */

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#pelamar-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Daftar Pelamar</h1>

<?php 
//
//$this->widget('application.extensions.tablesorter.Sorter', array(
//    'data'=>$model,
//    'columns'=>array(	
//        'nama',
//        'tanggal_lahir', 
//        'jenis_kelamin', 
//        'status',
//		'kota',
//		'tlp',
//		'pendidikan',
//		'skill',
//		'cv',// Relation value given in model
//    )
//));

 $this->widget('zii.widgets.grid.CGridView', array(
 	'id'=>'pelamar-grid',
 	'dataProvider'=>$model->search(),
 	'filter'=>$model,
 	'columns'=>array(
 		'id',
 		'no_ktp',
 		'nama',
 		'tempat_lahir',
 		'tanggal_lahir',
 		'jenis_kelamin',
 		/*
 		'status',
 		'jumlah_anak',
 		'alamat',
 		'kota',
 		'tlp',
 		'pendidikan',
 		'jenjang',
 		'jurusan',
 		'tahun_lulus',
 		'skill',
 		'gaji',
 		'cv',
 		*/
 		array(
 			'class'=>'CButtonColumn',
 		),
 	),
 )); ?>
