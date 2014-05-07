<?php
//tampilin notifikasi yang ada
foreach (Yii::app()->user->getFlashes() as $key => $message) {
    echo '<div class="flash-' . $key . '">' . $message . "</div>\n";
}
?>

<?php
if (count($model) == 0) {
    echo "<h2>Tidak ada pengumuman</h2>";
}
foreach ($model as $j => $modelp) {
    echo 'Nama Lowongan: ' . $modelp->lowongan->nama . '<br>';
    if (!isset($modelp->proses->deskripsi)) {
        echo 'sedang seleksi administrasi<br>';
    } else {

        //cek kalo ada yang submit tugas
        echo 'sampai tahap: ' . $modelp->proses->tahaps->nama . '<br>';
        echo 'Deskripsi  ' . $modelp->proses->deskripsi . '<br>';
        echo 'File Keterangan : ';
        echo '<a href=' . Yii::app()->baseUrl . '/soal_tugas/' . $modelp->proses->file_tugas . '>Download</a><br>';
        ?>

        <!-- kalo ini merupakan tahap 1 atau 2 -->
        <?php if ($modelp->proses->tahaps->id == 1) { ?>
            <?php if ($modelp->hasil_tugas == null) { ?>
                <div class="form">
                    <?php
                    $form = $this->beginWidget('CActiveForm', array(
                        'id' => 'tahap-form',
                        'enableAjaxValidation' => false,
                        'htmlOptions' => array('enctype' => 'multipart/form-data'),
                    ));
                    ?>
                    <p class="note">Isi hasil tugas anda </p>
                    <?php echo $form->errorSummary($modelp); ?>
                    <?php echo $form->hiddenField($modelp, 'id', array('value' => $modelp->id)); ?>
                    <div class="row">
                        <?php echo $form->labelEx($modelp, 'hasil_tugas'); ?>
                        <?php echo $form->fileField($modelp, 'hasil_tugas', array('size' => 30, 'maxlength' => 30)); ?>
                        <?php echo $form->error($modelp, 'hasil_tugas'); ?>

                    </div>
                    <div class="row buttons">
                        <?php echo CHtml::submitButton($modelp->isNewRecord ? 'Create' : 'Save'); ?>
                    </div>	
                    <?php $this->endWidget(); ?>

                </div><!-- form -->
                <?php
            } else {
                echo '<a href=' . Yii::app()->baseUrl . '/hasil_tugas/' . $modelp->hasil_tugas . '>Download pengerjaan tugas</a><br>';
            }
            //else echo "anda sudah submit tugas, jawaban anda : " . $modelp->hasil_tugas; 
        }//akhir tugas 1
        //kalo dia udah sampai tugas 2 / tahap 2
        elseif (($modelp->proses->tahaps->id == 2)) {
            ?>
            <?php if ($modelp->hasil_tugas2 == null) {
                ?>
                <div class="form">
                    <?php
                    $form = $this->beginWidget('CActiveForm', array(
                        'id' => 'tahap-form',
                        'enableAjaxValidation' => false,
                        'htmlOptions' => array('enctype' => 'multipart/form-data'),
                    ));
                    ?>
                    <p class="note">Isi hasil tugas anda </p>
                    <?php echo $form->errorSummary($modelp); ?>
                        <?php echo $form->hiddenField($modelp, 'id', array('value' => $modelp->id)); ?>
                    <div class="row">
                        <?php echo $form->labelEx($modelp, 'hasil_tugas2'); ?>
                        <?php echo $form->fileField($modelp, 'hasil_tugas2', array('size' => 30, 'maxlength' => 30)); ?>
                <?php echo $form->error($modelp, 'hasil_tugas2'); ?>

                    </div>
                    <div class="row buttons">
                    <?php echo CHtml::submitButton($modelp->isNewRecord ? 'Create' : 'Save'); ?>
                    </div>	
                <?php $this->endWidget(); ?>

                </div><!-- form -->
                <?php
            } else {
                echo '<a href=' . Yii::app()->baseUrl . '/hasil_tugas/' . $modelp->hasil_tugas2 . '>Download pengerjaan tugas</a><br>';
            }
        }
    }
    echo "<hr>";
}
?>