<?php

class DecorController extends FrontController {

    public $layout = '//layouts/main';

    public function actionIndex() {


        $criteria = new CDbCriteria;
        $criteria->condition = 'category_id=:CatID';
        $criteria->params = array(':CatID' => 6);
        $criteria->order = 'id DESC';
        $criteria->limit = '1';
        $cat_slider = CategorySlider::model()->find($criteria);


        $decortypes = DecorType::model()->findAll();
        $decorstyles = DecorStyle::model()->findAll();



        $prods = Product::model()->findAll(array('condition' => 'category_id=6 and show_in_website_category=1  AND  product_status_id !=2'));
        $ads = Ads::model()->findAll("category_id =6 and main_ad != 1");
        $brands = Brand::model()->findAll("category_id = 6");
        $users = User::model()->findAll('groups_id = 1 or groups_id = 4');

        $this->render('index', array('decortypes' => $decortypes, 'decorstyles' => $decorstyles, 'cat_slider' => $cat_slider, 'prods' => $prods, "ads" => $ads,'brands'=>$brands , "users"=>$users));
        //$this->render('sub', array('decortypes' => $decortypes, 'decorstyles' => $decorstyles, 'prods' => $prods, 'count' => $count, 'pages' => $pages, 'style_id' => $style_id, 'type_id' => $type_id ,'brands'=>$brands , "users"=>$users));

        
    }

