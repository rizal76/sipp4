
<h1>Seleksi Lanjutan</h1>
<?php
$form = $this->beginWidget('CActiveForm', array(
    'id' => 'lowongan-form',
    // Please note: When you enable ajax validation, make sure the corresponding
    // controller action is handling ajax validation correctly.
    // There is a call to performAjaxValidation() commented in generated controller code.
    // See class documentation of CActiveForm for details on this.
    'enableAjaxValidation' => false,
        ));
?>
<table id="myTable" class="tablesorter table table-bordered hasFilters tablesorter-bootstrap"> 
    <thead> 
        <tr> 
            <th>Nama</th> 
            <th>Lowongan</th>
<!--            <th>Administrasi</th>-->
            <?php
            foreach ($modelsT as $key => $value) {
                echo "<th>" . $value->nama . "</th>";
            }
            ?>
        </tr> 
    </thead> 
    <tbody> 
        <?php
        foreach ($modelsL as $key => $value) {

            echo "<tr><td>" . $value->pelamar->nama . "</td>";
            echo "<td>" . $value->lowongan->nama . "</td>";
//              if (!empty($value->hasil_tugas)) 
//             echo "<td>" . $value->hasil_tugas . "</td>";
            // echo "<td><a href=" . Yii::app()->request->baseUrl . "/cv/" . $value->pelamar->cv . ">Download</a></td>";
            //PRINT SETIAP TAHAP CHECKBOXNYA
            $tahapsL = $value->lowongan->lowongantahaps;
            $count = 0;
            foreach ($modelsT as $key2 => $value2) {
                if (isset($tahapsL[$count]) && $tahapsL[$count]->id_tahap == $key2 + 1) {
                    $id_lt = $tahapsL[$count]->id;
                    echo "<td>";
                    //kalo merupakan tahap teknis atau tulis
                    if ($key2 + 1 == 1 && isset($value->hasil_tugas)) {
                        echo "<a href=" . Yii::app()->request->baseUrl . "/hasil_tugas/" . $value->hasil_tugas . ">Hasil</a> ||   " . $form->checkBox($modelsL[$key], '[' . $key . ']id_lowongan_tahap', array('value' => $id_lt, 'name'=>'Lamaran['.$key.'][id_lowongan_tahap][]'));
                    } elseif ($key2 + 1 == 2 && isset($value->hasil_tugas2)) {
                        echo "<a href=" . Yii::app()->request->baseUrl . "/hasil_tugas/" . $value->hasil_tugas2 . ">Hasil</a> ||" . $form->checkBox($modelsL[$key], '[' . $key . ']id_lowongan_tahap', array('value' => $id_lt, 'name'=>'Lamaran['.$key.'][id_lowongan_tahap][]'));
                    } else {
                        echo  $form->checkBox($modelsL[$key], '[' . $key . ']id_lowongan_tahap', array('value' => $id_lt, 'name'=>'Lamaran['.$key.'][id_lowongan_tahap][]'));
                    }
                    echo "</td>";
                    $count++;
                } else {
                    echo "<td><input type='checkbox' disabled='disabled'></td>";
                }
            }
            echo '</tr>';
        }
        ?>
        <tr> 
        </tr> 

    </tbody> 
</table> 
    <?php echo CHtml::submitButton('Simpan', array( 'class'=>'btn btn-primary btn-sm' )); ?>

<?php $this->endWidget(); ?>

<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.js"></script> 
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/tablesorter.js"></script>
<script type="text/javascript">
    $(document).ready(function()
    {
        $("#myTable").tablesorter();
    }
    );
</script>