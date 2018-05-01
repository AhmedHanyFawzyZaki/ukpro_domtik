<?php

class AjaxController extends FrontController {

    public function actionLogin() {

        $arr = array();
        $model = new LoginForm;
        $arr['submitted'] = 0;
        if ($_POST['LoginForm']) {
            $arr['submitted'] = 1;
            $model->attributes = $_POST['LoginForm'];
            if ($model->validate() && $model->login()) {
                if (Yii::app()->user->group == 6) {
                    $arr['user'] = 0;
                } else {
                    $arr['user'] = 1;
                }
                $arr['success'] = 1;
            } else {
                $arr['success'] = 0;
                $arr['error'] = CHtml::errorSummary($model);
            }
        }

        echo json_encode($arr);
    }

   public function actionRegister() {
       // $this->layout='ajax';
        $arr = array();
        $model = new User('register');
        $arr['submitted'] = 0;
        
           $model->fname = Yii::app()->request->getPost('fname');
            $model->lname = Yii::app()->request->getPost('lname');
            
           $model->password = Yii::app()->request->getPost('Password');
           $model->password_repeat = Yii::app()->request->getPost('Password2');
           $model->email = Yii::app()->request->getPost('Email') ;
            $model->username = Yii::app()->request->getPost('Email') ;
            $model->activation_code = uniqid();
           $model->groups_id = '1';
           
           if ($model->save()) {
                $arr['submitted'] = 1;
                $user_details = new UserDetails();
                $user_details->user_id = $model->id;
                $user_details->created = date('Y-m-d H:i:s');
                $user_details->save(false);

//if newsletter
                if ($_POST['newletter_check']) {
                    $news = new Newsletter;
                    $news->email = $model->email;
                    $news->created = date('Y-m-d H:i:s');
                    $test = Newsletter::model()->findByAttributes(array('email' => $model->email));
                    if (!$test)
                       // $model->save(false);
                        $news->save(false);
                }

                $mail = new YiiMailer();
                $mail->setFrom(Yii::app()->params['adminEmail'], 'Cookile');
                $mail->setTo($model->email);
                $mail->setSubject('  Cookile account activation');

                $message = '
                    <br/>
                    Thank you for joining Cookile! <br/>
Now you will be able to buy homemade food from home cooks and bakers

<br/>
Your username is: ' . $model->username . '<br/>
Your password is: ' . $model->simple_decrypt($model->password) . '<br/>
In order to complete your account activation, please click on the following link.
<a href = "' . Yii::app()->getBaseUrl(true) . '/home/activate/?code=' . $model->activation_code . '" >' . Yii::app()->getBaseUrl(true) . '/home/activate/?code=' . $model->activation_code . '</a>

';
                $mail->setBody($message);

                if ($mail->send()) {
                    $arr['email'] = 1;
                } else {
                    $arr['email'] = 0;
                    $arr['email_error'] = "Error while sending email: " . $mail->getError();
                }
                $arr['success'] = 1;
                
            } else {
                $arr['success'] = 0;
                $arr['error'] = CHtml::errorSummary($model);
            }
           
           
           
           
//        
//        if ($_POST['User']) {
//           $arr['submitted'] = 1;
//            $model->attributes = $_POST['User'];
//
//            $model->username = $model->email;
//
//            $model->activation_code = uniqid();
//
//            if ($_POST['User']['groups_id'] == '') {
//                $model->groups_id = '1';
//            }
//
//            if ($model->save()) {
//                
//                $user_details = new UserDetails();
//                $user_details->user_id = $model->id;
//                $user_details->created = date('Y-m-d H:i:s');
//                $user_details->save(false);
//
////if newsletter
//                if ($_POST['newletter_check']) {
//                    $news = new Newsletter;
//                    $news->email = $model->email;
//                    $news->created = date('Y-m-d H:i:s');
//                    $test = Newsletter::model()->findByAttributes(array('email' => $model->email));
//                    if (!$test)
//                       // $model->save(false);
//                        $news->save(false);
//                }
//
//                $mail = new YiiMailer();
//                $mail->setFrom(Yii::app()->params['adminEmail'], 'Cookile');
//                $mail->setTo($model->email);
//                $mail->setSubject('Cookile account activation');
//
//                $message = '
//                    <br/>
//                    Thank you for joining Cookile! <br/>
//Now you will be able to buy homemade food from home cooks and bakers
//
//<br/>
//Your username is: ' . $model->username . '<br/>
//Your password is: ' . $model->simple_decrypt($model->password) . '<br/>
//In order to complete your account activation, please click on the following link.
//<a href = "' . Yii::app()->getBaseUrl(true) . '/home/activate/?code=' . $model->activation_code . '" >' . Yii::app()->getBaseUrl(true) . '/home/activate/?code=' . $model->activation_code . '</a>
//
//';
//                $mail->setBody($message);
//
//                if ($mail->send()) {
//                    $arr['email'] = 1;
//                } else {
//                    $arr['email'] = 0;
//                    $arr['email_error'] = "Error while sending email: " . $mail->getError();
//                }
//                $arr['success'] = 1;
//                
//            } else {
//                $arr['success'] = 0;
//                $arr['error'] = CHtml::errorSummary($model);
//            }
//        }

        echo json_encode($arr);
       // echo CJSON::encode(array('submitted' => $arr['submitted'],'success' => $arr['success']));
        
        //Yii::app()->end();
    }

    
    
//     public function actionRegister() {
//       // $this->layout='ajax';
//        $arr = array();
//        $model = new User('register');
//        $arr['submitted'] = 0;
//        
//         $model->fname = Yii::app()->request->getPost('fname');
//         $model->lname = Yii::app()->request->getPost('lname');
//         $model->password = Yii::app()->request->getPost('Password');
//        // $model->fname = Yii::app()->request->getPost('Password2');
//        $model->email = Yii::app()->request->getPost('Email');
//        
//        
//       // if ($_POST['User']) {
//            
//           // $model->attributes = $_POST['User'];
//
//           // $model->username = $model->email;
//
//            $model->activation_code = uniqid();
//
//            if ($_POST['User']['groups_id'] == '') {
//                $model->groups_id = '1';
//            }
//
//            if ($model->save()) {
//                $arr['submitted'] = 1;
//                $user_details = new UserDetails();
//                $user_details->user_id = $model->id;
//                $user_details->created = date('Y-m-d H:i:s');
//                $user_details->save(false);
//
////if newsletter
//                if ($_POST['newletter_check']) {
//                    $news = new Newsletter;
//                    $news->email = $model->email;
//                    $news->created = date('Y-m-d H:i:s');
//                    $test = Newsletter::model()->findByAttributes(array('email' => $model->email));
//                    if (!$test)
//                       // $model->save(false);
//                        $news->save(false);
//                }
//
//                $mail = new YiiMailer();
//                $mail->setFrom(Yii::app()->params['adminEmail'], 'Cookile');
//                $mail->setTo($model->email);
//                $mail->setSubject('Cookile account activation');
//
//                $message = '
//                    <br/>
//                    Thank you for joining Cookile! <br/>
//Now you will be able to buy homemade food from home cooks and bakers
//
//<br/>
//Your username is: ' . $model->username . '<br/>
//Your password is: ' . $model->simple_decrypt($model->password) . '<br/>
//In order to complete your account activation, please click on the following link.
//<a href = "' . Yii::app()->getBaseUrl(true) . '/home/activate/?code=' . $model->activation_code . '" >' . Yii::app()->getBaseUrl(true) . '/home/activate/?code=' . $model->activation_code . '</a>
//
//';
//                $mail->setBody($message);
//
//                if ($mail->send()) {
//                    $arr['email'] = 1;
//                } else {
//                    $arr['email'] = 0;
//                    $arr['email_error'] = "Error while sending email: " . $mail->getError();
//                }
//                $arr['success'] = 1;
//                
//            } else {
//                $arr['success'] = 0;
//                $arr['error'] = CHtml::errorSummary($model);
//            }
//      //  }
//
//       // echo json_encode($arr);
//        echo CJSON::encode(array('submitted' => $arr['submitted'],'success' => $arr['success']));
//        
//        //Yii::app()->end();
//    } 
    
    
    
    
    
    
    
    
    public function actionForgot() {
        $arr = array();
        $model = new User;
        $arr['submitted'] = 0;
        if (isset($_POST['User'])) {
            $arr['submitted'] = 1;
            $model->attributes = $_POST['User'];

            $criteria = new CDbCriteria;
            $criteria->condition = 'email=:email';
            $criteria->params = array(':email' => $model->email);
            $usermodel = User::model()->find($criteria);



            if (count($usermodel) == 0) {
                $arr['success'] = 0;
                $arr['error'] = 'Sorry, there\'s no account associated with that email address';
            } else {

//create randomkey
                $key = Helper::GenerateRandomKey();
                $usermodel->pass_reset = 1;
                $usermodel->pass_code = $key;
                $usermodel->save(false);

   
         $link_reset= Yii::app()->params['webSite']  . '/home/reset/hash/' . $usermodel->pass_code  ;
                
                $mail = new YiiMailer();
                $mail->setFrom(Yii::app()->params['adminEmail'], 'Cookile');
                $mail->setTo($model->email);
                $mail->setSubject('cookile Password reset');

                $message = 'Dear customer,

				Please follow this link to reset your password :  <br>
				Username:' . $usermodel->username . '<br>
				URL:<a   href=" $link_reset"  >' . Yii::app()->params['webSite']  . '/home/reset/hash/' . $usermodel->pass_code . ' </a>

				';

                $mail->setBody($message);


                if ($mail->send()) {
                $arr['email'] = 1;
                } else {
                    $arr['email'] = 0;
                    $arr['email_error'] = "Error while sending email: " . $mail->getError();
                }
                $arr['success'] = 1;
            }
        }

        echo json_encode($arr);
    }

