<?php

class MotorController extends FrontController {

    public $layout = '//layouts/main';

    public function actionIndex() {
        $slides = CategorySlider::model()->findAll(array('condition' => 'category_id=5', 'order' => 'id desc'));
        $motormodels = MotorModel::model()->findAll();
        $makes = Make::model()->findAll();
        $gass = Gas::model()->findAll();
        $doors = Door::model()->findAll();
        $kmages = Kmage::model()->findAll();
        $ages = Age::model()->findAll();
        $emissions = Emission::model()->findAll();
        $engines = Engine::model()->findAll();
        $currntdate = date('Y-m-d');
        //$featured_products = Product::model()->findAll(array('condition'=>'category_id=5 and category_featured=1','limit'=>'3','order'=>'rand()'));
        $cond = 'category_id=5 and show_in_home_page=1  AND  product_status_id !=2';
        $cond.= ' and user_id IN (select id from user where payment_status =1 and end_subscrib_date > "' . $currntdate . '")';
      
        $products = Product::model()->findAll(array('condition' => $cond));
         
        $ads = Ads::model()->findAll("category_id =5 and main_ad != 1");

        $this->render('index', array('slides' => $slides, 'products' => $products, 'motormodels' => $motormodels, 'makes' => $makes, 'gass' => $gass, 'doors' => $doors, 'kmages' => $kmages, 'ages' => $ages, 'emissions' => $emissions, 'engines' => $engines
                ,"ads"=>$ads));
    }

