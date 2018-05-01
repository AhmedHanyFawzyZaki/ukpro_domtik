<?php

class KidsController extends FrontController {
    public $layout = '//layouts/main';

    public function actionIndex() {
        
        
        $fashions = ProductDetails::model()->get_kids_home(0);
        $entertainments = ProductDetails::model()->get_kids_home(1);
        $gears = ProductDetails::model()->get_kids_home(2);
        
        $sliders = CategorySlider::model()->findAll(array('condition' => 'category_id = 8'));
         $ads = Ads::model()->findAll("category_id =8 and main_ad != 1");

        $this->render('index', array('categories' => $categories, 'fashions' => $fashions, 'entertainments' => $entertainments, 
            'gears' => $gears, 'sliders' => $sliders , "ads"=>$ads)); 
    }
    
    public function actionCategory() {
        
        $category = ProductCategory::model()->findByPk($_REQUEST['cat_id']);
      //  $products = Product::model()->findAllByAttributes(array('product_category_id' => $_REQUEST['cat_id'],'product_status_id' => 1));
        
        $condition='product_category_id='.$_REQUEST['cat_id'].' AND  product_status_id !=2 ';
        $products = Product::model()-> findAll(array('condition'=>$condition));
        
        
        
        $sliders = CategorySlider::model()->findAll(array('condition' => 'category_id = 8'));
        
        $count=count($products);
        $pages = new CPagination($count);
        $pages->pageSize = 16;
        
        $this->render('category', array('category' => $category, 'products' => $products, 'count'=>$count,'pages'=>$pages, 'sliders' => $sliders));
    }

    public function actionSubCategory() {
        
        Yii::app()->user->setState('big1', 'active');
        Yii::app()->user->setState('big2', '');
        Yii::app()->user->setState('big3', '');
        $cond='category_id = 8';
        
        
       if(isset($_REQUEST['cat_id'])) //must find the product main category in order to set the left filters
        {
            $cond.= ' and product_category_id='.$_REQUEST['cat_id'];
        }
        elseif(isset($_REQUEST['subcat_id']) && !isset($_REQUEST['cat_id']))
        {
           $subCategory= SubCategory::model()->findByPk($_REQUEST['subcat_id']) ;
           if($subCategory){
                 $cond.= ' and product_category_id='. $subCategory->product_category_id;
                 
                    $products_details = ProductDetails::model()->findAllByAttributes(array('sub_category_id' => $_REQUEST['subcat_id']));
           }
          
            
             
        }
        
         if (isset($_REQUEST['shop'])) {
            $cond.=' and user_id=' . $_REQUEST['shop'];
        }
        
            if (isset($_REQUEST['brand'])) {
            $cond.=' and brand_id=' . $_REQUEST['brand'];
        }
        
        
         if(isset($_REQUEST['subcat_id']))
        {
             $products_details = ProductDetails::model()->findAllByAttributes(array('sub_category_id' => $_REQUEST['subcat_id']));
            
        }
        
        $ids=array(); // to collect product details
        $ids2=array();   // to collect size 
        $ids3=array(); // to collect product sizes
        $ids4=array(); // to collect product colors
          
       
        
       // print_r($products_details) ; die ;
        
        $sub = SubCategory::model()->findByPk($_REQUEST['subcat_id']);
        $allsub = SubCategory::model()->findAllByAttributes(array('product_category_id' => $sub->productCategory->id));
        
        if($products_details)
        {
            foreach($products_details as $pd)
            {
                $ids[]=$pd->product_id;
            }
        }
        
         
         if($ids)
        {
            $cond.= ' and id in ('.implode(",", $ids).')';
        }
        
        if(empty($ids)) //there is a filteration by either the brand or the subcat and no result
        {
            $cond.=' and 1=2';  // to not get any thing in filteration  as this make sql false 
        }
        
        
         if(isset($_REQUEST['size'])){
            if($sub){
                $product_sizes = ProductSizes::model()->findAll(array('condition' => ' sizes_id ="'.$_REQUEST['size'].'" and product_id in (select id from product where category_id = 8 and product_category_id = '.$sub->productCategory->id.')'));
            }
                 
            if($product_sizes)
            {
             foreach($product_sizes as $product_size)
              {
                $ids3[]=$product_size->product_id;
               }
            }
            
            if($ids3){
                 $cond.= ' and id in ('.implode(",", $ids3).')';
            }
            
         if(empty($ids3)) //there is a filteration by either the brand or the subcat and no result
        {
            $cond.=' and 1=2';
        }
               

         }
         
         
         
         if(isset($_REQUEST['color'])){
           
                 $product_colors = ProductColor::model()->findAll(array('condition' => 'colors_id ="'.$_REQUEST['color'].'" and product_id in (select id from product where category_id = 8 and product_category_id = '.$sub->productCategory->id.')'));
             
             if($product_colors)
            {
             foreach($product_colors as $product_color)
              {
                $ids4[]=$product_color->product_id;
               }
            }
            
            if($ids4){
                 $cond.= ' and id in ('.implode(",", $ids4).')';
            }
            
            
        if(empty($ids4)) //there is a filteration by either the brand or the subcat and no result
        {
            $cond.=' and 1=2';
        }
             
         }
         
         
        
        
        $order = "title asc";
        if(isset($_REQUEST['sort']))
        {
            $order = $_REQUEST['sort'];
        }
        
        if($_REQUEST['tab']){
            Yii::app()->user->setState('big1', '');
            Yii::app()->user->setState($_REQUEST['tab'], 'active');
        }
        if(isset($_REQUEST['price']))
        {
            $arr= explode('_', $_REQUEST['price']);
            $min=$arr[0];
            $max=$arr[1];
            $cond.= ' and price between '.$min.' and '.$max;
        }
        
        
       
        
        
        
        
        
        
        $products=Product::model()->findAll(array('condition' => $cond,'order' => $order));
        
        
        
        if(isset($_REQUEST['age']))
        {
            $sizes = Size::model()->findAll(array('condition' => 'title ="'.$_REQUEST['age'].'" and product_id in (select id from product where category_id = 8 and product_category_id = '.$sub->productCategory->id.')'));
            if($sizes)
            {
                foreach($sizes as $size)
                {
                    $ids2[]=$size->product_id;
                }
            }
            if($ids2){
                 $cond.= ' and id in ('.implode(",", $ids2).')';
            }
            
        if(empty($ids2)) //there is a filteration by either the brand or the subcat and no result
        {
            $cond.=' and 1=2';
        }
             
            
           // $products=Product::model()->findAll(array('condition' => $cond,'order' => $order));
        }
        
        
        
        
          ///////////////////pagination/////////////////////////
        
        $criteria=new CDbCriteria();
        $criteria->condition=$cond ;
        $criteria->order=$order ;
    
        $count=Product::model()->count($criteria);
        $pages=new CPagination($count);

        // results per page
        $pages->pageSize=20;
        $pages->applyLimit($criteria);

        ///////////////////////////////////////////////////////////////////  
 if($sub){
       $ages = Size::model()->findAll(array('condition' => 'product_id in (select id from product where category_id = 8 and product_category_id = '.$sub->productCategory->id.')'));
 }
      
 
$brands = Brand::model()->findAll("category_id = 8");
          $users  = User::model()->findAll('groups_id = 1 or groups_id = 4');

        $this->render('sub_category', array('products' => $products, 'sub' => $sub, 'allsub' => $allsub, 'count'=>$count,'pages'=>$pages, 'ages' => $ages ,"brands"=>$brands , "users"=>$users));
    }
    