    public function actionSearchAutoComplete() {
        if (!empty($_GET['term'])) {
            $sql = 'SELECT id, title as value, title as label FROM product WHERE LOWER(`title`) LIKE :qterm OR LOWER(`desc`) LIKE :qterm';
            $sql .= ' ORDER BY title ASC';
            $command = Yii::app()->db->createCommand($sql);
            $qterm = '%' . $_GET['term'] . '%';
            $command->bindParam(":qterm", $qterm, PDO::PARAM_STR);
            $result = $command->queryAll();
            echo CJSON::encode($result);
            exit;
        } else {
            return false;
        }
    }

    public function actionLikeProduct($id) {
        if ((!Yii::app()->user->isGuest) && $id != '') {
            $like = UserProduct::model()->findByAttributes(array('user_id' => Yii::app()->user->id, 'product_id' => $id));
            if ($like && $like->is_favourate) {
                $like->is_favourate = 0;
                $like->save(false);
                echo '<img src="' . Yii::App()->baseUrl . '/img/like1.png" alt="">';
            } elseif ($like) {
                $like->is_favourate = 1;
                $like->save(false);
                echo '<img src="' . Yii::App()->baseUrl . '/img/like2.png" alt="">';
            } else {
                $like = new UserProduct;
                $like->user_id = Yii::App()->user->id;
                $like->product_id = $id;
                $like->is_favourate = 1;
                $like->created = date('Y-m-d H:i:s');
                $like->save(false);
                echo '<img src="' . Yii::App()->baseUrl . '/img/like2.png" alt="">';
            }
        } else {
            return false;
        }
    }

    public function actionUploadAttachment() {
        if (!Yii::app()->user->isGuest) {
            $photo = CUploadedFile::getInstanceByName('file1');
            $fileName = time() . $photo;
            $photo->saveAs(Yii::app()->basePath . '/../media/attachments/' . $fileName);

            $attachment = new MessageAttachment;
            $attachment->title = $photo->name;
            $attachment->file_path = $fileName;
            $attachment->date_create = date('Y-m-d H:i:s');
            $attachment->user_id = Yii::app()->user->id;
            if ($attachment->save())
                echo CJSON::encode(array('status' => 'success', 'id' => $attachment->id, 'title' => $attachment->title));
            else
                echo CJSON::encode(array('status' => 'fail'));
        } else
            echo CJSON::encode(array('status' => 'fail'));
    }

