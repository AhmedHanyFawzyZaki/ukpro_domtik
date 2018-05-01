<?php

/**
 * This is the model class for table "order_details".
 *
 * The followings are the available columns in table 'order_details':
 * @property integer $id
 * @property integer $order_id
 * @property integer $product_id
 * @property string $shipping_address
 * @property string $shipping_city
 * @property string $shipping_country
 * @property string $shipping_postcode
 * @property string $shipping_price
 * @property string $total_price
 * @property string $net_price
 * @property integer $quantity
 * @property string $color
 * @property string $size
 * @property string $commission_price
 * @property integer $sort
 */
class OrderDetails extends CActiveRecord
{
    public  $total;
    /**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'order_details';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('order_id, product_id, quantity, seller_id, sort', 'numerical', 'integerOnly'=>true),
			array('shipping_address, shipping_city, shipping_country, shipping_postcode, color, size', 'length', 'max'=>255),
			array('shipping_price, total_price, net_price, commission_price', 'length', 'max'=>10),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, order_id, product_id, shipping_address, shipping_city, shipping_country, shipping_postcode, shipping_price, total_price, net_price, quantity, color, size, commission_price, sort', 'safe', 'on'=>'search'),
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
                    'product' => array(self::BELONGS_TO, 'Product', 'product_id'),
                    'seller' => array(self::BELONGS_TO, 'User', 'seller_id'),
                     'order' => array(self::BELONGS_TO, 'Order', 'order_id'),

		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'order_id' => 'Order',
			'product_id' => 'Product',
                        'seller_id' => 'Seller',
			'shipping_address' => 'Shipping Address',
			'shipping_city' => 'Shipping City',
			'shipping_country' => 'Shipping Country',
			'shipping_postcode' => 'Shipping Postcode',
			'shipping_price' => 'Shipping Price',
			'total_price' => 'Total Price',
			'net_price' => 'Net Price',
			'quantity' => 'Quantity',
			'color' => 'Color',
			'size' => 'Size',
			'commission_price' => 'Commission Price',
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
		$criteria->compare('order_id',$this->order_id);
		$criteria->compare('product_id',$this->product_id);
		$criteria->compare('shipping_address',$this->shipping_address,true);
		$criteria->compare('shipping_city',$this->shipping_city,true);
		$criteria->compare('shipping_country',$this->shipping_country,true);
		$criteria->compare('shipping_postcode',$this->shipping_postcode,true);
		$criteria->compare('shipping_price',$this->shipping_price,true);
		$criteria->compare('total_price',$this->total_price,true);
		$criteria->compare('net_price',$this->net_price,true);
		$criteria->compare('quantity',$this->quantity);
		$criteria->compare('color',$this->color,true);
		$criteria->compare('size',$this->size,true);
		$criteria->compare('commission_price',$this->commission_price,true);
		$criteria->compare('sort',$this->sort);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return OrderDetails the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
