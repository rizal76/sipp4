
<?php echo CHtml::form();
?>
<?php echo CHtml::activeEmailField($user,'username',array('size'=>60,'maxlength'=>255,'encode'=>false,'value'=>'','placeholder'=>'username')) ?>
<?php echo CHtml::error($user,'username', array('class'=>'alert-danger')); ?>



<?php echo CHtml::activePasswordField($user,'password',array('size'=>60,'maxlength'=>255,'encode'=>false,'value'=>'','placeholder'=>'password')) ?>
<?php echo CHtml::error($user,'password', array('class'=>'alert-danger')); ?>

<p class="login button"> 
	<input type="submit" value="Login" />
</p>

<p class="tek-login"> Forget account ? click 
<?php 
echo CHtml::link('forget',array('user/forget'));
?>

</form>
