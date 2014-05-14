
<h1>Seleksi Administrasi</h1>
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
            <th>Telp.</th> 
            <th>Pendidikan</th> 
            <th>Skill</th> 
            <th>Kota</th> 
            <th>CV</th> 
            <th>Expected Salary</th>
            <th>Lowongan</th>
            <th>Departemen</th>
            <th>Lolos Administrasi</th>
        </tr> 
    </thead> 
    <tbody> 
        <?php
        
        foreach ($modelsL as $key => $value) {

            echo "<tr><td>" . $value->pelamar->nama . "</td>";
            echo "<td>" . $value->pelamar->tlp . "</td>";
            echo "<td>" . $value->pelamar->pendidikan . "</td>";
            echo "<td>" . $value->pelamar->skill . "</td>";
            echo "<td>" . $value->pelamar->kota . "</td>";
            echo "<td><a href=" . Yii::app()->request->baseUrl . "/cv/" . $value->pelamar->cv . ">Download</a></td>";
            echo "<td>" . $value->pelamar->cover_letter . "</td>";
            echo "<td>" . $value->lowongan->nama . "</td>";
            echo "<td>" . $value->lowongan->departemen . "</td>";
            $id_lt = $value->lowongan->lowongantahaps[0]->id;
            echo "<td>"  . $form->checkBox($modelsL[$key], '['.$key.']id_lowongan_tahap', array('value' => $id_lt )) . "</td></tr>";
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