    public function actionSub() {
        $condition = 'category_id=6  AND  product_status_id !=2';
        $id = $_REQUEST['id'];
        $style_id = $_REQUEST['style_id'];
        $type_id = $_REQUEST['type_id'];
        if ($id) {
            $condition.='';
        }
        if ($style_id) {

            $condition.= ' and id IN (select product_id from product_details where decor_style_id=' . $style_id . ')';
        }
        if ($type_id) {

            $condition.= ' and id IN (select product_id from product_details where decor_type_id=' . $type_id . ')';
        }

        if ($_REQUEST['cat_id']) {
            // echo "sssss";die;
            $condition = 'category_id=6';
            // echo "test";die;
            $condition.=' and product_category_id =' . $_REQUEST['cat_id'];
        }
        
//        if (isset($_REQUEST['cat_id'])) { //must find the product main category in order to set the left filters
//            $condition.= ' and product_category_id=' . $_REQUEST['cat_id'];
//        } 
        elseif (isset($_REQUEST['subcat_id']) && !isset($_REQUEST['cat_id'])) {
            $subCategory = SubCategory::model()->findByPk($_REQUEST['subcat_id']);
            if ($subCategory)
                $condition.= ' and product_category_id=' . $subCategory->product_category_id;
        }


         if (isset($_REQUEST['subcat_id'])) {
            $cond_det.=' and sub_category_id=' . $_REQUEST['subcat_id'];
        }


        if (isset($_REQUEST['shop'])) {
            $condition.=' and user_id=' . $_REQUEST['shop'];
        }

        $ids = array();
        $cond_det = '1=1';
        if ($_REQUEST['subcat_id']) {
            // echo $_REQUEST['subcat_id'];die;
            $cond_det.=' and sub_category_id=' . $_REQUEST['subcat_id'];
        }
        if (isset($_REQUEST['brand'])) {
            $cond_det.=' and brand_id=' . $_REQUEST['brand'];
        }
        if ($cond_det != '1=1') {
            // echo "test";die;
            $pro_dets = ProductDetails::model()->findAll(array('condition' => $cond_det));
            // print_r($pro_dets);die;
            if ($pro_dets) {
                // print_r ($pro_dets);die;
                foreach ($pro_dets as $pd) {
                    if ($pd->product->category_id == 6) {
                        // echo "test";die;
                        $ids[] = $pd->product_id;
                    }
                    //print_r($ids);die;
                }
            }
        }
        if ($cond_det != '1=1' && empty($ids)) { //there is a filteration by either the brand or the subcat and no result
            // echo "test";die;
            $condition.=' and 1=2';
        }
        if ($ids) {

            $condition.= ' and id in (' . implode(",", $ids) . ')';
        }



        if (isset($_REQUEST['price'])) {
            $arr = explode('_', $_REQUEST['price']);
            $min = $arr[0];
            $max = $arr[1];
            $pros = Product::model()->findAll(array('condition' => 'price between ' . $min . ' and ' . $max));
            $condition.=' and price between ' . $min . ' and ' . $max;
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
            $condition.= ' and id in (' . implode(",", $ids) . ')';
        }


        $sub = SubCategory::model()->findByPk($_REQUEST['subcat_id']);

        if (isset($_REQUEST['size'])) {

            if ($sub) {

                $product_sizes = ProductSizes::model()->findAll(array('condition' => ' sizes_id ="' . $_REQUEST['size'] . '" and product_id in (select id from product where category_id = 6 and product_category_id = ' . $sub->productCategory->id . ')'));
            } elseif (isset($_REQUEST['cat_id'])) {
                $product_sizes = ProductSizes::model()->findAll(array('condition' => ' sizes_id ="' . $_REQUEST['size'] . '" and product_id in (select id from product where category_id = 6 and product_category_id = ' . $_REQUEST['cat_id'] . ')'));
            }

            if ($product_sizes) {
                foreach ($product_sizes as $product_size) {
                    $ids3[] = $product_size->product_id;
                }
            }

            if ($ids3) {
                $condition.= ' and id in (' . implode(",", $ids3) . ')';
            }

            if (empty($ids3)) { //there is a filteration by either the brand or the subcat and no result
                $condition.=' and 1=2';
            }
        }




        if (isset($_REQUEST['color'])) {

            if ($sub) {
                $product_colors = ProductColor::model()->findAll(array('condition' => 'colors_id ="' . $_REQUEST['color'] . '" and product_id in (select id from product where category_id = 6 and product_category_id = ' . $sub->productCategory->id . ')'));
            } elseif (isset($_REQUEST['cat_id'])) {
                $product_colors = ProductColor::model()->findAll(array('condition' => ' colors_id ="' . $_REQUEST['color'] . '" and product_id in (select id from product where category_id = 6 and product_category_id = ' . $_REQUEST['cat_id'] . ')'));
            }


            if ($product_colors) {
                foreach ($product_colors as $product_color) {
                    $ids4[] = $product_color->product_id;
                }
            }

            if ($ids4) {
                $condition.= ' and id in (' . implode(",", $ids4) . ')';
            }


            if (empty($ids4)) { //there is a filteration by either the brand or the subcat and no result
                $condition.=' and 1=2';
            }
        }



        /*
          $prods=Product::model()->findAll(array('condition'=>$condition));
         */
        //print_r($prods);die;
        $decortypes = DecorType::model()->findAll();
        $decorstyles = DecorStyle::model()->findAll();


        ///////////////////pagination/////////////////////////

        $criteria = new CDbCriteria();
        $criteria->condition = $condition;
        //echo  $criteria->condition;die;
        // $criteria->order=$order ;

        $count = Product::model()->count($criteria);
        $pages = new CPagination($count);

        // results per page
        $pages->pageSize = 20;
        $pages->applyLimit($criteria);
        $prods = Product::model()->findAll($criteria);

        ///////////////////////////////////////////////////////////////////  

        $brands = Brand::model()->findAll("category_id = 6");
        $users = User::model()->findAll('groups_id = 1 or groups_id = 4');



        $this->render('sub', array('decortypes' => $decortypes, 'decorstyles' => $decorstyles, 'prods' => $prods, 'count' => $count, 'pages' => $pages, 'style_id' => $style_id, 'type_id' => $type_id, 'brands' => $brands, "users" => $users));
    }

    public function actionDetails($id) {
        $review = new Review;
        $product = Product::model()->findByPk($id);
        $productdetails = ProductDetails::model()->find(array('condition' => 'product_id=' . $product->id));

        $revs = Review::model()->findAllByAttributes(array('product_id' => $product->id));
        //  print_r($revs);die;

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


        $decortypes = DecorType::model()->findAll();
        $decorstyles = DecorStyle::model()->findAll();


        $photos = GalleryPhoto::model()->findAllByAttributes(array('gallery_id' => $product->gallery_id));

        $colors = Colors::model()->findAll(array('condition' => ' id in (select colors_id from product_color where  product_id = ' . $id . ')'));
        $sizes = Sizes::model()->findAll(array('condition' => ' id in (select sizes_id from product_sizes where  product_id = ' . $id . ')'));


        $this->render('details', array('decortypes' => $decortypes, 'decorstyles' => $decorstyles, 'product' => $product, 'photos' => $photos, 'revs' => $revs, 'review' => $review, 'productdetails' => $productdetails, 'colors' => $colors, 'sizes' => $sizes));
    }

}
