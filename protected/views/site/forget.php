

<h1 style="text-align:center">Forget Password</h1>

<div class="register">
	<div class="register-form">


		<?php $form=$this->beginWidget('CActiveForm', array(
			'id'=>'user-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
			'enableAjaxValidation'=>false,
			)); ?>

			<p class="note">Fields with <span class="required">*</span> are required.</p>

			<?php echo $form->errorSummary($model); ?>

			<div class="row">
				<div class="col-sm-2">
					<?php echo $form->emailField($model,'username',array('class'=>'form-control','placeholder'=>'your email*','size'=>30,'maxlength'=>30)); ?>
					<?php echo $form->error($model,'username'); ?>
				</div>	
			</div>

			
			<div class="row"> 
				<?php if (extension_loaded('gd')): ?> 
					<div class="row"> 
						<?php echo CHtml::activeLabelEx($model, 'verifyCode') ?> 
						<div> 
							<?php $this->widget('CCaptcha'); ?>
						</div> 
					</div> 
					<div class="col-sm-2"> 
						<?php echo CHtml::activeTextField($model,'verifyCode',array('class'=>'form-control','placeholder'=>'verify code*')); ?>
					<div class="hint">Ketik tulisan yang ada pada gambar. 
						<br/>Tulisan tidak case sensitive</div>
						</div> 
					<?php endif; ?> 
				</div> 
				</div></br></br>
				<div class="row button">
					<p class="login button">
						<?php echo CHtml::submitButton('Kirim',array( 'class'=>'btn btn-primary btn-sm' )); ?>
					</p>
				</div>

				<?php $this->endWidget(); ?>
			</div>
		</div>