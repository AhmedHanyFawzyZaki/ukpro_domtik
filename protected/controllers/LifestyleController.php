<?php

class LifestyleController extends FrontController {
   public $layout = '//layouts/main';
    public function actionIndex() {
      //  $slides = CategorySlider::model()->findAll(array('condition'=>'category_id=4','order'=>'id desc'));
        $featured_products = Product::model()->findAll(array('condition'=>'category_id=9 and category_featured=1  AND  product_status_id !=2','limit'=>'3','order'=>'rand()'));  //recommended
        $products = Product::model()->findAll(array('condition'=>'category_id=9 and show_in_home_page=1 AND  product_status_id !=2','order'=>'id desc','limit'=>6)); //latest products 
        $newarrivalsproducts = Product::model()->findAll(array('condition'=>'category_id=9 and show_in_website_category=1  AND  product_status_id !=2','order'=>'id desc')); //arrivals
        $slider = CategorySlider::model()->find(array('condition' => 'category_id = 10'));
       // $this->render('index', array('products' => $products, 'featured_products'=>$featured_products,'arrivals'=>$newarrivalsproducts,'slider'=>$slider));
        $ads = Ads::model()->findAll("category_id =9 and main_ad != 1");
        $this->render('index', array('products' => $products,'featured_products'=>$featured_products,'arrivals'=>$newarrivalsproducts,'slider'=>$slider ,"ads"=>$ads));
    }
    
    
    

