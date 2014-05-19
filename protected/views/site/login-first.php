<?php
//load jquery yg ga otomatis
Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js/jquery.js');
if(Yii::app()->user->isGuest) {
?>
<h3>Silahkan Login terlebih dahulu. </h3>
<?php } else ?>
<h3>Selamat ! anda sudah login.</h3>
