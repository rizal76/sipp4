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
//        'umur', 
//        'jenis_kelamin', 
//        'status',
//		'kota',
//		'tlp',
//		'pendidikan',
//		'skill',
//		'cv',// Relation value given in model
//    )
//));
$link = Yii::app()->baseUrl . '/cv/';
$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'pelamar-grid',
    'dataProvider' => $model->search(),
    'filter' => $model,
    'columns' => array(
        
        'nama',
        'kota',
        'umur',
        'jenis_kelamin',
        'gaji',
        'pendidikan',
        array('name' => 'cv',
            'type' => 'raw',
            'value' => 'CHtml::link( "CV", "cv/".$data->cv)',
        ),
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
            'class' => 'CButtonColumn',
        ),
    ),
));
?>
