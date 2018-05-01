<?php

/**
 * This is the model class for table "country".
 *
 * The followings are the available columns in table 'country':
 * @property integer $id
 * @property string $country_code
 * @property string $title
 * @property integer $cost_country
 * @property integer $sort
 *
 * The followings are the available model relations:
 * @property City[] $cities
 * @property ProductDetails[] $productDetails
 * @property ProductDetails[] $productDetails1
 * @property ProductDetails[] $productDetails2
 */
class Country extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'country';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('country_code, title', 'required'),
            array('cost_country, sort', 'numerical', 'integerOnly' => true),
            array('country_code', 'length', 'max' => 2),
            array('title', 'length', 'max' => 100),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, country_code, title, cost_country, sort', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'cities' => array(self::HAS_MANY, 'City', 'country_id'),
            'productDetails' => array(self::HAS_MANY, 'ProductDetails', 'county_id'),
            'productDetails1' => array(self::HAS_MANY, 'ProductDetails', 'destination_country'),
            'productDetails2' => array(self::HAS_MANY, 'ProductDetails', 'source_country'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'country_code' => 'Country Code',
            'title' => 'Title',
            'cost_country' => 'Cost Country',
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
    public function search() {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id);
        $criteria->compare('country_code', $this->country_code, true);
        $criteria->compare('title', $this->title, true);
        $criteria->compare('cost_country', $this->cost_country);
        $criteria->compare('sort', $this->sort);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    public function defaultScope() {
        return array("order" => "title");
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Country the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function getCountry() {
        return CHtml::listData(Country::model()->findAll(array('order' => 'id DESC')), 'id', 'title');
    }

}
