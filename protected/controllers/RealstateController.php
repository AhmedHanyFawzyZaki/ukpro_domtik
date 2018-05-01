<?php

class RealstateController extends FrontController {
    
    public $layout = '//layouts/main';
public function actionIndex()
{
        $slider = CategorySlider::model()->find(array('condition' => 'category_id = 10'));

$products=Product::model()->findAll(array('condition'=>'show_in_website_category=1 and category_id=10  AND  product_status_id !=2'));
$countries=Country::model()->findAll();
        $cities=City::model()->findAll();
//$this->render('index',array('products'=>$products,'countries'=>$countries,'cities'=>$cities,'slider'=>$slider));
        $ads = Ads::model()->findAll("category_id =10");

$this->render('index',array('products'=>$products,'countries'=>$countries,'cities'=>$cities ,"ads"=>$ads));


}
public function actionItem($id)
{           $review = new Review;
            $message = new Message;

    
            $product = Product::model()->findByPk($id);
            $proddet=ProductDetails::model()->findByAttributes(array('product_id'=>$product->id));
            $photos = GalleryPhoto::model()->findAllByAttributes(array('gallery_id' => $product->gallery_id));
            $revs = Review::model()->findAllByAttributes(array('product_id' => $product->id));
            $arrivls=Product::model()->findAll(array('condition'=>'category_id=10' ));
            if(!empty($product->product_category_id))
            $arrivls=Product::model()->findAll(array('condition'=>'category_id=10 and product_category_id='.$product->product_category_id));
            //print_r($arrivls);die;
            $count=count($arrivls);

                  if (isset($_POST['Review'])) {

            $userid = Yii::app()->user->id;
            if ($userid != '') {
                $review->attributes = $_POST['Review'];
                $review->user_id = Yii::app()->user->id;
                $review->product_id = $product->id;
                $review->comment_date = date('Y-m-d');
                if ($review->save()) {
                    Yii::app()->user->setFlash('update-success', 'Your Review has neen added sucessfuly.');
                } else {

                    Yii::app()->user->setFlash('update-error', 'Please Add your review');
                }
            } else {
                $this->redirect(array('home/confirm/flag/3'));
            }
        }
      if (isset($_POST['Message'])) {
            $userid = Yii::app()->user->id;
            if ($userid != '') {
                //print_r($_POST['Review']);die;

                $message->attributes = $_POST['Message'];
                $message->title = 'Purchase product '.$product->title;
                $message->reciever_id = $product->user_id;
                $message->sender_id = $userid;
                //$message->message_date = date('Y-m-d');
                $message->product_id=$id;

                if ($message->save()) {
                    Yii::app()->user->setFlash('add-success', 'Your Order has been sent sucessfuly to the owner.');
                } else {
                    Yii::app()->user->setFlash('add-error', 'Please write your order details');
                }
            } else {
                $this->redirect(array('home/confirm/flag/3'));
            }
        }
            
            

 $proddetails=ProductDetails::model()->findByAttributes(array('product_id'=>$id));

$this->render('item',array('product'=>$product,'photos'=>$photos,'revs'=>$revs,'review'=>$review,'proddet'=>$proddet,'arrivls'=>$arrivls,'count'=>$count,'message'=>$message,'proddetails'=>$proddetails));	
}

public function actionSearch()
{   
    
    $id=$_REQUEST['id'];
    $tit=$_REQUEST['title'];

    $condition="category_id=10  AND  product_status_id !=2";
    $cou=$_POST['Search']['country'];
    $cit=$_POST['Search']['city'];
    $rnt=$_POST['Search']['rent'];

    if(!empty($_POST['title']))
    {
        
        $title=$_POST['title'];
        
        $condition.=' and  title Like '.'"%'.$title.'%"';
        
       // echo $condition;die;
    }
    if(!empty($_POST['country']))
    {
        
        
        $condition.= ' and id IN (select product_id from product_details where country_id=' . $_POST['country'] . ')';
        
       // echo $condition;die;
    }
     if(!empty($_POST['city']))
    {
        
        
        $condition.= ' and id IN (select product_id from product_details where city_id=' . $_POST['city'] . ')';
        
       // echo $condition;die;
    }
    if(!empty($_POST['postcode']))
    {
        
        
        $condition.= ' and id IN (select product_id from product_details where post_code Like '.'"%'.$_POST['postcode'].'%"'. ')';
        
       // echo $condition;die;
    }
    if($_REQUEST['id']){
        if($_REQUEST['id']==1)
        
         $condition.= ' and id IN (select product_id from product_details where real_estate_type=0)';

    if($_REQUEST['id']==2)
         $condition.= ' and id IN (select product_id from product_details where real_estate_type=1)';

    }
    if(!empty($_POST['Search'])){
        
               $country_id=$_POST['Search']['country'];
               $city_id=$_POST['Search']['city'];
               $titles=$_POST['Search']['titles'];
               $minprice=$_POST['Search']['minprice'];
               $maxprice=$_POST['Search']['maxprice'];
               $rentOrsale=$_POST['Search']['rent'];
               
        //echo $titles."          islam";die;

    }
    $order="";
    if($_REQUEST['sort'])
    {
        if($_REQUEST['sort']=="title asc"){
            $condition.=' and  title Like '.'"%'.$title.'%"';
             $order="title asc";
        }elseif($_REQUEST['sort']=="title desc"){
            $condition.=' and  title Like '.'"%'.$title.'%"';
             $order="title desc";
        }elseif($_REQUEST['sort']=="id asc"){
            $order="id asc";
        }elseif($_REQUEST['sort']=="id desc"){
             $order="id desc";
        }
        
        
    }
    
    if ($country_id) {
            $condition.= ' and id IN (select product_id from product_details where country_id=' . $country_id . ')';
        }
        if ($city_id) {
            $condition.= ' and id IN (select product_id from product_details where city_id=' . $city_id . ')';
        }
        if ($titles) {
            $condition.=' and  title Like ' .'"%'.$titles.'%"';
        }
        if ($minprice) {
            $condition.=' and  price >=' . $minprice;
            
        }
        if ($maxprice) {
            $condition.=' and  price <=' . $maxprice;
            
        }
        if ($rentOrsale) {
            $condition.= ' and id IN (select product_id from product_details where real_estate_type='.$rentOrsale.')';
        }
//        if ($sale) {
//            $condition.= ' and id IN (select product_id from product_details where real_estate_type=1)';
//        }
       
        /*
        //$products=Product::model()->findAll(array('condition'=>$condition));
       $criteria=new CDbCriteria();
     $criteria->condition=$condition ;
      $criteria->order=$order ;
    
    $products=Product::model()->findAll($criteria);
            
         if(!$products){
             Yii::app()->user->setFlash('add-error', 'No Results matches your Search');
        }
        */
        
   //////////////////pagination/////////////////////////
        
      $criteria=new CDbCriteria();
     $criteria->condition=$condition ;
      $criteria->order=$order ;
    
    $count=Product::model()->count($criteria);
    $pages=new CPagination($count);

    // results per page
    $pages->pageSize=6;
    $pages->applyLimit($criteria);
    $products=Product::model()->findAll($criteria);
   $counts=count($products);
    /////////////////////////////////////////////////////////////////// 
        
          if(!$products){
             Yii::app()->user->setFlash('add-error', 'No Results matches your Search');
        }
        

       // print_r($products);die;
        $countries=Country::model()->findAll();
        $cities=City::model()->findAll();
        $titles=Product::model()->findAll(array('condition'=>'category_id=10'));
        
        $criteria = new CDbCriteria;
        $criteria->condition = 'category_id=:CatID';
        $criteria->params = array(':CatID' => 10);
        $criteria->order='price DESC';
        $maxprices = Product::model()->findAll($criteria);
        
        $criteria = new CDbCriteria;
        $criteria->condition = 'category_id=:CatID';
        $criteria->params = array(':CatID' => 10);
        $criteria->order='price ASC';
        $minprices = Product::model()->findAll($criteria);
        
      $this->render('search',array('products'=>$products,'countries'=>$countries,'cities'=>$cities,'titles'=>$titles,'maxprices'=>$maxprices,'minprices'=>$minprices,'count'=>$count,'pages'=>$pages,'counts'=>$counts,'cou'=>$cou,'cit'=>$cit,'tit'=>$tit,'rnt'=>$rnt));
}

public function actionCategory()
{
    
    $subcat_id=$_REQUEST['subcat_id'];
    $cat_id=$_REQUEST['cat_id'];
    $condition='category_id=10   AND  product_status_id !=2';
   

    if($cat_id){
        $condition .= ' and product_category_id='.$cat_id;
    }
    if($subcat_id){
        $condition .=' and product_category_id in (select product_category_id from sub_category where id='.$subcat_id.')';
    }
    
        $products = Product::model()->findAll(array('condition'=>$condition));
        if(!$products){
             Yii::app()->user->setFlash('add-error', 'No Matches');
        }

      $this->render('category',array('products'=>$products));
}
 public function actionGetcity() {
       // echo"test";die;
        $id = $_REQUEST['id'];
        $cities = City::model()->findAllByAttributes(array('country_id' => $id));
        $selest = '<select class="form-control" name="Search[city]">';
        foreach ($cities as $citie) {
            $selest.='<option value=' . $citie->id . '>' . $citie->title . '</option>';
        }
        $selest.='</select>';
        echo $selest;
    }
}
