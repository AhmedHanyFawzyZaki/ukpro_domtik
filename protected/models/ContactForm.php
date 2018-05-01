<?php

/**
 * ContactForm class.
 * ContactForm is the data structure for keeping
 * contact form data. It is used by the 'contact' action of 'SiteController'.
 */
class ContactForm extends CFormModel {

    public $name;
    public $email;
    public $comment;
    public $verifyCode;
    public $phone;
    public $mobile;
    public $address;

    /**
     * Declares the validation rules.
     */
    public function rules() {
        return array(
            // name, email, subject and body are required
          //  array('name,email,comment', 'required', 'on' => 'contact'),
           // array('phone , mobile', 'numerical'),
            array('name ,email', 'required'),
            array('email', 'email'),
            array('comment ', 'required'),
          //  array('phone', 'numerical'),
          ///  array('mobile', 'numerical'),
           //  array('verifyCode', 'captcha'),
            array('name, email', 'required', 'on' => 'index'),
            
            // verifyCode needs to be entered correctly
         ///   array('verifyCode', 'captcha', 'allowEmpty' => !CCaptcha::checkRequirements(), 'on' => 'contact'),
        );
    }

    /**
     * Declares customized attribute labels.
     * If not declared here, an attribute would have a label that is
     * the same as its name with the first letter in upper case.
     */
    public function attributeLabels() {
        return array(
            'verifyCode' => 'Verification Code',
            'name' => 'Full Name',
            'email' => 'E-mail',
            'comment' => 'Message',
        );
    }

}
