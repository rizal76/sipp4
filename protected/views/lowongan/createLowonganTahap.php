<?php
    foreach(Yii::app()->user->getFlashes() as $key => $message) {
        echo '<div class="alert alert-info flash-' . $key . '">' . $message . "</div>\n";
    }
?>

<h1>Create Lowongan Tahap</h1>

<?php $this->renderPartial('_formLowonganTahap', array('idLowongan'=>$idLowongan, 'tahaps'=>$tahaps)); ?>