<?php

/**
 * This is the model class for table "paymentfee".
 *
 * The followings are the available columns in table 'paymentfee':
 * @property integer $id
 * @property integer $user_id
 * @property integer $fee_package_id
 * @property string $token
 * @property string $price
 * @property string $date
 * @property integer $payment_status
 * @property string $buyer_id
 */
class Paymentfee extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'paymentfee';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_id, fee_package_id, token, price, date, buyer_id', 'required'),
			array('user_id, fee_package_id, payment_status', 'numerical', 'integerOnly'=>true),
			array('token, price, date, buyer_id', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, user_id, fee_package_id, token, price, date, payment_status, buyer_id', 'safe', 'on'=>'search'),
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
		    'packge' => array(self::BELONGS_TO, 'FeePackage', 'fee_package_id'),
            'user' => array(self::BELONGS_TO, 'User', 'user_id'),
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
			'fee_package_id' => 'Fee Package',
			'token' => 'Token',
			'price' => 'Price',
			'date' => 'Date',
			'payment_status' => 'Payment Status',
			'buyer_id' => 'Buyer',
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
		$criteria->compare('fee_package_id',$this->fee_package_id);
		$criteria->compare('token',$this->token,true);
		$criteria->compare('price',$this->price,true);
		$criteria->compare('date',$this->date,true);
		$criteria->compare('payment_status',$this->payment_status);
		$criteria->compare('buyer_id',$this->buyer_id,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Paymentfee the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