    public function actionDetails(){
        
        $product = Product::model()->findByPk($_REQUEST['pro_id']);
       // $colors = Color::model()->findAllByAttributes(array('product_id' => $_REQUEST['pro_id']));
       // $sizes = Size::model()->findAllByAttributes(array('product_id' => $_REQUEST['pro_id']));
        $colors = Colors::model()->findAll(array('condition' => ' id in (select colors_id from product_color where  product_id = '.$_REQUEST['pro_id'].')'));
          $sizes = Sizes::model()->findAll(array('condition' => ' id in (select sizes_id from product_sizes where  product_id = '.$_REQUEST['pro_id'].')'));
        $reviews = Review::model()->findAllByAttributes(array('product_id' => $_REQUEST['pro_id']));
        
        $shippings = ShippingValue::model()->findAll(array('condition' => 'user_id = '.$product->user_id));
        $photos = GalleryPhoto::model()->findAllByAttributes(array('gallery_id' => $product->gallery_id));
        
        $this->render('details', array('product' => $product, 'colors' => $colors, 'sizes' => $sizes, 'reviews' => $reviews, 'photos' => $photos, 'shippings' => $shippings));  
    }
    
    public function actionaddReview(){
        $review = new Review;
        $review->comment = $_REQUEST['comment'];
        $review->rate = $_REQUEST['rate'];
        $review->product_id = $_REQUEST['product'];
        $review->user_id = Yii::app()->user->id;
        $review->comment_date = date('Y-m-d');
        if($review->save()){
            $this->redirect(array('details','pro_id'=>$_REQUEST['product']));
        }
    }
    
    public function actionTypes(){
        
        $type = '';
        if($_REQUEST['type'] == 0){
            $type = 'baby';
        }elseif($_REQUEST['type'] == 1){
            $type = 'kids';
        }else{
            $type = 'moms & maternity';
        }
        $criteria = new CDBCriteria;
        $criteria->condition = 'kids_type ='.$_REQUEST['type'];
        $products = ProductDetails::model()->findAll($criteria);
        $count = count($products);
        $pages = new CPagination($count);
        $pages->setPageSize(12);
        $pages->applyLimit($criteria);
        
        $sliders = CategorySlider::model()->findAll(array('condition' => 'category_id = 8'));
        
        $this->render('types', array('products' => $products, 'type' => $type, 'sliders' => $sliders, 'count'=>$count,'pages'=>$pages, 'page_size' => 12));
    }
}
