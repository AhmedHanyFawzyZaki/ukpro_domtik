<?php

/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class AdminController extends Controller {

    /**
     * @var string the default layout for the controller view. Defaults to '//layouts/column1',
     * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
     */
    public $layout = '//layouts/column2';
    public $pageTitlecrumbs;

    public function init() {
        // set the default theme for any other controller that inherit the admin controller
        Yii::app()->theme = 'bootstrap';

        $parameters = Settings::model()->findByPk(1);

        Yii::app()->params['google'] = $parameters['google'];
        Yii::app()->params['twitter'] = $parameters['twitter'];
        Yii::app()->params['pinterest'] = $parameters['pinterest'];
        Yii::app()->params['support_email'] = $parameters['support_email'];
        Yii::app()->params['email'] = $parameters['email'];
        Yii::app()->params['adminEmail'] = $parameters['email'];
        Yii::app()->params['facebook'] = $parameters['facebook'];
        Yii::app()->params['paypal_email'] = $parameters['paypal_email'];
        Yii::app()->params['phone'] = $parameters['phone'];
        Yii::app()->params['mobile'] = $parameters['mobile'];
        Yii::app()->params['fax'] = $parameters['fax'];
        Yii::app()->params['address'] = $parameters['address'];


        /*/*Yii::app()->Paypal->apiUsername = $parameters['api_username'];
        //Yii::app()->Paypal->apiPassword = $parameters['api_password'];
        //Yii::app()->Paypal->apiSignature = $parameters['signature'];
        if ($parameters['paypal_live'] == 1)
            Yii::app()->Paypal->apiLive = true;
        else
            Yii::app()->Paypal->apiLive = false;*/
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

        //if the user is not admin redirect to the home page of the normal user
        if (Yii::app()->user->isGuest) {
          //  $this->redirect(Yii::app()->baseurl . '/dashboard');
        }
        return parent::beforeAction($action);
    }

}
