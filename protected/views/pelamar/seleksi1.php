


<h1>Daftar Pelamar Seleksi Awal</h1>

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'lowongan-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>
<?php 
$this->widget('application.extensions.tablesorter.Sorter', array(
    'data'=>$modelsP,
    'columns'=>array(
        'nama',
//        //'lamaran.lowongan.nama',
//         array(
//		 	'type'=>'raw', // this is for your related group members of the current group
//            'name'=>'admin.departemen', // this will access the attributeLabel from the member model class, and assign it to your column header
//            'value'=>'$data->admin->departemen', // this will access the current group's 1st member and give out the firstname of that member
//             // this tells that the value type is raw and no formatting is to be applied to it
//         ),
        'tanggal_lahir', 
        'jenis_kelamin', 
        'status',
		'kota',
		'tlp',
		'pendidikan',
		'skill',
		'cv',// Relation value given in model
    ),
   
));

// $this->widget('zii.widgets.grid.CGridView', array(
// 	'id'=>'pelamar-grid',
// 	'dataProvider'=>$model->search(),
// 	'filter'=>$model,
// 	'columns'=>array(
// 		'id',
// 		'no_ktp',
// 		'nama',
// 		'tempat_lahir',
// 		'tanggal_lahir',
// 		'jenis_kelamin',
// 		/*
// 		'status',
// 		'jumlah_anak',
// 		'alamat',
// 		'kota',
// 		'tlp',
// 		'pendidikan',
// 		'jenjang',
// 		'jurusan',
// 		'tahun_lulus',
// 		'skill',
// 		'gaji',
// 		'cv',
// 		*/
// 		array(
// 			'class'=>'CButtonColumn',
// 		),
// 	),
// )); ?>
        <div class="row buttons">
                        <?php echo CHtml::submitButton('Save'); ?>
        </div>
<?php $this->endWidget(); ?>

