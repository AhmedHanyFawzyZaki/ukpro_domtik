<?php

class HomeController extends FrontController {

    /**
     * Declares class-based actions.
     */
    public function actions() {
        return array(
            // captcha action renders the CAPTCHA image displayed on the contact page
            'captcha' => array(
                'class' => 'CCaptchaAction',
                'backColor' => 0xFFFFFF,
            ),
            'yiichat' => array('class' => 'YiiChatAction'), // <- ADD THIS LINE
        );
    }

    /**
     * This is the default 'index' action that is invoked
     * when an action is not explicitly requested by users.
     */
    public function actionIndex() {
        $banners = Banner::model()->findAll();
        $cats = Category::model()->recent()->findAll();
        $products = Product::model()->recent()->findAll();
        // print_r(Yii::app()->db);

        $this->render('index', array('banners' => $banners, 'cats' => $cats, 'products' => $products));
    }

    public function actionmoveimage() {
        $files = scandir('gallery');
        foreach ($files as $file) {
            $subject = $file;
            //echo $subject.'</br>';
            $pattern = '/large/';
            preg_match($pattern, $subject, $matches, PREG_OFFSET_CAPTURE);
            if (!empty($matches)) {
                rename("gallery/$file", "gallery/one/$file");
                echo 'yes' . '</br>';
            }
        }
        die;
    }

    public function actionaddFav() {
        //echo $id;die;
        $id = $_POST['pro_id'];
        $criteria = new CDbCriteria;
        $criteria->condition = 'user_id=:UserID and product_id=:ProductID';
        $criteria->params = array(':UserID' => Yii::app()->user->id, ':ProductID' => $id);
        $fav = Favourite::model()->find($criteria);
        if (empty($fav)) {
            $favourite = new Favourite;
            $favourite->user_id = Yii::app()->user->id;
            $favourite->product_id = $id;
            $favourite->save(false);
        }
        echo $favs = count(Favourite::model()->findAll("product_id = $id"));
        //$this->redirect(Yii::app()->request->urlReferrer);
        //$this->redirect(Yii::app()->user->returnUrl);
    }

    public function actionFaq() {
        $model = FaqCat::model()->findAll();
        $this->render('faq', array('faqcats' => $model,));
    }

    /**
     * This is the action to handle external exceptions.
     */
    public function actionError() {
        $report = false;
        if (isset($_POST['Report'])) {
            $model = new Report;
            $model->attributes = $_POST['Report'];
            $model->date_create = date('Y-m-d H:i:s');
            $model->page = filter_input(INPUT_SERVER, 'HTTP_REFERER');
            if ($model->save())
                $report = true;
        }

        $error = Yii::app()->errorHandler->error;
        $error['report'] = $report;

        if (Yii::app()->request->isAjaxRequest) {
            echo $error['message'];
            return;
        }
        $this->renderPartial('error', $error);
    }

    /**
     * Displays the contact page
     */
    public function actionContact() {
        $model = new Contact;
        if (isset($_POST['Contact'])) {
            $model->attributes = $_POST['Contact'];
            if ($model->save()) {
                $mail = new YiiMailer();
                $mail->setFrom($model->email, $model->name);
                $mail->setTo(Helper::yiiparam('email'));
                $mail->setSubject("Contact from " . $model->name);

                $message = '
                <br/>
                User information  <br/>
                ________________________________________<br/>
                Name :  ' . $model->name . '<br/>
                Email:   ' . $model->email . '<br/>
                Message:   ' . $model->message . '
              ';

                $mail->setBody($message);
                $mail->send();
                Yii::app()->user->setFlash('contact', 'Thank you for contacting us, one of our team will respond to you as soon as possible.');
            } else {
                Yii::app()->user->setFlash('error', 'Please complete the required fields and try again. ');
            }
        }
        $this->render('contact', array('model' => $model));
    }

    public function actionContact1() {

        //echo Helper::yiiparam('adminEmail');

        $model = new ContactForm;
        if (isset($_POST['ContactForm'])) {
            $model->attributes = $_POST['ContactForm'];
            if ($model->validate()) {
                $name = '=?UTF-8?B?' . base64_encode($model->name) . '?=';
                $subject = '=?UTF-8?B?' . base64_encode($model->subject) . '?=';
                $headers = "From: $name <{$model->email}>\r\n" .
                        "Reply-To: {$model->email}\r\n" .
                        "MIME-Version: 1.0\r\n" .
                        "Content-type: text/plain; charset=UTF-8";

                mail(Helper::yiiparam('adminEmail'), $subject, $model->body, $headers);
                Yii::app()->user->setFlash('contact', 'Thank you for contacting us. We will respond to you as soon as possible.');
                $this->refresh();
            }
        }
        $this->render('contact', array('model' => $model));
    }

    public function actionChangeShipping() {
        $id = $_REQUEST['id'];
        $shipp = ShippingValue::model()->findByPk($id);
        $arr[] = $shipp->title;
        $arr[] = $shipp->shippingcity->title;
        $arr[] = $shipp->shippingcountry->title;

        echo implode('*_*', $arr);
    }

    // register as seller
    public function actionRegister() {
        if (empty(Yii::app()->user->id)) {
            $model = new User('register');
            $user_details = new UserDetails();
            if (isset($_POST['User'])) {
                $model->attributes = $_POST['User'];
                //create randomkey
                $key = Helper::GenerateRandomKey();
                //$usermodel->pass_reset = 1;
                $model->pass_code = $key;
                if ($_POST['User']['groups_id'] == '') {
                    // Seller
                    $model->groups_id = '4';
                }
                if ($model->save()) {
                    //create the user details  record
                    $user_details = new UserDetails();
                    $user_details->attributes = $_POST['UserDetails'];
                    $user_details->user_id = $model->id;
                    $user_details->created = Date('y-m-d');
                    $user_details->save(false);
                    $mail = new YiiMailer();
                    $mail->setFrom(Yii::app()->params['adminEmail'], 'EXCLUSIVE LUXE Admininstrator');
                    $mail->setTo($model->email);
                    $mail->setSubject('New seller profile notification');

                    $message = '
							<br/>
							User account information  <br/>
							________________________________________<br/>
							Username:  ' . $model->username . '<br/>
							Password:   ' . $model->simple_decrypt($model->password) . '<br/>
							Activation URL:   <a href="' . Yii::app()->params['webSite'] . '/home/activeProfile/key/' . $model->pass_code . '">' . Yii::app()->params['webSite'] . '/home/activeProfile/key/' . $model->pass_code . '</a>

							';

                    $mail->setBody($message);


                    if ($mail->send()) {
                        // Yii::app()->user->setFlash('register-success', 'Thank you! An activation email has been sent to your email address.');
                        $this->redirect(array('home/confirm/flag/1'));
                    } else {
                        Yii::app()->user->setFlash('error', 'Error while sending email: ' . $mail->getError());
                    }
                    $this->redirect(Yii::app()->user->returnUrl);
                }
            }
            $this->render('register', array(
                'model' => $model,
                'user_details' => $user_details,
            ));
        } else {
            $this->redirect(array('users/dashboard'));
        }
    }

