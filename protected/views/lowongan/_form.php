<?php
/* @var $this LowonganController */
/* @var $model Lowongan */
/* @var $form CActiveForm */
?>

<div class="form">

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

    <p class="note">Fields with <span class="required">*</span> are required.</p>

        <?php echo $form->errorSummary($model); ?>

    <div class="row">
        <?php echo $form->labelEx($model, 'nama'); ?>
<?php echo $form->textField($model, 'nama', array('size' => 30, 'maxlength' => 30)); ?>
<?php echo $form->error($model, 'nama'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'deskripsi'); ?>
<?php echo $form->textField($model, 'deskripsi', array('size' => 60, 'maxlength' => 400)); ?>
<?php echo $form->error($model, 'deskripsi'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'persyaratan'); ?>
<?php echo $form->textField($model, 'persyaratan', array('size' => 60, 'maxlength' => 100)); ?>
<?php echo $form->error($model, 'persyaratan'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'departemen'); ?>
        <?php
        if (Yii::app()->user->isSuperAdmin()) {
            echo $form->dropDownList($model, 'departemen', array(
                'SIS' => 'SIS',
                'COM' => 'COM',
                'PMO' => 'PMO',
                'PRD' => 'PRD',
                'IMP' => 'IMP',
                'KOU' => 'KOU'));
        } else {
            //cari departemen
            $id = Yii::app()->user->id;
            $modelAdmin = Admin::model()->findByAttributes(array('id_user' => $id));
            echo $form->hiddenField($model, 'departemen', array('value' => $modelAdmin->departemen));
        }
        ?>
        <?php echo $form->error($model, 'departemen'); ?>
    </div>
    <div class="row">
        <?php echo $form->labelEx($model, 'new'); ?>
        <?php
        echo $form->dropDownList($model, 'new', array(
            '1' => 'Yes',
            '0' => 'No'));
        ?>
<?php echo $form->error($model, 'new'); ?>
    </div>
    <!-- Nampilin check box tahapan -->
    <?php if ($this->action->Id == 'create') { ?>
            <?php foreach ($tahaps as $i => $item): ?>
            <div class="row">
                <?php echo $form->labelEx($item, $item->nama); ?>
                <?php echo $form->checkBox($item, '[' . $i . ']nama', array('value' => 1, 'uncheckValue' => 0)); ?>
        <?php echo $form->error($item, '[' . $i . ']nama'); ?>
            </div>
            <div class="row">
                <?php echo $form->hiddenField($item, '[' . $i . ']id', array('value' => $item->id)); ?>
            <?php echo $form->error($item, '[' . $i . ']id'); ?>
            </div>
        <?php
        endforeach;
    }
    ?>
    <div class="row buttons">
    <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
    </div>

<?php $this->endWidget(); ?>

</div><!-- form -->