    public function actionMessageSeller() {
        if (!Yii::app()->user->isGuest) {
            $message = new Message;
            $message->from_id = Yii::app()->user->id;
            $message->to_id = Yii::app()->request->getPost('seller');
            $message->title = Yii::app()->request->getPost('title');
            $message->content = Yii::app()->request->getPost('message');
            $message->type = Yii::app()->request->getPost('type');
            $message->product_id = Yii::app()->request->getPost('product');
            $message->status = 1;
            $message->created = date('Y-m-d H:i:s');
            $message->is_read = 0;
            if ($message->save()) {
                $attachs = explode(',', Yii::app()->request->getPost('attachments'));
                foreach ($attachs as $id) {
                    $attach = MessageAttachment::model()->findByPk($id);
                    if ($attach) {
                        $attach->message_id = $message->id;
                        $attach->save();
                    }
                }
                echo CJSON::encode(array('status' => 'success'));
            } else
                echo CJSON::encode(array('status' => 'fail'));
        } else
            echo CJSON::encode(array('status' => 'fail'));
    }

    
    
     public function actionMessageContact() {
        if (!Yii::app()->user->isGuest) {
            $message = new Message;
            $message->from_id = Yii::app()->user->id;
            $message->to_id = Yii::app()->request->getPost('seller');
            $message->title = Yii::app()->request->getPost('title');
            $message->content = Yii::app()->request->getPost('message');
            $message->type = Yii::app()->request->getPost('type');
            $message->product_id = Yii::app()->request->getPost('product');
            $message->status = 1;
            $message->created = date('Y-m-d H:i:s');
            $message->is_read = 0;
            $message->save() ;
           
                echo CJSON::encode(array('status' => 'success'));
        } else
            echo CJSON::encode(array('status' => 'fail'));
    }
    
    
    public function actionLoadShopProducts() {
        $shop_id = Yii::app()->request->getPost('shop');
        $start = Yii::app()->request->getPost('start');
        $cat = Yii::app()->request->getPost('cagtegory', NULL);
        $sort = Yii::app()->request->getPost('sort', NULL);
        $limit = 6;

        $criteria = new CDbCriteria;
        $criteria->condition = 'active=1 AND store_id = ' . $shop_id;
        if ($cat) {
            $criteria->condition .= ' AND category_id';
        }
        if ($sort) {
            $sort = urldecode($sort);
            if ($sort == 'popular') {
                $criteria->join = 'LEFT OUTER JOIN `user_product` ON (`t`.`id` = `user_product`.`product_id` AND `user_product`.`is_favourate`=1)';
                $criteria->select.=' ,COUNT(`user_product`.`id`) as favCount';
                $criteria->order = '`favCount` DESC';
            } elseif ($sort == 'paid') {
                $criteria->join = 'LEFT OUTER JOIN order_details ON `t`.`id` = order_details.`product_id`';
                $criteria->select.=' ,COUNT(order_details.`id`) AS orderCount';
                $criteria->order = '`orderCount` DESC';
            }
            $criteria->group = 't.id';
        }

        $criteria->limit = $limit;
        $criteria->offset = $start;

        $products = Product::model()->findAll($criteria);

        if ($products)
            $this->renderPartial('shopProduct', array('products' => $products));
    }

    public function actionLoadMore() { //Orders History Dashboard
        $start = Yii::app()->request->getPost('start');

        $limit = Yii::app()->request->getPost('limit');

        $criteria = new CDbCriteria;

        $store = Store::model()->findByAttributes(array('user_id' => Yii::app()->user->id));

        $criteria->condition = 'store_id=' . $store->id;
        $criteria->order = 'id DESC';


        $criteria->limit = $limit;
        $criteria->offset = $start;

        $count = OrderDetails::model()->count($criteria);


        $orderDetails = OrderDetails::model()->findAll($criteria);

        $this->renderPartial('history', array('orderDetails' => $orderDetails));
    }

    ///////////////////////////////////LoadMoreReviews/////////////////////////////
    public function actionLoadMoreReviews() {
        $start = Yii::app()->request->getPost('start');

        $limit = Yii::app()->request->getPost('limit');

        $criteria = new CDbCriteria;

        $store = Store::model()->findByAttributes(array('user_id' => Yii::app()->user->id));

        $criteria->condition = 'store_id=' . $store->id;
        $criteria->order = 'id DESC';


        $criteria->limit = $limit;
        $criteria->offset = $start;

        //  $count = Review::model()->count($criteria);


        $reviews = Review::model()->findAll($criteria);

        $this->renderPartial('review', array('reviews' => $reviews));
    }

    ///////////////////////////////////LoadMoreReviews///////////////////////////////////////




    public function actionReportShop() {
        $shop_id = Yii::app()->request->getPost('shop');
        $email = Yii::app()->request->getPost('email');
        $message = Yii::app()->request->getPost('message');


        $report = New Report();
        $report->date_create = date('Y-m-d H:i:s');
        $report->email = $email;
        $report->message = $message;
        $report->type = 1;
        $report->shop_id = $shop_id;
        if ($report->save())
            echo CJSON::encode(array('status' => 'success'));
        else
            echo CJSON::encode(array('status' => 'fail'));
    }

    public function actionReportShop2() {
        $shop_id = Yii::app()->request->getPost('shop');
        $email = Yii::app()->request->getPost('email');
        $message = Yii::app()->request->getPost('message');
        $option = Yii::app()->request->getPost('optionsRadios');
        // $message .=$option ;
        $option .="  " . $message;

        $report = New Report();
        $report->date_create = date('Y-m-d H:i:s');
        $report->email = $email;
        $report->message = $option;
        $report->type = 1;
        $report->shop_id = $shop_id;
        if ($report->save())
            echo CJSON::encode(array('status' => 'success'));
        else
            echo CJSON::encode(array('status' => 'fail'));
    }

