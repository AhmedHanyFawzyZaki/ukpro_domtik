<?php

/**
 * This is the model class for table "currency".
 *
 * The followings are the available columns in table 'currency':
 * @property integer $id
 * @property string $title
 * @property double $rate
 * @property string $iso_code
 */
class Currency extends CActiveRecord {

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Currency the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'currency';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('rate, default', 'numerical'),
            array('title', 'length', 'max' => 300),
            array('iso_code , symbol', 'length', 'max' => 200),
            array('title, iso_code', 'required'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, title, rate, iso_code', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'title' => 'Title',
            'rate' => 'Rate Relative To SGD',
            'iso_code' => 'Iso Code',
            'default' => 'Default Currency'
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function search() {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id);
        $criteria->compare('title', $this->title, true);
        $criteria->compare('rate', $this->rate);
        $criteria->compare('iso_code', $this->iso_code, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

}
