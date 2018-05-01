<?php

/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class FrontController extends Controller {

    public function setaboutpage() {
        $aboutpage = Pages::model()->findByPk(9);
        return $aboutpage;
    }

    public function setprivacypage() {
        $privacypage = Pages::model()->findByPk(10);
        return $privacypage;
    }

    public function getPages() {
        $pages = Pages::model()->findAll();
        return $pages;
    }

    public function getcatPages() {
        $pagecat = PageCat::model()->findAll();
        return $pagecat;
    }

    public function getCarts() {
        $cart = Yii::app()->shoppingCart->getPositions();
        return $cart;
    }

    /**
     * @var string the default layout for the controller view. Defaults to '//layouts/column1',
     * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
     */
    public $layout = '//layouts/main';

    public function init() {

        $this->user_login = new LoginForm();

        $this->user_signUp = new User();
        $this->forget_password = new User('forgetpassword');
        $parameters = Settings::model()->findByPk(1);

        Yii::app()->params['google'] = $parameters['google'];
        Yii::app()->params['twitter'] = $parameters['twitter'];
        Yii::app()->params['pinterest'] = $parameters['pinterest'];
        Yii::app()->params['press_email'] = $parameters['press_email'];
        Yii::app()->params['email'] = $parameters['email'];
        Yii::app()->params['adminEmail'] = $parameters['email'];
        Yii::app()->params['facebook'] = $parameters['facebook'];
        Yii::app()->params['paypal_email'] = $parameters['paypal_email'];
        Yii::app()->params['phone'] = $parameters['phone'];
        Yii::app()->params['mobile'] = $parameters['mobile'];
        Yii::app()->params['exclusive_app'] = $parameters['exclusive_app'];
        Yii::app()->params['instgram_app'] = $parameters['instgram_app'];
Yii::app()->params['api_key'] = $parameters['api_key'];
        Yii::app()->params['ts_code'] = $parameters['ts_code'];

        //PaypalExpress
        /* Yii::app()->PaypalExpress->apiUsername = $parameters['api_username'];
          Yii::app()->PaypalExpress->apiPassword = $parameters['api_password'];
          Yii::app()->PaypalExpress->apiSignature = $parameters['signature'];
          // PaypalAdaptive
          Yii::app()->Paypal->email = $parameters['paypal_email'];
          Yii::app()->Paypal->username = $parameters['api_username'];
          Yii::app()->Paypal->password = $parameters['api_password'];
          Yii::app()->Paypal->signature = $parameters['signature'];
          Yii::app()->Paypal->appid = $parameters['appid'];
         
//        if ($parameters['paypal_live'] == 1){
//            Yii::app()->PaypalExpress->apiLive = true;
//            Yii::app()->Paypal->sandbox = false;
//        }
//        else{
//            Yii::app()->PaypalExpress->apiLive = false;
//            Yii::app()->Paypal->sandbox = true;
//        }
        //load js files
        if (!Yii::app()->request->isAjaxRequest)
            $this->registerMainScripts();
    }

    protected function registerMainScripts() {
        /**
         * libs
         */
        //Yii::app()->clientScript->registerCoreScript('jquery'); //jQuery
        //Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . '/js/jquery.js', CClientScript::POS_HEAD); //jQuery
        //Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . '/js/bootstrap.js', CClientScript::POS_HEAD); //Bootstrab
        /**
         * ui files
         */
        //Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . '/js/general/jquery.js', CClientScript::POS_END);
        //Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . '/js/general/bootstrap.js', CClientScript::POS_END);
        //Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . '/js/general/waypoints.min.js', CClientScript::POS_END);
    }

    protected function beforeAction($action) {

        ///////////////////////////error//////////////////////////////////////
        $parameters = Errormessage::model()->findByPk(1);
        Yii::app()->params['error_heading'] = $parameters['error_heading'];
        Yii::app()->params['error_subhead'] = $parameters['error_subhead'];
        Yii::app()->params['error_image'] = $parameters['error_image'];
        Yii::app()->params['error_home'] = $parameters['error_home'];
        Yii::app()->params['error_homeactive'] = $parameters['error_homeactive'];
        Yii::app()->params['error_prev'] = $parameters['error_prev'];
        Yii::app()->params['error_prevactive'] = $parameters['error_prevactive'];
        //////////////////////////////////error////////////////////////////////////
        return parent::beforeAction($action);
    }

    public $user_login;
    public $user_signUp;
    public $forget_password;

}
