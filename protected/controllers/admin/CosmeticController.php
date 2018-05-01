<?php

class CosmeticController extends FrontController {
    public $layout = '//layouts/main';

    public function actionIndex() {
        $products = Product::model()->findAll(array('condition'=>'category_id=3 and show_in_home_page=1','order'=>'id desc'));
        $featured_products = Product::model()->findAll(array('condition'=>'category_id=3 and category_featured=1','limit'=>'3','order'=>'rand()'));
        $brands=  Brand::model()->findAll(array('order'=>'rand()','limit'=>'4'));
        $slides= CategorySlider::model()->findAll(array('condition'=>'category_id=3'));
        $ads=  Ads::model()->findAll(array('condition'=>'category_id=3','limit'=>1));
        $this->render('index', array('products' => $products, 'featured_products'=>$featured_products,'brands'=>$brands,'ads'=>$ads,'slides'=>$slides));
    }

    public function actionSubCategory() {
        $cond='category_id=3';
        if(isset($_REQUEST['cat_id'])) //must find the product main category in order to set the left filters
        {
            $cond.= ' and product_category_id='.$_REQUEST['cat_id'];
        }
        elseif(isset($_REQUEST['subcat_id']) && !isset($_REQUEST['cat_id']))
        {
            $cond.= ' and product_category_id='. SubCategory::model()->findByPk($_REQUEST['subcat_id'])->product_category_id;
        }
        $ids=array();
        $cond_det='1=1';
        if(isset($_REQUEST['brand_id']))
        {
            $cond_det.=' and brand_id='.$_REQUEST['brand_id'];
        }
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
                    if($pd->product->category_id==3)
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
            $pros=Size::model()->findAll(array('condition'=>'price between '.$min.' and '.$max));
            if($pros)
            {
                foreach ($pros as $pr)
                {
                    if($pr->product->category_id==3)
                    {
                        $ids[]=$pr->product_id;
                        $ids2[]=$pr->product_id;
                    }
                }
            }
            if(empty($ids2))
            {
                $cond.=' and 2=3'; //searching with price and no products found
            }
        }
        if($ids)
        {
            $cond.= ' and id in ('.implode(",", $ids).')';
        }
        
        $order="title asc";
        if(isset($_REQUEST['sort']))
        {
            $order=$_REQUEST['sort'];
        }
        
        $products=Product::model()->findAll(array('condition'=>$cond,'order'=>$order));
        $count=count($products);
        $pages = new CPagination($count);
        $pages->pageSize = 12;
        
        $brands= Brand::model()->findAll();
        $featured_products = Product::model()->findAll(array('condition'=>'category_id=3 and category_featured=1','limit'=>'2','order'=>'rand()'));
        $this->render('sub-category',array('products'=>$products,'brands'=>$brands, 'featured_products'=>$featured_products,'count'=>$count,'pages'=>$pages));
    }
    
    public function actionItem(){
        $id=$_REQUEST['id'];
        $product = Product::model()->findByPk($id);
        $colors = Color::model()->findAllByAttributes(array('product_id' => $id));
        $photos = GalleryPhoto::model()->findAllByAttributes(array('gallery_id' => $product->gallery_id));
        $sizes = Size::model()->findAllByAttributes(array('product_id' => $id));
        $reviews = Review::model()->findAllByAttributes(array('product_id' => $id));
        
        $this->render('item', array('product' => $product, 'sizes' => $sizes, 'reviews' => $reviews, 'photos'=>$photos)); 
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
}