    public function actionSearch() {

//        print_r($_REQUEST['Search']);
//        die;
        $mak = $mod = $nprice = $xprice = $gas = $dor = $mage = $ge = $emiss = $eng = $mot_1 = $mot_2 = $mot_3 = "";
        $cond = 'category_id=5  AND  product_status_id !=2';
        if (!empty($_REQUEST['Search']['make'])) { //must find the product main category in order to set the left filters
            //  echo "test";die;
            $mak = $_REQUEST['Search']['make'];
            $cond.= ' and id IN (select product_id from product_details where make_id=' . $_REQUEST['Search']['make'] . ')';
        }
        if (!empty($_REQUEST['Search']['model'])) { //must find the product main category in order to set the left filters
            $mod = $_REQUEST['Search']['model'];
            $cond.= ' and id IN (select product_id from product_details where motor_model_id=' . $_REQUEST['Search']['model'] . ')';
        }
        if (!empty($_REQUEST['Search']['min_price'])) { //must find the product main category in order to set the left filters
            $nprice = $_REQUEST['Search']['min_price'];
            $cond.= ' and price>=' . $_REQUEST['Search']['min_price'];
        }
        if (!empty($_REQUEST['Search']['max_price'])) { //must find the product main category in order to set the left filters
            $xprice = $_REQUEST['Search']['max_price'];

            $cond.= ' and price<=' . $_REQUEST['Search']['max_price'];
        }
        if ($_REQUEST['cat_id']) { //must find the product main category in order to set the left filters
            // echo "test";die;
            $cond.= ' and product_category_id=' . $_REQUEST['cat_id'];
        }
        if ($_REQUEST['Search']['gas']) { //must find the product main category in order to set the left filters

            $gas = $_REQUEST['Search']['gas'];

            // echo $_REQUEST['Search']['gas'];die;
            $cond.= ' and id IN (select product_id from product_details where gas_id=' . $_REQUEST['Search']['gas'] . ')';
        }
        if ($_REQUEST['Search']['door']) { //must find the product main category in order to set the left filters

            $dor = $_REQUEST['Search']['door'];

            // echo "test";die;
            $cond.= ' and id IN (select product_id from product_details where door_id=' . $_REQUEST['Search']['door'] . ')';
        }
        if ($_REQUEST['Search']['kmage']) { //must find the product main category in order to set the left filters
            $mage = $_REQUEST['Search']['kmage'];

            // echo "test";die;
            $cond.= ' and id IN (select product_id from product_details where kmage_id=' . $_REQUEST['Search']['kmage'] . ')';
        }
        if ($_REQUEST['Search']['age']) { //must find the product main category in order to set the left filters

            $ge = $_REQUEST['Search']['age'];

            // echo "test";die;
            $cond.= ' and id IN (select product_id from product_details where age_id=' . $_REQUEST['Search']['age'] . ')';
        }
        if ($_REQUEST['Search']['emission']) { //must find the product main category in order to set the left filters
            $emiss = $_REQUEST['Search']['emission'];

            // echo "test";die;
            $cond.= ' and id IN (select product_id from product_details where emission_id=' . $_REQUEST['Search']['emission'] . ')';
        }
        if ($_REQUEST['Search']['engine']) { //must find the product main category in order to set the left filters
            $eng = $_REQUEST['Search']['engine'];

            // echo "test";die;
            $cond.= ' and id IN (select product_id from product_details where engine_id=' . $_REQUEST['Search']['engine'] . ')';
        }
//        $arr=array();
//        $k=0;

        if ($_REQUEST['Search']['motor_status1']) { //must find the product main category in order to set the left filters
            $mot_1 = $_REQUEST['Search']['motor_status1'];

            // echo $_REQUEST['Search']['motor_status1'];die;
//                 die;
            $cond.= ' and id IN (select product_id from product_details where motor_status=' . $_REQUEST['Search']['motor_status1'] . ')';
            // $arr[$k]=$_REQUEST['Search']['motor_status1'];
//$k++;
        }
        if ($_REQUEST['Search']['motor_status2']) { //must find the product main category in order to set the left filters
            $mot_2 = $_REQUEST['Search']['motor_status2'];

//           echo $_REQUEST['Search']['motor_status2'];die;
            $cond.= ' and id IN (select product_id from product_details where motor_status=' . $_REQUEST['Search']['motor_status2'] . ')';
//       $arr[$k]=$_REQUEST['Search']['motor_status2'];
//$k++;
        }
        if ($_REQUEST['Search']['motor_status3']) { //must find the product main category in order to set the left filters
            $mot_3 = $_REQUEST['Search']['motor_status3'];

//           echo $_REQUEST['Search']['motor_status1'] ;  
//          echo $_REQUEST['Search']['motor_status2'] ;  
//             echo $_REQUEST['Search']['motor_status3'] ;  die;
            $cond.= ' and id IN (select product_id from product_details where motor_status=' . $_REQUEST['Search']['motor_status3'] . ')';
            //echo $cond;die;
            //$arr[$k]=$_REQUEST['Search']['motor_status3'];
        }
        if (!empty($_REQUEST['Search']['power_engine'])) { //must find the product main category in order to set the left filters
            $cond.= ' and id IN (select product_id from product_details where power_engine=' . $_REQUEST['Search']['power_engine'] . ')';
        }
        $currntdate = date('Y-m-d');
        $cond.= ' and user_id IN (select id from user where payment_status =1 and end_subscrib_date > "' . $currntdate . '")';
//         echo $_REQUEST['Search']['motor_status1'] ;  
//          echo $_REQUEST['Search']['motor_status2'] ;  
//           echo $_REQUEST['Search']['motor_status3'] ;  die;
        //  echo '<pre>';
        //print_r($arr);
        /// echo '</pre>';
        // if(!empty($arr))
        // $cond.=' And id in (select product_id from product_details where motor_status in '.$arr(); 
        // echo $cond;die;


        /*
          $products=Product::model()->findAll(array('condition'=>$cond,'order'=>'id desc'));
          $count=count($products);
          $pages = new CPagination($count);
          $pages->pageSize = 9;
         */

        // echo $cond;die;
        ///////////////////pagination/////////////////////////

        $criteria = new CDbCriteria();
        $criteria->condition = $cond;
        $criteria->order = 'id desc';

        $count = Product::model()->count($criteria);
        $pages = new CPagination($count);

        // results per page
        $pages->pageSize = 15;
        $pages->applyLimit($criteria);
        $products = Product::model()->findAll($criteria);

        //print_r($products);die;
        ///////////////////////////////////////////////////////////////////  




        $gass = Gas::model()->findAll();
        $doors = Door::model()->findAll();
        $kmages = Kmage::model()->findAll();
        $ages = Age::model()->findAll();
        $emissions = Emission::model()->findAll();
        $engines = Engine::model()->findAll();
        $motormodels = MotorModel::model()->findAll();

        $makes = Make::model()->findAll();
        $this->render('search', array('products' => $products, 'count' => $count, 'pages' => $pages, 'makes' => $makes, 'motormodels' => $motormodels, 'gass' => $gass, 'doors' => $doors, 'kmages' => $kmages, 'ages' => $ages, 'emissions' => $emissions, 'engines' => $engines, 'mak' => $mak, 'mod' => $mod, 'nprice' => $nprice, 'xprice' => $xprice, 'gas' => $gas, 'dor' => $dor, 'mage' => $mage, 'ge' => $ge, 'emiss' => $emiss, 'eng' => $eng, 'mot_1' => $mot_1, 'mot_2' => $mot_2, 'mot_3' => $mot_3));
    }