    public function actionAddCoupon() {
        $shop_id = Yii::app()->request->getPost('shop');
        $code = Yii::app()->request->getPost('code');
        $type = Yii::app()->request->getPost('type');
        $discount = Yii::app()->request->getPost('discount');
        $min_purchase = Yii::app()->request->getPost('min_purchase');
        $due_date = Yii::app()->request->getPost('due_date');
        $active = Yii::app()->request->getPost('active');


        $coupon = New Coupon();
        //$report->date_create = date('Y-m-d H:i:s');
        //$report->email = $email;
        // $report->message =  $message;

        $coupon->code = $code;
        $coupon->type = $type;
        $coupon->store_id = $shop_id;
        $coupon->discount = $discount;
        $coupon->min_purchase = $min_purchase;
        $coupon->due_date = $due_date;
        $coupon->active = $active;

        if ($coupon->active == 1) {
            $coupon_status = "Active";
            $coupon_class = "active_status";
        } else {
            $coupon_status = "Inactive";
            $coupon_class = "inactive_status";
        }



        if ($coupon->type == 0) {

            $coupon_type = "%";
        } else {
            $coupon_type = " ";
        }





        //  echo $form->errorSummary($coupon); 
        //$coupon->save(false) ;

        if ($coupon->save())
            echo CJSON::encode(array('status' => 'success', 'code' => $code, 'discount' => $discount, 'id' => $coupon->id, 'due_date' => $due_date, 'type' => $type, 'coupon_class' => $coupon_class, 'coupon_status' => $coupon_status, 'coupon_type' => $coupon_type));
        else
            echo CJSON::encode(array('status' => 'fail'));
    }

    public function actionEditCoupon() {



        $id = $_GET['id'];
        // $id = Yii::app()->request->getPost('id'); 
        $coupon = Coupon::model()->findByPk($id);

        $shop_id = Yii::app()->request->getPost('shop');
        $code = Yii::app()->request->getPost('code');
        $type = Yii::app()->request->getPost('type');
        $discount = Yii::app()->request->getPost('discount');
        $min_purchase = Yii::app()->request->getPost('min_purchase');
        $due_date = Yii::app()->request->getPost('due_date');
        $active = Yii::app()->request->getPost('active');



        $coupon->code = $code;
        $coupon->type = $type;
        $coupon->discount = $discount;
        $coupon->min_purchase = $min_purchase;
        $coupon->due_date = $due_date;
        $coupon->active = $active;

        $coupon->save();

        if ($coupon->active == 1) {
            $coupon_status = "Active";
            $coupon_class = "active_status";
        } else {
            $coupon_status = "Inactive";
            $coupon_class = "inactive_status";
        }



        if ($coupon->type == 0) {

            $coupon_type = "%";
        } else {
            $coupon_type = " ";
        }







        //$coupon->save(false) ;

        if ($coupon->save())
            echo CJSON::encode(array('status' => 'success', 'code' => $code, 'discount' => $discount, 'id' => $coupon->id, 'due_date' => $due_date, 'type' => $type, 'coupon_class' => $coupon_class, 'coupon_status' => $coupon_status, 'coupon_type' => $coupon_type));
        else
            echo CJSON::encode(array('status' => 'fail'));
    }

    public function actionGetCouponId() {

        $id = Yii::app()->request->getPost('id');
        $coupon = Coupon::model()->findByPk($id);


        $code = $coupon->code;
        $type = $coupon->type;
        $discount = $coupon->discount;
        $min_purchase = $coupon->min_purchase;
        $due_date = $coupon->due_date;
        $active = $coupon->active;


        if ($coupon->active == 1) {
            $coupon_status = "Active";
            $coupon_class = "active_status";
        } else {
            $coupon_status = "Inactive";
            $coupon_class = "inactive_status";
        }



        if ($coupon->type == 0) {

            $coupon_type = "%";
        } else {
            $coupon_type = " ";
        }




        echo CJSON::encode(array('status' => 'success', 'id' => $id, 'code' => $code, 'discount' => $discount, 'id' => $coupon->id, 'due_date' => $due_date, 'type' => $type, 'min_purchase' => $min_purchase, 'active' => $active, 'coupon_class' => $coupon_class, 'coupon_status' => $coupon_status, 'coupon_type' => $coupon_type));
    }

    public function actionMarkMessages($mark) {



        $limit2 = $_GET['limit2'];
        //echo  $limit2 = Yii::app()->request->getPost('limit2');
        $str = Yii::app()->request->getPost('data'); // string hold messages ids
        $arr = (explode(",", $str));

        $mark = $_GET['mark'];  // the function we make
        for ($i = 0; $i < count($arr); $i++) {
            $read_messages = Message::model()->findByPK($arr[$i]);

            if (!$read_messages)
                continue;

            if ($mark == "read") {
                $read_messages->is_read = 1;
            } elseif ($mark == "unread") {
                $read_messages->is_read = 0;
            } elseif ($mark == "spam") {
                $read_messages->status = 1;
            } elseif ($mark == "delete") {
                $read_messages->status = 2;
            } elseif ($mark == "notSpam") {
                $read_messages->status = 1;
            } elseif ($mark == "revert") {
                $read_messages->status = 1;
            }

            $read_messages->save();
        }

        $filter = Yii::app()->request->getPost('filter');   // currnet page we stop in it 
        switch ($filter) {
            case "0":
                $condition_pag = 'to_id=' . Yii::app()->user->id . ' AND status = ' . $filter;
                break;
            case "3":
                $condition_pag = 'from_id=' . Yii::app()->user->id;
                break;
            case "1":
                $condition_pag = 'to_id=' . Yii::app()->user->id . ' AND status = ' . $filter;
                break;
            case "2":
                $condition_pag = 'to_id=' . Yii::app()->user->id . ' AND status = ' . $filter;
                break;
            default:
                break;
        }

        $criteria = new CDbCriteria(array(
            'condition' => $condition_pag,
            'order' => 'id DESC',
        ));

        $count = Message::model()->count($criteria);

        $pages = new CPagination($count);
        $pages->pageVar = 'link';
        $pages->route = "profile/messages";
        $pages->params = array('filter' => $filter);

        // results per page
        if (isset($limit2)) {
            $pages->pageSize = $limit2;
        } else
            $pages->pageSize = Yii::app()->params['inbox_limit'];

        $pages->applyLimit($criteria);

        $pag_all_messages = Message::model()->findAll($criteria);
        $user = User::model()->findByPk(Yii::app()->user->id);

        $this->renderPartial('messages', array('pag_all_messages' => $pag_all_messages, 'pages' => $pages, 'filter' => $filter, 'user' => $user));
    }

