<?php

class UsersController extends FrontController {

    public function actions() {
        return array(
            'yiichat' => array('class' => 'YiiChatAction'),
        );
    }

    public function actionIndex() {
        $user = new User;
        $userid = Yii::app()->user->id;
        if ($userid != '') {
            $user = User::model()->findByPk($userid);
            $userdetails = UserDetails::model()->findByAttributes(array('user_id' => $userid));
            $this->render('dashboard', array('user' => $user, 'userdetails' => $userdetails));
        } else {
            $this->redirect(array('home/confirm/flag/3'));
        }
    }

    /**
     * This is the action to handle external exceptions.
     */
    public function actionError() {
        if ($error = Yii::app()->errorHandler->error) {
            if (Yii::app()->request->isAjaxRequest)
                echo $error['message'];
            else
                $this->render('error', $error);
        }
    }

//    public function loadModel($model_name, $id) {
//        $model = $model_name::model()->findByPk($id);
//        if ($model === null)
//            throw new CHttpException(404, 'The requested page does not exist.');
//        return $model;
//    }


    public function actionDashboard() {
        $user = new User;
        $userid = Yii::app()->user->id;
        if ($userid != '') {
            $user = User::model()->findByPk($userid);
            $userdetails = UserDetails::model()->findByAttributes(array('user_id' => $userid));
            $this->render('dashboard', array('user' => $user, 'userdetails' => $userdetails));
        } else {
            $this->redirect(array('home/confirm/flag/3'));
        }
    }

    public function actionEditProfile() {
        $userid = Yii::app()->user->id;
        $save_passowrd = true;
        if ($userid != '') {
            $model = User::model()->findByPk($userid);
            $user_details = UserDetails::model()->findByAttributes(array('user_id' => $userid));
            if (isset($_POST['User'])) {
                if ($model->image != '') {
                    $_POST['User']['image'] = $model->image;
                }
                if ($user_details->shop_image != '') {
                    $_POST['UserDetails']['shop_image'] = $user_details->shop_image;
                }

                $model->attributes = $_POST['User'];
                $user_details->attributes = $_POST['UserDetails'];
                //$user_details->shop_address=$_POST['UserDetails']['shop_address'];
                //  echo $user_details->shop_address;die;
                $savedpass = $validatepass = 0;
                // echo 'fff'.$_POST['User']['oldpassword'];die;
                if ($_POST['User']['oldpassword'] != '') {
                    $save_passowrd = false;
                    $savedpass = $model->password;
                    $validatepass = $model->hash($_POST['User']['oldpassword']);
                    if ($savedpass == $validatepass) {
                        $save_passowrd = true;
                        $model->password = User::simple_encrypt($_POST['User']['newpassword']);
                    } else {
                        Yii::app()->user->setFlash('update-error', 'Sorry the new entered password does not match the old one');
                    }
                }


                $rnd1 = rand(0, 9999);  // generate random number between 0-9999
                $uploadedFile1 = CUploadedFile::getInstance($user_details, 'shop_image');

                if (!empty($uploadedFile1)) {
                    $fileName1 = "{$rnd1}-{$uploadedFile1}";  // random number + file name
                    $user_details->shop_image = $fileName1;
                    $uploadedFile1->saveAs(Yii::app()->basePath . '/../media/shop/' . $user_details->shop_image);
                }
                $rnd = rand(0, 9999);
                $uploadedFile = CUploadedFile::getInstance($model, 'image');
                if (!empty($uploadedFile)) {
                    $fileName = "{$rnd}-{$uploadedFile}";  // random number + file name
                    $model->image = $fileName;
                    $uploadedFile->saveAs(Yii::app()->basePath . '/../media/members/' . $model->image);
                }
                //   $model->password = $model->password_repeat=$model->simple_decrypt($model->password);
                if ($save_passowrd == true) {
                    if ($model->save()) {
                        $user_details->save(False);
                        Yii::app()->user->setFlash('update-success', 'Your information has been Updated Successfully.');
                        //$this->render('dashboard', array('user' => $model, 'userdetails' => $user_details));
                    } else {
                        Yii::app()->user->setFlash('update-error', 'Please complete your information correctly.');
                    }
                }
            }
            $this->render('editprofile', array(
                'model' => $model, 'user_details' => $user_details
            ));
        } else {
            $this->redirect(array('home/confirm/flag/3'));
        }
    }

    public function actionDeleteproudct($id) {



        $product = Product::model()->findByAttributes(array('id' => $id));
        $product->product_status_id = 2;
        $product->save(false);
//        ProductDetails::model()->deleteAll(array('condition' => 'product_id=' . $id));
//        Color::model()->deleteAll(array('condition' => 'product_id=' . $id));
//        Size::model()->deleteAll(array('condition' => 'product_id=' . $id));
//        Product::model()->deleteAll(array('condition' => 'id=' . $id));
        $this->redirect(array('users/allproduct'));
    }

    public function actionServices() {
        $userid = Yii::app()->user->id;
        if ($userid != '') {
            $model = User::model()->findByPk($userid);
            // $user_details = UserDetails::model()->findByAttributes(array('user_id' => $userid));
            if (isset($_POST['User'])) {
                if (!empty($_POST['User']['fee_package_id'])) {
                    $model->attributes = $_POST['User'];
                    $model->payment_status = 0;
                    if ($model->save(false)) {
                        Yii::app()->user->setFlash('upgrade-success', 'Congratulation! you upgrade your package successfully.');
                        $this->redirect(array('checkout'));
                    }
                }
//                if(!empty($_POST['User']['ads_number'])){
//                $this->redirect(array('users/buy/'.$_POST['User']['ads_number']));
//                }
            }
            $this->render('services', array(
                'model' => $model,
                    // 'user_details' => $user_details,
            ));
        } else {
            $this->redirect(array('home/confirm/flag/3'));
        }
    }

    public function actionBuy() {
        $userid = Yii::app()->user->id;
        if (!empty($userid)) {
            $user = User::model()->findByPk($userid);
            if (empty($user->fee_package_id))
                $this->redirect(array('users/services'));
            $package = FeePackage::model()->findByPk($user->fee_package_id);
            $total = $package->monthly_fee;
            //$url=Helper::PaypalExpress($total, 0,'home/feeconfirm/','home/feecancel/');
            //echo Yii::app()->getBaseUrl(true);
            $confirm = Yii::app()->getBaseUrl(true) . '/home/Feeconfirm';
            $cancel = Yii::app()->getBaseUrl(true) . '/home/Feecancel';
            $url = Helper::PaypalExpress($total, 0, $confirm, $cancel);
            if ($url['url']) {
                $model = new Paymentfee;
                $model->price = $total;
                $model->fee_package_id = $package->id;
                $model->user_id = Yii::app()->user->id;
                $model->payment_status = 0; //pending
                $model->date = date('Y-m-d');
                $model->buyer_id = Yii::app()->user->id;
                $model->token = $url['token'];
                $model->save(false);
                $this->redirect($url['url']);
            } else {
                throw new CHttpException(404, 'Sorry Paypal Reuqest has been failed! try again later.');
            }
        } else {
            $this->redirect(array('home/confirm/flag/3'));
        }
    }

///payment

    public function actionCheckOut() {
        $user = new User;
        $userid = Yii::app()->user->id;
        if ($userid != '') {
            $user = User::model()->findByPk($userid);
            $this->render('checkout', array('user' => $user));
        } else {
            $this->render('../home/loginFirst');
        }
    }

    public function actionThanks($survey) {
        $survey = Surveys::model()->findByPk(array("id" => $survey));
        $this->render('thanks', array('survey' => $survey));
    }

    public function actionDeleteimage1($id) {
        if ($id != '') {
            $criteria = new CDbCriteria;
            $criteria->condition = 'user_id=' . $id;
            $user_details = UserDetails::model()->findAll($criteria);


            @unlink(Yii::app()->basePath . '/../media/shop/' . $user_details->shop_image);
            $dele = UserDetails::model()->updateByPk($id, array('shop_image' => ''));
            echo "done";
        }
    }

    public function actionDeleteimage($id) {
        if ($id != '') {
            $criteria = new CDbCriteria;
            $criteria->condition = 'id=' . $id;
            $model = Product::model()->findAll($criteria);
            @unlink(Yii::app()->basePath . '/../media/product/' . $model->main_image);
            $dele = Product::model()->updateByPk($id, array('main_image' => ''));
            echo "done";
        }
    }

    public function actionIsertGallery() {
        $products = Product::model()->findAll();
        foreach ($products as $product) {
            $gallery_ob = new Gallery();
            $gallery_ob->name = true;
            $gallery_ob->description = true;
            $gallery_ob->versions = array(
                'small' => array(
                    'resize' => array(200, null),
                ),
                'medium' => array(
                    'resize' => array(800, null),
                )
            );
            $gallery_ob->save();
            $product->gallery_id = $gallery_ob->id;
            $product->save(false);
        }
    }

    public function actionAddProduct() {
        $userid = Yii::app()->user->id;
        if ($userid != '') {
            $user = User::model()->findByAttributes(array('id' => Yii::app()->user->id));
            if ($user->groups_id == 1 or $user->groups_id == 4) {
                $model = new Product;
                $productdetails = new ProductDetails;
                $gallery_ob = new Gallery();
                // Uncomment the following line if AJAX validation is needed
                // $this->performAjaxValidation($model);
                $gallery_ob->name = true;
                $gallery_ob->description = false;
                //$gallery->min_height = 1280;
                //$gallery->min_width = 854;
                $gallery_ob->versions = array(
                    'large' => array(
                        'resize' => array(1280, 854),
                    ),
                    'medium' => array(
                        'resize' => array(600, 400),
                    ),
                    'small' => array(
                        'resize' => array(100, 67),
                    )
                );
                $gallery_ob->save();
                $model->user_id = Yii::app()->user->id;

                if (isset($_POST['Product'])) {
                    $model->attributes = $_POST['Product'];
//                    echo '<pre>';
//                    print_r($model) ;
//                    echo '</pre>';
                    //$productdetails->attributes = $_POST['ProductDetails'];
                    $model->gallery_id = $gallery_ob->id;
                    $rnd = rand(0, 9999);  // generate random number between 0-9999
                    $uploadedFile = CUploadedFile::getInstance($model, 'main_image');

                    if (!empty($uploadedFile)) {
                        $fileName = "{$rnd}-{$uploadedFile}";  // random number + file name
                        //  echo $fileName;die;
                        $model->main_image = $fileName;
                        //echo  $model->main_image;die;
                        $uploadedFile->saveAs(Yii::app()->basePath . '/../media/product/' . $fileName);
                    }

                    if ($model->category_id == 2 or $model->category_id == 5 or $model->category_id == 10) {
                        $model->type = 1;
                        $cuurntdate = date('Y-m-d');
//                        echo strtotime($user->end_subscrib_date).'-';
//                         echo strtotime($cuurntdate);die;
//                         print_r($user);
//                         echo $user->payment_status ;die;
                        if ($user->ads_number == 0 or $user->payment_status == 0 or $user->end_subscrib_date < $cuurntdate) {
                            $this->redirect(array('home/confirm/flag/8'));                                                                           // echo "test";die;          
                        }
                    }


                    if ($model->category_id == 9 AND $model->type == 1) { // lifestyle
                        $cuurntdate = date('Y-m-d');
                        $user = User::model()->findByPk(Yii::app()->user->id);
                        if ($user->ads_number == 0 or $user->payment_status == 0 or $user->end_subscrib_date > $cuurntdate) {


                            $this->redirect(array('home/confirm/flag/8'));                                                                           // echo "test";die;          
                        }
                    }

                    //save as product
                    if ($model->category_id == 1 or $model->category_id == 3 or $model->category_id == 4 or $model->category_id == 6 or $model->category_id == 7 or $model->category_id == 8) {
                        $model->type = 0;
                    }


                    if ($model->save()) {
                        $productdetails->product_id = $model->id;
                        $productdetails->save(FALSE);
                        if ($model->type == 1)
                            $user->ads_number = $user->ads_number - 1;
                        $user->save(FALSE);
                        Yii::app()->user->setFlash('success', 'Your product has been added Successfully please complete its details.');

                        $this->redirect(array('addProductDetails', 'id' => $model->id));
                    } else {
                        Yii::app()->user->setFlash('add-error', 'Product cant be created ');
                        $this->redirect(array('addproduct'));
                    }
                }
                $sellers = User::model()->findAll("groups_id = 4");
                
                
                //trade doubler
                
                     require Yii::app()->basePath . '/extensions/TradeDoublerPOAPI.php';

                $api = new TradeDoublerPOAPI();
                $query_keys = array(
                );

                $response = $api->GetCategories($query_keys);
                $trade_cats = $api->unserializeJson($response);
                $trade_cats = $trade_cats['categoryTrees'][0]['subCategories'];

                
                //zanox
                
        require_once Yii::app()->basePath.'/extensions/zanox/ApiClient.php';
         $api = ApiClient::factory();
         $api = ApiClient::factory(PROTOCOL_JSON, VERSION_DEFAULT);
          $connectId = '02542D54D738FFC15738';
       $secretKey = '1924b91739b94f+bb2035a75312021/36d622447';

       $api->setConnectId($connectId);
       $api->setSecretKey($secretKey);
     
        $zanox_cats = json_decode($api->getProgramCategories());
        
        $zanox_cats =  $zanox_cats->categories[0]->category;
//        echo '<pre>';print_r($zanox_cats); echo '<pre>';die;
        
                $this->render('addproduct', array('model' => $model, 'gallery' => $gallery_ob, "sellers" => $sellers,
                'trade_cats'=>$trade_cats ,'zanox_cats'=>$zanox_cats));
            } else {
                $this->redirect(array('home/index'));
            }
        } else {
            $this->redirect(array('home/confirm/flag/3'));
        }
    }

    public function actionaddProductDetails($id) {
        $userid = Yii::app()->user->id;
        if ($userid != '') {
            $model = $this->loadModel($id);
            $catid = $model->category_id;
            $type = $model->type;
            $model_col = new ProductColor();
            $model_siz = new ProductSizes();
            $productdetails = ProductDetails::model()->findByAttributes(array('product_id' => $id));
            $sizees = Sizes::model()->findAllByAttributes(array('category_id' => 3));
            $decor_sizees = Sizes::model()->findAllByAttributes(array('category_id' => 6));

            if (isset($_POST['Product'])) {
                if ($model->main_image != '') {
                    $_POST['Product']['main_image'] = $model->main_image;
                }
                $model->attributes = $_POST['Product'];
                $productdetails->attributes = $_POST['ProductDetails'];
                if ($model->save()) {
                    $productdetails->product_id = $model->id;
                    $productdetails->save(False);
                    if (isset($_POST['ProductColor'])) {

                        // print_r ($_POST['ProductColor']);die;
                        for ($i = 0; $i < count($_POST['ProductColor']['colors_id']); $i++) {
                            $model_col = new ProductColor;
                            //   echo $_POST['ProductColor']['colors_id'][$i];die;
                            $model_col->colors_id = $_POST['ProductColor']['colors_id'][$i];
                            //  echo $model_col->colors_id ;die;
                            $model_col->product_id = $model->id;

                            if (!$model_col->save(false)) {
                                throw new CHttpException(400, 'DataBase Error Please Try Again Later.');
                            }
                        }
                    }
                    // if ($catid == 1 or $catid == 4 or $catid == 8) {
                    if (isset($_POST['ProductSizes'])) {

                        // print_r ($_POST['ProductSizes']);die;
                        for ($i = 0; $i < count($_POST['ProductSizes']['sizes_id']); $i++) {
                            $model_siz = new ProductSizes;
                            //   echo $_POST['ProductSizes']['sizes_id'][$i];die;
                            $model_siz->sizes_id = $_POST['ProductSizes']['sizes_id'][$i];
                            //  echo $model_siz->sizes_id ;die;
                            $model_siz->product_id = $model->id;

                            if (!$model_siz->save(false)) {
                                throw new CHttpException(400, 'DataBase Error Please Try Again Later.');
                            }
                        }
                    }
                    //   }
                    if ($catid == 3) {
                        $i = 0;
//                          echo '<pre>';
//                   print_r($_POST['product']);
//                    echo '</pre>';
//                        die;
                        foreach ($_POST['product'] as $sizes) {
                            $size = new Size();
                            $size->product_id = $model->id;
                            $size->type = 0;
//                            echo '<pre>';
//                            echo  $_POST['product']['size'][$i];
//                            echo '</pre>';die;
                            $size->size_id = $_POST['product']['size'][$i];

                            $sizee = Sizes::model()->findByAttributes(array('id' => $size->size_id));
                            $size->title = $sizee->title;
                            $size->price = $_POST['product']['price'][$i];
                            $size->quantity = $_POST['product']['quantity'][$i];
                            // echo  $size->title;die;
                            if (!empty($size->product_id) and ! empty($size->title)) {
                                $size->save(false);
                            }
                            $i++;
                        }
                    }
                    if ($catid == 2) {
                        $i = 0;
                        foreach ($_POST['room'] as $rooms) {
                            $room = new Room();
                            $room->product_id = $model->id;
                            $room->room_options = $_POST['room']['roomoptions'][$i];
                            $room->bed_options = $_POST['room']['bedoptions'][$i];
                            $room->adult_price = $_POST['room']['adultprice'][$i];
                            $room->children_price = $_POST['room']['childrenprice'][$i];
                            $room->infant_price = $_POST['room']['infantprice'][$i];
                            if (!empty($room->product_id) and ! empty($room->room_options)) {
                                $room->save(false);
                            }
                            $i++;
                        }
                    }
                    Yii::app()->user->setFlash('success2', 'Your product details has been added Successfully.');
                    $this->redirect(array('users/allProduct/id/' . $model->id));
                } else {
                    Yii::app()->user->setFlash('add-error', 'Something error, please complete  the required fields.');
                }
            }
            $gallery = Gallery::model()->findByPk($model->gallery_id);

            if ($catid == 1) {
                $this->render('clothesdetails', array('model' => $model, 'gallery' => $gallery, 'productdetails' => $productdetails, 'model_col' => $model_col, 'model_siz' => $model_siz));
            }
            if ($catid == 2) {
                $this->render('traveldetails', array('model' => $model, 'gallery' => $gallery, 'productdetails' => $productdetails));
            }
            if ($catid == 3) {
                $this->render('cosmeticdetails', array('model' => $model, 'gallery' => $gallery, 'productdetails' => $productdetails, 'sizees' => $sizees));
            }
            if ($catid == 4) {
                $this->render('jewlerydetails', array('model' => $model, 'gallery' => $gallery, 'productdetails' => $productdetails, 'model_siz' => $model_siz));
            }
            if ($catid == 5) {
                $this->render('motordetails', array('model' => $model, 'gallery' => $gallery, 'productdetails' => $productdetails, 'type' => $type, 'model_col' => $model_col, 'model_siz' => $model_siz));
            }
            if ($catid == 6) {
                $this->render('homedecordetails', array('model' => $model, 'gallery' => $gallery, 'productdetails' => $productdetails, 'model_col' => $model_col, 'model_siz' => $model_siz, 'sizees' => $decor_sizees));
            }
            if ($catid == 7) {
                $this->render('electronicsdetails', array('model' => $model, 'gallery' => $gallery, 'productdetails' => $productdetails, 'model_col' => $model_col));
            }
            if ($catid == 8) {
                $this->render('kidsdetails', array('model' => $model, 'gallery' => $gallery, 'productdetails' => $productdetails, 'model_col' => $model_col, 'model_siz' => $model_siz));
            }
            if ($catid == 9) {
                $this->render('lifestyledetails', array('model' => $model, 'gallery' => $gallery, 'productdetails' => $productdetails, 'type' => $type));
            }
            if ($catid == 10) {
                $this->render('realstatedetails', array('model' => $model, 'gallery' => $gallery, 'productdetails' => $productdetails));
            }
        } else {
            $this->redirect(array('home/confirm/flag/3'));
        }
    }

