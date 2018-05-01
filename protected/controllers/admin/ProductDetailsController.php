<?php

class ProductDetailsController extends AdminController
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			/*'accessControl', // perform access control for CRUD operations*/
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
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'users'=>array('admin'),
			),
			array('allow', 'actions' => array('order'), 'users' => array('@')),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new ProductDetails;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['ProductDetails']))
		{
			$model->attributes=$_POST['ProductDetails'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['ProductDetails']))
		{
			$model->attributes=$_POST['ProductDetails'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		if(Yii::app()->request->isPostRequest)
		{
			// we only allow deletion via POST request
			$this->loadModel($id)->delete();

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax']))
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index'));
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$model=new ProductDetails('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['ProductDetails']))
			$model->attributes=$_GET['ProductDetails'];

		$this->render('index',array(
			'model'=>$model,
		));

	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=ProductDetails::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='product-details-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
        
        public function actiongetMotorModels() {
        $model = new Product;
        $make_id = $_POST['make_id'];
        $criteria = new CDbCriteria;
        $criteria->condition = 'make_id=:MakeID';
        $criteria->params = array(':MakeID' => $make_id);
        //$criteria->order = 'id DESC';
        $mak = MotorModel::model()->findAll($criteria);
        
        //$data=CHtml::listData($sub,'id','title');
        echo $data = CHtml::dropDownList('ProductDetails[motor_model_id]', 'motor_model_id', CHtml::listData($mak, 'id', 'title'), array('class' => 'form-control'));
    }
    
    public function actiongetSourcecity() {
        $model = new Product;
        $source_country = $_POST['source_country'];
        $criteria = new CDbCriteria;
        $criteria->condition = 'country_id=:SourceCountry';
        $criteria->params = array(':SourceCountry' => $source_country);
        //$criteria->order = 'id DESC';
        $city = City::model()->findAll($criteria);
        //$data=CHtml::listData($sub,'id','title');
        echo $data = CHtml::dropDownList('ProductDetails[source_city]', 'source_city', CHtml::listData($city, 'id', 'title'), array('class' => 'listtxt'));
    }
    public function actiongetDestinationcity() {
        $model = new Product;
        $destination_country = $_POST['destination_country'];
        $criteria = new CDbCriteria;
        $criteria->condition = 'country_id=:DestinationCountry';
        $criteria->params = array(':DestinationCountry' => $destination_country);
        //$criteria->order = 'id DESC';
        $city = City::model()->findAll($criteria);
        //$data=CHtml::listData($sub,'id','title');
        echo $data = CHtml::dropDownList('ProductDetails[destination_city]', 'destination_city', CHtml::listData($city, 'id', 'title'), array('class' => 'listtxt'));
    }
     public function actiongetrealcity() {
        $model = new Product;
        $country_id = $_POST['country_id'];
        $criteria = new CDbCriteria;
        $criteria->condition = 'country_id=:CountryId';
        $criteria->params = array(':CountryId' => $country_id);
        //$criteria->order = 'id DESC';
        $city = City::model()->findAll($criteria);
        //$data=CHtml::listData($sub,'id','title');
        echo $data = CHtml::dropDownList('ProductDetails[city_id]', 'city_id', CHtml::listData($city, 'id', 'title'), array('class' => 'listtxt'));
    }
     public function actiongetlifecity() {
        $model = new Product;
        $country_id = $_POST['country_id'];
        $criteria = new CDbCriteria;
        $criteria->condition = 'country_id=:CountryId';
        $criteria->params = array(':CountryId' => $country_id);
        //$criteria->order = 'id DESC';
        $city = City::model()->findAll($criteria);
        //$data=CHtml::listData($sub,'id','title');
        echo $data = CHtml::dropDownList('ProductDetails[city_id]', 'city_id', CHtml::listData($city, 'id', 'title'), array('class' => 'form-control'));
    }
    
}
