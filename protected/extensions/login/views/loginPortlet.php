
<?php echo CHtml::form(); ?>
<?php echo CHtml::activeEmailField($user,'username',array('size'=>60,'maxlength'=>255,'encode'=>false,'value'=>'','placeholder'=>'username')) ?>
<?php echo CHtml::error($user,'username'); ?>



<?php echo CHtml::activePasswordField($user,'password',array('size'=>60,'maxlength'=>255,'encode'=>false,'value'=>'','placeholder'=>'password')) ?>
<?php echo CHtml::error($user,'password'); ?>

<p class="login button"> 
	<input type="submit" value="Login" />
</p>

<p class="tek-login"> if you dont have account, please register 
<?php 
echo CHtml::link('register',array('user/create'));
?> or you forget account click 
<?php 
echo CHtml::link('forget',array('user/forget'));
?>

</form>