    public function actionDeleteProfilePic() {
        if (!Yii::app()->user->isGuest) {
            $user = User::model()->findByPk(Yii::app()->user->id);
            $file = $user->image;
            $user->image = NULL;
            if ($user->save()) {
                if (file_exists(Yii::app()->getBasePath() . '/../media/members/' . $file)) {
                    unlink(Yii::app()->getBasePath() . '/../media/members/' . $file);
                }
                echo CJSON::encode(array('status' => 'success'));
            } else
                echo CJSON::encode(array('status' => 'fail'));
        } else
            echo CJSON::encode(array('status' => 'fail'));
    }

    public function actionCount() {


        $messages = Message::model()->findAll(array('condition' => 'is_read=0'));

        echo count($messages);
    }

    public function actionShip() {


        $order_id = $_GET['orderId'];
        if (isset($order_id)) {

            $order = Order::model()->findByPk($order_id);
            $order->status = 4;
            $order->save(false);

            $orderStore = OrderStore::model()->findByAttributes(array('order_id' => $order->id));
            // echo "<h3 style='margin-left:20px;color:#0f0;'>the order is shipped successfully</h3>" ;

            $this->renderPartial('ship', array('user' => $user, 'order' => $order, 'orderStore' => $orderStore));
        }
    }

    public function actionReceive() {


        $order_id = $_GET['orderId'];
        if (isset($order_id)) {

            $order = Order::model()->findByPk($order_id);
            $order->status = 2;
            $order->save(false);

            //$orderStore = OrderStore::model()->findByAttributes(array('order_id' =>$order->id));
            // echo "<h3 style='margin-left:20px;color:#0f0;'>the order is shipped successfully</h3>" ;
            //$this->renderPartial('ship', array('user' => $user,'order' => $order,                                        'orderStore' => $orderStore));
            //  echo '  ';
        }
    }

    public function actionShownCertificate() {
        if (!Yii::app()->user->isGuest) {

            $id = Yii::app()->request->getPost('id');
            $certification = Certification::model()->findByPK($id);

            $is_shown = $certification->is_shown;

            if ($is_shown == 1)
                $is_shown_new = 0;
            else
                $is_shown_new = 1;

            $certification->is_shown = $is_shown_new;
            $certification->save(false);

            echo CJSON::encode(array('status' => 'success', 'shown' => $is_shown_new));
        } else
            echo CJSON::encode(array('status' => 'fail'));
    }

    public function actionUploadCertificate() {
        if (!Yii::app()->user->isGuest) {

            $id = Yii::app()->request->getPost('id');
            $photo = CUploadedFile::getInstanceByName('file');
            $fileName = time() . $photo;
            $photo->saveAs(Yii::app()->basePath . '/../media/certifications/' . $fileName);
            $path = Yii::app()->baseUrl . '/media/certifications/' . $fileName;
            $certification = Certification::model()->findByPK($id);
            $certification->image = $fileName;
            $certification->save(false);

            $special_need = $certification->special_need;
            $image = $certification->image;

            echo CJSON::encode(array('status' => 'success', 'path' => $path, 'special_need' => $special_need, 'image' => $image, 'id' => $id));
        } else
            echo CJSON::encode(array('status' => 'fail'));
    }

    public function actionAddCertificate() {
        if (!Yii::app()->user->isGuest) {



            $id = Yii::app()->request->getPost('id');  // store id
            $type = Yii::app()->request->getPost('type');
            $special_need = Yii::app()->request->getPost('value');

            $prodcut_id = Yii::app()->request->getPost('prodcut');


            $certification = New Certification();
            $certification->type = $type;
            $certification->special_need = $special_need;
            if ($type == 1)
                $certification->store_id = $id;
            else {

                //$model = new Product;
                // $model->save(false);
                // $certification->product_id = $model->id;
                $certification->product_id = $prodcut_id;
            }

            //$certification->product_id = $id;
            $certification->save(false);

            echo CJSON::encode(array('status' => 'success', 'id' => $certification->id));
        } else
            echo CJSON::encode(array('status' => 'fail'));
    }

    public function actionDeleteCertf() {
        if (!Yii::app()->user->isGuest) {


            // $id=$_GET['id'] ;
            $id = Yii::app()->request->getPost('id');
            // $certification = Certification::model()->findByPK($id);


            Certification::model()->deleteByPk($id);
            echo CJSON::encode(array('status' => 'success', 'id' => $id));
        } else
            echo CJSON::encode(array('status' => 'fail'));
    }

    public function actionDeleteShop() {

        if (!Yii::app()->user->isGuest) {

            // $id=$_GET['id'] ;
            $store_id = Yii::app()->request->getPost('id');
            $store = Store::model()->findByPK($store_id);
            $store->deleted = date("Y-m-d H:i:s");
            //$model->updated = date('Y-m-d H:i:s');
            $store->save(false);

            echo CJSON::encode(array('status' => 'success', 'id' => $store_id));
        } else
            echo CJSON::encode(array('status' => 'fail'));
    }

    public function actionDeleteCertfImage() {
        if (!Yii::app()->user->isGuest) {


            // $id=$_GET['id'] ;
            $id = Yii::app()->request->getPost('id');

            $certification = Certification::model()->findByPK($id);
            $certification->image = NULL;
            $certification->save(false);
            echo '
                 <span id="addCertf-' . $certification->id . ' " >
                        <button      type="button" class="btn   add_a_cert  add_a_cert_' . $certification->id . '"  onclick="addClick(' . $certification->id . ') ;return false;"       >Add a certificate                          </button>  
                                                                                                             <input type="file"  class="add_cert_hidden_' . $certification->id . '"    id="cert-' . $certification->id . '" onchange="uploadCert(' . $certification->id . ')"   style="display: none" />      </span>   ';
        } else
            echo CJSON::encode(array('status' => 'fail'));
    }

