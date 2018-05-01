<?php

/**
 * This is the model class for table "user_details".
 *
 * The followings are the available columns in table 'user_details':
 * @property integer $id
 * @property integer $user_id
 * @property integar $fee_package_id
 * @property integar $country_id
 * @property integar $city_id
 * @property string $address
 * @property string $zipcode
 * @property string $lng
 * @property string $lat
 * @property string $shop_name
 * @property string $shop_address
 * @property string $shop_description
 * @property string $shop_image
 * @property string $created
 * @property string $last_login
 * @property string $phone_no
 * @property string $default_shipping_value
 * @property integar $ads_number
 * @property string $facebook
 * @property string $twitter
 * @property string $linkedin
 * @property string $instagram
 * @property string $google
 * @property string $website
 * @property string $paypal_account
 *
 * The followings are the available model relations:
 * @property User[] $users
 */
class UserDetails extends CActiveRecord
{
        public $shop_image;
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return UserDetails the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'user_details';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_id, country_id,city_id,fee_package_id, ads_number, phone_type', 'numerical', 'integerOnly'=>true),
                        array('paypal_account', 'email'),
                         array('website,facebook,linkedin,twitter,google', 'url'),                   
			array('phone_no', 'length', 'max'=>90),
			array('address, paypal_account, lng, lat, shop_name,shop_description, phone_no, default_shipping_value, shop_address,facebook,google,twitter,website,linkedin,instagram,country_id,shop_image', 'length', 'max'=>255),
			array('zipcode', 'length', 'max'=>50),
			array('created, last_login ,v_company,trainer_status,facebook,google,twitter,website,linkedin,shop_image', 'safe'),

			array('zipcode,address','required'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, user_id, company_id, state, city_id, address, paypal_account, zipcode, lng, lat, zoom, created, last_login, available_range, phone_no, fax_no, hear_from, remote_trainig, accept_leads, country_id, city, phone_type', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'users' => array(self::HAS_MANY, 'User', 'user_details_id'),
			'countryname' => array(self::BELONGS_TO, 'Country', 'country_id'),
			'fee_package_id' => array(self::BELONGS_TO, 'FeePackage', 'fee_package_id'),
			'city' => array(self::BELONGS_TO, 'City', 'city_id'),

		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'user_id' => 'User',
			'company_id' => 'Company',
			'state' => 'State',
			'city_id' => 'City ',
			'address' => 'Address',
			'paypal_account' => ' Paypal Account',
			'zipcode' => 'Post Code',
			'lng' => 'Long',
			'lat' => 'Lat',
			'zoom' => 'Zoom',
			'created' => 'Created',
			'last_login' => 'Last Login',
			'available_range' => 'Available Range',
			'phone_no' => 'Phone No',
			'fax_no' => 'Fax No',
			'hear_from' => 'Hear From',
			'remote_trainig' => 'Working Radius',
			'accept_leads' => 'Accept Leads',
			'country_id' => 'Country',
			'city' => 'City',
			'phone_type' => 'Phone Type',
			'v_company' => ' Company Name ',
			'trainer_status'=>'Reason',
                        'ads_number'=>'ads_number',
                        'default_shipping_value'=>' Default Shipping Value',
                        'fee_package_id'=>'Fee Package',
                        'facebook'=>'Facebook',
                        'google'=>'Google',
                        'instagram'=>'Instgram',
                        'linkedin'=>'Linked In',
                        'shop_address'=>'Shop Adress ',
                        'shop_description'=>'Shop Description',

                        'shop_image'=>'Shop Image',
                        'shop_name'=>'Shop Name',
                        'website'=>' Web site',

                    
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('company_id',$this->company_id);
		$criteria->compare('state',$this->state,true);
		$criteria->compare('city_id',$this->city_id,true);
		$criteria->compare('address',$this->address,true);
		$criteria->compare('paypal_account',$this->paypal_account,true);
		$criteria->compare('zipcode',$this->zipcode,true);
		$criteria->compare('lng',$this->lng,true);
		$criteria->compare('lat',$this->lat,true);
		$criteria->compare('zoom',$this->zoom);
		$criteria->compare('created',$this->created,true);
		$criteria->compare('last_login',$this->last_login,true);
		$criteria->compare('available_range',$this->available_range,true);
		$criteria->compare('phone_no',$this->phone_no,true);
		$criteria->compare('fax_no',$this->fax_no,true);
		$criteria->compare('hear_from',$this->hear_from,true);
		$criteria->compare('remote_trainig',$this->remote_trainig);
		$criteria->compare('accept_leads',$this->accept_leads);
		$criteria->compare('country_id',$this->country_id,true);
		$criteria->compare('city',$this->city,true);
		$criteria->compare('phone_type',$this->phone_type);
		$criteria->compare('default_shipping_value',$this->default_shipping_value);
		$criteria->compare('facebook',$this->facebook);
		$criteria->compare('ads_number',$this->ads_number);
		$criteria->compare('fee_package_id',$this->fee_package_id);
 		$criteria->compare('google',$this->google);
  		$criteria->compare('instagram',$this->instagram);
               
               
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}