    public function actionSubCategory() {
        $cond='category_id=9  AND  product_status_id !=2';
        if(isset($_REQUEST['cat_id'])) //must find the product main category in order to set the left filters
        {
            $cond.= ' and product_category_id='.$_REQUEST['cat_id'];
        }
        
        elseif(isset($_REQUEST['subcat_id']) && !isset($_REQUEST['cat_id']))  // find only by subcat
        {
            $cond.= ' and product_category_id='. SubCategory::model()->findByPk($_REQUEST['subcat_id'])->product_category_id;
        }
        
         if (isset($_REQUEST['shop'])) {
            $cond.=' and user_id=' . $_REQUEST['shop'];
        }
        
        
        
        
        $ids=array();
        $cond_det='1=1'; // true in sql
        if(isset($_REQUEST['subcat_id']))
        {
            $cond_det.=' and sub_category_id='.$_REQUEST['subcat_id'];
        }
        
           if (isset($_REQUEST['brand'])) {
            $cond_det.=' and brand_id=' . $_REQUEST['brand'];
        }
        
        if($cond_det!='1=1')
        {
            $pro_dets=  ProductDetails::model()->findAll(array('condition'=>$cond_det));
            if($pro_dets)
            {
                foreach($pro_dets as $pd)
                {
                    if($pd->product->category_id==9)
                    {
                        $ids[]=$pd->product_id; 
                       // product with  subcat_id and with  category_id==9
                    }
                }
            }
        }
        
        
      
        
        
        if($cond_det!='1=1' && empty($ids)) //there is a filteration by either the brand or the subcat and no result
        {
            $cond.=' and 1=2';
        }

        if(isset($_REQUEST['price']))
        {
            $arr= explode('_', $_REQUEST['price']);
            $min=$arr[0];
            $max=$arr[1];
            $pros=Product::model()->findAll(array('condition'=>'price between '.$min.' and '.$max));
            
            $cond.=' and price between '.$min.' and '.$max ;
            
            if($pros)
            {
                foreach ($pros as $pr)
                {
                    if($pr->category_id==9)
                    {
                        $ids[]=$pr->id;
                        $ids2[]=$pr->id;  // array according to price condition
                    }
                }
            }
            
       
            
        }
        if($ids)
        {
            $cond.= ' and id in ('.implode(",", $ids).')';
        }
        
       
          //  echo $cond ; 
          //  die;
        
        $order="title asc";
        if(isset($_REQUEST['sort']))
        {
            $order=$_REQUEST['sort'];
        }
        
        $products=Product::model()->findAll(array('condition'=>$cond,'order'=>$order));
        
         
    $criteria=new CDbCriteria();
     $criteria->condition=$cond ;
    $criteria->order=$order ;
    $count=Product::model()->count($criteria);
    $pages=new CPagination($count);

    // results per page
    $pages->pageSize=20;
    $pages->applyLimit($criteria);
    $pag_products=Product::model()->findAll($criteria);
    
    
    
$brands = Brand::model()->findAll("category_id = 9");
          $users  = User::model()->findAll('groups_id = 1 or groups_id = 4');

          
        $this->render('sub-category',array('products'=>$products,'count'=>$count,'pages'=>$pages,'pag_products' => $pag_products,"users"=>$users ,"brands"=>$brands));
        
        
     

 
        
    }
    
    
    
      
          


  

    
    public function actionItem(){
        $review = new Review;
        $message = new Message;
        $id=$_REQUEST['id'];
        $product = Product::model()->findByPk($id);
        
$proddetails=ProductDetails::model()->findByAttributes(array('product_id'=>$product->id));

        $sizes = Size::model()->findAllByAttributes(array('product_id' => $id));
        $photos = GalleryPhoto::model()->findAllByAttributes(array('gallery_id' => $product->gallery_id));
       
        
        if($product)
        $condition='category_id=9 and product_category_id='.$product->product_category_id.' and id!='.$id;
    else {
         throw new CHttpException(404,'The requested page does not exist.'); 
    }
        $newarrivalsproducts = Product::model()->findAll(array('condition'=>$condition,'order'=>'id desc'));
        
        
        
        // to save review
        if (isset($_POST['Review'])) {
            $userid = Yii::app()->user->id;
            if ($userid != '') {
                //print_r($_POST['Review']);die;

                $review->attributes = $_POST['Review'];
                $review->user_id = Yii::app()->user->id;
                $review->product_id = $product->id;
                $review->comment_date = date('Y-m-d');

                if ($review->save()) {
                    Yii::app()->user->setFlash('add-success', 'Your Review has been added sucessfuly.');
                } else {

                    Yii::app()->user->setFlash('add-error', 'Please Add your review');
                }
            } else {
                $this->redirect(array('home/confirm/flag/3'));
            }
        }
        
        
        
          // to save user orders in messages
        if (isset($_POST['Message'])) {
            $userid = Yii::app()->user->id;
            if ($userid != '') {
                //print_r($_POST['Review']);die;

                $message->attributes = $_POST['Message'];
                $message->title = 'Purchase product '.$product->title;
                $message->reciever_id = $product->user_id;
                $message->sender_id = $userid;
                $message->product_id = $product->id;
                //$message->message_date = date('Y-m-d');

                if ($message->save()) {
                    Yii::app()->user->setFlash('add-success', 'Your Order has been sent sucessfuly to the owner.');
                } else {

                    Yii::app()->user->setFlash('add-error', 'Please write your order details');
                }
            } else {
                $this->redirect(array('home/confirm/flag/3'));
            }
        }
        
        
        
        $reviews = Review::model()->findAllByAttributes(array('product_id' => $id));
        $this->render('item', array('product' => $product, 'sizes' => $sizes, 'reviews' => $reviews,'arrivals'=>$newarrivalsproducts, 'photos' => $photos, 'revs' => $revs, 'count' => $count, 'review' => $review,'message'=>$message ,'sub' => $sub,'proddetails'=>$proddetails)); 
    }
    
    
    
    
    public function actionaddReview(){
        $review = new Review;
        $review->comment = $_REQUEST['comment'];
        $review->rate = $_REQUEST['rate'];
        $review->product_id = $_REQUEST['product'];
        $review->user_id = Yii::app()->user->id;
        $review->comment_date = date('Y-m-d');
        if($review->save()){
            $this->redirect(array('item','id'=>$_REQUEST['product']));
        }
    }
    
    
    
    
    public function actionSearch() {
        
        $countries=Country::model()->findAll();
        $cities=City::model()->findAll();
        $cou=$_REQUEST['country'];
        $cit=$_REQUEST['city'];
          $cond='category_id=9   AND  product_status_id !=2';
        if(isset($_REQUEST['cat_id'])) //must find the product main category in order to set the left filters
        {
            $cond.= ' and product_category_id='.$_REQUEST['cat_id'];
        }
        
        elseif(isset($_REQUEST['subcat_id']) && !isset($_REQUEST['cat_id']))  // find only by subcat
        {
            $cond.= ' and product_category_id='. SubCategory::model()->findByPk($_REQUEST['subcat_id'])->product_category_id;
        }
        
        if(!empty($_POST['country']))
    {
        
        //echo "test";die;
        $cond.= ' and id IN (select product_id from product_details where country_id=' . $_POST['country'] . ')';
        
     //  echo $cond;die;
    }
     if(!empty($_POST['city']))
    {
        //echo "test";die;
        
        $cond.= ' and id IN (select product_id from product_details where city_id=' . $_POST['city'] . ')';
        
       // echo $cond;die;
    }
    if(!empty($_POST['postcode']))
    {
      //  echo "test";die;
        
        $cond.= ' and id IN (select product_id from product_details where post_code Like '.'"%'.$_POST['postcode'].'%"'. ')';
        
       // echo $cond;die;
    }
      
        $ids=array();
        $cond_det='1=1'; // true in sql
        if(isset($_REQUEST['subcat_id']))
        {
            $cond_det.=' and sub_category_id='.$_REQUEST['subcat_id'];
        }
        
        if($cond_det!='1=1')
        {
            $pro_dets=  ProductDetails::model()->findAll(array('condition'=>$cond_det));
            if($pro_dets)
            {
                foreach($pro_dets as $pd)
                {
                    if($pd->product->category_id==9)
                    {
                        $ids[]=$pd->product_id; 
                       // product with  subcat_id and with  category_id==9
                    }
                }
            }
        }
        
        
       
        
        
        if($cond_det!='1=1' && empty($ids)) //there is a filteration by either the brand or the subcat and no result
        {
            $cond.=' and 1=2';
        }

        if(isset($_REQUEST['price']))
        {
            $arr= explode('_', $_REQUEST['price']);
            $min=$arr[0];
            $max=$arr[1];
            $pros=Product::model()->findAll(array('condition'=>'price between '.$min.' and '.$max));
            
            $cond.=' and price between '.$min.' and '.$max ;
           
            if($pros)
            {
                foreach ($pros as $pr)
                {
                    if($pr->category_id==9)
                    {
                        $ids[]=$pr->id;
                        $ids2[]=$pr->id;  // array according to price condition
                    }
                }
            }
            
            
            
        }
        if($ids)
        {
            $cond.= ' and id in ('.implode(",", $ids).')';
        }
        
       
          //  echo $cond ; 
          //  die;
        
        $order="id desc";
        if(isset($_REQUEST['sort']))
        {
            $order=$_REQUEST['sort'];
        }
        
      
        
        
         if ($_REQUEST['search'] != '') {
            $keyword = urldecode($_REQUEST['search']);
            $cond.= " AND (LOWER(`t`.`title`) LIKE '%" . strtolower($keyword) . "%' OR LOWER(`t`.`description`) LIKE '%" . strtolower($keyword) . "%')";
            
        }
      
        /*
        $products=Product::model()->findAll(array('condition'=>$cond,'order'=>'id desc'));
        $count=count($products);
        $pages = new CPagination($count);
        $pages->pageSize = 9;
        */
        
        
             ///////////////////pagination/////////////////////////
        
      $criteria=new CDbCriteria();
     $criteria->condition=$cond ;
      $criteria->order=$order;
    
    $count=Product::model()->count($criteria);
    $pages=new CPagination($count);

    // results per page
    $pages->pageSize=20;
    $pages->applyLimit($criteria);
    $products=Product::model()->findAll($criteria);
   
    ///////////////////////////////////////////////////////////////////  
        
      
        $this->render('search',array('products'=>$products,'count'=>$count,'pages'=>$pages,'countries'=>$countries,'cities'=>$cities,'currntdate'=> $currntdate,'cou'=>$cou,'cit'=>$cit));
    }
    
    
    
    public function actionGetcity() {
       // echo"test";die;
        $id = $_REQUEST['id'];
        $cities = City::model()->findAllByAttributes(array('country_id' => $id));
        $selest = '<select class="form-control" name="city">';
        foreach ($cities as $citie) {
            $selest.='<option value=' . $citie->id . '>' . $citie->title . '</option>';
        }
        $selest.='</select>';
        echo $selest;
    }
    
    
}