    public function actionRemoveCoupon() {
        if (!Yii::app()->user->isGuest) {

            $id = Yii::app()->request->getPost('id');
            //$id=$_GET['id'] ;
            // $certification = Certification::model()->findByPK($id);


            Coupon::model()->deleteByPk($id);
            echo $id;
        } else
            echo CJSON::encode(array('status' => 'fail'));
    }

    public function actionAddProductShip() {
        if (!Yii::app()->user->isGuest) {

            $id = Yii::app()->request->getPost('id');


            $country = Country::model()->findByPK($id);

            if ($country)
                $country_name = $country->title;
            else {
                $country_name = "Every Where Else";
                $id = 240;
            }





            echo CJSON::encode(array('status' => 'success', 'id' => $id, 'country' => $country_name));
        } else
            echo CJSON::encode(array('status' => 'fail'));
    }

    public function actionAddPropertyOptions() {


        $property_id = $_REQUEST['property'];
        //  $product_id = $_REQUEST['product'];
        $option_name = $_REQUEST['property_name']; // option name that we add

        $property = Property::model()->findByPK($property_id);

        $lastId = Yii::app()->db->createCommand('SELECT   MAX(id)   FROM property_option')->queryScalar();

        $option_id = $lastId + 1;


        if (isset($property_id)) {
            /*
              // add properties to current product ajax
              $ProductProperty = New ProductProperty();
              $ProductProperty->product_id = $product_id;
              $ProductProperty->property_id = $property_id;
              $ProductProperty->title = $property->title;
              $ProductProperty->created = date("Y-m-d H:i:s");
              $ProductProperty->save();



              // add options  to current property  ajax
              $ProductPropertyOption = New ProductPropertyOption();
              $ProductPropertyOption->product_id = $product_id;
              $ProductPropertyOption->product_property_id = $property_id;
              $ProductPropertyOption->title = $property_name;

              $ProductPropertyOption->save(false);

             */




            $result = '';

            // $price = " ";

            $result .= '<tr id="tr_property_' . $option_id . '"   class="tr_property_' . $property_id . '     tr_hidden_add"       >  <input type="hidden"  name="property_id[]"  value="' . $property_id . '">   <input type="hidden"  name="property_name[]"  value="' . $property->title . '"> <input type="hidden"  name="option_name[]"  value="' . $option_name . '">
                          <td> ' . $option_name . '</td>
                          <td><input type="text" class="small-input2"    name="option_cost[]"   ></td>
                           <input type="hidden"    value="0"    id="input_stock_' . $option_id . '"      >
                          <td class="centerd"> 
                         <input type="checkbox"  onclick="check(' . $option_id . ');"     class="checken_stock"   data="1"   name="option_instock[]"   >     </td> 
                          <td class="centerd"><a href="#"  class="close2  deleteItem"     onclick="dele_tr();return false ;"    >X</a></td>
                        </tr>';

            echo $result;
        }
    }

    public function actionSetMainImage($product, $image) {
        if ($product)
            $prod = Product::model()->findByPk($product);
        else {
            $prod = new Product();
        }
        $prod->main_image = $image;
        $prod->save();

        echo CJSON::encode(array('status' => 'success'));
    }

    public function actionDeleteGalleryImage($image) {
        GalleryPhoto::model()->deleteByPk($image);

        echo CJSON::encode(array('status' => 'success'));
    }

