<?php

class ElectronicController extends FrontController {
    
    public $layout = '//layouts/electronic';
    
    public function actionIndex(){
        
        $deals = Product::model()->findAll(array('condition' =>'category_id = 7 and show_in_website_category = 1    AND  product_status_id !=2 ', 'limit' => 3, 'order' => 'id DESC'));
        $specialoffers = Product::model()->findAll(array('condition' =>'category_id = 7 and on_sale = 1    AND  product_status_id !=2  ', 'limit' => 2, 'order' => 'id DESC'));
        $features = Product::model()->findAll(array('condition' =>'category_id = 7 and category_featured = 1   AND  product_status_id !=2', 'limit' => 6, 'order' => 'id DESC'));
        $banners = CategorySlider::model()->findAllByAttributes(array('category_id' => 7));
        $ads = Ads::model()->findAll(array('condition' => 'category_id = 7', 'limit' => 2, 'order' => 'id DESC'));
        
        $this->render('index', array('deals' => $deals, 'specialoffers' => $specialoffers, 'features' => $features, 'slides' => $banners, 'ads' => $ads));
    }
    
    public function actionDetails(){
        
        $product = Product::model()->findByPk($_REQUEST['pro_id']);
        $photoes = GalleryPhoto::model()->findAllByAttributes(array('gallery_id' => $product->gallery_id));
               $similars = Product::model()->findAll(array('condition' =>'category_id = 7' ));
      if(!empty($product->product_category_id))
        $similars = Product::model()->findAll(array('condition' =>'category_id = 7 and product_category_id = '.$product->product_category_id));
        $reviews = Review::model()->findAllByAttributes(array('product_id' => $_REQUEST['pro_id']));
        $shippings = ShippingValue::model()->findAll(array('condition' => 'user_id = '.$product->user_id));
        $colors = Colors::model()->findAll(array('condition' => ' id in (select colors_id from product_color where  product_id = ' . $_REQUEST['pro_id'] . ')'));
        $this->render('details', array('product' => $product, 'photoes' => $photoes, 'similars' => $similars, 'reviews' => $reviews, 'shippings' => $shippings,'colors'=>$colors));
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
    
    public function actionCategory(){
        $cond='category_id=7   AND  product_status_id !=2';
        if(isset($_REQUEST['cat_id'])) //must find the product main category in order to set the left filters
        { 
            $cond.= ' and product_category_id='.$_REQUEST['cat_id'];
            $allsub = SubCategory::model()->findAllByAttributes(array('product_category_id' => $_REQUEST['cat_id']));
            $category = ProductCategory::model()->findByPk($_REQUEST['cat_id']);
        }
        
         if (isset($_REQUEST['shop'])) {
            $cond.=' and user_id=' . $_REQUEST['shop'];
        }
        
        $ids=array();
        $cond_det='1=1';
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
                    if($pd->product->category_id==7)
                    {
                        $ids[]=$pd->product_id;
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
            $cond.= ' and price between '.$min.' and '.$max;
        }
        if($ids)
        {
            $cond.= ' and id in ('.implode(",", $ids).')';
        }
        
        
        if(isset($_REQUEST['subcat_id'])){
        $sub = SubCategory::model()->findByPk($_REQUEST['subcat_id']);
        }
        
          if(isset($_REQUEST['color'])){
             
           if($sub){
                $product_colors = ProductColor::model()->findAll(array('condition' => 'colors_id ="'.$_REQUEST['color'].'" and product_id in (select id from product where category_id = 7 and product_category_id = '.$sub->productCategory->id.')'));
           }elseif (isset($_REQUEST['cat_id'])) {
                 $product_colors = ProductColor::model()->findAll(array('condition' => ' colors_id ="'.$_REQUEST['color'].'" and product_id in (select id from product where category_id = 7 and product_category_id = '.$_REQUEST['cat_id'].')'));
            }
                
             
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
        
      
        
         ///////////////////pagination/////////////////////////
        
      $criteria=new CDbCriteria();
     $criteria->condition=$cond ;
      $criteria->order=$order ;
    
    $count=Product::model()->count($criteria);
    $pages=new CPagination($count);

    // results per page
    $pages->pageSize=20;
    $pages->applyLimit($criteria);
    $products=Product::model()->findAll($criteria);
   
    ///////////////////////////////////////////////////////////////////  
        
        
        
$brands = Brand::model()->findAll("category_id = 7");
          $users  = User::model()->findAll('groups_id = 1 or groups_id = 4');

        
        $this->render('category', array('category' => $category,
                            'products' => $products, 'count'=>$count,'pages'=>$pages, 'allsub' => $allsub,"brands"=>$brands, "users"=>$users
                            ));
    }
}
    ?>