    public function actionEditproduct($id) {

        $userid = Yii::app()->user->id;
        if ($userid != '') {

            $model = $this->loadModel($id);
            $productdetails = ProductDetails::model()->findByAttributes(array('product_id' => $model->id));
            //echo "test";die;
            $criteria5 = new CDbCriteria;
            $criteria5->condition = 'product_id=' . $id;
            $model_col = new ProductColor;
            $colors = ProductColor::model()->findAll($criteria5);
            foreach ($colors as $color) {
                $arr_col[] = $color->colors_id;
            }
            $model_col->colors_id = $arr_col;


            $model_siz = new ProductSizes;
            $sizes = ProductSizes::model()->findAll($criteria5);
            foreach ($sizes as $size) {
                $arr_siz[] = $size->sizes_id;
            }
            $model_siz->sizes_id = $arr_siz;

            $catid = $model->category_id;

            $type = $model->type;

            if (isset($_POST['Product'])) {
                if ($model->main_image != '') {
                    $_POST['Product']['main_image'] = $model->main_image;
                }
                $model->attributes = $_POST['Product'];
                $productdetails->attributes = $_POST['ProductDetails'];

                $rnd = rand(0, 9999);  // generate random number between 0-9999
                $uploadedFile = CUploadedFile::getInstance($model, 'main_image');

                if (!empty($uploadedFile)) {
                    $fileName = "{$rnd}-{$uploadedFile}";  // random number + file name
                    $model->main_image = $fileName;
                    $uploadedFile->saveAs(Yii::app()->basePath . '/../media/product/' . $fileName);
                }
                if ($model->save()) {
                    $productdetails->product_id = $model->id;
                    $productdetails->save(False);
                    if ($catid == 2) {
                        $rooms_counts = count($_POST['room']['roomoptions']);
                    }
                    if ($catid == 3) {
                        $sizes_counts = count($_POST['product']['size']);
                    }


                    if ($catid == 2 and $rooms_counts != 0) {
                        // die;

                        Room::model()->deleteAll(array('condition' => 'product_id=' . $model->id));

                        //$count=count()
                        for ($i = 0; $i < $rooms_counts; $i++) {
                            $room = new Room();
                            $room->product_id = $model->id;
                            $room->room_options = $_POST['room']['roomoptions'][$i];
                            $room->bed_options = $_POST['room']['bedoptions'][$i];
                            $room->adult_price = $_POST['room']['adultprice'][$i];
                            $room->children_price = $_POST['room']['childrenprice'][$i];
                            $room->infant_price = $_POST['room']['infantprice'][$i];
                            if (!empty($room->product_id) and ! empty($room->room_options)and ! empty($room->adult_price)and ! empty($room->children_price) and ! empty($room->infant_price)) {
                                $room->save(false);
                            }
                        }
                    }

                    ProductColor::model()->deleteAll(array('condition' => 'product_id=' . $model->id));
                    //  echo "test";die;
                    if (isset($_POST['ProductColor'])) {
                        // print_r ($_POST['ProductColor']);die;
                        for ($i = 0; $i < count($_POST['ProductColor']['colors_id']); $i++) {
                            $model_col = new ProductColor;
                            // echo $_POST['ProductColor']['colors_id'][$i];die;
                            $model_col->colors_id = $_POST['ProductColor']['colors_id'][$i];
                            // echo  $model_col->colors_id;die;
                            $model_col->product_id = $model->id;

                            if (!$model_col->save(false)) {
                                throw new CHttpException(400, 'DataBase Error Please Try Again Later.');
                            }
                        }
                    }
                    if ($catid == 4 or $catid == 1 or $catid == 8) {

                        ProductSizes::model()->deleteAll(array('condition' => 'product_id=' . $model->id));
//echo "test";die;
                        if (isset($_POST['ProductSizes'])) {
                            // print_r ($_POST['ProductSizes']);die;
                            for ($i = 0; $i < count($_POST['ProductSizes']['sizes_id']); $i++) {
                                $model_siz = new ProductSizes;
                                // echo $_POST['ProductSizes']['sizes_id'][$i];die;
                                $model_siz->sizes_id = $_POST['ProductSizes']['sizes_id'][$i];
                                //echo  $model_siz->sizes_id;die;
                                $model_siz->product_id = $model->id;

                                if (!$model_siz->save(false)) {
                                    throw new CHttpException(400, 'DataBase Error Please Try Again Later.');
                                }
                            }
                        }
                    }

                    if ($catid == 3) {
                        //print_r( $_POST['product']['size'])  ; die ; 
                        Size::model()->deleteAll(array('condition' => 'product_id=' . $model->id));
                        $i = 0;
                        // print_r( $_POST['product']['size'])  ; die ; 
                        if (!empty($_POST['product']['size'])) {

                            foreach ($_POST['product'] as $sizes) {
                                $size = new Size();
                                $size->product_id = $model->id;
                                $size->type = 0;
                                $size->size_id = $_POST['product']['size'][$i];
                                $sizee = Sizes::model()->findByAttributes(array('id' => $size->size_id));
                                $size->title = $sizee->title;
                                $size->price = $_POST['product']['price'][$i];
                                $size->quantity = $_POST['product']['quantity'][$i];
                                //  echo $size->price;die;
                                if (!empty($size->product_id) and ! empty($size->title)) {
                                    $size->save(false);
                                }
                                $i++;
                            }
                        }
                    }
                    Yii::app()->user->setFlash('updated-success', 'Your product has been updated successfully.');
                    $this->redirect(array('allproduct', 'id' => $model->id));
                } else {
                    Yii::app()->user->setFlash('add-error', 'Something error, please complete  the required fields.');
                }
            }



            $gallery = Gallery::model()->findByPk($model->gallery_id);
            if ($catid == 1) {
                $this->render('clothesdetails', array('model' => $model, 'gallery' => $gallery, 'productdetails' => $productdetails, 'model_col' => $model_col, 'model_siz' => $model_siz));
            }
            if ($catid == 2) {
                $this->render('traveldetails', array('model' => $model, 'gallery' => $gallery, 'productdetails' => $productdetails));
            }
            if ($catid == 3) {
                $this->render('cosmeticdetails', array('model' => $model, 'gallery' => $gallery, 'productdetails' => $productdetails, 'size' => $sizes));
            }
            if ($catid == 4) {
                $this->render('jewlerydetails', array('model' => $model, 'gallery' => $gallery, 'productdetails' => $productdetails, 'model_siz' => $model_siz));
            }
            if ($catid == 5) {
                $this->render('motordetails', array('model' => $model, 'gallery' => $gallery, 'productdetails' => $productdetails, 'type' => $type, 'model_col' => $model_col));
            }
            if ($catid == 6) {
                $this->render('homedecordetails', array('model' => $model, 'gallery' => $gallery, 'productdetails' => $productdetails, 'model_col' => $model_col, 'model_siz' => $model_siz));
            }
            if ($catid == 7) {
                $this->render('electronicsdetails', array('model' => $model, 'gallery' => $gallery, 'productdetails' => $productdetails, 'model_col' => $model_col));
            }
            if ($catid == 8) {
                $this->render('kidsdetails', array('model' => $model, 'gallery' => $gallery, 'productdetails' => $productdetails, 'model_col' => $model_col, 'model_siz' => $model_siz));
            }
            if ($catid == 9) {
                $this->render('lifestyledetails', array('model' => $model, 'gallery' => $gallery, 'productdetails' => $productdetails, 'type' => $type));
            }
            if ($catid == 10) {
                $this->render('realstatedetails', array('model' => $model, 'gallery' => $gallery, 'productdetails' => $productdetails));
            }
//        $this->render('update', array(
//            'model' => $model,
//            'colors' => $colors,
//            'sizes' => $sizes,
//            'cat_id' => $cat_id,
//            'gallery' => $gallery,
//            'productdetails' => $productdetails,
//            'rooms' => $rooms,
//        ));
        } else {
            $this->redirect(array('home/confirm/flag/3'));
        }
    }