    public function actionItem() {
        $review = new Review;
        $message = new Message;
        $id = $_REQUEST['id'];
        $product = Product::model()->findByPk($id);
        $slides = CategorySlider::model()->findAll(array('condition' => 'category_id=5', 'order' => 'id desc'));
        $sizes = Size::model()->findAllByAttributes(array('product_id' => $id));
        $photos = GalleryPhoto::model()->findAllByAttributes(array('gallery_id' => $product->gallery_id));
        $newarrivalsproducts = Product::model()->findAll(array('condition' => 'category_id=5'));
        if (!empty($product->product_category_id))
            $newarrivalsproducts = Product::model()->findAll(array('condition' => 'category_id=5 and product_category_id=' . $product->product_category_id . ' and id!=' . $id . '', 'limit' => '6', 'order' => 'id desc'));
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
        if (isset($_POST['Message'])) {
            $userid = Yii::app()->user->id;
            if ($userid != '') {
                //print_r($_POST['Review']);die;

                $message->attributes = $_POST['Message'];
                $message->title = 'Purchase product ' . $product->title;
                $message->reciever_id = $product->user_id;
                $message->product_id = $product->id;
                $message->sender_id = $userid;
               // $message->message_date = date('Y-m-d');

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
        $motormodels = MotorModel::model()->findAll();
        $makes = Make::model()->findAll();
        $gass = Gas::model()->findAll();
        $doors = Door::model()->findAll();
        $kmages = Kmage::model()->findAll();
        $ages = Age::model()->findAll();
        $emissions = Emission::model()->findAll();
        $engines = Engine::model()->findAll();
        $products = Product::model()->findAll(array('condition'=>'category_id=5'));
//        if(!empty($product->product_category_id))
//        $products = Product::model()->findAll(array('condition'=>'category_id=10 and product_category_id='.$product->category_id));

        $this->render('item', array('product' => $product, 'sizes' => $sizes, 'reviews' => $reviews, 'message' => $message, 'arrivals' => $newarrivalsproducts, 'photos' => $photos, 'revs' => $revs, 'count' => $count, 'review' => $review, 'sub' => $sub, 'makes' => $makes, 'motormodels' => $motormodels, 'gass' => $gass, 'doors' => $doors, 'kmages' => $kmages, 'ages' => $ages, 'emissions' => $emissions, 'engines' => $engines,'products'=>$products,'slides'=>$slides));
    }

    public function actionGetmodel() {
       // echo"test";die;
        $id = $_REQUEST['id'];
        $motormodls = MotorModel::model()->findAllByAttributes(array('make_id' => $id));
        $selest = '<select class="form-control" name="Search[model]">';
        foreach ($motormodls as $motormodel) {
            $selest.='<option value=' . $motormodel->id . '>' . $motormodel->title . '</option>';
        }
        $selest.='</select>';
        echo $selest;die;
    }

}
