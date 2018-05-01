<?php

class ProductController extends AdminController {

    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = '//layouts/column2';

    /**
     * @return array action filters
     */
    public function filters() {
        return array(
                /* 'accessControl', // perform access control for CRUD operations */
        );
    }

    public function actions() {
        return array(
            'order' => array(
                'class' => 'ext.yiisortablemodel.actions.AjaxSortingAction',
            ),
        );
    }

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
    public function accessRules() {
        return array(
            array('allow', // allow all users to perform 'index' and 'view' actions
                'actions' => array('index', 'view'),
                'users' => array('*'),
            ),
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array('create', 'update'),
                'users' => array('@'),
            ),
            array('allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions' => array('admin', 'delete'),
                'users' => array('admin'),
            ),
            array('allow', 'actions' => array('order'), 'users' => array('@')),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id) {
        $this->render('view', array(
            'model' => $this->loadModel($id),
        ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate() {
        $id = $_REQUEST['id'];
        $model = new Product;
        $productdetails = new ProductDetails();
        $make = new Make();
        $motor = new MotorModel();

        $gallery_ob = new Gallery();
        
         $model_col = new ProductColor();
         $model_siz = new ProductSizes();
         $sizees=Sizes::model()->findAllByAttributes(array('category_id'=>3));


        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        $gallery_ob->name = true;
        $gallery_ob->description = false;
        $gallery->min_height = 1280;
        $gallery->min_width = 854;
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

        // Uncomment the following line if AJAX validation is needed
        if ($id == 1) {
        $criteria = new CDbCriteria;
        $criteria->condition = 'category_id=' . $id;
        $productcategory = ProductCategory::model()->findAll($criteria);


            $model->category_id = $id;
            $model->type = 0;
            $model->user_id = Yii::app()->user->id;
        }
        if ($id == 3) {
            $model->category_id = $id;
            $model->type = 0;
            $model->user_id = Yii::app()->user->id;
        }

        if ($id == 5) {
            $model->category_id = $id;
            $model->type = 1;
            $model->user_id = Yii::app()->user->id;
        }
        if ($id == 4) {
            $model->category_id = $id;
            $model->type = 0;
            $model->user_id = Yii::app()->user->id;
        }
        if ($id == 6) {
            $model->category_id = $id;
            $model->type = 0;
            $model->user_id = Yii::app()->user->id;
        }
        if ($id == 7) {
            $model->category_id = $id;
            $model->type = 0;
            $model->user_id = Yii::app()->user->id;
             $criteria = new CDbCriteria;
             
        }
        if ($id == 8) {
            
            $model->category_id = $id;
            $model->type = 0;
            $model->user_id = Yii::app()->user->id;
        }
        if ($id == 9) {
            $model->category_id = $id;
            $model->user_id = Yii::app()->user->id;
        }
        if ($id == 10) {
            $model->category_id = $id;
            $model->type = 1;
            $model->user_id = Yii::app()->user->id;
        }if ($id == 2) {
            $model->category_id = $id;
            $model->type = 1;
            $model->user_id = Yii::app()->user->id;
        }
        if ($model->main_image != '') {
                $_POST['Category']['main_image'] = $model->main_image;
            }
            
            
            
            
        if (isset($_POST['Product'])) {
          //  print_r($_POST['ProductDetails']);die;
            $model->attributes = $_POST['Product'];
            $productdetails->attributes = $_POST['ProductDetails'];
            $model->gallery_id = $gallery_ob->id;
           $productdetails->address  =$_POST['location'];

            $rnd = rand(0, 9999);  // generate random number between 0-9999
            $uploadedFile = CUploadedFile::getInstance($model, 'main_image');

            if (!empty($uploadedFile)){
                $fileName = "{$rnd}-{$uploadedFile}";  // random number + file name
                $model->main_image = $fileName;
                $uploadedFile->saveAs(Yii::app()->basePath . '/../media/product/' . $fileName);
            }
            if ($model->save()) {
                $productdetails->product_id = $model->id;
                $productdetails->attributes = $_POST['ProductDetails'];
                $productdetails->save(FALSE);
                
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
                if ($id == 1 or $id == 4 or $id==8 or $id==6) {
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
                }
                if ($id == 3 ) {
                    $i = 0;
                    foreach ($_POST['product'] as $sizes) {
                      //  echo  $_POST['product']['size'][$i];die;
                      //  echo$_POST['product']['quantity'][$i];die;
                        $size = new Size();
                        $size->product_id = $model->id;
                        $size->type=0;
                        $size->size_id = $_POST['product']['size'][$i];
                        $sizee=Sizes::model()->findByAttributes(array('id'=>$size->size_id));
                           $size->title=  $sizee->title;
                          // echo $size->title;die;
                        $size->price = $_POST['product']['price'][$i];
                        $size->quantity = $_POST['product']['quantity'][$i];
                        
                       // echo  $size->quantity;die;
                        if (!empty($size->product_id) and !empty($size->title)) {
                            $size->save(false);
                        }
                        $i++;
                    }
                    // }
                }
                if ($id == 2) {
                    // print_r( $_POST['room']);die;
                    // print_r( $_POST['room']['roomoptions']);die;
                    //  if (!empty($_POST['room']['roomoptions'])) {
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
                    //}
                }
                $this->redirect(array('view', 'id' => $model->id));
            }
        }

        $this->render('create', array(
            'model' => $model,
            'model_col'=>$model_col,
            'model_siz'=>$model_siz,          
            'sizees'=>$sizees,
            'id' => $id,
            'gallery' => $gallery_ob,
            'productdetails' => $productdetails,
        ));
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id) {

        $model = $this->loadModel($id);
        $criteria = new CDbCriteria;
        $criteria->condition = 'product_id=' . $id;
        //$colors = Color::model()->findAll($criteria);
        $model_col = new ProductColor;
        $colors = ProductColor::model()->findAll($criteria);
 foreach ($colors as $color) {
                    $arr_col[] = $color->colors_id;
                }
                $model_col->colors_id = $arr_col;
                
                
                $model_siz = new ProductSizes;
        $sizes = ProductSizes::model()->findAll($criteria);
 foreach ($sizes as $size) {
                    $arr_siz[] = $size->sizes_id;
                }
                $model_siz->sizes_id = $arr_siz;
                
        $criteria2 = new CDbCriteria;
        $criteria2->condition = 'product_id=' . $id;
        $sizes = Size::model()->findAll($criteria2);
       // $size_count = count($sizes);
        // echo $size_count;die;
        $cat_id = $model->category_id;

        $criteria3 = new CDbCriteria;
        $criteria3->condition = 'product_id=:ProductID';
        $criteria3->params = array(':ProductID' => $model->id);
        $productdetails = ProductDetails::model()->find($criteria3);

        $cat_id = $model->category_id;


        if ($cat_id == 2) {
            $criteria = new CDbCriteria;
            $criteria->condition = 'product_id=:ProductID';
            $criteria->params = array(':ProductID' => $model->id);
            $rooms = Room::model()->findAll($criteria);
            $room_count = count($_POST['rooms']);
        }
              
        if (isset($_POST['Product'])) {
             if ($model->main_image != '') {
                $_POST['Product']['main_image'] = $model->main_image;

            }

            $model->attributes = $_POST['Product'];
           
            $productdetails->attributes = $_POST['ProductDetails'];
           // $productdetails->address  =$_POST['location'];
            //echo $productdetails->address;die;
            if(!empty($_POST['Room']))
            $room->attributes = $_POST['Room'];


            if ($cat_id == 1) {
                $model->category_id = $cat_id;
                $model->type = 1;
                $model->user_id = Yii::app()->user->id;
            }
            $rnd = rand(0, 9999);  // generate random number between 0-9999
            $uploadedFile = CUploadedFile::getInstance($model, 'main_image');

            if (!empty($uploadedFile)) {
                $fileName = "{$rnd}-{$uploadedFile}";  // random number + file name
                $model->main_image = $fileName;
                $uploadedFile->saveAs(Yii::app()->basePath . '/../media/product/' . $fileName);
            }
            if ($model->save()) {

                $productdetails->product_id = $model->id;
                $productdetails->save(false);
                if ($cat_id == 2) {
                    $rooms_counts = count($_POST['room']['roomoptions']);
                }
                if ($cat_id == 3) {
                     $sizes_counts= count($_POST['product']['size']);
                }


                if ($cat_id == 2 and $rooms_counts != 0) {
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
                if ($cat_id == 4 or $cat_id == 1 or $cat_id==8) {
                                    ProductSizes::model()->deleteAll(array('condition' => 'product_id=' . $model->id));

                    if (isset($_POST['ProductSizes'])) {
                    // print_r ($_POST['ProductSizes']);die;
                                for ($i = 0; $i < count($_POST['ProductSizes']['sizes_id']); $i++) {
                                    $model_siz = new ProductSizes;
                                   // echo $_POST['ProductSizes']['sizes_id'][$i];die;
                                    $model_siz->sizes_id = $_POST['ProductSizes']['sizes_id'][$i];
                                   // echo  $model_col->sizes_id;die;
                                    $model_siz->product_id = $model->id;

                                    if (!$model_siz->save(false)) {
                                        throw new CHttpException(400, 'DataBase Error Please Try Again Later.');
                                    }
                                }
                            }
                }
               //echo $sizes_counts;die;
                if ($cat_id == 3 and $sizes_counts != 0) {
//               
//                   
                 //  echo "dfdf";die;
                     $sizes_counts= count($_POST['product']['size']);
                   //  echo $sizes_counts;die;
                    Size::model()->deleteAll(array('condition' => 'product_id=' . $model->id));
                    // echo $sizes_counts;die;
                    for ($i = 0; $i < $sizes_counts; $i++) {
//                        //   die;
                        $size = new Size();
                        $size->product_id = $model->id;
                        $size->type=0;
                        $size->size_id = $_POST['product']['size'][$i];
                         $sizee=Sizes::model()->findByAttributes(array('id'=>$size->size_id));
                           $size->title=  $sizee->title;
                        $size->price = $_POST['product']['price'][$i];
                        $size->quantity = $_POST['product']['quantity'][$i];
                        // $size->save(false);
                         
                        if (!empty($size->product_id) and ! empty($size->title)and ! empty($size->price)and ! empty($size->quantity)) {
                            $size->save(false);
                        }
                    }
//                
                
                }
                
//                
             
                $this->redirect(array('view', 'id' => $model->id));
            }
        }
        $gallery = Gallery::model()->findByPk($model->gallery_id);

        $this->render('update', array(
            'model' => $model,
            'colors' => $colors,
            'sizes' => $sizes,
            'cat_id' => $cat_id,
            'model_col'=>$model_col,
            'model_siz'=>$model_siz,          
            'gallery' => $gallery,
            'productdetails' => $productdetails,
            'rooms' => $rooms,
        ));
    }

    public function actionIsertGallery() {
        // $model = new Customer;

        $products = Product::model()->findAll();

        foreach ($products as $product) {
            // $customer = new Customer;

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
            $gallery_ob->save(false);
            $product->gallery_id = $gallery_ob->id;
            $product->save(false);

            //
//            $customer->gallery_id = $gallery_ob->id;
            //$command = Yii::app()->db->createCommand('update customer set  gallery_id ='.$gallery_ob->id);
            //$command->where('id=:id', array(':id' => $customer->id));
            //$command->query();
        }
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id) {
        
  $product=Product::model()->findByAttributes(array('id'=>$id));
  $product->product_status_id=2;
  $product->save(false);

       // if (Yii::app()->request->isPostRequest) {
            // we only allow deletion via POST request

//            $criteria = new CDbCriteria;
//            $criteria->condition = 'product_id=:ProductID';
//            $criteria->params = array(':ProductID' => $id);
//            $color = Color::model()->find($criteria);
//            if (count($color)) {
//                Color::model()->deleteAll($criteria);
//            }
//
//            $criteria = new CDbCriteria;
//            $criteria->condition = 'product_id=:ProductID';
//            $criteria->params = array(':ProductID' => $id);
//            $size = Size::model()->find($criteria);
//            if (count($size)) {
//                Size::model()->deleteAll($criteria);
//            }
//
//            $criteria = new CDbCriteria;
//            $criteria->condition = 'product_id=:ProductID';
//            $criteria->params = array(':ProductID' => $id);
//            $productdetails = ProductDetails::model()->find($criteria);
//            if (count($productdetails)) {
//                ProductDetails::model()->deleteAll($criteria);
//            }
//
//
//
//
//            $criteria = new CDbCriteria;
//            $criteria->condition = 'product_id=:ProductID';
//            $criteria->params = array(':ProductID' => $id);
//            $room = Room::model()->find($criteria);
//            if (count($room)) {
//                Room::model()->deleteAll($criteria);
//            }
//
//
//
//
//
//
//
//            $this->loadModel($id)->delete();
//
//
//
//            // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
//            if (!isset($_GET['ajax']))
//                $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index'));
//        } else
//            throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
    }

    /**
     * Lists all models.
     */
    public function actionIndex() {
        $id = $_REQUEST['id'];
        $_GET['Product']['category_id'] = $id;
        $_GET['Product']['product_status_id'] = 1;
        $model = new Product('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Product']))
            $model->attributes = $_GET['Product'];

        $this->render('index', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer the ID of the model to be loaded
     */
    public function loadModel($id) {
        $model = Product::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param CModel the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'product-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    public function actionDeleteimage($id) {//echo 'dd';die;
        if ($id != '') {
            $model = $this->loadModel($id);
            //echo Yii::app()->baseurl;die;
            @unlink(Yii::app()->baseurl . '/media/product/' . $model->main_image);
            $dele = Product::model()->updateByPk($id, array('main_image'=>''));
            echo "done";
        }
    }
 public function actiongetSubCats() {
        $model = new Product;
        $product_category_id = $_POST['product_category_id'];
        $criteria = new CDbCriteria;
        $criteria->condition = 'product_category_id=:ProductCatId';
        $criteria->params = array(':ProductCatId' => $product_category_id);
        //$criteria->order = 'id DESC';
        $sub = SubCategory::model()->findAll($criteria);
        //$data=CHtml::listData($sub,'id','title');
        echo $data = CHtml::dropDownList('ProductDetails[sub_category_id]', 'sub_category_id', CHtml::listData($sub, 'id', 'title'), array('class' => 'listtxt'));
    }
     public function actiongetHomesubcats() {
        $model = new Product;
        $product_category_id = $_POST['product_category_id'];
        $criteria = new CDbCriteria;
        $criteria->condition = 'product_category_id=:ProductCatId';
        $criteria->params = array(':ProductCatId' => $product_category_id);
        //$criteria->order = 'id DESC';
        $sub = SubCategory::model()->findAll($criteria);
        //$data=CHtml::listData($sub,'id','title');
        echo $data = CHtml::dropDownList('ProductDetails[sub_category_id]', 'sub_category_id', CHtml::listData($sub, 'id', 'title'), array('class' => 'form-control'));
    }
}
