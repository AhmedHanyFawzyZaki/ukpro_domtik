<?php

class UserController extends AdminController {

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
                //	'accessControl', // perform access control for CRUD operations
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
                'actions' => array('index', 'view', 'upload'),
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
        $model = new User;
        $user_details = new UserDetails();

        

        // Uncomment the following line if AJAX validation is needed
        $this->performAjaxValidation($model);
        if (isset($_POST['User'])) {
            $model = new User;


            $model->attributes = $_POST['User'];


            $user_details->attributes = $_POST['UserDetails'];
                                     $user_details->address=$_POST['location'];

            $rnd = rand(0, 9999);  // generate random number between 0-9999
            $uploadedFile = CUploadedFile::getInstance($model, 'image');

            if (!empty($uploadedFile)) {
                $fileName = "{$rnd}-{$uploadedFile}";  // random number + file name
                $model->image = $fileName;
                $uploadedFile->saveAs(Yii::app()->basePath . '/../media/members/' . $fileName);
            }
            $rnd1 = rand(0, 9999);  // generate random number between 0-9999
            $uploadedFile1 = CUploadedFile::getInstance($user_details, 'shop_image');

            if (!empty($uploadedFile1)) {
                $fileName1 = "{$rnd1}-{$uploadedFile1}";  // random number + file name
                $user_details->shop_image = $fileName1;
                $uploadedFile1->saveAs(Yii::app()->basePath . '/../media/members/' . $fileName1);
            }
            if ($model->save()) {
                $user_details->user_id = $model->id;
                $user_details->save(false);
                $this->redirect(array('view', 'id' => $model->id));
            } else {
                var_dump($model->getErrors());

                echo "Error Done";
                die();
            }
        }

        $this->render('create', array(
            'model' => $model, 'user_details' => $user_details
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
        $criteria->condition = 'user_id=:userID';
        $criteria->params = array(':userID' => $model->id);
        $user_details = UserDetails::model()->find($criteria); // $params is not needed
        // Uncomment the following line if AJAX validation is needed
        $this->performAjaxValidation($model);

        if (isset($_POST['User'])) {
if ($user_details->shop_image != '') {
                $_POST['UserDetails']['shop_image'] = $user_details->shop_image;
            }

           
            if ($model->image != '') {
                $_POST['User']['image'] = $model->image;
            }

            $model->attributes = $_POST['User'];
            $user_details->attributes = $_POST['UserDetails'];
            
             $user_details->address=$_POST['location'];
            $savedpass = $validatepass = 0;
           //  echo $_POST['User']['oldpassword'];die;
            
            if ($_POST['User']['oldpassword'] != '') {
                
                
                
                
                

                $savedpass = $model->password;
                $validatepass = $model->hash($_POST['User']['oldpassword']);
                if ($savedpass == $validatepass) {
                    $model->password = User::simple_encrypt($_POST['User']['newpassword']);
                } else {
                    Yii::app()->user->setFlash('Passchange', 'Sorry the new entered password does not match the old one');
                }
            }

            $rnd = rand(0, 9999);  // generate random number between 0-9999
            $uploadedFile = CUploadedFile::getInstance($model, 'image');

            if (!empty($uploadedFile)) {
                $fileName = "{$rnd}-{$uploadedFile}";  // random number + file name
                $model->image = $fileName;
                $uploadedFile->saveAs(Yii::app()->basePath . '/../media/members/' . $fileName);
            }
             $rnd1 = rand(0, 9999);  // generate random number between 0-9999
            $uploadedFile1 = CUploadedFile::getInstance($user_details, 'shop_image');

            if (!empty($uploadedFile1)) {
                $fileName1 = "{$rnd1}-{$uploadedFile1}";  // random number + file name
                $user_details->shop_image = $fileName1;
                $uploadedFile1->saveAs(Yii::app()->basePath . '/../media/members/' . $fileName1);
            }
            if ($model->save()) {
                $user_details->user_id = $model->id;
                $user_details->save(false);
                if ($savedpass == $validatepass) {
                    $this->redirect(array('view', 'id' => $model->id));
                }
            }
        }

        $this->render('update', array(
            'model' => $model, 'user_details' => $user_details
        ));
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id) {
        if (Yii::app()->request->isPostRequest) {

            if ($id == 1) {
                throw new CHttpException(400, 'Sorry you can not delete the super admin user.');
            }
            $criteria = new CDbCriteria;
            $criteria->condition = 'user_id=:userID';
            $criteria->params = array(':userID' => $id);
            UserDetails::model()->deleteAll($criteria);
            // we only allow deletion via POST request
            $this->loadModel($id)->delete();

            // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
            if (!isset($_GET['ajax']))
                $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index'));
        } else
            throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
    }

    /**
     * Lists all models.
     */
    public function actionIndex() {

        $model = new User('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['User']))
            $model->attributes = $_GET['User'];

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
        $model = User::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param CModel the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'user-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    public function actionUpload() {
        $output_dir = Yii::app()->basePath . '/../media/members/'; // folder for uploaded files
        if (isset($_FILES["image"])) {
            $ret = array();
            $error = $_FILES["image"]["error"];
            if (!is_array($_FILES["image"]["name"])) { //single file
                $fileName = $_FILES["image"]["name"];
                move_uploaded_file($_FILES["image"]["tmp_name"], $output_dir . $_FILES["image"]["name"]);
                $ret[$fileName] = $output_dir . $fileName;
            }
            echo json_encode($ret);
            //echo $fileName;
        }
    }

    public function actionDeleteimage($id) {
        if ($id != '') {
            $model = $this->loadModel($id);
            @unlink(Yii::app()->basePath . '/../media/members/' . $model->image);
            $dele = User::model()->updateByPk($id, array('image' => ''));
            echo "done";
        }
    }
      
 public function actionDeleteimage1($id) {
        if ($id != '') {
            
            
        $criteria = new CDbCriteria;
        $criteria->condition = 'user_id=' . $id;
        $user_details = UserDetails::model()->findAll($criteria);


            @unlink(Yii::app()->basePath . '/../media/members/' . $user_details->shop_image);
            $dele = UserDetails::model()->updateByPk($id, array('shop_image' => ''));
            echo "done";
        }
    }
      
  public function actiongetCity() {
        $model = new User;
        $country_id = $_POST['country_id'];
        $criteria = new CDbCriteria;
        $criteria->condition = 'country_id=:CountryID';
        $criteria->params = array(':CountryID' => $country_id);
        //$criteria->order = 'id DESC';
        $city = City::model()->findAll($criteria);
        //$data=CHtml::listData($sub,'id','title');
        echo $data = CHtml::dropDownList('UserDetails[city_id]', 'city_id', CHtml::listData($city, 'id', 'title'), array('class' => 'listtxt'));
    }
    
    
    
    

}
