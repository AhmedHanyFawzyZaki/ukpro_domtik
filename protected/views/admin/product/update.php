<?php
$this->breadcrumbs=array(
	'Products'=>array('index'),
	$model->title=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Product','url'=>array('index')),
	array('label'=>'View Product','url'=>array('view','id'=>$model->id)),
);
?>

<?php $this->pageTitlecrumbs = 'Update '. $model->title; ?>
<?php // echo $cat_id;die;

 if($cat_id==1) {
  echo $this->renderPartial('_clothsform', array('model'=>$model,'colors'=>$colors,'sizes'=>$sizes,'gallery' => $gallery,'id'=>$cat_id,'productdetails'=>$productdetails,'model_col'=>$model_col,'model_siz'=>$model_siz,  
));
 }elseif($cat_id==2) {
     
  echo $this->renderPartial('_travelform', array('model'=>$model,'productdetails'=>$productdetails,'gallery' => $gallery,'rooms'=>$rooms,'id'=>$cat_id


          ));
 }
 elseif($cat_id==3)
 {
       echo $this->renderPartial('_cosmeticsform', array('model'=>$model,'sizes'=>$sizes,'gallery' => $gallery,'productdetails' => $productdetails,'id'=>$cat_id
));

 }elseif($cat_id==4)
 {
     echo $this->renderPartial('_jeweleryform', array('model'=>$model,'colors'=>$colors,'sizes'=>$sizes,'productdetails'=>$productdetails,'gallery' => $gallery,'id'=>$cat_id,'model_siz'=>$model_siz
));
 }
 elseif($cat_id==5)
 {
       echo $this->renderPartial('_motorform', array('model'=>$model,'productdetails'=>$productdetails,'colors'=>$colors,'gallery' => $gallery,'id'=>$cat_id,'model_col'=>$model_col,
));

 }elseif($cat_id==6)
 {
       echo $this->renderPartial('_decorTypeform', array('model'=>$model,'productdetails'=>$productdetails,'color'=>$color,'gallery' => $gallery,'id'=>$cat_id,'sizes'=>$sizes,'model_col'=>$model_col,'model_siz'=>$model_siz,
));

 }elseif($cat_id==7)
 {
       echo $this->renderPartial('_electronicform', array('model'=>$model,'productdetails'=>$productdetails,'gallery' => $gallery,'id'=>$cat_id,'model_col'=>$model_col
));

 }elseif($cat_id==8)
 {
       echo $this->renderPartial('_kidsform', array('model'=>$model,'colors'=>$colors,'productdetails'=>$productdetails,'gallery' => $gallery,'id'=>$cat_id,'sizes'=>$sizes,'model_siz'=>$model_siz,'model_col'=>$model_col,
));

 }elseif($cat_id==9)
 {
       echo $this->renderPartial('_lifeStyleform', array('model'=>$model,'productdetails'=>$productdetails,'gallery' => $gallery,'id'=>$cat_id
));

 }elseif($cat_id==10)
 {
       echo $this->renderPartial('_realStateform', array('model'=>$model,'productdetails'=>$productdetails,'gallery' => $gallery,'id'=>$cat_id
));

 }
 else{
 echo $this->renderPartial('_form', array('model'=>$model));
}
?>
