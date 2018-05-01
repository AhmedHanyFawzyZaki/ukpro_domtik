<?php

class CosmeticController extends FrontController {

    public $layout = '//layouts/main';

    public function actionIndex() {
        
        $main_ad = Ads::model()->find("category_id =3 and main_ad = 1");
        $ads = Ads::model()->findAll("category_id =3 and main_ad != 1");

        
        $products = Product::model()->findAll(array('condition' => 'category_id=3  AND  product_status_id !=2  and show_in_home_page=1', 'order' => 'id desc'));
        $featured_products = Product::model()->findAll(array('condition' => 'category_id=3 and category_featured=1  AND  product_status_id !=2', 'limit' => '3', 'order' => 'rand()'));
        $brands = Brand::model()->findAll(array('order' => 'rand()', 'limit' => '4'));
        $slides = CategorySlider::model()->findAll(array('condition' => 'category_id=3'));
      //  $ads = Ads::model()->findAll(array('condition' => 'category_id=3', 'limit' => 1));
        $this->render('index', array('products' => $products, 'featured_products' => $featured_products, 'brands' => $brands, 'ads' => $ads, 'slides' => $slides ,'main_ad'=>$main_ad ));
//        $products = Product::model()->findAll(array('condition'=>'category_id=3  AND  product_status_id !=2  and show_in_home_page=1','order'=>'id desc'));
//        $featured_products = Product::model()->findAll(array('condition'=>'category_id=3 and category_featured=1  AND  product_status_id !=2','limit'=>'3','order'=>'rand()'));
//        $brands=  Brand::model()->findAll(array('order'=>'rand()','limit'=>'4'));
//        $slides= CategorySlider::model()->findAll(array('condition'=>'category_id=3'));
//        //$ads=  Ads::model()->findAll(array('condition'=>'category_id=3','limit'=>1));
//        
//        
//        $this->render('index', array('products' => $products, 'featured_products'=>$featured_products,'brands'=>$brands,'ads'=>$ads,'main_ad'=>$main_ad,'slides'=>$slides));
    }

