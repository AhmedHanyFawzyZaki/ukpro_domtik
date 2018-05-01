<?php

/**
 * This is the model class for table "order".
 *
 * The followings are the available columns in table 'order':
 * @property integer $id
 * @property string $creation_date
 * @property string $total_price
 * @property string $net_price
 * @property string $shipping_price
 * @property string $token
 * @property integer $status_id
 * @property integer $buyer_id
 * @property string $total_commission
 * @property integer $shipping_country
 * @property integer $shipping_city
 * @property string  $shipping_post_code
 * @property string $shipping_address
 * @property integer $billing_country
 * @property integer $billing_city
 * @property string $billing_post_code
 * @property string $billing_address
 * @property integer $sort
 */
class Order extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'order';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('buyer_id, shipping_country, shipping_city, billing_country, billing_city, shipping_address, billing_address', 'required'),
            array('status_id, buyer_id, shipping_country, shipping_city, billing_country, billing_city, sort', 'numerical', 'integerOnly' => true),
            array('total_price, net_price, shipping_price, total_commission', 'length', 'max' => 10),
            array('token', 'length', 'max' => 255),
            array('creation_date, shipping_address, billing_address', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, creation_date, total_price, net_price, shipping_price, token, status_id, buyer_id, total_commission, shipping_address, billing_address, shipping_country, shipping_city, billing_country, billing_city', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'userorders' => array(self::BELONGS_TO, 'User', 'buyer_id'),
            'billingcountry' => array(self::BELONGS_TO, 'Country', 'billing_country'),
            'billingcity' => array(self::BELONGS_TO, 'City', 'billing_city'),
            'shippingcountry' => array(self::BELONGS_TO, 'Country', 'shipping_country'),
            'shippingcity' => array(self::BELONGS_TO, 'City', 'shipping_city'),
            'orderstatus' => array(self::BELONGS_TO, 'OrderStatus', 'status_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'creation_date' => 'Creation Date',
            'total_price' => 'Total Price',
            'net_price' => 'Net Price',
            'shipping_price' => 'Shipping Price',
            'token' => 'Token',
            'status_id' => 'Status',
            'buyer_id' => 'Buyer',
            'total_commission' => 'Total Commission',
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
    public function search() {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id);
        $criteria->compare('creation_date', $this->creation_date, true);
        $criteria->compare('total_price', $this->total_price, true);
        $criteria->compare('net_price', $this->net_price, true);
        $criteria->compare('shipping_price', $this->shipping_price, true);
        $criteria->compare('token', $this->token, true);
        $criteria->compare('status_id', $this->status_id);
        $criteria->compare('buyer_id', $this->buyer_id);
        $criteria->compare('total_commission', $this->total_commission, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Order the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function allOrders($userid, $start, $end, $all) {
        $criteria = new CDbCriteria();
        $criteria->condition = " buyer_id=:user_id ";
        $criteria->params = array(':user_id' => $userid);
        if ($all != 1) {
            $criteria->offset = $start;
            $criteria->limit = $end;
        }
        //print_r($criteria);
        return Order::model()->findAll($criteria);
    }
}