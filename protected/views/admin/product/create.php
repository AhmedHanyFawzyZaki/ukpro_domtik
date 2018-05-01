<?php
$this->breadcrumbs=array(
	'Products'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Product','url'=>array('index')),
);
?>

<?php $this->pageTitlecrumbs = 'Create Product';?>
<?php  //echo $id;die;

 if($id==1) {
     
  echo $this->renderPartial('_clothsform', array('model'=>$model,'color'=>$color,'size'=>$size,'gallery' => $gallery,'id'=>$id,'model_col'=>$model_col,'model_siz'=>$model_siz,'productdetails'=>$productdetails          
));
 
  
 }elseif($id==2)
 {
     echo $this->renderPartial('_travelform', array('model'=>$model,'productdetails'=>$productdetails,'id'=>$id));

 }
 elseif ($id==3) {
       echo $this->renderPartial('_cosmeticsform', array('model'=>$model,'productdetails'=>$productdetails,'size'=>$size,'id'=>$id,'sizees'=>$sizees,
));

 }elseif($id==4)
 {
     echo $this->renderPartial('_jeweleryform', array('model'=>$model,'productdetails'=>$productdetails,'size'=>$size,'id'=>$id,'model_siz'=>$model_siz));

 }
 elseif ($id==5) {
       echo $this->renderPartial('_motorform', array('model'=>$model,'productdetails'=>$productdetails,'color'=>$color,'id'=>$id,'model_col'=>$model_col,
));

 }elseif($id==6)
 {
     echo $this->renderPartial('_decorTypeform', array('model'=>$model,'productdetails'=>$productdetails,'id'=>$id,'color'=>$color,'model_col'=>$model_col ,'size'=>$size,'model_siz'=>$model_siz));

 }elseif($id==7)
 {
     echo $this->renderPartial('_electronicform', array('model'=>$model,'productdetails'=>$productdetails,'id'=>$id,'model_col'=>$model_col));

 }elseif($id==8)
 {
     echo $this->renderPartial('_kidsform', array('model'=>$model,'productdetails'=>$productdetails,'id'=>$id,'sizes'=>$sizes,'model_siz'=>$model_siz,'model_col'=>$model_col));

 }elseif($id==9)
 {
     echo $this->renderPartial('_lifeStyleform', array('model'=>$model,'productdetails'=>$productdetails,'id'=>$id));

 }elseif($id==10)
 {
     echo $this->renderPartial('_realStateform', array('model'=>$model,'productdetails'=>$productdetails,'id'=>$id));

 }
 else{
 echo $this->renderPartial('_form', array('model'=>$model));
}
?>