    public function actionSubCategory() {
        $cond = 'category_id=3   AND  product_status_id !=2';
        if (isset($_REQUEST['cat_id'])) { //must find the product main category in order to set the left filters
            $cond.= ' and product_category_id=' . $_REQUEST['cat_id'];
        } elseif (isset($_REQUEST['subcat_id']) && !isset($_REQUEST['cat_id'])) {
            $cond.= ' and product_category_id=' . SubCategory::model()->findByPk($_REQUEST['subcat_id'])->product_category_id;
        }
        
          if (isset($_REQUEST['shop'])) {
            $cond.=' and user_id=' . $_REQUEST['shop'];
        }
        
        $ids = array();
        $cond_det = '1=1';
        if (isset($_REQUEST['brand_id'])) {
            $cond_det.=' and brand_id=' . $_REQUEST['brand_id'];
        }
          if (isset($_REQUEST['gender'])) {
            $cond_det.=' and gender=' . $_REQUEST['gender'];
        }
        
      
        if (isset($_REQUEST['subcat_id'])) {
            $cond_det.=' and sub_category_id=' . $_REQUEST['subcat_id'];
        }
        if ($cond_det != '1=1') {
            $pro_dets = ProductDetails::model()->findAll(array('condition' => $cond_det));
            if ($pro_dets) {
                foreach ($pro_dets as $pd) {
                    if ($pd->product->category_id == 3) {
                        $ids[] = $pd->product_id;
                    }
                }
            }
        }
        if ($cond_det != '1=1' && empty($ids)) { //there is a filteration by either the brand or the subcat and no result
            $cond.=' and 1=2';
        }

        if (isset($_REQUEST['price'])) {
            $arr = explode('_', $_REQUEST['price']);
            $min = $arr[0];
            $max = $arr[1];
            $pros = Size::model()->findAll(array('condition' => 'price between ' . $min . ' and ' . $max));
            $cond.=' and price between ' . $min . ' and ' . $max;
            if ($pros) {
                foreach ($pros as $pr) {
                    if ($pr->product->category_id == 3) {
                        $ids[] = $pr->product_id;
                        $ids2[] = $pr->product_id;
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
        if ($ids) {
            $cond.= ' and id in (' . implode(",", $ids) . ')';
        }

        $sub = SubCategory::model()->findByPk($_REQUEST['subcat_id']);

        if (isset($_REQUEST['size'])) {

            if ($sub) {

                $product_sizes = ProductSizes::model()->findAll(array('condition' => ' sizes_id ="' . $_REQUEST['size'] . '" and product_id in (select id from product where category_id = 1 and product_category_id = ' . $sub->productCategory->id . ')'));
            } elseif (isset($_REQUEST['cat_id'])) {
                $product_sizes = ProductSizes::model()->findAll(array('condition' => ' sizes_id ="' . $_REQUEST['size'] . '" and product_id in (select id from product where category_id = 1 and product_category_id = ' . $_REQUEST['cat_id'] . ')'));
            }

            if ($product_sizes) {
                foreach ($product_sizes as $product_size) {
                    $ids3[] = $product_size->product_id;
                }
            }

            if ($ids3) {
                $cond.= ' and id in (' . implode(",", $ids3) . ')';
            }

            if (empty($ids3)) { //there is a filteration by either the brand or the subcat and no result
                $cond.=' and 1=2';
            }
        }
        $order = "title asc";
        if (isset($_REQUEST['sort'])) {
            $order = $_REQUEST['sort'];
        }



        // echo $cond ; 
        // die;
        // $products=Product::model()->findAll(array('condition'=>$cond,'order'=>$order));
        //   print_r($products) ; die ;


        /*
          $products=Product::model()->findAll(array('condition'=>$cond,'order'=>$order));
          $count=count($products);
          $pages = new CPagination($count);
          $pages->pageSize = 12;
         */


        ///////////////////pagination/////////////////////////

        $criteria = new CDbCriteria();
        $criteria->condition = $cond;
        $criteria->order = $order;

        $count = Product::model()->count($criteria);
        $pages = new CPagination($count);

        // results per page
        $pages->pageSize = 12;
        $pages->applyLimit($criteria);
        $products = Product::model()->findAll($criteria);

        //  print_r($products) ; die ;
        ///////////////////////////////////////////////////////////////////  



        $brands = Brand::model()->findAll("category_id = 3");
          $users  = User::model()->findAll('groups_id = 1 or groups_id = 4');

        $featured_products = Product::model()->findAll(array('condition' => 'category_id=3 and category_featured=1', 'limit' => '2', 'order' => 'rand()'));
        $this->render('sub-category', array('products' => $products, 'brands' => $brands, 'featured_products' => $featured_products, 'count' => $count, 'pages' => $pages ,'users'=>$users));
    }

    public function actionItem() {

        $review = new Review;

        $id = $_REQUEST['id'];
        $product = Product::model()->findByPk($id);
        $colors = Color::model()->findAllByAttributes(array('product_id' => $id));
        $photos = GalleryPhoto::model()->findAllByAttributes(array('gallery_id' => $product->gallery_id));
        //$sizes = Size::model()->findAllByAttributes(array('product_id' => $id));
        // $sizes = Size::model()->findAll(array('condition'=>'product_id='.$id.' and quantity > 0'));

        $criteria4 = new CDbCriteria;
        $criteria4->condition = 'product_id=' . $product->id;
        $sizes = Size::model()->findAll($criteria4);
        // print_r($sizes);die;

        $reviews = Review::model()->findAllByAttributes(array('product_id' => $id));





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



        $this->render('item', array('product' => $product, 'sizes' => $sizes, 'reviews' => $reviews, 'photos' => $photos, 'review' => $review));
    }

    public function actionaddReview() {

        /*
          // to save review
          if (isset($_POST['Review'])) {
          // echo  "hghghghg" ; die ;
          $userid = Yii::app()->user->id;
          // echo  $userid ; die ;
          if ($userid != '') {
          //print_r($_POST['Review']);die;

          $review->attributes = $_POST['Review'];
          $review->user_id = Yii::app()->user->id;
          $review->product_id = $product->id;
          $review->comment_date = date('Y-m-d');



          if ($review->save()) {
          //echo "dfdfds" ; die ;
          Yii::app()->user->setFlash('add-success', 'Your Review has been added sucessfuly.');
          $this->redirect(array('item','id'=>$_REQUEST['product']));
          } else {

          Yii::app()->user->setFlash('add-error', 'Please Add your review');
          $this->redirect(array('item','id'=>$_REQUEST['product']));
          }
          } else {
          $this->redirect(array('home/confirm/flag/3'));
          }
          }


         */


        $review = new Review;
        $review->comment = $_REQUEST['comment'];
        $review->rate = $_REQUEST['rate'];
        $review->product_id = $_REQUEST['product'];
        $review->user_id = Yii::app()->user->id;
        $review->comment_date = date('Y-m-d');
        if ($review->save()) {
            $this->redirect(array('item', 'id' => $_REQUEST['product']));
        }
    }

}