    public function actionFilterOrders() {

        $filter = $_REQUEST['filter'];
        // echo  $start = Yii::app()->request->getPost('start');
        // echo   $limit = Yii::app()->request->getPost('limit');

        /*
          echo "type:" . $type = $_GET['type'];
          echo "start:" . $start = $_GET['start'];
          echo "limit:" . $limit = $_GET['limit'];

          echo "month:" . $month = $_GET['month'];
          echo "year:" . $year = $_GET['year'];

          echo "sort:" . $sort = $_GET['sort'];
         */


        $type = $_GET['type'];
        $start = $_GET['start'];
        $limit = $_GET['limit'];

        $month = $_GET['month'];
        $year = $_GET['year'];

        $sort = $_GET['sort'];



        $user = User::model()->findByPk(Yii::app()->user->id);

        $store = Store::model()->findByAttributes(array('user_id' => Yii::app()->user->id));

        $criteria = new CDbCriteria;
        //$criteria->with = array("order" => array("select" => "*"));

        $criteria->with = array(
            "order" => array(
                'alias' => 't1',
                'select' => '*'
            ),
            "product" => array(
                'alias' => 't2',
                'select' => 't2.*, LOWER(title)  AS titlesmall',
            // = 'select' => ' LOWER(title)  AS titlesmall',
            ),
        );

        $condition = 't.store_id=' . $store->id;

        if ($_GET['order_search'] != '') {
            $order_id = urldecode($_GET['order_search']);

            $condition .= '  AND  t.order_id=' . $order_id;
        }


        if ($month != '') {

            $condition .= '  AND  month(t1.order_date)=' . $month;
        }


        if ($year != '') {

            $condition .= '  AND  year(t1.order_date)=' . $year;
        }




        $criteria->condition = $condition;

        // echo $condition; die();
        if ($filter != 6)
            $criteria->addCondition('t1.status=' . $filter);

        // $criteria->order = 'order_id  DESC';
        if ($type == 2) {

            $criteria->limit = $start + $limit;
            $criteria->offset = 0;
        } elseif ($type == 1) {
            if ($_GET['order_search'] == '') {
                $criteria->limit = 2;
                $criteria->offset = 0;
            } else {
                $criteria->limit = 2;
                $criteria->offset = 0;
            }
        }




        if ($sort == 1) {

            $criteria->order = 't1.order_date  DESC';
        }


        if ($sort == 2) {
            // $criteria = new CDbCriteria;
            // $criteria->with = array("product" => array("select" => "*"));
            // $condition = 'store_id=' . $store->id;
            // $criteria->limit = $limit;
            // $criteria->offset = $start;
//             if ($_GET['order_search'] != '') {
//            $order_id = urldecode($_GET['order_search']);
//
//            $condition .= '  AND  order_id=' . $order_id;
//        }
//        if ($year != '') {
//
//            $condition .= '  AND  year(order_date)=' . $year;
//
//            if ($month != '') {
//
//                $condition .= '  AND  month(order_date)=' . $month;
//                ;
//            }
//        }
//       LCASE(title) AS title

            $criteria->order = 'titlesmall  ';
        }



        $orderDetails = OrderDetails::model()->findAll($criteria);
        // print_r($orderDetails) ;
        // echo '3434543'; 
        /*
          $criteria2 = new CDbCriteria;
          $criteria2->with = array("order" => array("select" => "*"));
          $condition2 = 'store_id=' . $store->id;  // search by order id
          $criteria2->condition = $condition2;
          if ($filter != 6)
          $criteria2->addCondition('order.status=' . $filter);

          //$criteria2->order = 'order_id DESC';
         */
        $total_count = OrderDetails::model()->count($criteria);

        if ($filter != 7)
            $this->renderPartial('ordersPartial', array('user' => $user, 'filter' => $filter, 'store' => $store, 'orderDetails' => $orderDetails, 'total_count' => $total_count, 'start' => $start));

        elseif ($filter == 7) {

            $reviews = Review::model()->findAll(array('order' => ' id DESC',
                'condition' => 'store_id=' . $store->id, 'limit' => 2));



            $this->renderPartial('review_orders', array('reviews' => $reviews, 'user' => $user, 'filter' => $filter, 'store' => $store));
        }
    }

//    public function actionSearchOrders() {
//
//        $filter = $_REQUEST['status'];
//
//        $user = User::model()->findByPk(Yii::app()->user->id);
//
//        $store = Store::model()->findByAttributes(array('user_id' => Yii::app()->user->id));
//
//
//
//        if ($_GET['order_search'] != '') {
//            $order_id = urldecode($_GET['order_search']);
//
//            if ($filter == 6)
//                $condition = 'user_id=' . $user->id . ' AND  id=' . $order_id;  // search by order id
//            else
//                $condition = 'user_id=' . $user->id . ' AND status=' . $filter . ' AND  id=' . $order_id;
//            //search by order id + status
//
//            $criteria = new CDbCriteria;
//            $criteria->condition = $condition;
//            $criteria->order = 'id DESC';
//            $orders = Order::model()->findAll($criteria);
//        }
//
//
//
//        $this->renderPartial('ordersPartial', array('orders' => $orders, 'user' => $user, 'filter' => $filter, 'store' => $store));
//    }
//    public function actionLoadMoreOrders() {
//        $start = Yii::app()->request->getPost('start');
//        $limit = Yii::app()->request->getPost('limit');
//
//
//        $start = 0;
//
//        $order_search = Yii::app()->request->getPost('order_search');
//        $filter = Yii::app()->request->getPost('filter');
//
//        $user = User::model()->findByPk(Yii::app()->user->id);
//
//        $store = Store::model()->findByAttributes(array('user_id' => Yii::app()->user->id));
//
//        if ($order_search != '') {
//            $order_id = urldecode($order_search);
//
//            if ($filter == 6)
//                $condition = 'user_id=' . $user->id . ' AND  id=' . $order_id;  // search by order id
//            else
//                $condition = 'user_id=' . $user->id . ' AND status=' . $filter . ' AND  id=' . $order_id;
//            //search by order id + status
//        }
//
//        else {
//            if ($filter == 6)
//                $condition = 'user_id=' . $user->id;  // search by order id
//            else
//                $condition = 'user_id=' . $user->id . ' AND status=' . $filter;
//            //search by order id + status
//        }
//
//
//        $criteria = new CDbCriteria;
//        $criteria->condition = $condition;
//        $criteria->order = 'id DESC';
//        $criteria->limit = $limit + 1;  // 1 is the intial limit
//        $criteria->offset = $start;
//        $orders = Order::model()->findAll($criteria);
//
//
//
//        $criteria2 = new CDbCriteria;
//        $criteria2->condition = 'user_id=' . $user->id;
//        $criteria2->order = 'id DESC';
//        $total_count = Order::model()->count($criteria2);
//
//
//        $this->renderPartial('ordersPartial', array('orders' => $orders, 'user' => $user, 'filter' => $filter, 'store' => $store, 'total_count' => $total_count));
//    }


