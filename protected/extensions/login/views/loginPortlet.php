
<?php echo CHtml::form(); ?>
<?php echo CHtml::activeEmailField($user, 'username', array('size' => 60, 'maxlength' => 255, 'encode' => false, 'value' => '', 'placeholder' => 'username')) ?>
<?php
echo CHtml::error($user, 'username');
if ($user->getError('username') != null) {
    $teksErrors = explode(" ", $user->getError('username'));
    $teksError = "";
    foreach ($teksErrors as $value) {
        $teksError = $teksError . " " . $value;
    }
    ?>
    <script>alert('<?php echo $teksError; ?>');</script>
<?php } ?>


<?php echo CHtml::activePasswordField($user, 'password', array('size' => 60, 'maxlength' => 255, 'encode' => false, 'value' => '', 'placeholder' => 'password')) ?>
<?php
echo CHtml::error($user,'password'); 
if ($user->getError('password') != null) {
    $teksErrors = explode(" ", $user->getError('password'));
    $teksError = "";
    foreach ($teksErrors as $value) {
        $teksError = $teksError . " " . $value;
    }
    ?>
    <script>alert('<?php echo $teksError; ?>');</script>
<?php } ?>

<p class="login button"> 
    <input type="submit" value="Login" />
</p>

<p class="tek-login"> Forget account ? click 
    <?php
    echo CHtml::link('forget', array('user/forget'));
    ?>

</form>
