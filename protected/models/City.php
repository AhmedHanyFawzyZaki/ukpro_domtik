<?php

/**
 * This is the model class for table "city".
 *
 * The followings are the available columns in table 'city':
 * @property integer $id
 * @property integer $country_id
 * @property string $title
 * @property integer $sort
 * @property string $temp1
 * @property string $temp2
 *
 * The followings are the available model relations:
 * @property Country $country
 * @property ProductDetails[] $productDetails
 * @property ProductDetails[] $productDetails1
 * @property ProductDetails[] $productDetails2
 */
class City extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'city';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('title,country_id', 'required'),
            array('country_id, sort', 'numerical', 'integerOnly' => true),
            array('title, temp1, temp2', 'length', 'max' => 255),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, country_id, title, sort, temp1, temp2', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'country' => array(self::BELONGS_TO, 'Country', 'country_id'),
            'productDetails' => array(self::HAS_MANY, 'ProductDetails', 'destination_city'),
            'productDetails1' => array(self::HAS_MANY, 'ProductDetails', 'city_id'),
            'productDetails2' => array(self::HAS_MANY, 'ProductDetails', 'source_city'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'country_id' => 'Country',
            'title' => 'Title',
            'sort' => 'Sort',
            'temp1' => 'Temp1',
            'temp2' => 'Temp2',
        );
    }

    public function defaultScope() {
        return array("order" => "title");
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
        $criteria->compare('country_id', $this->country_id);
        $criteria->compare('title', $this->title, true);
        $criteria->compare('sort', $this->sort);
        $criteria->compare('temp1', $this->temp1, true);
        $criteria->compare('temp2', $this->temp2, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return City the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function getCity() {
        return CHtml::listData(City::model()->findAll(array('order' => 'id DESC')), 'id', 'title');
    }

}