    public function loadModel($id) {
        $model = Product::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    public function loadproductdetails($product_id) {


        $productdetails = ProductDetails::model()->findByAttributes(array('product_id' => $product_id));

        if ($productdetails === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $productdetails;
    }

    public function actiongetModels() {
        $model = new Product;
        $make_id = $_POST['make_id'];
        $criteria = new CDbCriteria;
        $criteria->condition = 'make_id=:MakeID';
        $criteria->params = array(':MakeID' => $make_id);
        //$criteria->order = 'id DESC';
        $mot = MotorModel::model()->findAll($criteria);
        //$data=CHtml::listData($sub,'id','title');
        echo $data = CHtml::dropDownList('ProductDetails[motor_model_id]', 'motor_model_id', CHtml::listData($mot, 'id', 'title'), array('class' => 'listtxt'));
    }

    public function actionallProduct() {
        $userid = Yii::app()->user->id;
        if ($userid != '') {
            $user = User::model()->findByAttributes(array('id' => Yii::app()->user->id));
            if ($user->groups_id == 1 or $user->groups_id == 4) {



                $criteria = new CDbCriteria;
                $criteria->condition = 'user_id=' . Yii::app()->user->id . ' and product_status_id !=2';
                $count = Product::model()->count($criteria);
                $pages = new CPagination($count);
                // results per page
                $pages->pageSize = 18;
                $pages->applyLimit($criteria);
                $products = Product::model()->findAll($criteria);



                $this->render('allproduct', array('products' => $products, 'count' => $count, 'pages' => $pages));
            } else {
                $this->redirect(array('home/index'));
            }
        } else {
            $this->redirect(array('home/confirm/flag/3'));
        }
    }

    public function actionreceivedMessage() {
        $userid = Yii::app()->user->id;
        if (empty($userid)) {
            $this->redirect(array('home/confirm/flag/3'));
        } else {
            $messages = Message::model()->findAllByAttributes(array('reciever_id' => Yii::app()->user->id));
            $this->render('message', array('messages' => $messages));
        }
    }

    public function actionaddShippingValue() {
        $userid = Yii::app()->user->id;
        if (empty($userid)) {
            $this->redirect(array('home/confirm/flag/3'));
        }
        $model = new ShippingValue;
        if (isset($_POST['ShippingValue'])) {
            $model->attributes = $_POST['ShippingValue'];
            $model->user_id = Yii::app()->user->id;
            if ($model->save()) {
                $this->redirect(array('users/allshipping'));
            }
        }
        $this->render('addshipping', array('model' => $model));
    }

    public function actioneditShippingvalue($id) {
        $model = ShippingValue::model()->findByAttributes(array('id' => $id));
        if (isset($_POST['ShippingValue'])) {
            $model->attributes = $_POST['ShippingValue'];
            if ($model->save()) {
                $this->redirect(array('users/allshipping'));
            }
        }
        $this->render('addshipping', array('model' => $model, 'productdetails' => $productdetails));
    }

    public function actionallshipping() {
        $userid = Yii::app()->user->id;
        if (empty($userid)) {
            $this->redirect(array('home/confirm/flag/3'));
        } else {
            $criteria = new CDbCriteria;
            $criteria->condition = ' user_id=:UserID';
            $criteria->params = array(':UserID' => $userid);
            $hipping = ShippingValue::model()->findAll($criteria);
            $this->render('allshipping', array('models' => $hipping));
        }
    }

    public function actiondeleteshipping($id) {
        ShippingValue::model()->deleteAll(array('condition' => 'id=' . $id));
        $this->redirect(array('users/allshipping'));
    }

    public function actionDeletemessage($id) {
        Message::model()->deleteAll(array('condition' => 'id=' . $id));
        $this->redirect(array('users/receivedMessage'));
    }

    public function actionMessageDetails($id) {
        $message = Message::model()->findByAttributes(array('id' => $id));
        $message_replys = Reply::model()->findAllByAttributes(array('message_id' => $message->id));
        $reply = new Reply;
        if (isset($_POST['Reply']['details'])) {
            $reply->details = $_POST['Reply']['details'];
            $reply->message_id = $message->id;
            $reply->reply_date = date('Y-m-d H:i:s');
            $reply->user_id = $message->sender_id;
            if ($reply->save())
                ;
            $this->redirect(array('users/receivedMessage'));
        }
        $this->render('messagedetails', array('message' => $message, 'reply' => $reply, 'message_replys' => $message_replys));
    }

    public function actionfavorites() {
        $userid = Yii::app()->user->id;
        if (empty($userid)) {
            $this->redirect(array('home/confirm/flag/3'));
        } else {
            /*
              $criteria = new CDbCriteria;
              $criteria->condition = 'id in (select product_id from favourite where user_id=:UserID)';
              $criteria->params = array(':UserID' => $userid);
              $favs = Product::model()->findAll($criteria);
             */

            $criteria = new CDbCriteria();
            $cond = 'id in (select product_id from favourite where user_id=' . $userid . ')';
            $criteria->condition = $cond;
            $criteria->order = 'id  DESC';
            $count = Product::model()->count($criteria);
            $pages = new CPagination($count);

            // results per page
            $pages->pageSize = 20;
            $pages->applyLimit($criteria);
            $favs = Product::model()->findAll($criteria);


            $this->render('favorites', array('favs' => $favs, 'count' => $count, 'pages' => $pages));
        }
    }

    public function actiondeletefavorites($id) {
        $userid = Yii::app()->user->id;
        if (empty($userid)) {
            $this->redirect(array('home/confirm/flag/3'));
        }
        $criteria = new CDbCriteria;
        $criteria->condition = 'product_id=:ProductID and user_id=:UserID';
        $criteria->params = array(':ProductID' => $id, ':UserID' => $userid);
        Favourite::model()->deleteAll($criteria);
        $this->redirect(array('users/favorites'));
    }

    public function actionsendmessage() {
        $messages = Message::model()->findAllByAttributes(array('sender_id' => Yii::app()->user->id));
        $this->render('outbox', array('messages' => $messages));
    }

    public function actionOrder() {
        $orders = Order::model()->findAll();
        $this->render('order', array('orders' => $orders));
    }

    public function actionBuyerOrders() {
        $userid = Yii::app()->user->id;
        $user = User::model()->findByPk($userid);
        if (empty($user)) {
            $this->redirect(array('home/confirm/flag/3'));
        } else {
            $buyer_orders = Order::model()->findAllByAttributes(array('buyer_id' => $user->id));
            $this->render('buyer_order', array('buyer_orders' => $buyer_orders));
        }
    }

    public function actionSellerOrders() {
        $userid = Yii::app()->user->id;
        $user = User::model()->findByPk($userid);

        if (empty($user)) {
            $this->redirect(array('home/confirm/flag/3'));
        } else {
            $order_details = OrderDetails::model()->findAllByAttributes(array('seller_id' => $user->id));
            // $seller_orders = Order::model()->findAll(array('condition' => 'id in (select order_id from order_details where seller_id='.$user->id.')'));

            $this->render('order_seller', array('order_details' => $order_details));
        }
    }

    public function actionSellerOrderDetails($id) {
        $userid = Yii::app()->user->id;
        $user = User::model()->findByPk($userid);


        if (empty($user)) {
            $this->redirect(array('home/confirm/flag/3'));
        } else {
            $order_detail = OrderDetails::model()->findByAttributes(array('id' => $id, 'seller_id' => $user->id));

            $this->render('seller_order_detail', array('order_detail' => $order_detail));
        }
    }

    public function actionOrderDetails($id) {
        $order = Order::model()->findByPk($id);

        $status = OrderStatus::model()->findAll();

        $order_owner = User::model()->findByAttributes(array('id' => $order->buyer_id));

        $order_details = OrderDetails::model()->findAllByAttributes(array('order_id' => $order->id));





        // $product = Product::model()->findByAttributes(array('id' => $order_details->product_id));

        if (isset($_POST['Order']['status_id'])) {

            $state = $_POST['Order']['status_id'];
            if ($state == 1) {
                // echo "test22";die;
                $order->status_id = 1;
            } elseif ($state == 2) {
                // echo "test";die;
                $order->status_id = 2;
            } elseif ($state == 3) {
                // echo "test3333";die;
                $order->status_id = 3;
            }
            // print_r($order);die;
            // echo  $order->status_id;die;
            if ($order->save()) {
                //echo "redirect";die;
                $this->redirect(array('users/Order'));
            }
        }
        $this->render('orderdetails', array('order' => $order, 'status' => $status, 'order_owner' => $order_owner, 'order_details' => $order_details, 'country' => $country, 'city' => $city));
    }

    public function actiondeleteOrder($id) {
        Order::model()->deleteAll(array('condition' => 'id=' . $id));
        $this->redirect(array('users/Order'));
    }

    public function actionChat() {
        if (empty(Yii::app()->user->id)) {
            $this->redirect(array('home/confirm/flag/3'));
        }

        $criteria = new CDbCriteria;
        $criteria->group = 'chat_id';

        if (!empty(Yii::app()->user->id)) {
            $criteria->condition = 'chat_id = "' . Yii::app()->user->id . '"';
            $chats = YiichatPost::model()->findAll($criteria);
        } else {
            if (!$_REQUEST['chat'])
                throw new CHttpException(404, 'The requested page does not exist.');
            $chats = array();
            $_REQUEST['chat'] = Yii::app()->user->id;
            $_REQUEST['chat'] = Yii::app()->user->id;
        }

        // print_r($chats);die;
        $users = array();
        $first = true;
        foreach ($chats as $value) {
            $temp = explode('_', $value->chat_id);

            if (count($temp) > 0) {
                if (!$users[$temp[1]]) {
                    $users[$temp[1]] = array(
                        'user' => User::model()->findByPk($temp[1]),
                        'chat_id' => $value->chat_id,
                    );
                }
            }
            if ($first) {
                if (!$_REQUEST['chat'])
                    $_REQUEST['chat'] = $value->chat_id;
                $first = false;
            }
        }
        // print_r($temp);die;
        $this->render('chat', array('users' => $users));
    }

    public function ActionFetchFromXml() {
        if ($_POST['upload']) {
            $filename = $_FILES['xmlfile']['name'];
            $rand = rand(0, 9999);
            $filename = $rand . '-' . $filename;

            $target_path = Yii::app()->basePath . '/../media/xml/';

            $target_path = $target_path . basename($filename);

            $extension = end(explode('.', $filename));
            if ($extension == 'xml') {
                if (move_uploaded_file($_FILES['xmlfile']['tmp_name'], $target_path)) {
                    chmod($target_path, 0777);
//    echo "The file ".  basename( $_FILES['xmlfile']['name']). 
//    " has been uploaded";
                } else {
                    Yii::app()->user->setFlash('xml_fail', 'sorry the file is not uploaded');
                    if (!$_GET['flag']) {
                        $this->redirect(array('users/dashboard'));
                    } else {
                        $this->redirect(array('admin/product'));
                    }
                }

                //   echo 'fdf';die;


                if (file_exists(Yii::app()->basePath . '/../media/xml/' . $filename)) {

                    $xml = simplexml_load_file(Yii::app()->basePath . '/../media/xml/' . $filename);
//    echo '<pre>';
//    print_r($xml);
//    echo '<pre>';die;

                    if ($xml) {
                        $webcats = $xml->merchant->websiteCat;
//                        foreach ($webcats as $key=>$value){
//                            echo $key .'___>' .$value;
//                        }
                        $errors = array();
                        $xml_fail = '';

                        $attributes = array();
                        $details_attributes = array();
                        for ($i = 0; $i < sizeof($webcats); $i++) {

                            // echo($p[$i]['name']).'<br>____________________________________________<br>';
                            //category
                            $cat_name = $webcats[$i]['name'];


                            $category = (Category::model()->find("lower(title) like lower('%$cat_name%')"));

                            $attributes['category_id'] = $category->id;
                            if ($category != null) {
                                if ($attributes['category_id'] != 2) {
                                    //print_r($attributes);
                                    for ($j = 0; $j < sizeof($webcats[$i]->prod); $j++) {
                                        $pro = $webcats[$i][$j]->prod;



                                        //pro category 
                                        $pro_category_name = $pro->cat->procat;

                                        $pro_category = (ProductCategory::model()->find("lower(title) like lower('%$pro_category_name%')"));
                                        if ($pro_category != null) {
                                            $attributes['product_category_id'] = $pro_category->id;
                                        } else {
                                            $procategory = new ProductCategory;
                                            $procategory->category_id = $attributes['category_id'];
                                            $procategory->title = $pro_category_name;
                                            $procategory->save(false);
                                            $attributes['product_category_id'] = $procategory->id;
                                        }

                                        //sub category 
                                        $sub_category_name = $pro->cat->subcat;

                                        $sub_category = (SubCategory::model()->find("lower(title) like lower('%$sub_category_name%')"));
                                        if ($sub_category != null) {
                                            $details_attributes['sub_category_id'] = $sub_category->id;
                                        } else {
                                            $subcategory = new SubCategory;
                                            $subcategory->product_category_id = $attributes['product_category_id'];
                                            $subcategory->title = $sub_category_name;
                                            $subcategory->save(false);
                                            $details_attributes['sub_category_id'] = $subcategory->id;
                                        }

                                        //title

                                        $attributes['title'] = $pro->text->title;


                                        //title
                                        $attributes['description'] = $pro->text->desc;


                                        //price
                                        $attributes['price'] = $pro->price->price;


                                        //Quantity
                                        $attributes['quantity'] = $pro->stock_quantity;


                                        //Brand
                                        $brand_name = $pro->brand;

                                        $brand = (Brand::model()->find("lower(title) like lower('%$brand_name%')"));
                                        if ($brand != null) {
                                            $details_attributes['brand_id'] = $brand->id;
                                        } else {
                                            $brand_m = new Brand;
                                            $brand_m->title = $brand_name;
                                            $brand_m->category_id = $attributes['category_id'];
                                            $brand_m->save(false);
                                            $details_attributes['brand_id'] = $brand_m->id;
                                        }

                                        //image
                                        $attributes['main_image'] = $pro->img->main;


                                        //thumb 
                                        $attributes['thumb'] = $pro->img->thumb;


                                        //colors
                                        $colors = $pro->colors;

                                        $colors_arr = explode(',', $colors);
                                        $pro_colors = array();
                                        foreach ($colors_arr as $color) {
                                            if ($color != '') {
                                                $color_id = Colors::model()->find("lower(title) like lower('%$color%')")->id;
                                                if ($color_id != null) {
                                                    $pro_colors[] = $color_id;
                                                } else {
                                                    $colors_m = new Colors;
                                                    $colors_m->title = $color;
                                                    $colors_m->save(false);
                                                    $pro_colors[] = $colors_m->id;
                                                }
                                            }
                                        }


                                        //sizes
                                        $sizes = $pro->sizes;

                                        $sizes_arr = explode(',', $sizes);
                                        $pro_sizes = array();
                                        foreach ($sizes_arr as $size) {
                                            if ($size != '') {
                                                $size_id = Sizes::model()->find("lower(title) like lower('%$size%')")->id;
                                                if ($size_id != null) {
                                                    $pro_sizes[] = $size_id;
                                                } else {
                                                    $sizes_m = new Sizes;
                                                    $sizes_m->category_id = $attributes['category_id'];
                                                    $sizes_m->title = $size;
                                                    $sizes_m->save(false);
                                                    $pro_sizes[] = $sizes_m->id;
                                                }
                                            }
                                        }






                                        //travel sizes
//           
                                        $travel_arr = array();
                                        $travel_arr_all = array();


                                        $travel_sizes = $pro->tra_rooms;


                                        if ($travel_sizes and $attributes['category_id'] == 2) {

                                            for ($t = 0; $t < sizeof($travel_sizes); $t++) {
//                     $size =$travel_sizes[$k]->size;
//                     $size_id = Sizes::model()->find("lower(title) like lower('%$size%')")->id;
                                                // $cosmetic_arr['size']= $size_id;
                                                $cosmetic_arr['roomoptions'] = $travel_sizes[$t]->room->roomOptions;
                                                $cosmetic_arr['price'] = $travel_sizes[$t]->sizee->price;

                                                $cosmetic_arr_all[] = $cosmetic_arr;
                                            }
                                        }

                                        //cosmetic sizes
//           
                                        $cosmetic_arr = array();
                                        $cosmetic_arr_all = array();


                                        $cosm_sizes = $pro->cosmeticSizes;



                                        if ($cosm_sizes and $attributes['category_id']) {

                                            for ($k = 0; $k <= sizeof($cosm_sizes); $k++) {
                                                //  print_r($cosm_sizes->sizee[1]);die;
                                                $size = $cosm_sizes->sizee[$k]->size;
                                                $size_id = Sizes::model()->find("lower(title) like lower('%$size%')")->id;
                                                if ($size_id != null) {
                                                    $cosmetic_arr['size'] = $size_id;
                                                } else {
                                                    $sizes_m = new Sizes;
                                                    $sizes_m->category_id = $attributes['category_id'];
                                                    $sizes_m->title = $size;
                                                    $sizes_m->save(false);
                                                    $cosmetic_arr['size'] = $sizes_m->id;
                                                }
                                                $cosmetic_arr['quantity'] = $cosm_sizes->sizee[$k]->quantity;
                                                if ($cosm_sizes->sizee[$k]->price != '') {
                                                    $cosmetic_arr['price'] = $cosm_sizes->sizee[$k]->price;
                                                } else {
                                                    $cosmetic_arr['price'] = $attributes['price'];
                                                }
                                                $cosmetic_arr_all[] = $cosmetic_arr;
                                            }
//  echo '<pre>';
//           print_r($cosm_sizes);
//            echo '<pre>';die;
                                        }


                                        //gender
                                        $attributes['gender'] = $pro->gender;



                                        $model = new Product;
                                        $model->attributes = $attributes;
                                        if ($id = Product::model()->saveXml($attributes, $details_attributes, $pro_colors, $pro_sizes, $cosmetic_arr_all)) {

                                            //gallery
                                            $gallery = $pro->gallery->img;
                                            //print_r($gallery[0]['large']);die;
                                            for ($g = 0; $g < sizeof($gallery); $g++) {
                                                $gallery_m = new XmlGallery;
                                                $gallery_m->image = $gallery[$g]['large'];
                                                $gallery_m->thumb = $gallery[$g]['thumb'];
                                                $gallery_m->product_id = $id;
                                                $gallery_m->save(false);
                                            }
                                        }
                                    }
                                } // if category != 2
                            } // if category is found
//                else{
//                    $xml_fail .='Category not found. <br>';
//                    Yii::app()->user->setFlash('xml_fail', $xml_fail);
//                    $this->redirect(array('users/dashboard'));
//                }
                        }
                        Yii::app()->user->setFlash('xml_success', 'Congratulations! xml file inserted successfully.');
                        if (!$_GET['flag']) {
                            $this->redirect(array('users/dashboard'));
                        } else {
                            $this->redirect(array('admin/product'));
                        }
                        //echo '<pre>';
                    } else {
//                        if(empty($errors)){
//                            echo 'empty';  print_r($errors);die;
//                        }else{
//                            echo 'not empty';  print_r($errors);die;
//                            $errors_srt = '';
//                            foreach ($errors as $err){
//                                $errors_srt .=$err.' - ';
//                            }
//                        }
                        Yii::app()->user->setFlash('xml_fail', 'sorry you have errors in your xml file . please check xml guide.');
                        if (!$_GET['flag']) {
                            $this->redirect(array('users/dashboard'));
                        } else {
                            $this->redirect(array('admin/product'));
                        }
                    }
                } else {
                    Yii::app()->user->setFlash('xml_fail', 'sorry failed to open file.');
                    if (!$_GET['flag']) {
                        $this->redirect(array('users/dashboard'));
                    } else {
                        $this->redirect(array('admin/product'));
                    }
                }
            } else {
                Yii::app()->user->setFlash('xml_fail', 'sorry this file is not allowed.');
                if (!$_GET['flag']) {
                    $this->redirect(array('users/dashboard'));
                } else {
                    $this->redirect(array('admin/product'));
                }
            }
        }
    }

    public function actionDownloadXml() {
        // echo 'fd';die;
        if (file_exists(Yii::app()->basePath . '/../media/guide/guide_xmlproducts.xml')) {
            header("Content-disposition: attachment; filename=guide_xmlproducts.xml");
            header("Content-type: application/xml");
            readfile(Yii::app()->basePath . '/../media/guide/guide_xmlproducts.xml');
        }
    }

    public function ActionFetchFromExcel() {
        if ($_POST['uploadexcel']) {
            $filename = $_FILES['excelfile']['name'];
            $rand = rand(0, 9999);
            $filename = $rand . '-' . $filename;

            $target_path = Yii::app()->basePath . '/../media/excel/';

            $target_path = $target_path . basename($filename);

            $extension = end(explode('.', $filename));
            if ($extension == 'xlsx' or $extension == 'csv') {
                if (move_uploaded_file($_FILES['excelfile']['tmp_name'], $target_path)) {

                    chmod($target_path, 0777);
                } else {
                    //  echo "There was an error uploading the file, please try again!";
                }
                if (file_exists(Yii::app()->basePath . "/../media/excel/$filename")) {

                    $file_path = Yii::app()->basePath . "/../media/excel/$filename";

                    if ($sheet_array = Yii::app()->yexcel->readActiveSheet($file_path)) {


//        echo '<pre>';
//         print_r($sheet_array);die;
//         echo '<pre>';
                        if ($sheet_array[1]['A'] != 'category_id'
                                or $sheet_array[1]['B'] != 'product_category_id'

                                or $sheet_array[1]['C'] != 'sub_category_id'
                                or $sheet_array[1]['D'] != 'title'
                                or $sheet_array[1]['E'] != 'description'
                                or $sheet_array[1]['F'] != 'price'
                                or $sheet_array[1]['G'] != 'stock_quantity'
                                or $sheet_array[1]['H'] != 'brand'
                                or $sheet_array[1]['I'] != 'main_image'
                                or $sheet_array[1]['J'] != 'colors'
                                or $sheet_array[1]['K'] != 'sizes'
                                or $sheet_array[1]['L'] != 'gender'
                        ) {
                            Yii::app()->user->setFlash('xml_fail', 'sorry there are errors in the excel file.please check the excel guide.');
                            if (!$_GET['flag']) {
                                $this->redirect(array('users/dashboard'));
                            } else {
                                $this->redirect(array('admin/product'));
                            }
                        } else {

                            for ($i = 2; $i < sizeof($sheet_array) + 1; $i++) {

                                $pro = $sheet_array[$i];
//         echo '<pre>';
//         print_r($pro);
//         echo '<pre>';
                                //category 
                                $category_name = $pro['A'];
                                $category = (Category::model()->find("lower(title) like lower('%$category_name%')"));
                                if ($category != null) {
                                    $attributes['category_id'] = $category->id;
                                    if ($attributes['category_id'] != 2) {

                                        //product category 
                                        $pro_category_name = $pro['B'];
                                        $pro_category_id = (ProductCategory::model()->find("lower(title) like lower('%$pro_category_name%')"));
                                        if ($pro_category_id != null) {
                                            $attributes['product_category_id'] = $pro_category_id->id;
                                        } else {
                                            $procategory = new ProductCategory;
                                            $procategory->category_id = $attributes['category_id'];
                                            $procategory->title = $pro_category_name;
                                            $procategory->save(false);
                                            $attributes['product_category_id'] = $procategory->id;
                                        }


                                        //category 
                                        $sub_category_name = $pro['C'];
                                        $sub_category = (SubCategory::model()->find("lower(title) like lower('%$sub_category_name%')"));
                                        if ($sub_category != null) {
                                            $details_attributes['sub_category_id'] = $sub_category->id;
                                        } else {
                                            $subcategory = new SubCategory;
                                            $subcategory->product_category_id = $attributes['product_category_id'];
                                            $subcategory->title = $sub_category_name;
                                            $subcategory->save(false);
                                            $details_attributes['sub_category_id'] = $subcategory->id;
                                        }

                                        //title
                                        $attributes['title'] = $pro['D'];

                                        //title
                                        $attributes['description'] = $pro['E'];

                                        //price
                                        $attributes['price'] = $pro['F'];

                                        //Quantity
                                        $attributes['quantity'] = $pro['G'];

                                        //Brand
                                        $brand_name = $pro['H'];
                                        $brand = (Brand::model()->find("lower(title) like lower('%$brand_name%')"));
                                        if ($brand) {
                                            $details_attributes['brand_id'] = $brand->id;
                                        } else {

                                            $brand_m = new Brand;
                                            $brand_m->title = $brand_name;
                                            $brand_m->category_id = $attributes['category_id'];
                                            $brand_m->save(false);
                                            $details_attributes['brand_id'] = $brand_m->id;
                                        }

                                        //image
                                        $attributes['main_image'] = $pro['I'];
                                        //thumb
                                        $attributes['thumb'] = $pro['AC'];

                                        //colors
                                        $colors = $pro['J'];
                                        $colors_arr = explode(',', $colors);
                                        $pro_colors = array();
                                        foreach ($colors_arr as $color) {
                                            if ($color != '') {
                                                $color_id = Colors::model()->find("lower(title) like lower('%$color%')")->id;
                                                if ($color_id != null) {
                                                    $pro_colors[] = $color_id;
                                                } else {
                                                    $colors_m = new Colors;
                                                    $colors_m->title = $color;
                                                    $colors_m->save(false);
                                                    $pro_colors[] = $colors_m->id;
                                                }
                                            }
                                        }


                                        //sizes
                                        $sizes = $pro['K'];
                                        $sizes_arr = explode(',', $sizes);
                                        $pro_sizes = array();
                                        foreach ($sizes_arr as $size) {
                                            if ($size != '') {
                                                $size_id = Sizes::model()->find("lower(title) like lower('%$size%')")->id;
                                                if ($size_id != null) {
                                                    $pro_sizes[] = $size_id;
                                                } else {
                                                    $sizes_m = new Sizes;
                                                    $sizes_m->category_id = $attributes['category_id'];
                                                    $sizes_m->title = $size;
                                                    $sizes_m->save(false);
                                                    $pro_sizes[] = $sizes_m->id;
                                                }
                                            }
                                        }



                                        //gender
                                        $attributes['gender'] = $pro['L'];


                                        //travel sizes
//           
                                        //cosmetic sizes
//           
//        $cosmetic_arr = array();
//        $cosmetic_arr_all = array();
//        
//
//                $cosm_sizes = $pro['N'];
// 
//                $cosm_sizes =explode('#', $cosm_sizes);
//                
//             if( $cosm_sizes and $attributes['category_id']){
//
//                for ($k = 0 ; $k< sizeof($cosm_sizes) ; $k++){
//                    $each_size =  explode(',', $cosm_sizes[$k]);
//                    echo     $size =$each_size[0];
//                     $size_id = Sizes::model()->find("lower(title) like lower('%$size%')")->id;
//                   echo $cosmetic_arr['size']= $size_id;
//                    $cosmetic_arr['quantity'] =$each_size[1];
//                    $cosmetic_arr['price'] =$each_size[2];
//                   // $cosmetic_arr['flag'] =1;//excel
//             
//             $cosmetic_arr_all[] = $cosmetic_arr;
//                }
//
//                }





                                        $cosmetic_arr = array();
                                        $cosmetic_arr_all = array();


                                        $cosm_sizes = $pro['N'];

                                        $cosm_sizes = explode('#', $cosm_sizes);

                                        if ($cosm_sizes and $attributes['category_id']) {

                                            for ($k = 0; $k <= sizeof($cosm_sizes); $k++) {
                                                $each_size = explode(',', $cosm_sizes[$k]);
                                                $size = $each_size[$k];
                                                $size_id = Sizes::model()->find("lower(title) like lower('%$size%')")->id;
                                                if ($size_id != null) {
                                                    $cosmetic_arr['size'] = $size_id;
                                                } else {
                                                    $sizes_m = new Sizes;
                                                    $sizes_m->category_id = $attributes['category_id'];
                                                    $sizes_m->title = $size;
                                                    $sizes_m->save(false);
                                                    $cosmetic_arr['size'] = $sizes_m->id;
                                                }
                                                $cosmetic_arr['quantity'] = $each_size[1];
                                                $cosmetic_arr['price'] = $each_size[2];
                                                $cosmetic_arr['flag'] = 1; //excel

                                                $cosmetic_arr_all[] = $cosmetic_arr;
                                            }
                                        }





//           echo '<pre>';
//           print_r($attributes);die;
//            echo '<pre>';
                                        $model = new Product;
                                        $model->attributes = $attributes;
                                        if ($id = Product::model()->saveXml($attributes, $details_attributes, $pro_colors, $pro_sizes, $cosmetic_arr_all)) {


                                            //gallery
                                            $gallery = $pro['AB'];
                                            $gal = explode('{gallery}', $gallery);
                                            //print_r($gallery[0]['large']);die;
                                            for ($g = 0; $g < sizeof($gal); $g++) {
                                                $single_gallery = explode('{thumb}', $gal[$g]);
                                                $gallery_m = new XmlGallery;
                                                $gallery_m->image = trim($single_gallery[0]);
                                                $gallery_m->thumb = trim($single_gallery[1]);
                                                $gallery_m->product_id = $id;
                                                $gallery_m->save(false);
                                            }
                                        }
                                    }
                                }
                            }
                        }


                        Yii::app()->user->setFlash('xml_success', 'Congratulations! the file inserted successfully.');
                        if (!$_GET['flag']) {
                            $this->redirect(array('users/dashboard'));
                        } else {
                            $this->redirect(array('admin/product'));
                        }
                    } else {
                        Yii::app()->user->setFlash('xml_fail', 'sorry there are errors in the excel file.please check the excel guide.');
                        if (!$_GET['flag']) {
                            $this->redirect(array('users/dashboard'));
                        } else {
                            $this->redirect(array('admin/product'));
                        }
                    }
                } else {
                    Yii::app()->user->setFlash('xml_fail', 'sorry failed to open file.');
                    if (!$_GET['flag']) {
                        $this->redirect(array('users/dashboard'));
                    } else {
                        $this->redirect(array('admin/product'));
                    }
                }
            } else {
                Yii::app()->user->setFlash('xml_fail', 'sorry this file is not allowed.');
                if (!$_GET['flag']) {
                    $this->redirect(array('users/dashboard'));
                } else {
                    $this->redirect(array('admin/product'));
                }
            }
        }
    }

    public function actionDownloadExcel() {
        // echo 'fd';die;
        if (file_exists(Yii::app()->basePath . '/../media/guide/guide_excelproducts.xlsx')) {
            header("Content-disposition: attachment; filename=guide_excelproducts.xlsx");
            header("Content-type: application/xlsx");
            readfile(Yii::app()->basePath . '/../media/guide/guide_excelproducts.xlsx');
        }
    }

    function convertXLStoCSV($infile, $outfile) {
        $fileType = PHPExcel_IOFactory::identify($infile);
        $objReader = PHPExcel_IOFactory::createReader($fileType);

        $objReader->setReadDataOnly(true);
        $objPHPExcel = $objReader->load($infile);

        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'CSV');
        $objWriter->save($outfile);
    }

    public function ActionFetchFromCsv() {
        if ($_POST['uploadecsv']) {
            $filename = $_FILES['csvfile']['name'];
            $rand = rand(0, 9999);
            $filename = $rand . '-' . $filename;

            $target_path = Yii::app()->basePath . '/../media/csv/';

            $target_path = $target_path . basename($filename);

            $extension = end(explode('.', $filename));
            if ($extension == 'csv' or $extension == 'xlsx') {
                if (move_uploaded_file($_FILES['csvfile']['tmp_name'], $target_path)) {
                    chmod($target_path, 0777);
                }
                if (file_exists(Yii::app()->basePath . "/../media/csv/$filename")) {

                    $file_path = Yii::app()->basePath . "/../media/csv/$filename";

                    if ($extension == 'xlsx') {
                        require_once(Yii::app()->basePath . '/extensions/PHPExcel/Classes/PHPExcel.php');
                        $output_name = rand(0000, 9999);
                        $output_path = Yii::app()->basePath . "/../media/csv/$output_name.csv";

                        $this->convertXLStoCSV($file_path, $output_path);
                        chmod($output_path, 0777);
                        $filename = $output_name . '.csv';
                    }

                    $fields_array = array('main_category', 'sub_category', 'product_category', 'product_title',
                        'description', 'price', 'stock_quantity', 'brand', 'main_image', 'ain_image'
                        , 'sizes', 'gender', 'cosmetic_size', 'decorStyle', 'decorType', 'dimensions',
                        'model', 'gas', 'doors', 'type', 'country', 'city', 'postcode'
                        , 'facilities', 'gallery', 'thumb', 'colors', 'decor_style', 'decor_type', 'manufacure'
                        , 'kmage', 'age', 'emission', 'engine', 'power_engine', 'kids_type', 'kids_for');
                    $sheet_array = array();
                    $header = null;
                    $handle = fopen(Yii::app()->basePath . "/../media/csv/$filename", "r");
                    if ($handle) {
                        while (($data = fgetcsv($handle, 10000, ",")) !== FALSE) {
                            if (is_null($header)) {
                                $header = $data;
//echo '<pre>';
                                $diff = array_diff($header, $fields_array);
//echo '<pre>';die;


                                if ($diff != null) {
                                    $error = 'sorry you have error in your file . please check the guide . <br>';
                                    $error .= 'please check that this fields is found in your file or it may be spilling not correct : <br>';
                                    foreach ($diff as $di) {
                                        $error .=" $di /";
                                    }
                                    rtrim($error, ' /');
                                    Yii::app()->user->setFlash('xml_fail', $error);
                                    if (!$_GET['flag']) {
                                        $this->redirect(array('users/dashboard'));
                                    } else {
                                        $this->redirect(array('admin/product'));
                                    }
                                }
                            } elseif (is_array($header) && count($header) == count($data)) {
                                $sheet_array[] = array_combine($header, $data);
                            }
                            // $sheet_array[] = array_combine($header, $data);
//$sheet_array[] = $data;
                        }
//echo '<pre>';
// print_r($sheet_array);
// echo '<pre>';die;
//fclose($handle);
//        echo '<pre>';
//         print_r($sheet_array);die;
//         echo '<pre>';
//                        if ($sheet_array[0][0] != 'category_id'
//                                or $sheet_array[0][1] != 'product_category_id'
//
//                                or $sheet_array[0][2] != 'sub_category_id'
//                                or $sheet_array[0][3] != 'title'
//                                or $sheet_array[0][4] != 'description'
//                                or $sheet_array[0][5] != 'price'
//                                or $sheet_array[0][6] != 'stock_quantity'
//                                or $sheet_array[0][7] != 'brand'
//                                or $sheet_array[0][8] != 'main_image'
//                                or $sheet_array[0][9] != 'colors'
//                                or $sheet_array[0][10] != 'sizes'
//                                or $sheet_array[0][11] != 'gender'
//                        ) {
//                            Yii::app()->user->setFlash('xml_fail', 'sorry there are errors in the excel file.please check the excel guide.');
//                            if (!$_GET['flag']) {
//                                $this->redirect(array('users/dashboard'));
//                            } else {
//                                $this->redirect(array('admin/product'));
//                            }
//                        } else {

                        for ($i = 1; $i < sizeof($sheet_array); $i++) {

                            $pro = $sheet_array[$i];
//         echo '<pre>';
//         print_r($pro);
//         echo '<pre>';
                            //category 
                            $category_name = $pro['main_category'];
                            $category = (Category::model()->find("lower(title) like lower('%$category_name%')"));
                            if ($category != null) {
                                $attributes['category_id'] = $category->id;
                                if ($attributes['category_id'] != 2) {

                                    //product category 
                                    $pro_category_name = $pro['product_category'];
                                    $pro_category_id = (ProductCategory::model()->find("lower(title) like lower('%$pro_category_name%')"));
                                    if ($pro_category_id != null) {
                                        $attributes['product_category_id'] = $pro_category_id->id;
                                    } else {
                                        $procategory = new ProductCategory;
                                        $procategory->category_id = $attributes['category_id'];
                                        $procategory->title = $pro_category_name;
                                        $procategory->save(false);
                                        $attributes['product_category_id'] = $procategory->id;
                                    }


                                    //category 
                                    $sub_category_name = $pro['sub_category'];
                                    $sub_category = (SubCategory::model()->find("lower(title) like lower('%$sub_category_name%')"));
                                    if ($sub_category != null) {
                                        $details_attributes['sub_category_id'] = $sub_category->id;
                                    } else {
                                        $subcategory = new SubCategory;
                                        $subcategory->product_category_id = $attributes['product_category_id'];
                                        $subcategory->title = $sub_category_name;
                                        $subcategory->save(false);
                                        $details_attributes['sub_category_id'] = $subcategory->id;
                                    }

                                    //title
                                    $attributes['title'] = $pro['product_title'];

                                    //title
                                    $attributes['description'] = $pro['description'];

                                    //price
                                    $attributes['price'] = $pro['price'];

                                    //Quantity
                                    $attributes['quantity'] = $pro['stock_quantity'];

                                    //Brand
                                    $brand_name = $pro['brand'];
                                    $brand = (Brand::model()->find("lower(title) like lower('%$brand_name%')"));
                                    if ($brand) {
                                        $details_attributes['brand_id'] = $brand->id;
                                    } else {

                                        $brand_m = new Brand;
                                        $brand_m->title = $brand_name;
                                        $brand_m->category_id = $attributes['category_id'];
                                        $brand_m->save(false);
                                        $details_attributes['brand_id'] = $brand_m->id;
                                    }

                                    //image
                                    $attributes['main_image'] = $pro['main_image'];
                                    //thumb
                                    $attributes['thumb'] = $pro['thumb'];

                                    //colors
                                    $colors = $pro['colors'];
                                    $colors_arr = explode(',', $colors);
                                    $pro_colors = array();
                                    foreach ($colors_arr as $color) {
                                        if ($color != '') {
                                            $color_id = Colors::model()->find("lower(title) like lower('%$color%')")->id;
                                            if ($color_id != null) {
                                                $pro_colors[] = $color_id;
                                            } else {
                                                $colors_m = new Colors;
                                                $colors_m->title = $color;
                                                $colors_m->save(false);
                                                $pro_colors[] = $colors_m->id;
                                            }
                                        }
                                    }


                                    //sizes
                                    $sizes = $pro['sizes'];
                                    $sizes_arr = explode(',', $sizes);
                                    $pro_sizes = array();
                                    foreach ($sizes_arr as $size) {
                                        if ($size != '') {
                                            $size_id = Sizes::model()->find("lower(title) like lower('%$size%')")->id;
                                            if ($size_id != null) {
                                                $pro_sizes[] = $size_id;
                                            } else {
                                                $sizes_m = new Sizes;
                                                $sizes_m->category_id = $attributes['category_id'];
                                                $sizes_m->title = $size;
                                                $sizes_m->save(false);
                                                $pro_sizes[] = $sizes_m->id;
                                            }
                                        }
                                    }



                                    //gender
                                    $attributes['gender'] = $pro['gender'];


                                    //travel sizes
//           
                                    //cosmetic sizes
//           
//        $cosmetic_arr = array();
//        $cosmetic_arr_all = array();
//        
//
//                $cosm_sizes = $pro['N'];
// 
//                $cosm_sizes =explode('#', $cosm_sizes);
//                
//             if( $cosm_sizes and $attributes['category_id']){
//
//                for ($k = 0 ; $k< sizeof($cosm_sizes) ; $k++){
//                    $each_size =  explode(',', $cosm_sizes[$k]);
//                    echo     $size =$each_size[0];
//                     $size_id = Sizes::model()->find("lower(title) like lower('%$size%')")->id;
//                   echo $cosmetic_arr['size']= $size_id;
//                    $cosmetic_arr['quantity'] =$each_size[1];
//                    $cosmetic_arr['price'] =$each_size[2];
//                   // $cosmetic_arr['flag'] =1;//excel
//             
//             $cosmetic_arr_all[] = $cosmetic_arr;
//                }
//
//                }





                                    $cosmetic_arr = array();
                                    $cosmetic_arr_all = array();


                                    $cosm_sizes = $pro['cosmetic_size'];

                                    $cosm_sizes = explode('#', $cosm_sizes);

                                    if ($cosm_sizes and $attributes['category_id']) {

                                        for ($k = 0; $k <= sizeof($cosm_sizes); $k++) {
                                            $each_size = explode(',', $cosm_sizes[$k]);
                                            $size = $each_size[$k];
                                            $size_id = Sizes::model()->find("lower(title) like lower('%$size%')")->id;
                                            if ($size_id != null) {
                                                $cosmetic_arr['size'] = $size_id;
                                            } else {
                                                $sizes_m = new Sizes;
                                                $sizes_m->category_id = $attributes['category_id'];
                                                $sizes_m->title = $size;
                                                $sizes_m->save(false);
                                                $cosmetic_arr['size'] = $sizes_m->id;
                                            }
                                            $cosmetic_arr['quantity'] = $each_size[1];
                                            if ($each_size[2] != '') {
                                                $cosmetic_arr['price'] = $each_size[2];
                                            } else {
                                                $cosmetic_arr['price'] = $attributes['price'];
                                            }
                                            $cosmetic_arr['flag'] = 1; //excel

                                            $cosmetic_arr_all[] = $cosmetic_arr;
                                        }
                                    }


                                    $details_attributes['decor_style_id'] = '';
                                    $details_attributes['decor_type_id'] = '';
                                    $details_attributes['dimensions'] = '';
                                    if ($attributes['category_id'] == 6) {
                                        //decor style 
                                        $decor_style_name = $pro['decor_style'];
                                        $decor_style = (DecorStyle::model()->find("lower(title) like lower('%$decor_style_name%')"));
                                        if ($decor_style != null) {
                                            $details_attributes['decor_style_id'] = $decor_style->id;
                                        } else {
                                            $decor_style_m = new DecorStyle;
                                            $decor_style_m->title = $decor_style_name;
                                            $decor_style_m->save(false);
                                            $details_attributes['decor_style_id'] = $decor_style_m->id;
                                        }

                                        //decor type 
                                        $decor_type_name = $pro['decor_type'];
                                        $decor_type = (DecorType::model()->find("lower(title) like lower('%$decor_type_name%')"));
                                        if ($decor_type != null) {
                                            $details_attributes['decor_type_id'] = $decor_type->id;
                                        } else {
                                            $decor_type_m = new DecorType;
                                            $decor_type_m->title = $decor_type_name;
                                            $decor_type_m->save(false);
                                            $details_attributes['decor_type_id'] = $decor_type_m->id;
                                        }

                                        //dimensions

                                        $details_attributes['dimensions'] = $pro['dimensions'];
                                    }


                                    $details_attributes['make_id'] = '';
                                    $details_attributes['motor_model_id'] = '';

//                                       $details_attributes['dimensions']='';
                                    if ($attributes['category_id'] == 5) {

                                        // make 
                                        $motor_make_name = $pro['manufacure'];
                                        $motor_make = (Make::model()->find("lower(title) like lower('%$motor_make_name%')"));
                                        if ($motor_make != null) {
                                            $details_attributes['make_id'] = $motor_make->id;
                                        } else {
                                            $make = new Make;
                                            $make->title = $motor_make_name;
                                            $make->save(false);
                                            $details_attributes['make_id'] = $make->id;
                                        }

                                        //motor model 
                                        $motor_model_name = $pro['model'];
                                        $motor_model = (MotorModel::model()->find("lower(title) like lower('%$motor_model_name%')"));
                                        if ($motor_model != null) {
                                            $details_attributes['motor_model_id'] = $motor_model->id;
                                        } else {
                                            $motor_model_m = new MotorModel;
                                            $motor_model_m->title = $motor_model_name;
                                            $motor_model_m->save(false);
                                            $details_attributes['motor_model_id'] = $motor_model_m->id;
                                        }
                                    }



//           echo '<pre>';
//           print_r($attributes);die;
//            echo '<pre>';
                                    $model = new Product;
                                    $model->attributes = $attributes;
                                    if ($id = Product::model()->saveXml($attributes, $details_attributes, $pro_colors, $pro_sizes, $cosmetic_arr_all)) {


                                        //gallery
                                        $gallery = $pro['gallery'];
                                        $gal = explode('{gallery}', $gallery);
                                        //print_r($gallery[0]['large']);die;
                                        for ($g = 0; $g < sizeof($gal); $g++) {
                                            $single_gallery = explode('{thumb}', $gal[$g]);
                                            $gallery_m = new XmlGallery;
                                            $gallery_m->image = trim($single_gallery[0]);
                                            $gallery_m->thumb = trim($single_gallery[1]);
                                            $gallery_m->product_id = $id;
                                            $gallery_m->save(false);
                                        }
                                    }
                                }
                            }
                        }
                        // }


                        Yii::app()->user->setFlash('xml_success', 'Congratulations! the file inserted successfully.');
                        if (!$_GET['flag']) {
                            $this->redirect(array('users/dashboard'));
                        } else {
                            $this->redirect(array('admin/product'));
                        }
                        fclose($handle);
                    } else {
                        Yii::app()->user->setFlash('xml_fail', 'sorry there are errors in the excel file.please check the excel guide.');
                        if (!$_GET['flag']) {
                            $this->redirect(array('users/dashboard'));
                        } else {
                            $this->redirect(array('admin/product'));
                        }
                    }
                } else {
                    Yii::app()->user->setFlash('xml_fail', 'sorry failed to open file.');
                    if (!$_GET['flag']) {
                        $this->redirect(array('users/dashboard'));
                    } else {
                        $this->redirect(array('admin/product'));
                    }
                }
            } else {
                Yii::app()->user->setFlash('xml_fail', 'sorry this file is not allowed.');
                if (!$_GET['flag']) {
                    $this->redirect(array('users/dashboard'));
                } else {
                    $this->redirect(array('admin/product'));
                }
            }
        }
    }

    public function actionDownloadCsv() {
        // echo 'fd';die;
        if (file_exists(Yii::app()->basePath . '/../media/guide/guide_csvproducts.csv')) {
            header("Content-disposition: attachment; filename=guide_csvproducts.csv");
            header("Content-type: application/csv");
            readfile(Yii::app()->basePath . '/../media/guide/guide_csvproducts.csv');
        }
    }

//    public function ActionImportCsv() {
//        echo 'rrr';
//
//        $arrResult = array();
//        $handle = fopen(Yii::app()->basePath . "/../media/guide/guide_csvproducts.csv", "r");
//        if ($handle) {
//            while (($data = fgetcsv($handle, 10000, ",")) !== FALSE) {
//
//                $arrResult[] = $data;
//            }
//            echo '<pre>';
//            print_r($arrResult);
//            echo '<pre>';
//            fclose($handle);
//        }
//    }

    public function actionNewwindow() {
        echo ' <div id="chat">

                            </div>';
        echo $this->widget('YiiChatWidget', array(
            'chat_id' => 445, // a chat identificator
            'identity' => Yii::app()->user->id, // the user, Yii::app()->user->id ?
            'selector' => '#chatt', // were it will be inserted
            'minPostLen' => 2, // min and
            'maxPostLen' => 255, // max string size for post
            'defaultController' => 'admin/dashboard',
            //"timerMs"=>5000,
            'model' => new ChatHandler(), // the class handler. **** FOR DEMO, READ MORE LATER IN THIS DOC ****
            'onSuccess' => new CJavaScriptExpression(
                    "function(code, text, post_id){   }"),
            'onError' => new CJavaScriptExpression(
                    "function(errorcode, info){ }"),
        ));
    }

    public function ActionFetchFromMyXml() {
        if ($_POST['upload']) {
            $category = $_POST['category'];
            $user_id = $_POST['seller'];
            $filename = $_FILES['xmlfile']['name'];
            $rand = rand(0, 9999);
            $filename = $rand . '-' . $filename;

            $target_path = Yii::app()->basePath . '/../media/xml/';

            $target_path = $target_path . basename($filename);

            $extension = end(explode('.', $filename));

            if ($extension == 'xml') {

                if (move_uploaded_file($_FILES['xmlfile']['tmp_name'], $target_path)) {

                    chmod($target_path, 0777);
//    echo "The file ".  basename( $_FILES['xmlfile']['name']). 
//    " has been uploaded";
                } else {
                    Yii::app()->user->setFlash('xml_fail', 'sorry the file is not uploaded');
                    if (!$_GET['flag']) {
                        $this->redirect(array('users/dashboard'));
                    } else {
                        $this->redirect(array('admin/product'));
                    }
                }

                //   echo 'fdf';die;


                if (file_exists(Yii::app()->basePath . '/../media/xml/' . $filename)) {

                    $xml = simplexml_load_file(Yii::app()->basePath . '/../media/xml/' . $filename);
//    echo '<pre>';
//    print_r($xml);
//    echo '<pre>';die;

                    if ($xml) {

                        $products = $xml->merchant;
                        //    echo 'ff'. $products->prod[1]['id'];
//                        echo '<pre>';
//                        print_r($products[0]);
//                          echo '<pre>';
//                        die;


                        $errors = array();
                        $xml_fail = '';

                        $attributes = array();
                        $details_attributes = array();
                        //  echo sizeof($products->prod);die;
                        for ($i = 0; $i < sizeof($products->prod); $i++) {

                            $product = $products->prod[$i];
                            // echo($p[$i]['name']).'<br>____________________________________________<br>';
                            //category
//                            $cat_name = $webcats[$i]['name'];
//
//
//                            $category = (Category::model()->find("lower(title) like lower('%$cat_name%')"));

                            $attributes['user_id'] = $user_id;
                            $attributes['category_id'] = $category;
                            if ($category != null) {
                                if ($attributes['category_id'] != 2) {
                                    //print_r($attributes);
//                                    for ($j = 0; $j < sizeof($products[$i]->prod); $j++) {
                                    //   echo $pro = $product->text->desc;die;
                                    //pro category 
                                    $pro_category_name = $product->cat->awCat;

                                    $pro_category = (ProductCategory::model()->find("lower(title) like lower('%$pro_category_name%')"));
                                    if ($pro_category != null) {
                                        $attributes['product_category_id'] = $pro_category->id;
                                    } else {
                                        $procategory = new ProductCategory;
                                        $procategory->category_id = $attributes['category_id'];
                                        $procategory->title = $pro_category_name;
                                        $procategory->save(false);
                                        $attributes['product_category_id'] = $procategory->id;
                                    }

                                    //sub category 
                                    $sub_category_name = $product->cat->mCat;

                                    $sub_category = (SubCategory::model()->find("lower(title) like lower('%$sub_category_name%')"));
                                    if ($sub_category != null) {
                                        $details_attributes['sub_category_id'] = $sub_category->id;
                                    } else {
                                        $subcategory = new SubCategory;
                                        $subcategory->product_category_id = $attributes['product_category_id'];
                                        $subcategory->title = $sub_category_name;
                                        $subcategory->save(false);
                                        $details_attributes['sub_category_id'] = $subcategory->id;
                                    }

                                    //title

                                    $attributes['title'] = $product->text->name;


                                    //title
                                    $attributes['description'] = $product->text->desc;


                                    //price
                                    $attributes['price'] = $product->price->buynow;


                                    //Quantity
                                    $attributes['quantity'] = $product['stock_quantity'];


                                    //Brand
                                    $brand_name = $product->brand;

                                    $brand = (Brand::model()->find("lower(title) like lower('%$brand_name%')"));
                                    if ($brand != null) {
                                        $details_attributes['brand_id'] = $brand->id;
                                    } else {
                                        $brand_m = new Brand;
                                        $brand_m->title = $brand_name;
                                        $brand_m->category_id = $attributes['category_id'];
                                        $brand_m->save(false);
                                        $details_attributes['brand_id'] = $brand_m->id;
                                    }

                                    //image
                                    $attributes['main_image'] = $product->uri->awImage;



                                    //thumb 
                                    $attributes['thumb'] = $product->uri->mImage;

                                    //merchant id
                                    $attributes['merchant_id'] = $xml->merchant['id'];
                                    //merchant id
                                    $attributes['merchant_name'] = $xml->merchant['name'];

                                    //url
                                    $attributes['url'] = $product->uri->awTrack;
                                    //mlink
                                    $attributes['mlink'] = $product->uri->mLink;
                                    //prod id
                                    $attributes['prod_id'] = $product['id'];
                                    //pid
                                    $attributes['pid'] = $product->pId;


                                    //colors
//                                        $colors = $pro->colors;
//
//                                        $colors_arr = explode(',', $colors);
//                                        $pro_colors = array();
//                                        foreach ($colors_arr as $color) {
//                                            if ($color != '') {
//                                                $color_id = Colors::model()->find("lower(title) like lower('%$color%')")->id;
//                                                if ($color_id != null) {
//                                                    $pro_colors[] = $color_id;
//                                                } else {
//                                                    $colors_m = new Colors;
//                                                    $colors_m->title = $color;
//                                                    $colors_m->save(false);
//                                                    $pro_colors[] = $colors_m->id;
//                                                }
//                                            }
//                                        }
                                    //sizes
//                                        $sizes = $pro->sizes;
//
//                                        $sizes_arr = explode(',', $sizes);
//                                        $pro_sizes = array();
//                                        foreach ($sizes_arr as $size) {
//                                            if ($size != '') {
//                                                $size_id = Sizes::model()->find("lower(title) like lower('%$size%')")->id;
//                                                if ($size_id != null) {
//                                                    $pro_sizes[] = $size_id;
//                                                } else {
//                                                    $sizes_m = new Sizes;
//                                                    $sizes_m->category_id = $attributes['category_id'];
//                                                    $sizes_m->title = $size;
//                                                    $sizes_m->save(false);
//                                                    $pro_sizes[] = $sizes_m->id;
//                                                }
//                                            }
//                                        }
                                    //travel sizes
//           
//                                        $travel_arr = array();
//                                        $travel_arr_all = array();
//
//
//                                        $travel_sizes = $pro->tra_rooms;
//
//
//                                        if ($travel_sizes and $attributes['category_id'] == 2) {
//
//                                            for ($t = 0; $t < sizeof($travel_sizes); $t++) {
////                     $size =$travel_sizes[$k]->size;
////                     $size_id = Sizes::model()->find("lower(title) like lower('%$size%')")->id;
//                                                // $cosmetic_arr['size']= $size_id;
//                                                $cosmetic_arr['roomoptions'] = $travel_sizes[$t]->room->roomOptions;
//                                                $cosmetic_arr['price'] = $travel_sizes[$t]->sizee->price;
//
//                                                $cosmetic_arr_all[] = $cosmetic_arr;
//                                            }
//                                        }
                                    //cosmetic sizes
//           
//                                        $cosmetic_arr = array();
//                                        $cosmetic_arr_all = array();
//
//
//                                        $cosm_sizes = $pro->cosmeticSizes;
//
//
//
//                                        if ($cosm_sizes and $attributes['category_id']) {
//
//                                            for ($k = 0; $k <= sizeof($cosm_sizes); $k++) {
//                                                //  print_r($cosm_sizes->sizee[1]);die;
//                                                $size = $cosm_sizes->sizee[$k]->size;
//                                                $size_id = Sizes::model()->find("lower(title) like lower('%$size%')")->id;
//                                                if ($size_id != null) {
//                                                    $cosmetic_arr['size'] = $size_id;
//                                                } else {
//                                                    $sizes_m = new Sizes;
//                                                    $sizes_m->category_id = $attributes['category_id'];
//                                                    $sizes_m->title = $size;
//                                                    $sizes_m->save(false);
//                                                    $cosmetic_arr['size'] = $sizes_m->id;
//                                                }
//                                                $cosmetic_arr['quantity'] = $cosm_sizes->sizee[$k]->quantity;
//                                                if ($cosm_sizes->sizee[$k]->price != '') {
//                                                    $cosmetic_arr['price'] = $cosm_sizes->sizee[$k]->price;
//                                                } else {
//                                                    $cosmetic_arr['price'] = $attributes['price'];
//                                                }
//                                                $cosmetic_arr_all[] = $cosmetic_arr;
//                                            }
////  echo '<pre>';
////           print_r($cosm_sizes);
////            echo '<pre>';die;
//                                        }
                                    //gender
                                    //  $attributes['gender'] = $pro->gender;



                                    $model = new Product;
                                    $model->attributes = $attributes;
                                    if ($id = Product::model()->saveXml($attributes, $details_attributes)) {

                                        //gallery
                                        // $gallery = $pro->gallery->img;
                                        //print_r($gallery[0]['large']);die;
//                                            for ($g = 0; $g < sizeof($gallery); $g++) {
//                                                $gallery_m = new XmlGallery;
//                                                $gallery_m->image = $gallery[$g]['large'];
//                                                $gallery_m->thumb = $gallery[$g]['thumb'];
//                                                $gallery_m->product_id = $id;
//                                                $gallery_m->save(false);
//                                            }
                                    }
                                    // }
                                } // if category != 2
                            } // if category is found
//                else{
//                    $xml_fail .='Category not found. <br>';
//                    Yii::app()->user->setFlash('xml_fail', $xml_fail);
//                    $this->redirect(array('users/dashboard'));
//                }
                        }
                        Yii::app()->user->setFlash('xml_success', 'Congratulations! xml file inserted successfully.');
                        if (!$_GET['flag']) {
                            $this->redirect(array('users/dashboard'));
                        } else {
                            $this->redirect(array('admin/product'));
                        }
                        //echo '<pre>';
                    } else {
//                        if(empty($errors)){
//                            echo 'empty';  print_r($errors);die;
//                        }else{
//                            echo 'not empty';  print_r($errors);die;
//                            $errors_srt = '';
//                            foreach ($errors as $err){
//                                $errors_srt .=$err.' - ';
//                            }
//                        }
                        Yii::app()->user->setFlash('xml_fail', 'sorry you have errors in your xml file . please check xml guide.');
                        if (!$_GET['flag']) {
                            $this->redirect(array('users/dashboard'));
                        } else {
                            $this->redirect(array('admin/product'));
                        }
                    }
                } else {
                    Yii::app()->user->setFlash('xml_fail', 'sorry failed to open file.');
                    if (!$_GET['flag']) {
                        $this->redirect(array('users/dashboard'));
                    } else {
                        $this->redirect(array('admin/product'));
                    }
                }
            } else {
                Yii::app()->user->setFlash('xml_fail', 'sorry this file is not allowed.');
                if (!$_GET['flag']) {
                    $this->redirect(array('users/dashboard'));
                } else {
                    $this->redirect(array('admin/product'));
                }
            }
        }
    }

    public function ActionFetchFromMyCsv() {
        if ($_POST['uploadecsv']) {
            $category = $_POST['category'];
            $user_id = $_POST['seller'];
            $filename = $_FILES['csvfile']['name'];
            $rand = rand(0, 9999);
            $filename = $rand . '-' . $filename;

            $target_path = Yii::app()->basePath . '/../media/csv/';

            $target_path = $target_path . basename($filename);

            $extension = end(explode('.', $filename));
            if ($extension == 'csv' or $extension == 'xlsx') {
                if (move_uploaded_file($_FILES['csvfile']['tmp_name'], $target_path)) {
                    chmod($target_path, 0777);
                }
                if (file_exists(Yii::app()->basePath . "/../media/csv/$filename")) {

                    $file_path = Yii::app()->basePath . "/../media/csv/$filename";

                    if ($extension == 'xlsx') {
                        require_once(Yii::app()->basePath . '/extensions/PHPExcel/Classes/PHPExcel.php');
                        $output_name = rand(0000, 9999);
                        $output_path = Yii::app()->basePath . "/../media/csv/$output_name.csv";

                        $this->convertXLStoCSV($file_path, $output_path);
                        chmod($output_path, 0777);
                        $filename = $output_name . '.csv';
                    }

                    $fields_array = array('aw_product_id', 'merchant_product_id', 'merchant_category', 'aw_deep_link',
                        'merchant_image_url', 'search_price', 'description', 'merchant_deep_link', 'main_image', 'merchant_name'
                        , 'merchant_id', 'category_name', 'category_id', 'delivery_cost', 'currency', 'store_price',
                        'display_price', 'data_feed_id');
                    $sheet_array = array();
                    $header = null;
                    $handle = fopen(Yii::app()->basePath . "/../media/csv/$filename", "r");
                    if ($handle) {
                        while (($data = fgetcsv($handle, 10000, ",")) !== FALSE) {
                            if (is_null($header)) {
                                $header = $data;
//echo '<pre>';
                                $diff = array_diff($header, $fields_array);
//echo '<pre>';die;
//                              echo '<pre>';
//                                print_r($header);
//                                echo '<pre>';die;

                                if ($diff != null) {
                                    $error = 'sorry you have error in your file . please check the guide . <br>';
                                    $error .= 'please check that this fields is found in your file or it may be spilling not correct : <br>';
                                    foreach ($diff as $di) {
                                        $error .=" $di /";
                                    }
                                    rtrim($error, ' /');
                                    Yii::app()->user->setFlash('xml_fail', $error);
                                    if (!$_GET['flag']) {
                                        $this->redirect(array('users/dashboard'));
                                    } else {
                                        $this->redirect(array('admin/product'));
                                    }
                                }
                            } elseif (is_array($header) && count($header) == count($data)) {
                                $sheet_array[] = array_combine($header, $data);
                            }
                            // $sheet_array[] = array_combine($header, $data);
//$sheet_array[] = $data;
                        }
//echo '<pre>';
// print_r($sheet_array);
// echo '<pre>';die;
//fclose($handle);
//        echo '<pre>';
//         print_r($sheet_array);die;
//         echo '<pre>';
//                        if ($sheet_array[0][0] != 'category_id'
//                                or $sheet_array[0][1] != 'product_category_id'
//
//                                or $sheet_array[0][2] != 'sub_category_id'
//                                or $sheet_array[0][3] != 'title'
//                                or $sheet_array[0][4] != 'description'
//                                or $sheet_array[0][5] != 'price'
//                                or $sheet_array[0][6] != 'stock_quantity'
//                                or $sheet_array[0][7] != 'brand'
//                                or $sheet_array[0][8] != 'main_image'
//                                or $sheet_array[0][9] != 'colors'
//                                or $sheet_array[0][10] != 'sizes'
//                                or $sheet_array[0][11] != 'gender'
//                        ) {
//                            Yii::app()->user->setFlash('xml_fail', 'sorry there are errors in the excel file.please check the excel guide.');
//                            if (!$_GET['flag']) {
//                                $this->redirect(array('users/dashboard'));
//                            } else {
//                                $this->redirect(array('admin/product'));
//                            }
//                        } else {

                        for ($i = 1; $i < sizeof($sheet_array); $i++) {

                            $pro = $sheet_array[$i];
//         echo '<pre>';
//         print_r($pro);
//         echo '<pre>';
                            //category 
//                            $category_name = $pro['main_category'];
//                            $category = (Category::model()->find("lower(title) like lower('%$category_name%')"));

                            $attributes['user_id'] = $user_id;
                            if ($category != null) {
                                $attributes['category_id'] = $category;
                                if ($attributes['category_id'] != 2) {

                                    //product category 
                                    $pro_category_name = $pro['category_name'];
                                    $pro_category_id = (ProductCategory::model()->find("lower(title) like lower('%$pro_category_name%')"));
                                    if ($pro_category_id != null) {
                                        $attributes['product_category_id'] = $pro_category_id->id;
                                    } else {
                                        $procategory = new ProductCategory;
                                        $procategory->category_id = $attributes['category_id'];
                                        $procategory->title = $pro_category_name;
                                        $procategory->save(false);
                                        $attributes['product_category_id'] = $procategory->id;
                                    }


                                    //category 
                                    $sub_category_name = $pro['merchant_category'];
                                    $sub_category = (SubCategory::model()->find("lower(title) like lower('%$sub_category_name%')"));
                                    if ($sub_category != null) {
                                        $details_attributes['sub_category_id'] = $sub_category->id;
                                    } else {
                                        $subcategory = new SubCategory;
                                        $subcategory->product_category_id = $attributes['product_category_id'];
                                        $subcategory->title = $sub_category_name;
                                        $subcategory->save(false);
                                        $details_attributes['sub_category_id'] = $subcategory->id;
                                    }

                                    //title
                                    $attributes['title'] = $pro['product_name'];

                                    //title
                                    $attributes['description'] = $pro['description'];

                                    //price
                                    $attributes['price'] = $bodytag = str_replace("GBP", "", $pro['display_price']);

                                    //Quantity
                                    //   $attributes['quantity'] = $pro['stock_quantity'];
                                    //Brand
//                                    $brand_name = $pro['brand'];
//                                    $brand = (Brand::model()->find("lower(title) like lower('%$brand_name%')"));
//                                    if ($brand) {
//                                        $details_attributes['brand_id'] = $brand->id;
//                                    } else {
//
//                                        $brand_m = new Brand;
//                                        $brand_m->title = $brand_name;
//                                        $brand_m->category_id = $attributes['category_id'];
//                                        $brand_m->save(false);
//                                        $details_attributes['brand_id'] = $brand_m->id;
//                                    }
                                    //url
                                    $attributes['url'] = $pro['aw_deep_link'];
                                    //mlink
                                    $attributes['mlink'] = $pro['merchant_deep_link'];
                                    //image
                                    $attributes['main_image'] = $pro['merchant_image_url'];
                                    //thumb
                                    $attributes['thumb'] = $pro['aw_image_url'];

                                    $attributes['prod_id'] = $pro['aw_product_id'];
                                    $attributes['merchant_id'] = $pro['merchant_id'];
                                    $attributes['merchant_name'] = $pro['merchant_name'];
                                    $attributes['pid'] = $pro['merchant_product_id'];
                                    $attributes['data_feed_id'] = $pro['data_feed_id'];

                                    //colors
//                                    $colors = $pro['colors'];
//                                    $colors_arr = explode(',', $colors);
//                                    $pro_colors = array();
//                                    foreach ($colors_arr as $color) {
//                                        if ($color != '') {
//                                            $color_id = Colors::model()->find("lower(title) like lower('%$color%')")->id;
//                                            if ($color_id != null) {
//                                                $pro_colors[] = $color_id;
//                                            } else {
//                                                $colors_m = new Colors;
//                                                $colors_m->title = $color;
//                                                $colors_m->save(false);
//                                                $pro_colors[] = $colors_m->id;
//                                            }
//                                        }
//                                    }
                                    //sizes
//                                    $sizes = $pro['sizes'];
//                                    $sizes_arr = explode(',', $sizes);
//                                    $pro_sizes = array();
//                                    foreach ($sizes_arr as $size) {
//                                        if ($size != '') {
//                                            $size_id = Sizes::model()->find("lower(title) like lower('%$size%')")->id;
//                                            if ($size_id != null) {
//                                                $pro_sizes[] = $size_id;
//                                            } else {
//                                                $sizes_m = new Sizes;
//                                                $sizes_m->category_id = $attributes['category_id'];
//                                                $sizes_m->title = $size;
//                                                $sizes_m->save(false);
//                                                $pro_sizes[] = $sizes_m->id;
//                                            }
//                                        }
//                                    }
                                    //gender
                                    //$attributes['gender'] = $pro['gender'];
                                    //travel sizes
//           
                                    //cosmetic sizes
//           
//        $cosmetic_arr = array();
//        $cosmetic_arr_all = array();
//        
//
//                $cosm_sizes = $pro['N'];
// 
//                $cosm_sizes =explode('#', $cosm_sizes);
//                
//             if( $cosm_sizes and $attributes['category_id']){
//
//                for ($k = 0 ; $k< sizeof($cosm_sizes) ; $k++){
//                    $each_size =  explode(',', $cosm_sizes[$k]);
//                    echo     $size =$each_size[0];
//                     $size_id = Sizes::model()->find("lower(title) like lower('%$size%')")->id;
//                   echo $cosmetic_arr['size']= $size_id;
//                    $cosmetic_arr['quantity'] =$each_size[1];
//                    $cosmetic_arr['price'] =$each_size[2];
//                   // $cosmetic_arr['flag'] =1;//excel
//             
//             $cosmetic_arr_all[] = $cosmetic_arr;
//                }
//
//                }





                                    $cosmetic_arr = array();
                                    $cosmetic_arr_all = array();


//                                    $cosm_sizes = $pro['cosmetic_size'];
//
//                                    $cosm_sizes = explode('#', $cosm_sizes);
//
//                                    if ($cosm_sizes and $attributes['category_id']) {
//
//                                        for ($k = 0; $k <= sizeof($cosm_sizes); $k++) {
//                                            $each_size = explode(',', $cosm_sizes[$k]);
//                                            $size = $each_size[$k];
//                                            $size_id = Sizes::model()->find("lower(title) like lower('%$size%')")->id;
//                                            if ($size_id != null) {
//                                                $cosmetic_arr['size'] = $size_id;
//                                            } else {
//                                                $sizes_m = new Sizes;
//                                                $sizes_m->category_id = $attributes['category_id'];
//                                                $sizes_m->title = $size;
//                                                $sizes_m->save(false);
//                                                $cosmetic_arr['size'] = $sizes_m->id;
//                                            }
//                                            $cosmetic_arr['quantity'] = $each_size[1];
//                                            if ($each_size[2] != '') {
//                                                $cosmetic_arr['price'] = $each_size[2];
//                                            } else {
//                                                $cosmetic_arr['price'] = $attributes['price'];
//                                            }
//                                            $cosmetic_arr['flag'] = 1; //excel
//
//                                            $cosmetic_arr_all[] = $cosmetic_arr;
//                                        }
//                                    }
//                                    $details_attributes['decor_style_id'] = '';
//                                    $details_attributes['decor_type_id'] = '';
//                                    $details_attributes['dimensions'] = '';
//                                    if ($attributes['category_id'] == 6) {
//                                        //decor style 
//                                        $decor_style_name = $pro['decor_style'];
//                                        $decor_style = (DecorStyle::model()->find("lower(title) like lower('%$decor_style_name%')"));
//                                        if ($decor_style != null) {
//                                            $details_attributes['decor_style_id'] = $decor_style->id;
//                                        } else {
//                                            $decor_style_m = new DecorStyle;
//                                            $decor_style_m->title = $decor_style_name;
//                                            $decor_style_m->save(false);
//                                            $details_attributes['decor_style_id'] = $decor_style_m->id;
//                                        }
//
//                                        //decor type 
//                                        $decor_type_name = $pro['decor_type'];
//                                        $decor_type = (DecorType::model()->find("lower(title) like lower('%$decor_type_name%')"));
//                                        if ($decor_type != null) {
//                                            $details_attributes['decor_type_id'] = $decor_type->id;
//                                        } else {
//                                            $decor_type_m = new DecorType;
//                                            $decor_type_m->title = $decor_type_name;
//                                            $decor_type_m->save(false);
//                                            $details_attributes['decor_type_id'] = $decor_type_m->id;
//                                        }
//
//                                        //dimensions
//
//                                        $details_attributes['dimensions'] = $pro['dimensions'];
//                                    }
//                                    $details_attributes['make_id'] = '';
//                                    $details_attributes['motor_model_id'] = '';
//                                       $details_attributes['dimensions']='';
//                                    if ($attributes['category_id'] == 5) {
//
//                                        // make 
//                                        $motor_make_name = $pro['manufacure'];
//                                        $motor_make = (Make::model()->find("lower(title) like lower('%$motor_make_name%')"));
//                                        if ($motor_make != null) {
//                                            $details_attributes['make_id'] = $motor_make->id;
//                                        } else {
//                                            $make = new Make;
//                                            $make->title = $motor_make_name;
//                                            $make->save(false);
//                                            $details_attributes['make_id'] = $make->id;
//                                        }
//
//                                        //motor model 
//                                        $motor_model_name = $pro['model'];
//                                        $motor_model = (MotorModel::model()->find("lower(title) like lower('%$motor_model_name%')"));
//                                        if ($motor_model != null) {
//                                            $details_attributes['motor_model_id'] = $motor_model->id;
//                                        } else {
//                                            $motor_model_m = new MotorModel;
//                                            $motor_model_m->title = $motor_model_name;
//                                            $motor_model_m->save(false);
//                                            $details_attributes['motor_model_id'] = $motor_model_m->id;
//                                        }
//                                    }
//           echo '<pre>';
//           print_r($attributes);die;
//            echo '<pre>';
                                    $model = new Product;
                                    $model->attributes = $attributes;
                                    if ($id = Product::model()->saveXml($attributes, $details_attributes, $pro_colors, $pro_sizes, $cosmetic_arr_all)) {


                                        //gallery
                                        $gallery = $pro['gallery'];
                                        $gal = explode('{gallery}', $gallery);
                                        //print_r($gallery[0]['large']);die;
                                        for ($g = 0; $g < sizeof($gal); $g++) {
                                            $single_gallery = explode('{thumb}', $gal[$g]);
                                            $gallery_m = new XmlGallery;
                                            $gallery_m->image = trim($single_gallery[0]);
                                            $gallery_m->thumb = trim($single_gallery[1]);
                                            $gallery_m->product_id = $id;
                                            $gallery_m->save(false);
                                        }
                                    }
                                }
                            }
                        }
                        // }


                        Yii::app()->user->setFlash('xml_success', 'Congratulations! the file inserted successfully.');
                        if (!$_GET['flag']) {
                            $this->redirect(array('users/dashboard'));
                        } else {
                            $this->redirect(array('admin/product'));
                        }
                        fclose($handle);
                    } else {
                        Yii::app()->user->setFlash('xml_fail', 'sorry there are errors in the excel file.please check the excel guide.');
                        if (!$_GET['flag']) {
                            $this->redirect(array('users/dashboard'));
                        } else {
                            $this->redirect(array('admin/product'));
                        }
                    }
                } else {
                    Yii::app()->user->setFlash('xml_fail', 'sorry failed to open file.');
                    if (!$_GET['flag']) {
                        $this->redirect(array('users/dashboard'));
                    } else {
                        $this->redirect(array('admin/product'));
                    }
                }
            } else {
                Yii::app()->user->setFlash('xml_fail', 'sorry this file is not allowed.');
                if (!$_GET['flag']) {
                    $this->redirect(array('users/dashboard'));
                } else {
                    $this->redirect(array('admin/product'));
                }
            }
        }
    }

    function ActionItemSearch() {
//Set the values for some of the parameters
        $Operation = "ItemSearch";
        $Version = "2013-08-01";
        $ResponseGroup = "ItemAttributes,Offers";
//User interface provides values
//for $SearchIndex and $Keywords
//Define the request

        $request = "http://webservices.amazon.com/onca/xml"
                . "?Service=AWSECommerceService"
                . "&AssociateTag=" . "exclusivelu0a-21"
                . "&AWSAccessKeyId=" . "AKIAIJTDX5JX6QB7D5HQ"
                . "&Operation=" . $Operation
                . "&Version=" . $Version
                . "&SearchIndex=Books"
                . "&Keywords=harry+potter"
//. "&Signature=" . "L%2FmKzjbETz5a7QpmmFf2k6n4mrGhnuSuUldhqvt3Ncs%3D"
                . "&Timestamp=2014-11-28T19:37:18.000Z"
                . "&ResponseGroup=" . $ResponseGroup;
//Catch the response in the $response object

        $signature = base64_encode(hash_hmac('sha256', $request, "pk-APKAJ4AXZMTLIQUOBNRQ.pem", TRUE));

        $request = "http://webservices.amazon.com/onca/xml"
                . "?Service=AWSECommerceService"
                . "&AssociateTag=" . "exclusivelu0a-21"
                . "&AWSAccessKeyId=" . "AKIAIJTDX5JX6QB7D5HQ"
                . "&Operation=" . $Operation
                . "&Version=" . $Version
                . "&SearchIndex=Books"
                . "&Keywords=harry+potter"
                . "&Timestamp=2014-11-30T19:37:18.000Z"
                . "&ResponseGroup=" . $ResponseGroup
                . "&Signature=" . $signature;
        echo $request;
        $response = file_get_contents($request);
        $parsed_xml = simplexml_load_string($response);
        printSearchResults($parsed_xml, "Books");
    }

    public function ActionTestAmazon() {



        $search_value = $_POST['search_value'];
        $category = $_POST['category'];
        $country = $_POST['country'];
      //  $browse_search = $_POST['browse_search'];





        if ("cli" !== PHP_SAPI) {
            //echo "<pre>";
        }

//if (is_file('sampleSettings.php'))
//{
//  include 'sampleSettings.php';
//}

        $settings = Settings::model()->findByPk(1);
        defined('AWS_API_KEY') or define('AWS_API_KEY', $settings->aws_api_key);
        defined('AWS_API_SECRET_KEY') or define('AWS_API_SECRET_KEY', $settings->aws_api_secret_key);
        defined('AWS_ASSOCIATE_TAG') or define('AWS_ASSOCIATE_TAG', $settings->aws_associate_tag);

//echo Yii::app()->basePath.'/extensions/AmazonECS.class.php';
require Yii::app()->basePath.'/extensions/AmazonECS.class.php';

        try {
            // get a new object with your API Key and secret key. Lang is optional.
            // if you leave lang blank it will be US.
            $amazonEcs = new AmazonECS(AWS_API_KEY, AWS_API_SECRET_KEY, 'de', AWS_ASSOCIATE_TAG);

            // If you are at min version 1.3.3 you can enable the requestdelay.
            // This is usefull to get rid of the api requestlimit.
            // It depends on your current associate status and it is disabled by default.
            // $amazonEcs->requestDelay(true);
            // for the new version of the wsdl its required to provide a associate Tag
            // @see https://affiliate-program.amazon.com/gp/advertising/api/detail/api-changes.html?ie=UTF8&pf_rd_t=501&ref_=amb_link_83957571_2&pf_rd_m=ATVPDKIKX0DER&pf_rd_p=&pf_rd_s=assoc-center-1&pf_rd_r=&pf_rd_i=assoc-api-detail-2-v2
            // you can set it with the setter function or as the fourth paramameter of ther constructor above
            $amazonEcs->associateTag(AWS_ASSOCIATE_TAG);

            // changing the category to DVD and the response to only images and looking for some matrix stuff.
            $response = $amazonEcs->category($category)->country($country)->responseGroup('Large')->search($search_value);
//     $response = $amazonEcs->country('com');
//            echo '<pre>';
//            print_r($response);
//            echo '<pre>';die;
//            
//$item = $response->Items->Item[0];
//$browse_node=array();
//$browse_node_c=array();
//$browse_nodes = $item->BrowseNodes;
//
//
//    $browse_nodes = $item->BrowseNodes;
//if($browse_no = $browse_nodes->BrowseNode[0]){
//    
//    $browse_node[0] = $browse_nodes->BrowseNode[0]->Name;
//    $browse_node[1] = $browse_nodes->BrowseNode[0]->Ancestors->BrowseNode->Name;
//    $browse_node[2] = $browse_nodes->BrowseNode[0]->Ancestors->BrowseNode->Ancestors->BrowseNode->Name;    
//$browse_node[3] = $browse_nodes->BrowseNode[0]->Ancestors->BrowseNode->Ancestors->BrowseNode->Ancestors->BrowseNode->Name;    
//$browse_node[4] = $browse_nodes->BrowseNode[0]->Ancestors->BrowseNode->Ancestors->BrowseNode->Ancestors->BrowseNode->Ancestors->BrowseNode->Name; 
//$browse_node[5] = $browse_nodes->BrowseNode[0]->Ancestors->BrowseNode->Ancestors->BrowseNode->Ancestors->BrowseNode->Ancestors->BrowseNode->Ancestors->BrowseNode->Name; 
//$browse_node[6] = $browse_nodes->BrowseNode[0]->Ancestors->BrowseNode->Ancestors->BrowseNode->Ancestors->BrowseNode->Ancestors->BrowseNode->Ancestors->BrowseNode->Ancestors->BrowseNode->Name; 
//$browse_node[7] = $browse_nodes->BrowseNode[0]->Ancestors->BrowseNode->Ancestors->BrowseNode->Ancestors->BrowseNode->Ancestors->BrowseNode->Ancestors->BrowseNode->Ancestors->BrowseNode->Ancestors->BrowseNode->Name; 
//
//}
//echo '<pre>';
//print_r($browse_node);
//echo '<pre>';die;
            // from now on you want to have pure arrays as response
            //$amazonEcs->returnType(AmazonECS::RETURN_TYPE_ARRAY);
            // searching again
            //$response = $amazonEcs->search('Bud Spencer');
            //var_dump($response);
            // and again... Changing the responsegroup and category before
            //$response = $amazonEcs->responseGroup('Small')->category('Books')->search('PHP 5');
            //var_dump($response);
            // category has been set so lets have a look for another book
            //$response = $amazonEcs->search('MySql');
            //var_dump($response);
            // want to look in the US Database? No Problem
            //$response = $amazonEcs->country('com')->search('MySql');
            //var_dump($response);
            // or Japan?
            //$response = $amazonEcs->country('co.jp')->search('MySql');
            //var_dump($response);
            // Back to DE and looking for some Music !! Warning "Large" produces a lot of Response
            //$response = $amazonEcs->country('de')->category('Music')->responseGroup('Small')->search('The Beatles');
            //var_dump($response);
            // Or doing searchs in a loop?
//   for ($i = 1; $i < 4; $i++)
//   {
//     $response = $amazonEcs->search('Matrix ' . $i);
//     //var_dump($response);
//   }
            // Want to have more Repsonsegroups?                         And Maybe you want to start with resultpage 2?
            // $response = $amazonEcs->responseGroup('Small,Images')->optionalParameters(array('ItemPage' => 2))->search('Bruce Willis');
            //var_dump($response);
            // With version 1.2 you can use the page function to set up the page of the resultset
            //$response = $amazonEcs->responseGroup('Small,Images')->page(3)->search('Bruce Willis');
            //print_r($response);
        } catch (Exception $e) {
            echo $e->getMessage();
        }

        if ("cli" !== PHP_SAPI) {
            // echo "</pre>";
        }

        $cats = Category::model()->findAll();
        $sellers = User::model()->findAll("groups_id = 4");

        $this->render("testamazon", array("response" => $response, 'category' => $category,
            "country" => $country, "search_value" => $search_value, 'cats' => $cats, 'sellers' => $sellers));
    }

    public function actionSaveAmazon() {


        $search_value = $_POST['search_value'];
        $category = $_POST['category'];
        $country = $_POST['country'];
        // $browse_search = $_POST['browse_search'];


        $my_category = $_POST['main_category'];
        $user = $_POST['seller'];

        if ("cli" !== PHP_SAPI) {
            //echo "<pre>";
        }

        $settings= Settings::model()->findByPk(1);
        defined('AWS_API_KEY') or define('AWS_API_KEY', $settings->aws_api_key);
        defined('AWS_API_SECRET_KEY') or define('AWS_API_SECRET_KEY', $settings->aws_api_secret_key);
        defined('AWS_ASSOCIATE_TAG') or define('AWS_ASSOCIATE_TAG', $settings->aws_associate_tag);

require Yii::app()->basePath.'/extensions/AmazonECS.class.php';
        try {
            // get a new object with your API Key and secret key. Lang is optional.
            // if you leave lang blank it will be US.
            $amazonEcs = new AmazonECS(AWS_API_KEY, AWS_API_SECRET_KEY, 'de', AWS_ASSOCIATE_TAG);

            // If you are at min version 1.3.3 you can enable the requestdelay.
            // This is usefull to get rid of the api requestlimit.
            // It depends on your current associate status and it is disabled by default.
            // $amazonEcs->requestDelay(true);
            // for the new version of the wsdl its required to provide a associate Tag
            // @see https://affiliate-program.amazon.com/gp/advertising/api/detail/api-changes.html?ie=UTF8&pf_rd_t=501&ref_=amb_link_83957571_2&pf_rd_m=ATVPDKIKX0DER&pf_rd_p=&pf_rd_s=assoc-center-1&pf_rd_r=&pf_rd_i=assoc-api-detail-2-v2
            // you can set it with the setter function or as the fourth paramameter of ther constructor above
            $amazonEcs->associateTag(AWS_ASSOCIATE_TAG);

            // changing the category to DVD and the response to only images and looking for some matrix stuff.
            $response = $amazonEcs->category($category)->country($country)->responseGroup('Large')->search($search_value);
        } catch (Exception $e) {
            echo $e->getMessage();
        }

        if ("cli" !== PHP_SAPI) {
            //  echo "</pre>";
        }


        $arr = array();
//print_r($_POST['check']) ;die;
        for ($k = 0; $k < sizeof($_POST['check']); $k++) {
            echo 'check' . $_POST['check'][$k];
            if ($_POST['check'][$k]) {
                $arr[] = $_POST['check'][$k];
            }
        }
        //  echo sizeof($_POST['check']).'=';
        //print_r($arr);die;


        $attributes = array();
        $details_attributes = array();
//         echo sizeof($response->Items->Item);die;
        for ($i = 0; $i < sizeof($response->Items->Item); $i++) {
            $item = $response->Items->Item[$i];
            echo $item->ASIN . '--';
            //print_r($item);
            //echo $item->ASIN ;
            if (in_array($item->ASIN, $arr)) {


                //browse nodes
                $browse_node = array();
                $browse_nodes = $item->BrowseNodes;
//                echo '<pre>';
//                print_r($browse_nodes->BrowseNode[0]);echo '<pre>';
//if( $browse_nodes->BrowseNode){

                $browse_node[0] = $browse_nodes->BrowseNode->Name;
                $browse_node[1] = $browse_nodes->BrowseNode->Ancestors->BrowseNode->Name;
                $browse_node[2] = $browse_nodes->BrowseNode->Ancestors->BrowseNode->Ancestors->BrowseNode->Name;
                $browse_node[3] = $browse_nodes->BrowseNode->Ancestors->BrowseNode->Ancestors->BrowseNode->Ancestors->BrowseNode->Name;
                $browse_node[4] = $browse_nodes->BrowseNode->Ancestors->BrowseNode->Ancestors->BrowseNode->Ancestors->BrowseNode->Ancestors->BrowseNode->Name;
                $browse_node[5] = $browse_nodes->BrowseNode->Ancestors->BrowseNode->Ancestors->BrowseNode->Ancestors->BrowseNode->Ancestors->BrowseNode->Ancestors->BrowseNode->Name;
                $browse_node[6] = $browse_nodes->BrowseNode->Ancestors->BrowseNode->Ancestors->BrowseNode->Ancestors->BrowseNode->Ancestors->BrowseNode->Ancestors->BrowseNode->Ancestors->BrowseNode->Name;
                $browse_node[7] = $browse_nodes->BrowseNode->Ancestors->BrowseNode->Ancestors->BrowseNode->Ancestors->BrowseNode->Ancestors->BrowseNode->Ancestors->BrowseNode->Ancestors->BrowseNode->Ancestors->BrowseNode->Name;

                // }        
                //end

                $browse_node = array_filter($browse_node);
//             $browse_node = array_filter($browse_node);
//            echo '6666'; 
              //  print_r($browse_node);
//                for($j=sizeof($browse_node) ; $j>=0 ; $j--){
                $j = sizeof($browse_node);
                //  if($browse_node[$j] != ''){
                //    $atrributes['category_id'] =  $browse_node[$j];
//                      $attributes['product_category_id'] = $browse_node[$j-1];
//                       $attributes['sub_category_id'] = $browse_node[$j-3];
                //  }
                // }

                $attributes['category_id'] = $my_category;

                //product category 
                $pro_category_name = $browse_node[$j - 1];
                $pro_category_id = (ProductCategory::model()->find("category_id = $my_category and lower(title) like lower('%$pro_category_name%')"));
                if ($pro_category_id != null) {
                    $attributes['product_category_id'] = $pro_category_id->id;
                } else {
                    $procategory = new ProductCategory;
                    $procategory->category_id = $attributes['category_id'];
                    $procategory->title = $pro_category_name;
                    $procategory->save(false);
                    $attributes['product_category_id'] = $procategory->id;
                }


                //sub category 
                $sub_category_name = $browse_node[$j - 3];
                $pro_cat = $attributes['product_category_id'];
                $sub_category = (SubCategory::model()->find("product_category_id =$pro_cat and lower(title) like lower('%$sub_category_name%')"));
                if ($sub_category != null) {
                    $details_attributes['sub_category_id'] = $sub_category->id;
                } else {
                    $subcategory = new SubCategory;
                    $subcategory->product_category_id = $attributes['product_category_id'];
                    $subcategory->title = $sub_category_name;
                    $subcategory->save(false);
                    $details_attributes['sub_category_id'] = $subcategory->id;
                }


//            $attributes['category_id'] = $my_category;
                $attributes['user_id'] = $user;
                $attributes['title'] = $item->ItemAttributes->Title;
                $attributes['description'] = $item->ItemAttributes->Title;

                //price
                $attributes['price'] = ($item->ItemAttributes->ListPrice->Amount) / 100;


                //Quantity
                $attributes['quantity'] = $item->ItemAttributes->PackageQuantity;


                //Brand
                $brand_name = $item->ItemAttributes->Brand;

                $brand = (Brand::model()->find("lower(title) like lower('%$brand_name%')"));
                if ($brand != null) {
                    $details_attributes['brand_id'] = $brand->id;
                } else {
                    $brand_m = new Brand;
                    $brand_m->title = $brand_name;
                    $brand_m->category_id = $attributes['category_id'];
                    $brand_m->save(false);
                    $details_attributes['brand_id'] = $brand_m->id;
                }

                //image
                $attributes['main_image'] = $item->LargeImage->URL;


                //thumb 
                $attributes['thumb'] = $item->SmallImage->URL;

//                               $gallery= $item->ImageSets->ImageSet;
//                                 
//  echo '<pre>';  print_r($details_attributes);  echo '<pre>';die;

                $model = new Product;
                $model->attributes = $attributes;
                if ($id = Product::model()->saveXml($attributes, $details_attributes, null, null, null)) {


                    $gallery = $item->ImageSets->ImageSet;
                    if ($gallery != null) {
                        for ($b = 0; $b < sizeof($gallery) - 1; $b++) {
                            $MediumImage = $gallery[0]->MediumImage->URL;
                            $LargeImage = $gallery[0]->LargeImage->URL;
                            $gallery_m = new XmlGallery;
                            if ($LargeImage)
                                $gallery_m->image = $LargeImage;
                            if ($MediumImage)
                                $gallery_m->thumb = $MediumImage;
                            $gallery_m->product_id = $id;
                            $gallery_m->save(false);
                        }
                    }
                }
//
//                                        echo '<pre>';
//            print_r($attributes);echo '<pre>';
//            
//                   echo '<pre>';
//            print_r($details_attributes);echo '<pre>';
            }
        }

        Yii::app()->user->setFlash('xml_success', 'Congratulations! Amazon products inserted successfully.');
        if (!$_GET['flag']) {
            $this->redirect(array('users/dashboard'));
        } else {
            $this->redirect(array('admin/product'));
        }
    }

    public function ActionAffiliateWindow() {
        $search_value = $_POST['search_value'];
        require Yii::app()->basePath . '/extensions/affiliate-window-soapclient-master/library/AffiliateWindow/ProductServeSoapClient.php';
      $settings = Settings::model()->findByPk(1);
        $awPsClient = new \AffiliateWindow\ProductServeSoapClient($settings->affiliate_window_key);
        $response = $awPsClient->getProductList(array(
            'sQuery' => $search_value,
            'iLimit' => 10
        ));

//$response = $awPsClient->getCategory(array(
//    'iCategoryId' => '173',
//   
//));
//echo '<pre>';
//print_r($response);die;
//echo '<pre>';
//         $products = $response->oProduct;
//        for($i=0 ; $i < sizeof($products) ;$i++){
//           echo  $subcat_id = $products[$i]->iCategoryId.'-';
//           
//           // get name of subcat 
//           $cat = $awPsClient->getCategory(array(
//                'iCategoryId' => $subcat_id,
//            ));
//         echo  $cat_name = $cat->sName;
//        }
//echo '<pre>';
//$output= '';
//$output.= $awPsClient->__getLastRequest();
//$output.= $awPsClient->__getLastResponse();
//$output= str_replace('><', ">\n<", $output);
//print $output;
//print_r($response);
//echo '</pre>';

        $cats = Category::model()->findAll();
        $sellers = User::model()->findAll("groups_id = 4");
        $this->render("affilate", array('response' => $response, 'cats' => $cats, 'sellers' => $sellers, "search_value" => $search_value));
    }

    public function actionSaveAffilate() {


        $search_value = $_POST['search_value'];
//        $category = $_POST['category'];
//        $country = $_POST['country'];
        // $browse_search = $_POST['browse_search'];


        $my_category = $_POST['main_category'];
        $user = $_POST['seller'];

//        if ("cli" !== PHP_SAPI)
//{
//    //echo "<pre>";
//}


        require Yii::app()->basePath . '/extensions/affiliate-window-soapclient-master/library/AffiliateWindow/ProductServeSoapClient.php';
        $settings = Settings::model()->findByPk(1);
        $awPsClient = new \AffiliateWindow\ProductServeSoapClient($settings->affiliate_window_key);
        $response = $awPsClient->getProductList(array(
            'sQuery' => $search_value,
            'iLimit' => 10
        ));


        $arr = array();
//print_r($_POST['check']) ;die;
        for ($k = 0; $k < sizeof($_POST['check']); $k++) {
            echo ($_POST['check'][$k]);
            if (isset($_POST['check'][$k])) {
                $arr[] = $_POST['check'][$k];
            }
        }
        //  echo sizeof($_POST['check']).'=';
        //print_r($arr);


        $attributes = array();
        $details_attributes = array();
//         echo sizeof($response->Items->Item);die;
        $products = $response->oProduct;
//          echo '<pre>';
//          print_r($products);echo '<pre>';die;
        for ($k = 0; $k < sizeof($products); $k++) {
            $item = $products[$k];
         //   echo $item->iId . '-';
            if (in_array($item->iId, $arr)) {


                $attributes['category_id'] = $my_category;


                $aff_subcat = $awPsClient->getCategory(array(
                    'iCategoryId' => $item->iCategoryId,
                ));
                //  print_r($aff_subcat);
                $aff_sub_category_name = $aff_subcat->oCategory->sName;

                $aff_procat = $awPsClient->getCategory(array(
                    'iCategoryId' => $aff_subcat->oCategory->iParentId,
                ));
                $aff_pro_category_name = $aff_procat->oCategory->sName;


                //  product category 
                $pro_category_name = $aff_pro_category_name;
                $pro_category_id = (ProductCategory::model()->find("category_id = $my_category and lower(title) like lower('%$pro_category_name%')"));
                if ($pro_category_id != null) {
                    $attributes['product_category_id'] = $pro_category_id->id;
                } else {
                    $procategory = new ProductCategory;
                    $procategory->category_id = $attributes['category_id'];
                    $procategory->title = $pro_category_name;
                    $procategory->save(false);
                    $attributes['product_category_id'] = $procategory->id;
                }

                //sub category 
                $sub_category_name = $aff_sub_category_name;
                $pro_cat = $attributes['product_category_id'];
                $sub_category = (SubCategory::model()->find("product_category_id =$pro_cat and lower(title) like lower('%$sub_category_name%')"));
                if ($sub_category != null) {
                    $details_attributes['sub_category_id'] = $sub_category->id;
                } else {
                    $subcategory = new SubCategory;
                    $subcategory->product_category_id = $attributes['product_category_id'];
                    $subcategory->title = $sub_category_name;
                    $subcategory->save(false);
                    $details_attributes['sub_category_id'] = $subcategory->id;
                }
//                                    
//
//            
//            $attributes['category_id'] = $my_category;
                $attributes['user_id'] = $user;
                $attributes['title'] = $item->sName;
                $attributes['description'] = $item->sName;

                //price
                $attributes['price'] = $item->fPrice;


                //Quantity
                //       $attributes['quantity'] = $item->ItemAttributes->PackageQuantity;
                //Brand
                //    $brand_name = $item->ItemAttributes->Brand;
//                                        $brand = (Brand::model()->find("lower(title) like lower('%$brand_name%')"));
//                                        if ($brand != null) {
//                                            $details_attributes['brand_id'] = $brand->id;
//                                        } else {
//                                            $brand_m = new Brand;
//                                            $brand_m->title = $brand_name;
//                                            $brand_m->category_id = $attributes['category_id'];
//                                            $brand_m->save(false);
//                                            $details_attributes['brand_id'] = $brand_m->id;
//                                        }
                //image
                $attributes['main_image'] = $item->sAwThumbUrl;


                //thumb 
                $attributes['thumb'] = $item->sAwThumbUrlL;

//                               $gallery= $item->ImageSets->ImageSet;
//                                 
//  echo '<pre>';  print_r($attributes);  echo '<pre>';die;

                $model = new Product;
                $model->attributes = $attributes;
                if ($id = Product::model()->saveXml($attributes, $details_attributes, null, null, null)) {


//                                        $gallery= $item->ImageSets->ImageSet;
//                                        if($gallery){
//                                        for ($b = 0; $b < sizeof($gallery)-1; $b++) {
//                                            $MediumImage = $gallery[0]->MediumImage->URL;
//                                            $LargeImage = $gallery[0]->LargeImage->URL;
//                                            $gallery_m = new XmlGallery;
//                                           if($LargeImage) $gallery_m->image = $LargeImage;
//                                           if($MediumImage) $gallery_m->thumb = $MediumImage;
//                                            $gallery_m->product_id = $id;
//                                            $gallery_m->save(false);
//                                        }
//                                    
//                                    }
                }
//
//                                        echo '<pre>';
//            print_r($attributes);echo '<pre>';
//            
//                   echo '<pre>';
//            print_r($details_attributes);echo '<pre>';
            }
        }

        Yii::app()->user->setFlash('xml_success', 'Congratulations! Affiliate Window products inserted successfully.');
        if (!$_GET['flag']) {
            $this->redirect(array('users/dashboard'));
        } else {
            $this->redirect(array('admin/product'));
        }
    }

    public function ActionJunction() {
        $search_value = $_POST['search_value'];

        require Yii::app()->basePath . '/extensions/comm/lib/CROSCON/CommissionJunction/Client.php';
        require Yii::app()->basePath . '/extensions/comm/lib/CROSCON/CommissionJunction/Exception.php';

        $settings = Settings::model()->findByPk(1);
        $api_key = $settings->junction_key;

        $client = new CROSCON\CommissionJunction\Client($api_key);

//$languages = $client->supportLookup('languages');
        try {

            $parameters = array(
//    "authorization"=>'00913e47db74b3f06ed5e6fda2e5a21e248890b1dca770f6ee514d8bdcf5b7e6f17524646d13fd45d22f12aa4c9486d2e4b35f414deda958fdf0bba937fefbb861/7a059bf30859bfee2df0b137f0ba419ea9c8fe5485abc718b2df76587d6b322e737d4ec962f710ccfa594c7c50e53e7fb54ef297ba34b4ac18bc34227df93c4d',
                "website-id" => $settings->junction_website_id,
                "keywords" => $search_value,
                "serviceable-area" => "US"
            );
            $products = $client->productSearch($parameters);
//echo '<pre>';
//print_r($client->productSearch($parameters));
//echo '<pre>';
//echo "\n";
        } catch (\CROSCON\CommissionJunction\Exception $e) {
            echo "!! ERROR: {$e->getMessage()}";
        }

        $cats = Category::model()->findAll();
        $sellers = User::model()->findAll("groups_id = 4");
        $this->render("comm", array("products" => $products, "cats" => $cats, "sellers" => $sellers, "search_value" => $search_value));
    }

    public function actionSaveComm() {


        $search_value = $_POST['search_value'];


        $main_category = $_POST['main_category'];
        $pro_category = $_POST['pro_category'];
        $sub_category = $_POST['sub_category'];
        $user = $_POST['seller'];

//        if ("cli" !== PHP_SAPI)
//{
//    //echo "<pre>";
//}


        require Yii::app()->basePath . '/extensions/comm/lib/CROSCON/CommissionJunction/Client.php';
        require Yii::app()->basePath . '/extensions/comm/lib/CROSCON/CommissionJunction/Exception.php';

         $settings = Settings::model()->findByPk(1);
        $api_key = $settings->junction_key;
        
        $client = new CROSCON\CommissionJunction\Client($api_key);

//$languages = $client->supportLookup('languages');
        try {

            $parameters = array(
//    "authorization"=>'00913e47db74b3f06ed5e6fda2e5a21e248890b1dca770f6ee514d8bdcf5b7e6f17524646d13fd45d22f12aa4c9486d2e4b35f414deda958fdf0bba937fefbb861/7a059bf30859bfee2df0b137f0ba419ea9c8fe5485abc718b2df76587d6b322e737d4ec962f710ccfa594c7c50e53e7fb54ef297ba34b4ac18bc34227df93c4d',
                "website-id" => $settings->junction_website_id,
                "keywords" => $search_value,
                "serviceable-area" => "US"
            );
            $products = $client->productSearch($parameters);
//echo '<pre>';
//print_r($client->productSearch($parameters));
//echo '<pre>';
//echo "\n";
        } catch (\CROSCON\CommissionJunction\Exception $e) {
            echo "!! ERROR: {$e->getMessage()}";
        }



        $arr = array();
//print_r($_POST['check']) ;die;
        for ($k = 0; $k < sizeof($_POST['check']); $k++) {
            // echo ($_POST['check'][$k]);
            if (isset($_POST['check'][$k])) {
                $arr[] = $_POST['check'][$k];
            }
        }
        //  echo sizeof($_POST['check']).'=';
//         print_r($arr);


        $attributes = array();
        $details_attributes = array();
//         echo sizeof($response->Items->Item);die;
        $products = $products['products']['product'];
//          echo '<pre>';
//          print_r($products);echo '<pre>';die;
        for ($k = 0; $k < sizeof($products); $k++) {
            $item = $products[$k];
            // echo $item['ad-id'].'-';
            if (in_array($item['ad-id'], $arr)) {


                $attributes['category_id'] = $main_category;




                //  product category 

                $details_attributes['product_category_id'] = $pro_category;


                //sub category 

                $details_attributes['sub_category_id'] = $sub_category;


//            
//            $attributes['category_id'] = $my_category;
                $attributes['user_id'] = $user;
                $attributes['title'] = Helper::limit_words($item['description'], 10);
                $attributes['description'] = $item['description'];

                //price
                $attributes['price'] = $item['manufacturer-sku']['price'];


                //Quantity
                //       $attributes['quantity'] = $item->ItemAttributes->PackageQuantity;
                //Brand
                //    $brand_name = $item->ItemAttributes->Brand;
//                                        $brand = (Brand::model()->find("lower(title) like lower('%$brand_name%')"));
//                                        if ($brand != null) {
//                                            $details_attributes['brand_id'] = $brand->id;
//                                        } else {
//                                            $brand_m = new Brand;
//                                            $brand_m->title = $brand_name;
//                                            $brand_m->category_id = $attributes['category_id'];
//                                            $brand_m->save(false);
//                                            $details_attributes['brand_id'] = $brand_m->id;
//                                        }
                //image
                $attributes['main_image'] = $item['image-url'];


                //thumb 
                $attributes['thumb'] = $item['image-url'];
                $attributes['url'] = $item['buy-url'];

//                               $gallery= $item->ImageSets->ImageSet;
//                                 
//  echo '<pre>';  print_r($attributes);  echo '<pre>';die;

                $model = new Product;
                $model->attributes = $attributes;
                if ($id = Product::model()->saveXml($attributes, $details_attributes, null, null, null)) {


//                                        $gallery= $item->ImageSets->ImageSet;
//                                        if($gallery){
//                                        for ($b = 0; $b < sizeof($gallery)-1; $b++) {
//                                            $MediumImage = $gallery[0]->MediumImage->URL;
//                                            $LargeImage = $gallery[0]->LargeImage->URL;
//                                            $gallery_m = new XmlGallery;
//                                           if($LargeImage) $gallery_m->image = $LargeImage;
//                                           if($MediumImage) $gallery_m->thumb = $MediumImage;
//                                            $gallery_m->product_id = $id;
//                                            $gallery_m->save(false);
//                                        }
//                                    
//                                    }
                }
//
//                                        echo '<pre>';
//            print_r($attributes);echo '<pre>';
//            
//                   echo '<pre>';
//            print_r($details_attributes);echo '<pre>';
            }
        }

        Yii::app()->user->setFlash('xml_success', 'Congratulations! Commission Junction products inserted successfully.');
        if (!$_GET['flag']) {
            $this->redirect(array('users/dashboard'));
        } else {
            $this->redirect(array('admin/product'));
        }
    }

    public function ActionGetProCats() {
        $cat_id = $_POST['cat_id'];
        $procats = ProductCategory::model()->findAll("category_id = $cat_id");

        $output = '<option value="">select product category</option>';
        foreach ($procats as $procat) {
            $output.= '<option value="' . $procat->id . '">' . $procat->title . '</option>';
        }
        echo $output;
    }

    public function ActionGetSubCats() {
        $procat_id = $_POST['procat_id'];
        $subcats = SubCategory::model()->findAll("product_category_id = $procat_id");

        $output = '<option value="">select sub category</option>';
        foreach ($subcats as $subcat) {
            $output.= '<option value="' . $subcat->id . '">' . $subcat->title . '</option>';
        }
        echo $output;
    }
    
    
    Public function ActionTradeDoubler(){
        
        $search_value = $_POST['search_value'];
        $tdCategoryId = $_POST['tdCategoryId'];
        
        require Yii::app()->basePath . '/extensions/TradeDoublerPOAPI.php';
     
        $api = new TradeDoublerPOAPI();
       
$query_keys = array (

  "q"         =>   $search_value,
//  "minPrice"  =>    0,
  "tdCategoryId"=>$tdCategoryId,
//  "maxPrice"  =>    500,
  "limit"     =>    50

);

$response = $api->searchService($query_keys);
$data = $api->unserializeJson($response);
$products = $data['products'];

$t = array();
$fields = $products[0]['fields'];
for($f = 0 ; $f<sizeof($fields) ; $f++){
    $name= $fields[$f]['name'];
     $t[$name] = $fields[$f]['value'];
}
//echo '<pre>';
//print_r($t);
//echo '<pre>';
//die;
        $cats = Category::model()->findAll();
        $sellers = User::model()->findAll("groups_id = 4");
        
        $this->render("trade_doubler" , array("cats"=>$cats , 'sellers'=>$sellers , 'products'=>$products ,
            'search_value'=>$search_value , 'tdCategoryId'=>$tdCategoryId));
    }
    

    
    
     public function actionSaveTradeDoubler() {

        $search_value = $_POST['search_value'];
        $tdCategoryId = $_POST['tdCategoryId'];


        $main_category = $_POST['main_category'];
        $pro_category = $_POST['pro_category'];
        $sub_category = $_POST['sub_category'];
        $user = $_POST['seller'];

        
         require Yii::app()->basePath . '/extensions/TradeDoublerPOAPI.php';

        $api = new TradeDoublerPOAPI();
$query_keys = array (

  "q"         =>   $search_value,
//  "minPrice"  =>    0,
  "tdCategoryId"=>$tdCategoryId,
//  "maxPrice"  =>    500,
  "limit"     =>    50

);

$response = $api->searchService($query_keys);
$data = $api->unserializeJson($response);
$products = $data['products'];
//print_r($products);die;

        $arr = array();
//print_r($_POST['check']) ;die;
        for ($k = 0; $k < sizeof($_POST['check']); $k++) {
            // echo ($_POST['check'][$k]);
            if (isset($_POST['check'][$k])) {
                $arr[] = $_POST['check'][$k];
            }
        }
        //  echo sizeof($_POST['check']).'=';
       //  print_r($arr);


        $attributes = array();
        $details_attributes = array();
//         echo sizeof($response->Items->Item);die;
       // $products = $products['products']['product'];
//          echo '<pre>';
//          print_r($products);echo '<pre>';die;
        for ($k = 0; $k < sizeof($products); $k++) {
            $item = $products[$k];
            $t = array();
$fields = $products[$k]['fields'];
for($f = 0 ; $f<sizeof($fields) ; $f++){
    $name= $fields[$f]['name'];
     $t[$name] = $fields[$f]['value'];
}
//print_r($t);die;
            // echo $item['ad-id'].'-';
            if (in_array($item['offers'][0]['id'] , $arr)) {

//echo $item['offers'][0]['id'];
                $attributes['category_id'] = $main_category;
//
//                //  product category 
//
                $attributes['product_category_id'] = $pro_category;
//
//
//                //sub category 
//
                $details_attributes['sub_category_id'] = $sub_category;


//            
//            $attributes['category_id'] = $my_category;
                $attributes['user_id'] = $user;
                $attributes['title'] = Helper::limit_words($item['name'] , 10);
                $attributes['description'] = $t['prod_description_long'] ;

                //price
                $attributes['price'] = $item['offers'][0]['priceHistory'][0]['price']['value'];


                //Quantity
                //       $attributes['quantity'] = $item->ItemAttributes->PackageQuantity;
                //Brand
                //    $brand_name = $item->ItemAttributes->Brand;
//                                        $brand = (Brand::model()->find("lower(title) like lower('%$brand_name%')"));
//                                        if ($brand != null) {
//                                            $details_attributes['brand_id'] = $brand->id;
//                                        } else {
//                                            $brand_m = new Brand;
//                                            $brand_m->title = $brand_name;
//                                            $brand_m->category_id = $attributes['category_id'];
//                                            $brand_m->save(false);
//                                            $details_attributes['brand_id'] = $brand_m->id;
//                                        }
                //image
                $attributes['main_image'] = $item['productImage']['url'];


                //thumb 
                $attributes['thumb'] = $t['img_medium'];
                $attributes['url'] = $item['offers'][0]['productUrl'];

//                               $gallery= $item->ImageSets->ImageSet;
//                                 
//  echo '<pre>';  print_r($attributes);  echo '<pre>';

                $model = new Product;
                $model->attributes = $attributes;
                if ($id = Product::model()->saveXml($attributes, $details_attributes, null, null, null)) {


//                                        $gallery= $item->ImageSets->ImageSet;
//                                        if($gallery){
//                                        for ($b = 0; $b < sizeof($gallery)-1; $b++) {
//                                            $MediumImage = $gallery[0]->MediumImage->URL;
//                                            $LargeImage = $gallery[0]->LargeImage->URL;
//                                            $gallery_m = new XmlGallery;
//                                           if($LargeImage) $gallery_m->image = $LargeImage;
//                                           if($MediumImage) $gallery_m->thumb = $MediumImage;
//                                            $gallery_m->product_id = $id;
//                                            $gallery_m->save(false);
//                                        }
//                                    
//                                    }
                }
//
//                                        echo '<pre>';
//            print_r($attributes);echo '<pre>';
//            
//                   echo '<pre>';
//            print_r($details_attributes);echo '<pre>';
            }
        }

        Yii::app()->user->setFlash('xml_success', 'Congratulations! Trade Doubler products inserted successfully.');
        if (!$_GET['flag']) {
            $this->redirect(array('users/dashboard'));
        } else {
            $this->redirect(array('admin/product'));
        }
    }
    
    
    
    public function ActionZanox(){
        
         $search_value = $_POST['search_value'];
       // $category = $_POST['category'];
        $min_price = $_POST['min_price'];
        $max_price = $_POST['max_price'];
        
        
        require_once Yii::app()->basePath.'/extensions/zanox/ApiClient.php';
         $api = ApiClient::factory();
         $api = ApiClient::factory(PROTOCOL_JSON, VERSION_DEFAULT);
         
         $settings = Settings::model()->findByPk(1);
          $connectId = $settings->zanox_connect_id;
       $secretKey = $settings->zanox_secret_key;

       $api->setConnectId($connectId);
       $api->setSecretKey($secretKey);
       
     $query      = $search_value;
       // $searchType = 'phrase';
        $programs   = NULL;
      //  $region     = NULL;
//        echo $merchantcategory = 'Cars';
        $programId  = array();
        $hasImages  = true;
        $minPrice   = $min_price;
        $maxPrice   = $max_price;
        $adspaceId  = NULL;
        $page       = 0;
        $items      = 100;

        $zanox_cats = $api->getProgramCategories();
        $data = $api->searchProducts($query, $searchType, $region,
                        $merchantcategory, $programId, $hasImages, $minPrice,
                        $maxPrice, $adspaceId, $page, $items);
//        echo '<pre>';
//        print_r(json_decode($zanox_cats));
//        echo "<pre>";die;
        
        $data = json_decode($data);
        $products  = $data->productItems->productItem;
        
//         echo '<pre>';
//        print_r(($products));
//        echo "<pre>";die;
        
         $cats = Category::model()->findAll();
        $sellers = User::model()->findAll("groups_id = 4");
        
        $this->render("zanox" , array('products'=>$products , 'cats'=>$cats , 'sellers'=>$sellers ,'zanox_cats'=>$zanox_cats
                ,'search_value'=>$search_value , "min_price"=>$min_price , 'max_price'=>$max_price, 'category'=>$category));
    }
    
    
    
    
     public function actionSaveZanox() {

        $search_value = $_POST['search_value'];
       // $category = $_POST['category'];
        $min_price = $_POST['min_price'];
        $max_price = $_POST['max_price'];


        $main_category = $_POST['main_category'];
        $pro_category = $_POST['pro_category'];
        $sub_category = $_POST['sub_category'];
        $user = $_POST['seller'];

        
require_once Yii::app()->basePath.'/extensions/zanox/ApiClient.php';
         $api = ApiClient::factory();
         $api = ApiClient::factory(PROTOCOL_JSON, VERSION_DEFAULT);
         
         $settings = Settings::model()->findByPk(1);
          $connectId = $settings->zanox_connect_id;
       $secretKey = $settings->zanox_secret_key;

       $api->setConnectId($connectId);
       $api->setSecretKey($secretKey);
       
     $query      = $search_value;
       // $searchType = 'phrase';
        $programs   = NULL;
      //  $region     = NULL;
         $merchantcategory = $category;
        $programId  = array();
        $hasImages  = true;
        $minPrice   = $min_price;
        $maxPrice   = $max_price;
        $adspaceId  = NULL;
        $page       = 0;
        $items      = 100;

        $zanox_cats = $api->getProgramCategories();
        $data = $api->searchProducts($query, $searchType, $region,
                        $merchantcategory, $programId, $hasImages, $minPrice,
                        $maxPrice, $adspaceId, $page, $items);
//        echo '<pre>';
//        print_r(json_decode($zanox_cats));
//        echo "<pre>";die;
        
        $data = json_decode($data);
        $products  = $data->productItems->productItem;

//print_r($products);die;

        $arr = array();
//print_r($_POST['check']) ;die;
        for ($k = 0; $k < sizeof($_POST['check']); $k++) {
            // echo ($_POST['check'][$k]);
            if (isset($_POST['check'][$k])) {
                $arr[] = $_POST['check'][$k];
            }
        }
        //  echo sizeof($_POST['check']).'=';
     //    print_r($arr);


        $attributes = array();
        $details_attributes = array();
//         echo sizeof($response->Items->Item);die;
       // $products = $products['products']['product'];
//          echo '<pre>';
//          print_r($products);echo '<pre>';die;
        for ($k = 0; $k < sizeof($products); $k++) {
            $item = $products[$k];
 
            if (in_array($item->ean, $arr)) {

//echo $item->ean;
                $attributes['category_id'] = $main_category;
//
//                //  product category 
//
                $attributes['product_category_id'] = $pro_category;
//
//
//                //sub category 
//
                $details_attributes['sub_category_id'] = $sub_category;


//            
//            $attributes['category_id'] = $my_category;
                $attributes['user_id'] = $user;
                $attributes['title'] = Helper::limit_words($item->name , 10);
                $attributes['description'] = $item->description ;

                //price
                $attributes['price'] = $item->price;


                //Quantity
                //       $attributes['quantity'] = $item->ItemAttributes->PackageQuantity;
                //Brand
                //    $brand_name = $item->ItemAttributes->Brand;
//                                        $brand = (Brand::model()->find("lower(title) like lower('%$brand_name%')"));
//                                        if ($brand != null) {
//                                            $details_attributes['brand_id'] = $brand->id;
//                                        } else {
//                                            $brand_m = new Brand;
//                                            $brand_m->title = $brand_name;
//                                            $brand_m->category_id = $attributes['category_id'];
//                                            $brand_m->save(false);
//                                            $details_attributes['brand_id'] = $brand_m->id;
//                                        }
//                                        
              if($item->image->large != ''){
                 $attributes['main_image'] = $item->image->large;
                     $attributes['thumb'] = $item->image->large;
            }elseif($item->image->small){
                $attributes['main_image'] = $item->image->large;
                     $attributes['thumb'] = $item->image->large;
            }
                //image
               


                //thumb 
            
                $attributes['url'] = $item->trackingLinks;

//                               $gallery= $item->ImageSets->ImageSet;
//                                 
  //echo '<pre>';  print_r($attributes);  echo '<pre>';

                $model = new Product;
                $model->attributes = $attributes;
                if ($id = Product::model()->saveXml($attributes, $details_attributes, null, null, null)) {


//                                        $gallery= $item->ImageSets->ImageSet;
//                                        if($gallery){
//                                        for ($b = 0; $b < sizeof($gallery)-1; $b++) {
//                                            $MediumImage = $gallery[0]->MediumImage->URL;
//                                            $LargeImage = $gallery[0]->LargeImage->URL;
//                                            $gallery_m = new XmlGallery;
//                                           if($LargeImage) $gallery_m->image = $LargeImage;
//                                           if($MediumImage) $gallery_m->thumb = $MediumImage;
//                                            $gallery_m->product_id = $id;
//                                            $gallery_m->save(false);
//                                        }
//                                    
//                                    }
                }
//
//                                        echo '<pre>';
//            print_r($attributes);echo '<pre>';
//            
//                   echo '<pre>';
//            print_r($details_attributes);echo '<pre>';
            }
        }

        Yii::app()->user->setFlash('xml_success', 'Congratulations! Zanox products inserted successfully.');
        if (!$_GET['flag']) {
            $this->redirect(array('users/dashboard'));
        } else {
            $this->redirect(array('admin/product'));
        }
    }
    
    
}

//Your developer key is:
//00b2a8e1601a5d5dada1fe5985a714abca25b4e50b5d3fb880254fa7bd65d235750411faeb0cd0ccb61631cec230b44e197f6d3ace8a9e5aa12a0d58ba4fdb7acd/00a8b59f76000f90c9c94285c9173906ec7264fb319b11f42956927cc4f664e5c2909e8c9cd8279a734ed685e23687c0853018d7db3cb2a86d8cf0085692baa1c1