<?php
/* @var $this UserController */
/* @var $model User */

$this->breadcrumbs = array(
    'Users' => array('index'),
    'Manage',
);

$this->menu = array(
    array('label' => 'List User', 'url' => array('index')),
    array('label' => 'Create User', 'url' => array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#user-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Admin</h1>

<p>
    You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
    or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>
<?php echo CHtml::link('Advanced Search', '#', array('class' => 'search-button')); ?>
<div class="search-form" style="display:none">
    <?php
    $this->renderPartial('_search', array(
        'model' => $model,
    ));
    ?>
</div><!-- search-form -->
<hr>
<?php echo CHtml::link('Create Admin',array('user/createAdmin'), array('class'=>'btn btn-primary btn-sm')); ?>


<?php
$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'user-grid',
    'dataProvider' => $model->search(),
    'filter' => $model,
    'columns' => array(
        'id',
        'username',
        'password',
        array(
            'type' => 'raw', // this is for your related group members of the current group
            'name' => 'admin.departemen', // this will access the attributeLabel from the member model class, and assign it to your column header
            'value' => '$data->admin->departemen', // this will access the current group's 1st member and give out the firstname of that member
        // this tells that the value type is raw and no formatting is to be applied to it
        ),
        array(
            'class' => 'CButtonColumn',
            'template' => '{view2}{update2}{delete}',
            'buttons' => array
                (
                'update2' => array
                    (
                    'imageUrl' => Yii::app()->request->baseUrl . '/images/update.png',
                    'url' => 'Yii::app()->createUrl("user/updateAdmin", array("id"=>$data->id))',
                ),
                'view2' => array
                    (
                    'imageUrl' => Yii::app()->request->baseUrl . '/images/view.png',
                    'url' => 'Yii::app()->createUrl("user/viewAdmin", array("id"=>$data->id))',
                ),
            ),
        ),
    ),
));
?>