    /**
      activate account
     */
    public function actionActiveProfile() {
        if (!empty(Yii::app()->user->id)) {
            $this->redirect(array('users/dashboard'));
        }
        $userkey = $_GET['key'];
        //echo $userkey;die;
        if (empty($userkey)) {
            $this->redirect(array('home/index'));
        }
        // $user = User::model()->findByPk($userId);
        $user = User::model()->find(array('condition' => 'pass_code="' . $userkey . '"'));
        if (empty($user)) {
            $this->redirect(array('home/index'));
        }
        $user->active = 1;
        $user->pass_code = '';
        //if ($user->save(true, array('active'))) {
        if ($user->save()) {
            $user_login = $this->user_login;
            $user_login->username = $user->username;
            $user_login->password = $user->simple_decrypt($user->password);
            if ($user_login->validate() && $user_login->login()) {
                if (Yii::app()->user->group == 3 or Yii::app()->user->group == 4) {
                    $this->redirect(array('users/editprofile'));
                } else if (Yii::app()->user->group == 1) {
                    $this->redirect(array('admin/dashboard'));
                } else {
                    $this->redirect(array('home/index'));
                }
            }
            $this->redirect(array('home/index'));
        }
        $this->redirect(array('home/index'));
    }

    public function actionConfirm() {
        $flag = $_GET['flag'];
        // display the confirm
        $this->render('confirm', array('flag' => $flag));
    }