    public function actionAddToCart() {
        $id = Yii::app()->request->getPost('item'); //product id

        $quantity = Yii::app()->request->getPost('quantity');  // selected quantity of selected product
        $options = Yii::app()->request->getPost('props');   // options  of selected product as array of options ids  from ProductPropertyOption table



        $product = Product::model()->findByPk($id);

        
  // we want to create array called   $cart[shop_id][product_id]  to load all user selected products
        if (Yii::app()->user->hasState('cart')) {
            $cart = Yii::app()->user->getState('cart');
        } else {
            $cart = array();
        }

        if (!key_exists($product->store_id, $cart))
            $cart[$product->store_id] = array();

        if (!is_array($cart[$product->store_id]))
            $cart[$product->store_id] = array();

        //get shipment cost
        $user = User::model()->findByPk(Yii::app()->user->id);
        //get country of the user
        $country_id = $user->userDetails->country_id;
        //get the shipment cost
        $shipment = ProductShipping::model()->findByAttributes(array('product_id' => $product->id, 'country_id' => $country_id));
        if (!$shipment) {
            $shipment = ProductShipping::model()->findByAttributes(array('product_id' => $product->id, 'country_id' => 0)); //Every Where Else
            if (!$shipment) {
                $shipment_cost = 0;
                $shipment_alt_cost = 0;
            } else {
                $shipment_cost = $shipment->cost;
                $shipment_alt_cost = $shipment->alt_cost;
            }
        } else {
            $shipment_cost = $shipment->cost;
            $shipment_alt_cost = $shipment->alt_cost;
        }

        $cart[$product->store_id][$product->id] = array(
            'quantity' => $quantity,
            'options' => $options,
            'shipping_cost' => $shipment_cost,
            'shipping_alt_cost' => $shipment_alt_cost,
        );

        if (!Yii::app()->user->hasState('cartStoreOptions')) {
            $storesOptions = array();
        } else {
            $storesOptions = Yii::app()->user->getState('cartStoreOptions');
        }

        if (!isset($storesOptions[$product->store_id])) {
            $storesOptions[$product->store_id] = array(
                'buyer_commision' => Yii::app()->params['buyer_commision'],
                'seller_commision' => Yii::app()->params['seller_commision'],
                'shipment_type_view' => true,
                'shipment_type' => 2,
                'note' => '',
                'shipping_period_type' => 1,
                'shipping_period_from' => 0,
                'shipping_period_to' => 0,
                'pickup_time' => '',
                'product_count' => 0,
                'total_price' => 0,
                'shipping_cost' => 0,
                'coupon_discount' => 0,
            );
        }


        $storeOptions = $storesOptions[$product->store_id];

        //get the prefered type of the shipment_pickup and its info
        $storeOptions['total_price'] = 0;
        $storeOptions['product_count'] = 0;
        $storeOptions['shipping_cost'] = 0;
        foreach ($cart[$product->store_id] as $pro_id => $data) {
            $product = Product::model()->findByPk($pro_id);

            //product_count
            $storeOptions['product_count'] ++;
            
            //product_count
            if(count($cart[$product->store_id])==1)
            $storeOptions['shipping_cost'] += $data['shipping_cost'];
            else
                $storeOptions['shipping_cost'] += $data['shipping_alt_cost'];
            
            //total price
            $storeOptions['total_price'] += $product->price;
            
            

            //set the shipment and pickup info
            if ($product->is_pick_up && $product->is_shipment)
                $storeOptions['shipment_type_view'] = ($storeOptions['shipment_type_view'] && true);
            elseif ($product->is_pick_up) {
                $storeOptions['shipment_type_view'] = false;
                $storeOptions['shipment_type'] = 2;
            } elseif ($product->is_shipment) {
                $storeOptions['shipment_type_view'] = false;
                $storeOptions['shipment_type'] = 1;
            }

            if ($product->is_shipment) {
                if ($product->shipping_period_type > $storeOptions['shipping_period_type']) {
                    $storeOptions['shipping_period_type'] = $product->shipping_period_type;
                    $storeOptions['shipping_period_from'] = $product->shipping_period_from;
                    $storeOptions['shipping_period_to'] = $product->shipping_period_to;
                }

                if ($product->shipping_period_from > $storeOptions['shipping_period_from']) {
                    $storeOptions['shipping_period_from'] = $product->shipping_period_from;
                }
                if ($product->shipping_period_to > $storeOptions['shipping_period_to']) {
                    $storeOptions['shipping_period_to'] = $product->shipping_period_to;
                }
            }

            if ($product->is_pick_up) {
                if ($product->open_hour_type == 1)
                    $str.="All Hours";
                else
                    $str.=$product->open_hour_from . ' - ' . $product->open_hour_to;
                $str.=', ';
                if ($product->open_day_type == 1)
                    $str.="All Days";
                else
                    $str.=Helper::getweekDay($product->open_day_from) . ' - ' . Helper::getweekDay($product->open_day_to);
                $str.=', and unavailable in ' . Helper::implodeDays($product->unavailable_days);
                $storeOptions['pickup_time'] = $str;
            }
        }

        $storesOptions[$product->store_id] = $storeOptions;

        if (Yii::app()->user->hasState('cartPrice')) {
            $price = Yii::app()->user->getState('cartPrice');
        } else {
            $price = 0;
        }
        $price += ($quantity * $product->price);
        // $price = ($quantity * $product->price);

        Yii::app()->user->setState('cart', $cart); //$cart is array of store of product 
        Yii::app()->user->setState('cartCount', Order::getCartCount()); // the no# of products in $cart array
        Yii::app()->user->setState('cartPrice', $price); // the total price of user $cart
        Yii::app()->user->setState('cartStoreOptions', $storesOptions);  // array containe detail information  about collection of selected products  // not correct

        echo CJSON::encode(array('status' => 'success', 'cartCount' => Order::getCartCount() ,'price' => $price , 'quantity' => $quantity));
    }

    public function actionAddCouponCart() {
        $shop_id = Yii::app()->request->getPost('shop');
        $code = Yii::app()->request->getPost('code');
        $storesOptions = Yii::app()->user->getState('cartStoreOptions');


        $coupon = Coupon::model()->findByAttributes(array('store_id' => $shop_id, 'code' => $code, 'active' => 1));

        if ($coupon && $coupon->due_date >= date('Y-m-d')) {
            if ($coupon->type == 0)
                $discount = ($coupon->discount * $storesOptions[$shop_id]['total_price']) / 100;
            else
                $discount = $coupon->discount;

            $storesOptions[$shop_id]['coupon_discount'] = $discount;
            Yii::app()->user->setState('cartStoreOptions', $storesOptions);

            //get subtotal
            $subtotal = $storesOptions[$shop_id]['total_price'] + $storesOptions[$shop_id]['shipping_cost'] - $storesOptions[$shop_id]['coupon_discount'];

            echo CJSON::encode(array('status' => 'success', 'discount' => Helper::getPrice($discount), 'subtotal' => Helper::getPrice($subtotal)));
        } else
            echo CJSON::encode(array('status' => 'fail'));
    }

    public function actionDeleteitemFromCart() {
        $shop_id = Yii::app()->request->getPost('shop_id');
        $product_id = Yii::app()->request->getPost('id');
        if (Yii::app()->user->hasState('cart')) {
            $cart = Yii::app()->user->getState('cart');
        } else {
            $cart = array();
        }

        unset($cart[$shop_id][$product_id]);
        Yii::app()->user->setState('cart', $cart);


        echo CJSON::encode(array('status' => 'success'));
    }

    public function actionDeleteshopFromCart() {

        $shop_id = Yii::app()->request->getPost('shop_id');

        if (Yii::app()->user->hasState('cart')) {
            $cart = Yii::app()->user->getState('cart');
        } else {
            $cart = array();
        }

        unset($cart[$shop_id]);


        Yii::app()->user->setState('cart', $cart);

        echo CJSON::encode(array('status' => 'success'));
    }

}
