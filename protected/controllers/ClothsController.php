<?php

class ClothsController extends FrontController {

    public $layout = '//layouts/clothes';

    public function actionIndex() {



        /*
          $products = Product::model()->findAllByAttributes(array('category_id' => 1));
          $count_prod = count($products);
         */
        $catsliders = CategorySlider::model()->findAllByAttributes(array('category_id' => 1));

        $arrival_cond = 'show_in_website_category=1';
        $arrival_cond.=' and category_id=1';
        $criteria = new CDbCriteria;
        $criteria->condition = $arrival_cond;
        $arrivls = Product::model()->findAll($criteria);
        $count = count($arrivls);


        /*
          $pages = new CPagination($count_prod);
          $pages->pageSize = 15;
         */



        ///////////////////pagination/////////////////////////

        $criteria = new CDbCriteria();
        $criteria->condition = 'category_id=1  AND  product_status_id !=2 ';
        //$criteria->order=$order;

        $count_prod = Product::model()->count($criteria);
        $pages = new CPagination($count_prod);

        // results per page
        $pages->pageSize = 15;
        $pages->applyLimit($criteria);
        $products = Product::model()->findAll($criteria);

        ///////////////////////////////////////////////////////////////////


        $main_ad = Ads::model()->find("category_id =1 and main_ad = 1");
        $ads = Ads::model()->findAll("category_id =1 and main_ad != 1");

        $this->render('index', array('products' => $products, 'arrivls' => $arrivls, 'count' => $count, 'pages' => $pages, 'count_prod' => $count_prod, 'catsliders' => $catsliders
                , "main_ad"=>$main_ad , "ads"=>$ads));
    }

    public function actionItem($id) {
        
         
        
        $review = new Review;

        $product = Product::model()->findByPk($id);
        //$ships = ShippingValue::model()->findAll(array('condition'=>'user_id='.Yii::app()->user->id));
        //print_r($ships);die;

        $sub = SubCategory::model()->findByAttributes(array('product_category_id' => $product->product_category_id));

        if (isset($_POST['Review'])) {

            $userid = Yii::app()->user->id;
            if ($userid != '') {

                //print_r($_POST['Review']);die;

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

        $revs = Review::model()->findAllByAttributes(array('product_id' => $product->id));

        //print_r($product);die;
//$photos=array();
        $photos = GalleryPhoto::model()->findAllByAttributes(array('gallery_id' => $product->gallery_id));

        //print_r($photos);die;



        $colors = Colors::model()->findAll(array('condition' => ' id in (select colors_id from product_color where  product_id = ' . $id . ')'));
        $sizes = Sizes::model()->findAll(array('condition' => ' id in (select sizes_id from product_sizes where  product_id = ' . $id . ')'));


        $likes = Product::model()->findAll(array('condition' => 'category_id=' . $product->category_id));
        if(!empty($product->product_category_id))
        $likes = Product::model()->findAll(array('condition' => 'product_category_id=' . $product->product_category_id . ' and  category_id=' . $product->category_id));
        $count = count($likes);
        //print_r($likes);die;

        $this->render('item', array('product' => $product, 'colors' => $colors, 'sizes' => $sizes, 'photos' => $photos, 'likes' => $likes, 'revs' => $revs, 'count' => $count, 'review' => $review, 'sub' => $sub));
    }

    public function actionSubCategory() {
        $cond = 'category_id=1   AND  product_status_id !=2 ';
        if (isset($_REQUEST['cat_id'])) { //must find the product main category in order to set the left filters
            $cond.= ' and product_category_id=' . $_REQUEST['cat_id'];
        } elseif (isset($_REQUEST['subcat_id']) && !isset($_REQUEST['cat_id'])) {
            $subCategory = SubCategory::model()->findByPk($_REQUEST['subcat_id']);
            if ($subCategory)
                $cond.= ' and product_category_id=' . $subCategory->product_category_id;
        }

 if (isset($_REQUEST['shop'])) {
            $cond.=' and user_id=' . $_REQUEST['shop'];
        }
        
        
        
        $ids = array();
        $cond_det = '1=1';
        if (isset($_REQUEST['subcat_id'])) {
            $cond_det.=' and sub_category_id=' . $_REQUEST['subcat_id'];
        }
         if (isset($_REQUEST['brand'])) {
            $cond_det.=' and brand_id=' . $_REQUEST['brand'];
        }
        
         if (isset($_REQUEST['gender'])) {
            $cond_det.=' and gender=' . $_REQUEST['gender'];
        }
        
        if ($cond_det != '1=1') {
            $pro_dets = ProductDetails::model()->findAll(array('condition' => $cond_det));
            if ($pro_dets) {
                foreach ($pro_dets as $pd) {
                    if ($pd->product->category_id == 1) {
                        $ids[] = $pd->product_id;
                    }
                }
            }
        }
        if ($cond_det != '1=1' && empty($ids)) { //there is a filteration the subcat and no result
            $cond.=' and 1=2';
        }

        if (isset($_REQUEST['price'])) {
            $arr = explode('_', $_REQUEST['price']);
            $min = $arr[0];
            $max = $arr[1];
            $pros = Product::model()->findAll(array('condition' => 'price between ' . $min . ' and ' . $max));
            $cond.=' and price between ' . $min . ' and ' . $max;
            //    echo $cond ; 
            // die;

            if ($pros) {
                foreach ($pros as $pr) {
                    if ($pr->category_id == 1) {
                        $ids[] = $pr->id;
                        $ids2[] = $pr->id;
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




        if (isset($_REQUEST['color'])) {

            if ($sub) {
                $product_colors = ProductColor::model()->findAll(array('condition' => 'colors_id ="' . $_REQUEST['color'] . '" and product_id in (select id from product where category_id = 1 and product_category_id = ' . $sub->productCategory->id . ')'));
            } elseif (isset($_REQUEST['cat_id'])) {
                $product_colors = ProductColor::model()->findAll(array('condition' => ' colors_id ="' . $_REQUEST['color'] . '" and product_id in (select id from product where category_id = 1 and product_category_id = ' . $_REQUEST['cat_id'] . ')'));
            }


            if ($product_colors) {
                foreach ($product_colors as $product_color) {
                    $ids4[] = $product_color->product_id;
                }
            }

            if ($ids4) {
                $cond.= ' and id in (' . implode(",", $ids4) . ')';
            }


            if (empty($ids4)) { //there is a filteration by either the brand or the subcat and no result
                $cond.=' and 1=2';
            }
        }



        //  echo $cond ; die ;


        $order = "title asc";
        if (isset($_REQUEST['sort'])) {
            $order = $_REQUEST['sort'];
        }


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
        $pages->pageSize = 20;
        $pages->applyLimit($criteria);
        $products = Product::model()->findAll($criteria);

        ///////////////////////////////////////////////////////////////////  

        $sub = SubCategory::model()->findByPk($_REQUEST['subcat_id']);
        $arrivls = Product::model()->findAll(array('condition' => 'show_in_website_category=1 and category_id=1 '));

        $brands  = Brand::model()->findAll('category_id = 1');
        $users  = User::model()->findAll('groups_id = 1 or groups_id = 4');
        $this->render('subcategory', array('products' => $products, 'count' => $count, 'pages' => $pages, 'sub' => $sub, 'arrivls' => $arrivls,"brands"=>$brands , "users"=>$users));
    }

}
