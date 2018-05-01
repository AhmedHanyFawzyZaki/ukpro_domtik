<?php
$this->breadcrumbs=array(
	'Users'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List User','url'=>array('index')),
	array('label'=>'Create User','url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('user-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<?php $this->pageTitlecrumbs = 'Manage Users';?> 

<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'user-grid',
	//'type'=>'striped  condensed',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
     
	'columns'=>array(

		'username',
		'email',
		'fname',
		'lname',
            
array(
					 'name'=> 'image',
					'type'=> 'raw',
				'value'=> 'CHtml::Image(Yii::app()->baseUrl."/media/members/".$data->image,"", array("width" => 130))'
				),
            
            
 'fee_package_id' => array(
                'name' => 'fee_package_id',
                'value' => '$data->feepackage->title',
                'filter' => FeePackage::model()->getFeepackage(),
            ),


//            
//array(
//					 'name'=> 'shop_image',
//					 'type'=> 'raw',
//				         'value'=> 'CHtml::Image(Yii::app()->baseUrl."/media/members/".$data->shop_image,"", array("width" => 130))'
//				),
//
//


		'groups_id'=>array(// display 'author.username' using an expression
                        'name'=>'groups_id',
                       'value'=>'$data->usergroup->group_title',
                        'filter'=> Groups::model()->getgroups(),
                    ),
          'instgram_access',
            


 'instgram_access'=>array(
            'name' => 'instgram_access',
            'value'=>'($data->instgram_access==1)?"Allowed":"Not Allowed"',
                ),

		/*
		'details',
		'group',
		'active',
		'user_details_id',
		*/
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
		),
	),
)); ?>
