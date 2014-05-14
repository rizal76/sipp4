

<h1>Lowongan <?php echo $model->nama; ?></h1>
<?php
foreach(Yii::app()->user->getFlashes() as $key => $message) {
echo '<div class="flash-' . $key . '">' . $message . "</div>\n";
}
?>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'nama',
		'deskripsi',
		'persyaratan',
	),
)); ?>


<?php 
//yg boleh lamar hanya pelamar
if(Yii::app()->user->isMember()) {
	//kalo belum lamar
	$cekPelamar = Lamaran::model()->findByAttributes(
	    array('id_pelamar'=>Yii::app()->user->id, 'id_lowongan'=>$model->id)
	);
	if($cekPelamar==null)
		 echo CHtml::link('Apply Lowongan',array('lowongan/apply', 'id'=>$model->id), array('class'=>'btn btn-primary btn-sm'));

		//kalo udah lamar
	else
		echo "anda sudah apply lowongan ini";
}
if(Yii::app()->user->isGuest){
		 echo CHtml::link('Apply Lowongan',array('lowongan/apply', 'id'=>$model->id), array('class'=>'btn btn-primary btn-sm'));

}
?>
