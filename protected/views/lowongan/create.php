
<?php
    foreach(Yii::app()->user->getFlashes() as $key => $message) {
        echo '<div class="alert alert-info flash-' . $key . '">' . $message . "</div>\n";
    }
?>
<h1>Create Lowongan </h1>

<?php $this->renderPartial('_form', array('model'=>$model, 'tahaps'=>$tahaps)); ?>