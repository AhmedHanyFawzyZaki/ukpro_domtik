<?php

/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class FrontController extends CController {

    /**
     * @var string the default layout for the controller view. Defaults to '//layouts/column1',
     * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
     */
    public $layout = '//layouts/main';

    /**
     * @var array context menu items. This property will be assigned to {@link CMenu::items}.
     */
    public $menu = array();

    /**
     * @var array the breadcrumbs of the current page. The value of this property will
     * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
     * for more details on how to specify this property.
     */
    public $breadcrumbs = array();
    public $user = false;
    public $createShop = true;
    public $geoLocation;

    public function init() {

        $parameters = Settings::model()->findByPk(1);
        $comms = Commission::model()->findByPk(1);
        $this->pageTitle = $parameters['title'] . ' - ' . ucfirst($this->id);

        Yii::app()->params['icon'] = $parameters['fav_icon'];
        Yii::app()->params['google'] = $parameters['google'];
        Yii::app()->params['twitter'] = $parameters['twitter'];
        Yii::app()->params['youtube'] = $parameters['youtube'];
        Yii::app()->params['email'] = $parameters['email'];
        Yii::app()->params['adminEmail'] = $parameters['email'];
        Yii::app()->params['title'] = $parameters['title'];
        Yii::app()->params['facebook'] = $parameters['facebook'];
        Yii::app()->params['banner_header'] = $parameters['banner_header'];
        Yii::app()->params['banner_subheader'] = $parameters['banner_subheader'];
        Yii::app()->params['search_max_price'] = $parameters['search_max_price'];
        Yii::app()->params['search_min_price'] = $parameters['search_min_price'];

        Yii::app()->params['buyer_commision'] = $comms->buyer_comm;
        Yii::app()->params['seller_commision'] = $comms->seller_comm;
        Yii::app()->params['open_shop'] = $comms->open_store_comm;
        Yii::app()->params['edit_shop'] = $comms->edit_store_comm;
        Yii::app()->params['add_item'] = $comms->add_item_comm;
        Yii::app()->params['edit_item'] = $comms->renew_item_comm;
        Yii::app()->params['comm_currency'] = $comms->currency_id;
        

        Yii::app()->params['messages_limit'] = $parameters['messages_limit'];
        Yii::app()->params['inbox_limit'] = $parameters['inbox_limit'];


        //test test_environment
        if (Yii::app()->user->getState('group') == 6)
            Yii::app()->params['test_environment'] = $parameters['test_environment'];
        else
            Yii::app()->params['test_environment'] = NULL;


        Yii::app()->Paypal->apiUsername = $parameters['api_username'];
        Yii::app()->Paypal->apiPassword = $parameters['api_password'];
        Yii::app()->Paypal->apiSignature = $parameters['signature'];
        if ($parameters['paypal_live'] == 1)
            Yii::app()->Paypal->apiLive = true;
        else
            Yii::app()->Paypal->apiLive = false;

        
        
        
        // get languages
        $langs = Language::model()->findAll(array('condition' => 'active=1'));

        $langs_arr = array();
        foreach ($langs as $value) {
            $langs_arr[$value->code] = $value->native_title;
            if ($value->default_lang == 1)
                Yii::app()->params['default_language'] = $value->code;
        }
        Yii::app()->params['languages'] = $langs_arr;


        if ($_POST['setting_currency'] && $_POST['setting_currency'] != '') {
            Yii::app()->params['currency'] = $_POST['setting_currency'];
            Yii::app()->user->setState('currency', Yii::app()->params['currency']);
        } elseif (Yii::app()->user->hasState('currency')) {
            Yii::app()->params['currency'] = Yii::app()->user->getState('currency');
        } else {
            $commission = Commission::model()->findByPk(1);
            $currency = Currency::model()->findByPk($commission->currency_id);
            Yii::app()->params['currency'] = $currency->symbol;
        }



        if (!Yii::app()->user->isGuest)
            $this->user = User::model()->findByPk(Yii::app()->user->id);

        if (isset($_POST['lat'])) {

            Yii::app()->user->setState('userLocation', array('latitude' => $_POST['lat'], 'longitude' => $_POST['lng']));
        }

        if (Yii::app()->user->hasState('userLocation')) {
            $loc = Yii::app()->user->getState('userLocation');
            $this->geoLocation = new stdClass();
            $this->geoLocation->latitude = $loc['latitude'];
            $this->geoLocation->longitude = $loc['longitude'];
        } else {
            $this->geoLocation = new geoPlugin();
            $this->geoLocation->locate();
            //block country
        }


        parent::init();
    }

    public function beforeAction($action) {

        EMHelper::catchLanguage();

        $parameters = Settings::model()->findByPk(1);

        ///////////////////////////error//////////////////////////////////////
        Yii::app()->params['error_heading'] = $parameters['error_heading'];
        Yii::app()->params['error_subhead'] = $parameters['error_subhead'];
        Yii::app()->params['error_image'] = $parameters['error_image'];
        Yii::app()->params['error_home'] = $parameters['error_home'];
        Yii::app()->params['error_homeactive'] = $parameters['error_homeactive'];
        Yii::app()->params['error_prev'] = $parameters['error_prev'];
        Yii::app()->params['error_prevactive'] = $parameters['error_prevactive'];

        //////////////////////////////////error////////////////////////////////////

        Yii::app()->user->setFlash('loginError', false);
        Yii::app()->user->setFlash('registerError', false);

        //login register and newsletter submit
        if (Yii::app()->user->isGuest):
            $this->loginModel = new LoginForm;
            if ($_POST['LoginForm']) {

                $this->loginModel->attributes = $_POST['LoginForm'];
                if ($this->loginModel->validate() && $this->loginModel->login()) {
                    if (Yii::app()->user->group == 6) {
                        $this->redirect(array('dashboard/index'));
                    } else {
                        $this->refresh();
                    }
                } else {
                    Yii::app()->user->setFlash('loginError', true);
                }
            }

            
            ///
         
            $this->registerForm = new User('register');

            $this->forgot = new User;
  /* 
            if (isset($_POST['User'])) {
                $this->registerForm->attributes = $_POST['User'];

                $this->registerForm->username = $this->registerForm->email;

                $this->registerForm->activation_code = uniqid();

                if ($_POST['User']['groups_id'] == '') {
                    $this->registerForm->groups_id = '1';
                }

                if ($this->registerForm->save()) {
                    $user_details = new UserDetails();
                    $user_details->user_id = $this->registerForm->id;
                    $user_details->created = date('Y-m-d H:i:s');
                    $user_details->save(false);

                    //if newsletter
                    if ($_POST['newletter_check']) {
                        $model = new Newsletter;
                        $model->email = $this->registerForm->email;
                        $model->created = date('Y-m-d H:i:s');
                        $test = Newsletter::model()->findByAttributes(array('email' => $model->email));
                        if (!$test)
                            $model->save(false);
                    }

                    
                    
                    
                    
                    
                    $mail = new YiiMailer();
                    $mail->setFrom(Yii::app()->params['adminEmail'], Yii::app()->name . ' Admininstrator');
                    $mail->setTo($this->registerForm->email);
                    $mail->setSubject(' New customer profile notification');

                    $message = '
                    Thank you for joining Cookile! <br/>
Now you will be able to buy homemade food from home cooks and bakers

<br/>
Your username is: ' .$this->registerForm->email . '<br/>
Your password is: ' . $this->registerForm->simple_decrypt($this->registerForm->password) . '<br/>
In order to complete your account activation, please click on the following link.
<a href = "' . Yii::app()->getBaseUrl(true) . '/home/activate/?code=' . $this->registerForm->activation_code . '" >' . Yii::app()->getBaseUrl(true) . '/home/activate/?code=' . $this->registerForm->activation_code . '</a>

';
                    $mail->setBody($message);

                    if ($mail->send()) {
                        Yii::app()->user->setFlash('message', array('title' => 'Welcome aboard!', 'message' => "Now you're just a step away from joining the home-cooking largest community!<br/>An activation e-mail was sent to you, please click on the link to activate your account."));
                    } else {
                        Yii::app()->user->setFlash('message', 'Error while sending email: ' . $mail->getError());
                    }
                    $this->redirect(Yii::app()->user->returnUrl);
                } else {
                    Yii::app()->user->setFlash('registerError', true);
                }
            }
            
            */
            
            
        endif;

        if ($_POST['Newsletter']) {
            $model = new Newsletter;
            $model->attributes = $_POST['Newsletter'];
            $model->created = date('Y-m-d H:i:s');
            $test = Newsletter::model()->findByAttributes(array('email' => $model->email));
            if (!$test && $model->save(false))
                Yii::app()->user->setFlash('message', 'Congratulation You Will recieve our news on ' . $model->email . '.');
        }
        //end login, register newsletter submit
        //check the createshop button visibility
        if ($this->user && $this->user->store) {
            $this->createShop = false;
        } else {
            $this->createShop = true;
        }

        if ($this->getId() == 'shop') {
            $this->createShop = false;
        }

        return parent::beforeAction($action);
        
        
    }
    

    public $loginModel;
    public $registerForm;
    public $forgot;
    public $currency;

}