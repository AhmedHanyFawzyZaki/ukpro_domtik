<?php

/**
 * This is the model class for table "orders".
 *
 * The followings are the available columns in table 'orders':
 * @property integer $id
 * @property integer $user_id
 * @property string $total_price
 * @property string $price
 * @property string $total_shipping
 * @property string $payer_id
 * @property string $token
 * @property integer $shipping_country
 * @property integer $shipping_city
 * @property string $shipping_post_code
 * @property string $shipping_address
 * @property integer $billing_country
 * @property integer $billing_city
 * @property string $billing_post_code
 * @property string $billing_address
 * @property integer $status
 * @property string $date
 * @property integer $sort
 */
class Orders extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'orders';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_id, shipping_country, shipping_city, billing_country, billing_city, status, sort', 'numerical', 'integerOnly'=>true),
			array('total_price, price', 'length', 'max'=>10),
			array('total_shipping, payer_id, token, date', 'length', 'max'=>255),
			array('shipping_post_code, billing_post_code', 'length', 'max'=>50),
			array('shipping_address, billing_address', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, user_id, total_price, price, total_shipping, payer_id, token, shipping_country, shipping_city, shipping_post_code, shipping_address, billing_country, billing_city, billing_post_code, billing_address, status, date, sort', 'safe', 'on'=>'search'),
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
                    
                    'userorders' => array(self::BELONGS_TO, 'User', 'user_id'),
                    'billingcountry' => array(self::BELONGS_TO, 'Country', 'billing_country'),
                    'billingcity' => array(self::BELONGS_TO, 'City', 'billing_city'),
                    'shippingcountry' => array(self::BELONGS_TO, 'Country', 'shipping_country'),
                    'shippingcity' => array(self::BELONGS_TO, 'City', 'shipping_city'),
                     'orderstatus' => array(self::BELONGS_TO, 'OrderStatus', 'status'),
                 
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
			'total_price' => 'Total Price',
			'price' => 'Price',
			'total_shipping' => 'Total Shipping',
			'payer_id' => 'Payer',
			'token' => 'Token',
			'shipping_country' => 'Shipping Country',
			'shipping_city' => 'Shipping City',
			'shipping_post_code' => 'Shipping Post Code',
			'shipping_address' => 'Shipping Address',
			'billing_country' => 'Billing Country',
			'billing_city' => 'Billing City',
			'billing_post_code' => 'Billing Post Code',
			'billing_address' => 'Billing Address',
			'status' => 'Status',
			'date' => 'Date',
			'sort' => 'Sort',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('total_price',$this->total_price,true);
		$criteria->compare('price',$this->price,true);
		$criteria->compare('total_shipping',$this->total_shipping,true);
		$criteria->compare('payer_id',$this->payer_id,true);
		$criteria->compare('token',$this->token,true);
		$criteria->compare('shipping_country',$this->shipping_country);
		$criteria->compare('shipping_city',$this->shipping_city);
		$criteria->compare('shipping_post_code',$this->shipping_post_code,true);
		$criteria->compare('shipping_address',$this->shipping_address,true);
		$criteria->compare('billing_country',$this->billing_country);
		$criteria->compare('billing_city',$this->billing_city);
		$criteria->compare('billing_post_code',$this->billing_post_code,true);
		$criteria->compare('billing_address',$this->billing_address,true);
		$criteria->compare('status',$this->status);
		$criteria->compare('date',$this->date,true);
		$criteria->compare('sort',$this->sort);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Orders the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
        
public function getOrder()
	{
		return CHtml::listData(Orders::model()->findAll(array('order'=>'id DESC')),'id','username');
	}

}
