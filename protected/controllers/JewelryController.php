<?php
class JewelryController extends FrontController {
    public $layout = '//layouts/main';
    public function actionIndex() {
        $slides = CategorySlider::model()->findAll(array('condition'=>'category_id=4','order'=>'id desc'));
        $featured_products = Product::model()->findAll(array('condition'=>'category_id=4 and category_featured=1  AND  product_status_id !=2','limit'=>'3','order'=>'rand()'));
        $products = Product::model()->findAll(array('condition'=>'category_id=4 and show_in_home_page=1  AND  product_status_id !=2','order'=>'id desc'));
        $newarrivalsproducts = Product::model()->findAll(array('condition'=>'category_id=4 and show_in_website_category=1 AND  product_status_id !=2','order'=>'id desc'));
      
        $main_ad = Ads::model()->find("category_id =4 and main_ad = 1");
        $ads = Ads::model()->findAll("category_id =4 and main_ad != 1");

        $this->render('index', array('slides'=>$slides,'products' => $products, 'featured_products'=>$featured_products,'arrivals'=>$newarrivalsproducts
                ,'ads'=>$ads , "main_ad"=>$main_ad));
    }

    public function actionSubCategory() {
        $cond='category_id=4  AND  product_status_id !=2';
        if(isset($_REQUEST['cat_id'])) //must find the product main category in order to set the left filters
        {
            $cond.= ' and product_category_id='.$_REQUEST['cat_id'];
        }
        elseif(isset($_REQUEST['subcat_id']) && !isset($_REQUEST['cat_id']))
        {
              $subCategory= SubCategory::model()->findByPk($_REQUEST['subcat_id']) ;
              if($subCategory)
            $cond.= ' and product_category_id='. $subCategory->product_category_id;
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
                    if($pd->product->category_id==4)
                    {
                        $ids[]=$pd->product_id;
                    }
                }
            }
        }
        if($cond_det!='1=1' && empty($ids)) //there is a filteration the subcat and no result
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
             //    echo $cond ; 
              // die;
        
            if($pros)
            {
                foreach ($pros as $pr)
                {
                    if($pr->category_id==4)
                    {
                        $ids[]=$pr->id;
                        $ids2[]=$pr->id;
                    }
                }
            }
            /*
            if(empty($ids2))
            {
                $cond.=' and 2=3'; //searching with price and no products found
            }
            */
        }
        if($ids)
        {
            $cond.= ' and id in ('.implode(",", $ids).')';
        }
        
        
         $sub = SubCategory::model()->findByPk($_REQUEST['subcat_id']);
        
         if(isset($_REQUEST['size'])){
              
            if($sub){
              
                $product_sizes = ProductSizes::model()->findAll(array('condition' => ' sizes_id ="'.$_REQUEST['size'].'" and product_id in (select id from product where category_id = 4 and product_category_id = '.$sub->productCategory->id.')'));
            }elseif (isset($_REQUEST['cat_id'])) {
                 $product_sizes = ProductSizes::model()->findAll(array('condition' => ' sizes_id ="'.$_REQUEST['size'].'" and product_id in (select id from product where category_id = 4 and product_category_id = '.$_REQUEST['cat_id'].')'));
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
         
     
        
        
        
        $order="title asc";
        if(isset($_REQUEST['sort']))
        {
            $order=$_REQUEST['sort'];
        }
        
        
        /*
        $products=Product::model()->findAll(array('condition'=>$cond,'order'=>$order));
        $count=count($products);
        $pages = new CPagination($count);
        $pages->pageSize = 12;
        */
        
        
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
        
        $brands = Brand::model()->findAll("category_id = 4");
         $users  = User::model()->findAll('groups_id = 1 or groups_id = 4');

        $this->render('sub-category',array('products'=>$products,'count'=>$count,'pages'=>$pages ,'users'=>$users ,"brands"=>$brands));
    }
    
    public function actionItem(){
        $review = new Review;
        $id=$_REQUEST['id'];
        $product = Product::model()->findByPk($id);
       // $sizes = Size::model()->findAllByAttributes(array('product_id' => $id));
          $sizes = Sizes::model()->findAll(array('condition' => ' id in (select sizes_id from product_sizes where  product_id = '.$id.')'));
        $photos = GalleryPhoto::model()->findAllByAttributes(array('gallery_id' => $product->gallery_id));
           $newarrivalsproducts = Product::model()->findAll(array('condition'=>'category_id=4' ));
        if(!empty($product->product_category_id))
        $newarrivalsproducts = Product::model()->findAll(array('condition'=>'category_id=4 and product_category_id='.$product->product_category_id.' and id!='.$id.'','order'=>'id desc'));
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
        $reviews = Review::model()->findAllByAttributes(array('product_id' => $id));
        $this->render('item', array('product' => $product, 'sizes' => $sizes, 'reviews' => $reviews,'arrivals'=>$newarrivalsproducts, 'photos' => $photos, 'revs' => $revs, 'count' => $count, 'review' => $review, 'sub' => $sub)); 
    }
}