    /**
     * member login
     */
    public function actionLogin() {
        //$model = new LoginForm;
        if (!empty(Yii::app()->user->id)) {

            $this->redirect(array('users/dashboard'));
        }
        $user_login = $this->user_login;
        // if it is ajax validation request
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'login-form') {
            echo CActiveForm::validate($user_login);
            Yii::app()->end();
        }
        // collect user input data
        if (isset($_POST['LoginForm'])) {
            $user_login->attributes = $_POST['LoginForm'];
            $user = User::model()->find(array('condition' => 'username="' . $user_login->username . '"'));
            if (!empty($user)) {
                if ($user->active == 0) {
                    //Yii::app()->user->setFlash('ask-active', 'Please check your email to activate your account.');
                    $this->redirect(array('home/confirm/flag/2'));
                }
            }
            // validate user input and redirect to the previous page if valid
            if ($user_login->validate() && $user_login->login()) {
                if (Yii::app()->user->group == 3 or Yii::app()->user->group == 4) {
                    $this->redirect(array('users/dashboard'));
                } else if (Yii::app()->user->group == 1) {
                    $this->redirect(array('admin/dashboard'));
                } else {
                    $this->redirect(Yii::app()->user->returnUrl);
                }
            } else {
                echo 'wrong';
                die;
            }
        }
        // display the login form
        $this->render('login', array('model' => $user_login));
    }

    public function actionJoin() {
        if (!empty(Yii::app()->user->id)) {
            $this->redirect(array('users/dashboard'));
        }
        $user_signUp = $this->user_signUp;
        $user_signUp->scenario = 'join';
        //	$model= new User('register');

        if (isset($_POST['User'])) {
            $user_signUp->attributes = $_POST['User'];
            if ($_POST['User']['groups_id'] == '') {
                $user_signUp->groups_id = 3;
            }
            //$key = Helper::GenerateRandomKey();
            //$usermodel->pass_reset = 1;
            //$user_signUp->pass_code = $key;
            $user_signUp->active = 1;
            if ($user_signUp->save()) {
                $user_details = new UserDetails();
                $user_details->user_id = $user_signUp->id;
                $user_details->created = Date('y-m-d');
                $user_details->save(false);
                $user_login = $this->user_login;
                $user_login->username = $user_signUp->username;
                $user_login->password = $user_signUp->simple_decrypt($user_signUp->password);

                $mail = new YiiMailer();
                $mail->setFrom(Yii::app()->params['adminEmail'], 'EXCLUSIVE CLUB');
                $mail->setTo($model->email);
                $mail->setSubject('New Account In EXCLUSIVE CLUB');

                $message = '
							<br/>
                                                        THANKS FOR REGISTER IN OUR EXCLUSIVE CLUB <br/>
							Your  account information  <br/>
							________________________________________<br/>
							Username:  ' . $user_signUp->username . '<br/>
							Password:   ' . $user_signUp->simple_decrypt($model->password) . '<br/>
							EXCLUSIVE CLUB URL:   <a href="' . Yii::app()->params['webSite'] . '">' . Yii::app()->params['webSite'] . '</a>
							';

                $mail->setBody($message);


                $mail->send();
                if ($user_login->validate() && $user_login->login()) {
                    if (Yii::app()->user->group == 3) {
                        Yii::app()->user->setFlash('update-success', "THANKS FOR REGISTER IN OUR EXCLUSIVE CLUB, Please complete your profile");
                        $this->redirect(array('users/editprofile'));
                    } else {
                        $this->redirect(array('home/index'));
                    }
                }
                $this->redirect(array('home/index'));
            } else {
                foreach ($user_signUp->getErrors() as $error) {
                    $list.=$error[0] . '<br>';
                }
                echo 'wrong' . '*-*' . $list . '<br>';
                die;
            }
        }

        $this->render('join', array(
            'model' => $model,
        ));
    }

    public function actionLandingPage() {
        $this->layout = '//layouts/main2';
        $user_signUp = $this->user_signUp;
        $user_signUp->scenario = 'join';
        if (isset($_POST['User'])) {
            $user_signUp->attributes = $_POST['User'];
            if ($_POST['User']['groups_id'] == '') {
                $user_signUp->groups_id = 3;
            }
            //$key = Helper::GenerateRandomKey();
            //$usermodel->pass_reset = 1;
            //$user_signUp->pass_code = $key;
            $user_signUp->active = 1;
            if ($user_signUp->save()) {
                $user_details = new UserDetails();
                $user_details->user_id = $user_signUp->id;
                $user_details->created = Date('y-m-d');
                $user_details->save(false);
                $user_login = $this->user_login;
                $user_login->username = $user_signUp->username;
                $user_login->password = $user_signUp->simple_decrypt($user_signUp->password);

                ////////
                $mail = new YiiMailer();
                $mail->setFrom(Yii::app()->params['adminEmail'], 'EXCLUSIVE CLUB');
                $mail->setTo($model->email);
                $mail->setSubject('New Account In EXCLUSIVE CLUB');

                $message = '
							<br/>
                                                        THANKS FOR REGISTER IN OUR EXCLUSIVE CLUB <br/>
							Your  account information  <br/>
							________________________________________<br/>
							Username:  ' . $user_signUp->username . '<br/>
							Password:   ' . $user_signUp->simple_decrypt($model->password) . '<br/>
							EXCLUSIVE CLUB URL:   <a href="' . Yii::app()->params['webSite'] . '">' . Yii::app()->params['webSite'] . '</a>
							';

                $mail->setBody($message);


                $mail->send();


                ///////
                if ($user_login->validate() && $user_login->login()) {
                    if (Yii::app()->user->group == 3) {
                        Yii::app()->user->setFlash('update-success', "THANKS FOR REGISTER IN OUR EXCLUSIVE CLUB, Please complete your profile");
                        $this->redirect(array('users/editprofile'));
                    } else {
                        $this->redirect(array('home/index'));
                    }
                }
                $this->redirect(array('home/index'));
            } else {
                foreach ($user_signUp->getErrors() as $error) {
                    $list.=$error[0] . '<br>';
                }
                //echo 'wrong' . '*-*' . $list . '<br>';
                Yii::app()->user->setFlash('error', "Please fill the missing fields: $list");
                $this->redirect(array('home/landingpage'));
            }
        }

        $this->render('landing');
    }

    /**
     * Logs out the current user and redirect to homepage.
     */
    public function actionLogout() {
        Yii::app()->user->logout();
        $this->redirect(array('home/index'));
        //$this->redirect(Yii::app()->baseurl);
    }

    public function actiongetCity() {
        // $model = new User;
        $country_id = $_POST['country_id'];
        $criteria = new CDbCriteria;
        $criteria->condition = 'country_id=:CountryID';
        $criteria->params = array(':CountryID' => $country_id);
        $city = City::model()->findAll($criteria);
        echo $data = CHtml::dropDownList('UserDetails[city_id]', 'city_id', CHtml::listData($city, 'id', 'title'), array('prompt' => 'Select your city', 'class' => 'form-control'));
    }

    public function actionForgotpass() {
        if (!empty(Yii::app()->user->id)) {
            $this->redirect(array('users/dashboard'));
        }
        $forget_password = $this->forget_password;
        $result = "wrong";
        if (isset($_POST['User'])) {
            $forget_password->attributes = $_POST['User'];
            $criteria = new CDbCriteria;
            $criteria->condition = 'email=:email';
            $criteria->params = array(':email' => $forget_password->email);
            $usermodel = User::model()->find($criteria);
            if (empty($usermodel)) {
                echo 'wrong';
                die;
                // Yii::app()->user->setFlash('ErrorMsg', 'Sorry, there\'s no account associated with that email address');
            } else {
                $key = Helper::GenerateRandomKey();
                $usermodel->pass_reset = 1;
                $usermodel->pass_code = $key;
                $usermodel->save(false);

                $mail = new YiiMailer();
                $mail->setFrom(Yii::app()->params['adminEmail'], Yii::app()->name . ' Admininstrator');
                $mail->setTo($usermodel->email);
                $mail->setSubject(Yii::app()->name . ' Password reset');
                $message = 'Dear customer,

					Please follow this link to reset your password :
					Username:' . $usermodel->username . '
					URL: 	' . Yii::app()->getBaseUrl(true) . '/home/reset/hash/' . $usermodel->pass_code . '

					';
                $mail->setBody($message);
                if ($mail->send()) {
                    $result = "success";
                    echo 'success';
                    die;
                    //  Yii::app()->user->setFlash('forgot-success', 'Check <b> ' . $usermodel->email . ' </b> for the confirmation email. It will have a link to reset your password..');
                } else {
                    $result = "not-send";
                    echo 'not-send';
                    die;
                    //  Yii::app()->user->setFlash('error', 'Error while sending email: ' . $mail->getError());
                }
            }
        }
        echo $result;
        die;
        $this->render('forgotpass', array('model' => $model));
    }

    public function actionReset($hash) {
        $criteria = new CDbCriteria;
        $criteria->condition = 'pass_code=:Hash and pass_reset=1';
        $criteria->params = array(':Hash' => $hash);
        $model = new User('passreset');
        $model = User::model()->find($criteria);

        if (count($model) == 0) {
            $flag = 0;
            Yii::app()->user->setFlash('ErrorMsg', 'Sorry you have followed a wrong link .');
        } else {
            $flag = 1;
        }

        if (isset($_POST['User']) and count($model) != 0) {
            $model->attributes = $_POST['User'];

            $model->pass_reset = 0;
            $model->pass_code = '';
            //$user_found->password = $model->newpassword = $_POST['User']['newpassword'];
            $model->password = $model->hash($_POST['User']['newpassword']);
            if ($model->save())
                $this->redirect(array('home/confirm/flag/10'));
            //Yii::app()->user->setFlash('ErrorMsg', ' Please Login with your new credentials');
            // $this->redirect(array('home/index'));
        }
        $this->render('resetpass', array('model' => $model, 'flag' => $flag));
    }

    public function actionSetcookie() {
        $model = Faq::model()->findAll();
        $value = serialize($model);
        //	$value='i am the first test for cookie';
        Yii::app()->request->cookies['TstCookie'] = new CHttpCookie('TstCookie', $value);
        echo "cookie has been set";
    }

    public function actionGetcookie() {
        $value = new Faq;
        $value = unserialize(Yii::app()->request->cookies['TstCookie']);
        echo "cookie is";
        //var_dump($value);
        foreach ($value as $fq) {
            echo $fq['question'] . "<br/>";
        }
    }

    public function actionPages($slug) {
        $model = Pages::model()->findByAttributes(array("url" => $slug));
        $this->render('staticpage', array("pages" => $model, 'url' => $slug));
    }

    public function actionAddToCartold() {
        $pro_id = $_REQUEST['product_id']; //required
        $cat_id = $_REQUEST['category_id']; //required
        $qty = $_REQUEST['qty']; //required

        $product = Product::model()->findByPk($pro_id);

        $color_id = '';
        $size_id = '';
        $color = 'N/A';
        $size = 'N/A';
        if (isset($_REQUEST['color_id'])) {
            $color_id = $_REQUEST['color_id'];
            $color = Colors::model()->findByPk($color_id)->title;
        }
        if (isset($_REQUEST['size_id'])) {
            $size_id = $_REQUEST['size_id'];
            $size = Sizes::model()->findByPk($size_id)->title;
        }

        $price = $product->price; //default is the product price
        if ($cat_id == 3 && $size_id != '') {
            $price = Size::model()->findByPk($size_id)->price; //size price
        }


        //intialize shipping for each item
        $ship_val = $_REQUEST['ship_val'];
        $ship_address = $_REQUEST['ship_address'];
        $ship_city = $_REQUEST['ship_city'];
        $ship_country = $_REQUEST['ship_country'];
        $ship_postcode = $_REQUEST['ship_postcode'];


        if ($product->id) {
            if (Yii::app()->user->hasState('cart')) {
                $cart = Yii::app()->user->getState('cart'); //is cart?
            } else {
                $cart = array(); // intialize the cart
            }

            // intialize the category as i will group the items by category
            if (!key_exists($cat_id, $cart))
                $cart[$cat_id] = array();

            if (!is_array($cart[$cat_id]))
                $cart[$cat_id] = array(); //is an array?

            $commission = Commission::model()->findByAttributes(array('user_id' => $product->user_id, 'category_id' => $cat_id, 'type' => '0'));
            if ($commission) {
                $admin_commission = ($commission->title / 100) * $qty * $price; //percentage
            } else {
                $admin_commission = (Category::model()->findByPk($cat_id)->default_commission / 100) * $qty * $price;
            }

            $cart[$cat_id][$pro_id] = array(
                'qty' => $qty,
                'price' => $price,
                'size' => $size,
                'color' => $color,
                'ship_price' => $ship_val,
                'ship_address' => $ship_address,
                'ship_city' => $ship_city,
                'ship_country' => $ship_country,
                'ship_postcode' => $ship_postcode,
                'admin_commission' => $admin_commission,
                'seller_id' => $product->user_id,
            );
            Yii::app()->user->setState('cart', $cart);
            $msg = $product->title . ' has been added successfully to cart';
        }
        Yii::app()->user->setFlash('cart', $msg);
        $this->redirect(array('ShoppingCart'));
    }

    public function actionAddToCart() {
        $pro_id = $_REQUEST['product_id']; //required
        $cat_id = $_REQUEST['category_id']; //required
        $qty = $_REQUEST['qty']; //required

        $product = Product::model()->findByPk($pro_id);

        $color_id = '';
        $size_id = '';
        $color = 'N/A';
        $size = 'N/A';
        if (isset($_REQUEST['color_id'])) {
            $color_id = $_REQUEST['color_id'];
            $color = Colors::model()->findByPk($color_id)->title;
        }
        if (isset($_REQUEST['size_id'])) {
            $size_id = $_REQUEST['size_id'];
            $size = Sizes::model()->findByPk($size_id)->title;
        }

        $price = $product->price; //default is the product price
        if ($cat_id == 3 && $size_id != '') {
            $price = Size::model()->findByPk($size_id)->price; //size price
        }
//        echo $pro_id.'</br>';
//        echo $cat_id.'</br>';
//        echo $qty.'</br>';
//        echo $color.'</br>';
//        echo $size.'</br>';
//        echo $price.'</br>';
//        die;
        //intialize shipping for each item
//        $ship_val = $_REQUEST['ship_val'];
//        $ship_address = $_REQUEST['ship_address'];
//        $ship_city = $_REQUEST['ship_city'];
//        $ship_country = $_REQUEST['ship_country'];
//        $ship_postcode = $_REQUEST['ship_postcode'];


        if ($product->id) {
            if (Yii::app()->user->hasState('cart')) {
                $cart = Yii::app()->user->getState('cart'); //is cart?
            } else {
                $cart = array(); // intialize the cart
            }

            // intialize the category as i will group the items by category
            if (!key_exists($cat_id, $cart))
                $cart[$cat_id] = array();

            if (!is_array($cart[$cat_id]))
                $cart[$cat_id] = array(); //is an array?

            $commission = Commission::model()->findByAttributes(array('user_id' => $product->user_id, 'category_id' => $cat_id, 'type' => '0'));
            if ($commission) {
                $admin_commission = ($commission->title / 100) * $qty * $price; //percentage
            } else {
                $admin_commission = (Category::model()->findByPk($cat_id)->default_commission / 100) * $qty * $price;
            }

            $cart[$cat_id][$pro_id] = array(
                'qty' => $qty,
                'price' => $price,
                'size' => $size,
                'color' => $color,
                // 'ship_price' => $ship_val,
                //'ship_address' => $ship_address,
                // 'ship_city' => $ship_city,
                // 'ship_country' => $ship_country,
                // 'ship_postcode' => $ship_postcode,
                'admin_commission' => $admin_commission,
                'seller_id' => $product->user_id,
            );
            Yii::app()->user->setState('cart', $cart);
            $msg = $product->title . ' has been added successfully to cart';
        }
        Yii::app()->user->setFlash('cart', $msg);
        $this->redirect(array('ShoppingCart'));
    }

    public function actionRemoveItem() {
        if (isset($_REQUEST['id']) && isset($_REQUEST['cat_id'])) {
            $cat_id = $_REQUEST['cat_id'];
            $id = $_REQUEST['id'];
            $cart = Yii::app()->user->getState('cart');
            if (!empty($cart[$cat_id][$id])) {
                $product = Product::model()->findByPk($id);
                unset($cart[$cat_id][$id]);
                if (count($cart[$cat_id]) < 1) {
                    unset($cart[$cat_id]);
                }
                Yii::app()->user->setState('cart', $cart);
                $msg = $product->title . ' has been successfully removed from cart';
                Yii::app()->user->setFlash('cart', $msg);
                $this->redirect(array('ShoppingCart'));
            }
        }
    }

    public function actionEditItem() {
        if (isset($_REQUEST['id']) && isset($_REQUEST['cat_id']) && isset($_REQUEST['qty']) && is_numeric($_REQUEST['qty'])) {
            $cat_id = $_REQUEST['cat_id'];
            $id = $_REQUEST['id'];
            $qty = $_REQUEST['qty'];
            $cart = Yii::app()->user->getState('cart');
            if (!empty($cart[$cat_id][$id])) {
                $product = Product::model()->findByPk($id);

                $price = $cart[$cat_id][$id]['price'];
                $commission = Commission::model()->findByAttributes(array('user_id' => $product->user_id, 'category_id' => $cat_id, 'type' => '0'));
                if ($commission) {
                    $admin_commission = ($commission->title / 100) * $qty * $price; //percentage
                } else {
                    $admin_commission = (Category::model()->findByPk($cat_id)->default_commission / 100) * $qty * $price;
                }
                $cart[$cat_id][$id]['admin_commission'] = $admin_commission;
                $cart[$cat_id][$id]['qty'] = $qty;
                Yii::app()->user->setState('cart', $cart);
                $msg = $product->title . ' has been successfully updated';
                Yii::app()->user->setFlash('cart', $msg);
                $this->redirect(array('ShoppingCart'));
            }
        } else {
            $msg = 'Only Integer Quantity is acceptable.';
            Yii::app()->user->setFlash('cart', $msg);
            array('ShoppingCart');
        }
    }

    public function actionShoppingCart() {
        $cart = Yii::app()->user->getState('cart');
        $this->render('cart', array('cart' => $cart));
    }

    public function actionCarterror() {
        $cart = Yii::app()->user->getState('cart');
        $this->render('cart', array('cart' => $cart));
    }

    public function actionCheckout() {
        $userid = Yii::app()->user->id;
        if ($userid != '') {
            $userdetails = UserDetails::model()->findByAttributes(array('user_id' => $userid));
            if (Yii::app()->user->hasState('cart')) {
                $cart = Yii::app()->user->getState('cart');
                $model = new Order;
                $model->shipping_country = $model->billing_country = $userdetails->country_id;
                $model->shipping_city = $model->billing_city = $userdetails->city_id;
                $model->shipping_post_code = $model->billing_post_code = $userdetails->zipcode;
                $model->shipping_address = $model->billing_address = $userdetails->address;
                $order_details = new OrderDetails();
                if (isset($_POST['Order'])) {
                    $model->attributes = $_POST['Order'];
                    if (!empty($model->shipping_country)) {
                        foreach ($cart as $products) {
                            foreach ($products as $pro_id => $details) {
                                $product = Product::model()->findByPk($pro_id);
                                $shipp = ShippingValue::model()->findAllByAttributes(array('user_id' => $product->user_id, 'country_id' => $model->shipping_country));
                                if (empty($shipp))
                                    $error[] = $pro_id;
                            }
                        }
                        if (!empty($error)) {
//                            $this->render('cart', array(
//                                'cart' => $cart,
//                                'errors' => $error,
//                            ));
                            Yii::app()->user->setState('errors', $error);
                            $this->redirect('Carterror');
                        } elseif (empty($error)) {
                            //echo 'hie';die;
                            $shippingadress = array(
                                'shipping_country' => $model->shipping_country,
                                'shipping_city' => $model->shipping_city,
                                'shipping_post_code' => $model->shipping_post_code,
                                'shipping_address' => $model->shipping_address,
                                'billing_country' => $model->billing_country,
                                'billing_city' => $model->billing_city,
                                'billing_post_code' => $model->billing_post_code,
                                'billing_address' => $model->billing_address,
                            );
                            Yii::app()->user->setState('shippingadress', $shippingadress);
//                            $this->render('ordersummary', array(
//                                'cart' => $cart,
//                                'shippingadress' => $shippingadress,
//                            ));
                            $this->redirect('ordersummary');
                        }
                    }
                }
            } else {
                throw new CHttpException(404, 'Invalid request. Shopping cart is empty.');
            }
            $this->render('checkout', array(
                'model' => $model,
                'order_details' => $order_details,
            ));
        } else {
            $this->redirect(array('home/confirm/flag/3'));
        }
    }

    public function actionCheckoutold() {
        if (Yii::app()->user->hasState('cart')) {
            $cart = Yii::app()->user->getState('cart');
            $receivers_arr = array();
            $admin_total_commission = 0;
            $total_price = 0; //to be paid to the primary paypal receiver
            $total_shipping = 0;
            foreach ($cart as $cat_id => $products) {
                foreach ($products as $pro => $details) {
                    $seller_email = UserDetails::model()->find(array('condition' => 'user_id=' . $details['seller_id']))->paypal_account;
                    if (array_key_exists($seller_email, $receivers_arr)) {
                        $receivers_arr[$seller_email]+=$details['price'] * $details['qty'] + $details['ship_price'] - $details['admin_commission'];
                    } else {
                        if ($seller_email != Yii::app()->params['paypal_email']) {
                            $receivers_arr[$seller_email] = $details['price'] * $details['qty'] + $details['ship_price'] - $details['admin_commission'];
                        }
                    }
                    $admin_total_commission+=$details['admin_commission']; //to be saved in the order module not more
                    $total_price+=$details['price'] * $details['qty'] + $details['ship_price'];
                    $total_shipping+=$details['ship_price'];
                }
            }

            if (count($receivers_arr) > 0) {
                $url = Helper::PaypalAdaptive($receivers_arr, $total_price, $admin_total_commission);
            } else {
                $url = Helper::PaypalExpress($total_price, $admin_total_commission);
            }
            if ($url) {
                $model = new Order;
                $model->total_price = $total_price;
                $model->total_commission = $admin_total_commission;
                $model->shipping_price = $total_shipping;
                $model->status_id = 1; //pending
                $model->buyer_id = Yii::app()->user->id;
                $model->net_price = $total_price - $total_shipping;
                if ($model->save(false)) {
                    foreach ($cart as $cat_id => $products) {
                        foreach ($products as $pro => $details) {
                            $order_det = new OrderDetails;
                            $order_det->order_id = $model->id;
                            $order_det->product_id = $pro;
                            $order_det->shipping_address = $details['ship_address'];
                            $order_det->shipping_city = $details['ship_city'];
                            $order_det->shipping_country = $details['ship_country'];
                            $order_det->shipping_postcode = $details['ship_postcode'];
                            $order_det->shipping_price = $details['ship_price'];
                            $order_det->color = $details['color'];
                            $order_det->size = $details['size'];
                            $order_det->quantity = $details['qty'];
                            $order_det->total_price = $details['price'] * $details['qty'] + $details['ship_price'];
                            $order_det->net_price = $details['price'] * $details['qty'] - $details['admin_commission'];
                            $order_det->commission_price = $details['admin_commission'];
                            $order_det->save(false);
                        }
                    }
                    $this->redirect($url);
                }
            } else {
                throw new CHttpException(404, 'Sorry Paypal Reuqest has been failed! try again later.');
            }
        } else {
            throw new CHttpException(404, 'Invalid request. Shopping cart is empty.');
        }


        $this->redirect($url);
    }

    public function actionPaynow() {
        $shippingadress = Yii::app()->user->getState('shippingadress');
        if (!empty($shippingadress)) {
            if (Yii::app()->user->hasState('cart')) {
                $cart = Yii::app()->user->getState('cart');

                //print_r($shippingadress);
                //die;
                $receivers_arr = array();
                $admin_total_commission = 0;
                $total_price = 0; //to be paid to the primary paypal receiver
                $total_shipping = 0;
                foreach ($cart as $cat_id => $products) {
                    foreach ($products as $pro => $details) {
                        $seller_email = UserDetails::model()->find(array('condition' => 'user_id=' . $details['seller_id']))->paypal_account;
                        //$product = Product::model()->findByPk($pro_id);
                        $shipp = ShippingValue::model()->findByAttributes(array('user_id' => $details['seller_id'], 'country_id' => $shippingadress['shipping_country']));
                        //$category_total_shipping+=$shipp->title;
                        if (array_key_exists($seller_email, $receivers_arr)) {
                            $receivers_arr[$seller_email]+=$details['price'] * $details['qty'] + $shipp->title - $details['admin_commission'];
                        } else {
                            if ($seller_email != Yii::app()->params['paypal_email']) {
                                $receivers_arr[$seller_email] = $details['price'] * $details['qty'] + $shipp->title - $details['admin_commission'];
                            }
                        }
                        $admin_total_commission+=$details['admin_commission']; //to be saved in the order module not more
                        $total_price+=$details['price'] * $details['qty'] + $shipp->title;
                        $total_shipping+=$shipp->title;
                    }
                }

                if (count($receivers_arr) > 0) {
                    $url = Helper::PaypalAdaptive($receivers_arr, $total_price, $admin_total_commission);
                } else {
                    $url = Helper::PaypalExpress($total_price, $admin_total_commission, '', '');
                }
                //  print_r($url);
                //  die;
                if ($url['url']) {
                    $model = new Order;
                    $model->shipping_country = $shippingadress['shipping_country'];
                    $model->shipping_city = $shippingadress['shipping_city'];
                    $model->shipping_post_code = $shippingadress['shipping_post_code'];
                    $model->shipping_address = $shippingadress['shipping_address'];

                    $model->billing_country = $shippingadress['billing_country'];
                    $model->billing_city = $shippingadress['billing_city'];
                    $model->billing_post_code = $shippingadress['billing_post_code'];
                    $model->billing_address = $shippingadress['billing_address'];

                    $model->total_price = $total_price;
                    $model->total_commission = $admin_total_commission;
                    $model->shipping_price = $total_shipping;
                    $model->status_id = 1; //pending
                    $model->buyer_id = Yii::app()->user->id;
                    $model->net_price = $total_price - $total_shipping;
                    $model->token = $url['token'];
                    if ($model->save(false)) {
                        foreach ($cart as $cat_id => $products) {
                            foreach ($products as $pro => $details) {
                                $shipp = ShippingValue::model()->findByAttributes(array('user_id' => $details['seller_id'], 'country_id' => $shippingadress['shipping_country']));
                                $order_det = new OrderDetails;
                                $order_det->order_id = $model->id;
                                $order_det->product_id = $pro;
                                $order_det->shipping_address = $model->shipping_address;
                                $order_det->shipping_city = $model->shipping_city;
                                $order_det->shipping_country = $model->shipping_country;
                                $order_det->shipping_postcode = $model->shipping_post_code;
                                $order_det->shipping_price = $shipp->title;
                                $order_det->seller_id = $details['seller_id'];
                                $order_det->color = $details['color'];
                                $order_det->size = $details['size'];
                                $order_det->quantity = $details['qty'];
                                $order_det->total_price = $details['price'] * $details['qty'] + $shipp->title;
                                $order_det->net_price = $details['price'] * $details['qty'] - $details['admin_commission'];
                                $order_det->commission_price = $details['admin_commission'];
                                $order_det->save(false);
                            }
                        }
                        $this->redirect($url['url']);
                        //   echo $url['url'];die;
                    }
                } else {
                    throw new CHttpException(404, 'Sorry Paypal Reuqest has been failed! try again later.');
                }
            } else {
                throw new CHttpException(404, 'Invalid request. Shopping cart is empty.');
            }
        } else {
            $this->redirect($url['url']);
        }
        $this->redirect($url['url']);
    }

    public function actionItem($id) {

        $layout = '//layouts/main';

        $review = new Review;


        //echo $_POST['Review']['rate'];die;
        $product = Product::model()->findByPk($id);

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

        $colors = Color::model()->findAllByAttributes(array('product_id' => $id));

        $sizes = Size::model()->findAllByAttributes(array('product_id' => $id));
        $likes = Product::model()->findAll(array('condition' => 'product_category_id=' . $product->product_category_id . ' and  category_id=' . $product->category_id));
        $count = count($likes);
        //print_r($likes);die;

        $this->render('item', array('product' => $product, 'colors' => $colors, 'sizes' => $sizes, 'photos' => $photos, 'likes' => $likes, 'revs' => $revs, 'count' => $count, 'review' => $review, 'sub' => $sub));
    }

    public function actionFeeconfirm() {
        // $layout = '//layouts/main';
        $token = trim($_GET['token']);
        $payerId = trim($_GET['PayerID']);
        $criteria = new CDbCriteria;
        $criteria->condition = 'token=:Token';
        $criteria->params = array(':Token' => $token);
        $paymentfee = Paymentfee::model()->find($criteria);
        $user = User::model()->findByPk($paymentfee->user_id);
        $package = $user->feepackage->title;
        $period = $user->feepackage->period;
        $start_subscribe = date('Y-m-d');
        $end_subscribe = date('Y-m-d', strtotime("+$period days"));
        $username = $user->username;
        $userEmail = $user->email;
        $result = Yii::app()->Paypal->GetExpressCheckoutDetails($token);
        $result['PAYERID'] = $payerId;
        $result['TOKEN'] = $token;
        $result['ORDERTOTAL'] = $paymentfee->price;


        // payment was completed successfully
        if ($paymentfee->payment_status == 0 or $paymentfee->payment_status == 2) { // pending
            $paymentfee->payment_status = 1; //paypal complete payment
            $paymentfee->save(false);

            ////////////////////////////update user table  
            $user->ads_number = $user->ads_number + $user->feepackage->ads_number;
            $user->start_subscrib_date = $start_subscribe;
            $user->end_subscrib_date = $end_subscribe;
            $user->payment_status = 1;
            $user->save(false);
        }

        //////////////////////////////////send mail to the user
        $mail = new YiiMailer();
        $mail->setFrom(Yii::app()->params['adminEmail'], Yii::app()->name . ' monthly fee subscribe ');
        $mail->setTo($userEmail);
        $mail->setSubject('Confirm payment of monthly fee subscribe');

        $message = 'Dear customer,

			Thank you for completing the payment of ' . $package . ', now you can enjoy all ' . $package . ' features.<br/>';
        $mail->setBody($message);
        $mail->send();

        ///////////////////////send mail to admin
        $mail2 = new YiiMailer();
        $mail2->setFrom(Yii::app()->params['adminEmail'], Yii::app()->name . ' monthly fee subscribe ');
        $mail2->setTo(Yii::app()->params['adminEmail'], Yii::app()->name . ' monthly fee subscribe ');
        $mail2->setSubject('Payment confirmation');
        $message2 = 'Dear Admin,
                          Your customer "' . $username . ' " has completed the paymant of the "' . $package . '" package by using paypal . 
                   ';
        $mail2->setBody($message2);
        $mail2->send();

        Yii::app()->user->setFlash('payment', $message);

        $this->redirect(array('home/confirm/flag/4'));
        // echo $this->renderPartial('confirm');
    }

    public function actionFeecancel() {
        $token = trim($_GET['token']);
        $payerId = trim($_GET['PayerID']);
        $criteria = new CDbCriteria;
        $criteria->condition = 'token=:Token';
        $criteria->params = array(':Token' => $token);
        $paymentfee = Paymentfee::model()->find($criteria);
        $paymentfee->payment_status = 2; //paypal cancel payment
        $paymentfee->save(false);
        $user = User::model()->findByPk($paymentfee->user_id);
        $user->payment_status = 2;
        $user->save(false);
        $this->redirect(array('home/confirm/flag/5'));
    }

    public function actionOrderconfirm() {
        $token = trim($_GET['token']);
        // $paykey = trim($_GET['paykey']).'<br/>';
        $payerId = trim($_GET['PayerID']);
        $criteria = new CDbCriteria;
        $criteria->condition = 'token=:Token';
        $criteria->params = array(':Token' => $token);
        $order = Order::model()->find($criteria);
        // print_r($order);die;
        $user = User::model()->findByPk($order->buyer_id);

        // payment was completed successfully
        if ($order->status_id == 1 or $order->status_id == 2) { // pending
            $order->status_id = 3; //paypal complete
            $order->save(false);
            $orderdets = OrderDetails::model()->findAllByAttributes(array('order_id' => $order->id));
            if (!empty($orderdets)) {
                foreach ($orderdets as $orderdet) {
                    $seller = User::model()->findByPk($orderdet->seller_id);
                    $product = Product::model()->findByPk($orderdet->product_id);
                    $product->quantity = $product->quantity - $orderdet->quantity;
                    $product->save(false);

                    ///////////////////////send mail to buyer
                    $mail = new YiiMailer();
                    $mail->setFrom(Yii::app()->params['adminEmail'], Yii::app()->name . '  New Order ');
                    $mail->setTo($seller->email, Yii::app()->name . ' New Order');
                    $mail->setSubject(Yii::app()->name . '  New Order ');
                    $message = 'Dear Customer,
                          New  order has been done successfully with this destails:<br/>
               Products Name : ' . $product->title . '. <br/>  
               Product Price : ' . $product->price . ' GBP. <br/>  
               Qty : ' . $product->quantity . ' GBP. <br/> 
               Shipping Price : ' . $orderdet->shipping_price . ' GBP. <br/>
               Web Site Commission : ' . $orderdet->commission_price . ' GBP. <br/> 
               Net Price : ' . $orderdet->net_price . ' GBP. <br/> 
               please check your orders in your dashboard on ' . Yii::app()->name . ''
                    ;
                    $mail->setBody($message);
                    $mail->send();
                }
            }
            ////////////////////////////update user table 
            $key = Helper::GenerateRandomKey(4);
            $user->token = $key;
            $user->instgram_access = 1;
            $user->save(false);
        }
        //////////////////////////////////send mail to Admin
        $mail = new YiiMailer();
        $mail->setFrom(Yii::app()->params['adminEmail'], Yii::app()->name . ' New Order');
        $mail->setTo(Yii::app()->params['adminEmail']);
        $mail->setSubject(Yii::app()->name . ' New Order');

        $message = 'Dear Admin,

			New order has been done successfully with this destails:<br/>
               Total Price:' . $order->total_price . ' GBP. <br/> 
               Shipping Price:' . $order->shipping_price . ' GBP. <br/>
               Web Site Commission:' . $order->total_commission . ' GBP. <br/>
               to view the order by details please go to these link : <a href="' . Yii::app()->params['webSite'] . '/admin/order/view/id/' . $order->id . '">' . Yii::app()->params['webSite'] . '/admin/order/view/id/' . $order->id . '</a>'
        ;
        $mail->setBody($message);
        $mail->send();

        ///////////////////////send mail to buyer
        $mail2 = new YiiMailer();
        $mail2->setFrom(Yii::app()->params['adminEmail'], Yii::app()->name . '  ');
        $mail2->setTo($user->email, Yii::app()->name . '  New Order');
        $mail2->setSubject(Yii::app()->name . ' New Order');
        $message2 = 'Dear client,
                          Your  order has been done successfully with this destails:<br/>
               Products Price:' . $order->net_price . ' GBP. <br/>   
               Shipping Price:' . $order->shipping_price . ' GBP. <br/>
               Total Price:' . $order->total_price . ' GBP. <br/> 
               please check your orders in your dashboard on ' . Yii::app()->name . ''
        ;
        $mail2->setBody($message2);
        $mail2->send();

        $this->redirect(array('home/confirm/flag/11'));
        // echo $this->renderPartial('confirm');
    }

    public function actionOrdercancel() {
        $token = trim($_GET['token']);
        $payerId = trim($_GET['PayerID']);
        $criteria = new CDbCriteria;
        $criteria->condition = 'token=:Token';
        $criteria->params = array(':Token' => $token);
        $order = Order::model()->find($criteria);
        // print_r($order);die;
        $order->status_id = 2; //paypal cancel payment
        $order->save(false);
        $this->redirect(array('home/confirm/flag/5'));
    }

    public function actionSearch() {
        Yii::app()->user->setState('search-key', '');
        if (isset($_REQUEST['keyword'])) {
            Yii::app()->user->setState('search-key', $_REQUEST['keyword']);
            $criteria = new CDbCriteria;
            $criteria->condition = 'LOWER(title) like "%' . strtolower($_REQUEST['keyword']) . '%" or LOWER(description) like "%' . strtolower($_REQUEST['keyword']) . '%"';
            $count = Product::model()->count($criteria);
            $pages = new CPagination($count);
            // results per page
            $pages->pageSize = 20;
            $pages->applyLimit($criteria);
            $products = Product::model()->findAll($criteria);
        } else {
            $products = Product::model()->findAll();
        }
        $this->render('search', array('products' => $products, 'count' => $count, 'pages' => $pages));
    }

    public function actionOwner($id) {
        $message = new Message;
        if (isset($_POST['Message'])) {
            $userid = Yii::app()->user->id;
            if ($userid != '') {
                //print_r($_POST['Review']);die;

                $message->attributes = $_POST['Message'];
                $message->reciever_id = $id;
                $message->sender_id = $userid;
                $message->message_date = date('Y-m-d');

                if ($message->save()) {
                    Yii::app()->user->setFlash('add-success', 'Your message has been sent sucessfuly to the seller.');
                } else {

                    Yii::app()->user->setFlash('add-error', 'Please write your message');
                }
            } else {
                $this->redirect(array('home/confirm/flag/3'));
            }
        }
        $owner = User::model()->findByPk($id);
        $userdetails = UserDetails::model()->findByAttributes(array('user_id' => $id));
        $this->render('owner_profile', array('user' => $owner, 'userdetails' => $userdetails, 'message' => $message));
    }

    public function actionSellerproduct($id) {
        $message = new Message;
        if (isset($_POST['Message'])) {
            $userid = Yii::app()->user->id;
            if ($userid != '') {
                //print_r($_POST['Review']);die;

                $message->attributes = $_POST['Message'];
                $message->reciever_id = $id;
                $message->sender_id = $userid;
                $message->message_date = date('Y-m-d');

                if ($message->save()) {
                    Yii::app()->user->setFlash('add-success', 'Your message has been sent sucessfuly to the seller.');
                } else {

                    Yii::app()->user->setFlash('add-error', 'Please write your message');
                }
            } else {
                $this->redirect(array('home/confirm/flag/3'));
            }
        }
        $criteria = new CDbCriteria;
        $criteria->condition = 'user_id=' . $id;
        $count = Product::model()->count($criteria);
        $pages = new CPagination($count);
        // results per page
        $pages->pageSize = 18;
        $pages->applyLimit($criteria);
        $products = Product::model()->findAll($criteria);
        $owner = User::model()->findByPk($id);
        $this->render('seller_products', array('user' => $owner, 'products' => $products, 'count' => $count, 'pages' => $pages, 'message' => $message));
    }

    public function actionremoveFav() {
        $id = $_POST['pro_id'];
        $user_id = Yii::app()->user->id;
        Favourite::model()->deleteAll(array('condition' => 'product_id=' . $id . ' and ' . 'user_id=' . $user_id));
        echo $favs = count(Favourite::model()->findAll("product_id = $id"));
    }

    public function actionRemovecheckout() {
        Yii::app()->user->setState('cart', $cart);
        $errors = Yii::app()->user->getState('errors');
        $cart = Yii::app()->user->getState('cart');
        foreach ($errors as $error) {
            if (!empty($cart[$error->category_id][$error])) {
                unset($cart[$error->category_id][$error]);
                if (count($cart[$error->category_id]) < 1) {
                    unset($cart[$error->category_id]);
                }
            }
        }
        unset($errors);
        Yii::app()->user->setState('errors', '');


        $this->redirect('ShoppingCart');
    }

    public function actionOrdersummary() {
        $cart = Yii::app()->user->getState('cart');
        $shippingadress = Yii::app()->user->getState('shippingadress');

        $this->render('ordersummary', array('cart' => $cart, 'shippingadress' => $shippingadress));
    }

    public function actionRemoveordersummary() {
        if (isset($_REQUEST['id']) && isset($_REQUEST['cat_id'])) {
            $cat_id = $_REQUEST['cat_id'];
            $id = $_REQUEST['id'];
            $cart = Yii::app()->user->getState('cart');
            if (!empty($cart[$cat_id][$id])) {
                $product = Product::model()->findByPk($id);
                unset($cart[$cat_id][$id]);
                if (count($cart[$cat_id]) < 1) {
                    unset($cart[$cat_id]);
                }
                Yii::app()->user->setState('cart', $cart);
                $msg = $product->title . ' has been successfully removed from cart';
                Yii::app()->user->setFlash('cart', $msg);
                $this->redirect(array('ShoppingCart'));
            }
        }
    }

}
