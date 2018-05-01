<?php

/**
 * This is the model class for table "make".
 *
 * The followings are the available columns in table 'make':
 * @property integer $id
 * @property string $title
 * @property integer $sort
 * @property string $temp1
 * @property string $temp2
 *
 * The followings are the available model relations:
 * @property MotorModel[] $motorModels
 * @property ProductDetails[] $productDetails
 */
class Make extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'make';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('title', 'required'),
            array('sort', 'numerical', 'integerOnly' => true),
            array('title, temp1, temp2', 'length', 'max' => 255),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, title, sort, temp1, temp2', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'motorModels' => array(self::HAS_MANY, 'MotorModel', 'make_id'),
            'productDetails' => array(self::HAS_MANY, 'ProductDetails', 'make_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'title' => 'Title',
            'sort' => 'Sort',
            'temp1' => 'Temp1',
            'temp2' => 'Temp2',
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
        $criteria->compare('sort', $this->sort);
        $criteria->compare('temp1', $this->temp1, true);
        $criteria->compare('temp2', $this->temp2, true);

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
     * @return Make the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function getMake() {
        return CHtml::listData(Make::model()->findAll(array('order' => 'id DESC')), 'id', 'title');
    }

}
