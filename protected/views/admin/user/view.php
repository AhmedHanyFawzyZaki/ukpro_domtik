<?php
$this->breadcrumbs=array(
	'Users'=>array('index'),
	$model->username.' Profile',
);

$this->menu=array(
	array('label'=>'List User','url'=>array('index')),
	array('label'=>'Create User','url'=>array('create')),
	array('label'=>'Update User','url'=>array('update','id'=>$model->id)),
	array('label'=>'Delete User','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
);
?>
<?php 

        $criteria = new CDbCriteria;
        $criteria->condition = 'user_id=' . $model->id;
        $user_details = UserDetails::model()->find($criteria);
?>
<?php $this->pageTitlecrumbs = 'View User "'. $model->username.' "'; ?>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(

		array(
			'name'=>'groups_id',
			'type'=>'raw',
			 'value'=>$model->usergroup->group_title
				),


		'username',

		'email',

		'fname',
		'lname',




//		array(
//		'name'=>'image',
//		'type'=>'raw',
//		'value'=>CHtml::image(Yii::app()->request->baseUrl.'/media/members/'.$model->image,$model->username,array('width'=>250)),
//		),
//


array(
                        'name' => 'image',
                        'type' => 'raw',
                       'value' => CHtml::image(Yii::app()->request->baseUrl.'/media/members/'.$model->image),
                    ),

 array(
                'name' => 'fee_package_id',
                'value' => $model->feepackage->title,
                'type' => 'raw',
            ),


array(
                        'name' => 'shop_image',
                        'type' => 'raw',
                       'value' => CHtml::image(Yii::app()->request->baseUrl.'/media/members/'.$user_details->shop_image),
                    ),




		'details',
            array(
            'name' => 'instgram_access',
            'value'=>($model->instgram_access==1)?  "Allowed":"Not allowed",
                ),


	),
)); ?>
