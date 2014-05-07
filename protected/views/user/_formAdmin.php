<?php
/* @var $this UserController */
/* @var $model User */
/* @var $form CActiveForm */
?>


<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'user-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model, $admin); ?>


	<div class="row">
		<div class="col-sm-2">
		<?php echo $form->textField($model,'username',array('placeholder'=>'masukan username', 'id'=>'nama', 'size'=>30,'maxlength'=>30, 'class'=>'form-control')); ?>
		<?php echo $form->error($model,'username'); ?>
		</div>
	</div>

	<div class="row">
		<div class="col-sm-2">
		<?php echo $form->passwordField($model,'password',array('placeholder'=>'masukan password','id'=>'password', 'size'=>30,'maxlength'=>128, 'class'=>'form-control')); ?>
		<?php echo $form->error($model,'password'); ?>
		</div>
	</div>
	<div class="row">
		<div class="col-sm-2">
                    
			<?php
                        echo $form->dropDownList($admin,'departemen', array(
				'SIS'=>'SIS', 
				'COM'=>'COM',
				'PMO'=>'PMO',
				'PRD'=>'PRD',
				'IMP'=>'IMP',
				'KOU'=>'KOU'

				), array('class'=>'form-control')); 
			?>
			<?php echo $form->error($admin,'departemen'); ?>
		</div>
	</div>

     <?php if (extension_loaded('gd')): ?> 
        <div class="row"> 
            <?php echo CHtml::activeLabelEx($model, 'verifyCode') ?> 
            <div> 
                <?php $this->widget('CCaptcha'); ?><br/> 
                
            </div> 
        </div> 
        <div class="col-sm-2">
        <?php echo CHtml::activeTextField($model,'verifyCode', array('class'=>'form-control', 'placeholder'=>'type verifyCode here')); ?> 
    	</div>
    <?php endif; ?> 


    <br>
	<div class="row buttons">
		<p class="login button">
		<?php echo CHtml::submitButton( $model->isNewRecord ? 'Create' : 'Save',  array(
        'value'=>'Daftar', 'class'=>'btn btn-primary btn-sm' )); ?>
		</p>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->