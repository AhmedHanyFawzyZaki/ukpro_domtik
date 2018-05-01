<?php

/**
 * This is the model class for table "order_details".
 *
 * The followings are the available columns in table 'order_details':
 * @property integer $id
 * @property integer $order_id
 * @property integer $user_id
 * @property integer $product_id
 * @property integer $quantity
 * @property string $total_price
 * @property string $price
 * @property string $shipping_amount
 * @property string $date
 * @property integer $sort
 */
class OrderDetails extends CActiveRecord
{
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
			array('order_id, user_id, product_id, quantity, sort', 'numerical', 'integerOnly'=>true),
			array('total_price, price, shipping_amount', 'length', 'max'=>10),
			array('date', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, order_id, user_id, product_id, quantity, total_price, price, shipping_amount, date, sort', 'safe', 'on'=>'search'),
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
                    
                    'order' => array(self::BELONGS_TO, 'Orders', 'order_id'),
		    'orderuser' => array(self::BELONGS_TO, 'User', 'user_id'),
                    'orderproduct' => array(self::BELONGS_TO, 'Product', 'product_id'),

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
			//'user_id' => 'User',
			'product_id' => 'Product',
			'quantity' => 'Quantity',
			'total_price' => 'Total Price',
			'price' => 'Price',
			'shipping_amount' => 'Shipping Amount',
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
		$criteria->compare('order_id',$this->order_id);
		//$criteria->compare('user_id',$this->user_id);
		$criteria->compare('product_id',$this->product_id);
		$criteria->compare('quantity',$this->quantity);
		$criteria->compare('total_price',$this->total_price,true);
		$criteria->compare('price',$this->price,true);
		$criteria->compare('shipping_amount',$this->shipping_amount,true);
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
	 * @return OrderDetails the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
