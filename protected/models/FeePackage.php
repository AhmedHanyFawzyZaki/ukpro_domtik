<?php

/**
 * This is the model class for table "fee_package".
 *
 * The followings are the available columns in table 'fee_package':
 * @property integer $id
 * @property string $title
 * @property string $monthly_fee
 * @property integer $sort
 * @property integer $ads_number
 * @property integer $period
 */
class FeePackage extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'fee_package';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('title, monthly_fee, ads_number', 'required'),
            array('sort,ads_number,period', 'numerical', 'integerOnly' => true),
            array('title,monthly_fee', 'length', 'max' => 255),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, title, monthly_fee, sort, ads_number, period', 'safe', 'on' => 'search'),
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
            'monthly_fee' => 'Monthly Fee',
            'ads_number' => 'Service Number',
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
        $criteria->compare('title', $this->title, true);
        $criteria->compare('monthly_fee', $this->monthly_fee, true);
        $criteria->compare('sort', $this->sort);
        $criteria->compare('ads_number', $this->ads_number);
        $criteria->compare('period', $this->period);

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
     * @return FeePackage the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function packageList() {
        //var_dump(CHtml::listData(FeePackage::model()->findAll(), 'id', 'title'));die;
        $arr = FeePackage::model()->findAll();
        if (!empty($arr)) {
            foreach ($arr as $ar) {
                $ret[$ar->id] = '<strong>' . $ar->title . '</strong> ' . $ar->ads_number . ' Services by ' . $ar->monthly_fee . ' GBP during ' . $ar->period . ' Days';
            }
            return $ret;
        }
    }

    public function getFeepackage() {
        return CHtml::listData(FeePackage::model()->findAll(array('order' => 'id DESC')), 'id', 'title');
    }

}
