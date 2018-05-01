<?php

/**
 * This is the model class for table "colors".
 *
 * The followings are the available columns in table 'colors':
 * @property integer $id
 * @property string $title
 * @property string $color
 * @property integer $sort
 * @property string $temp1
 */
class Colors extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'colors';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('title, color', 'required'),
            array('sort', 'numerical', 'integerOnly' => true),
            array('title, color, temp1', 'length', 'max' => 255),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, title, color, sort, temp1', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'colors' => array(self::BELONGS_TO, 'Colors', 'colors_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'title' => 'Title',
            'color' => 'Color',
            'sort' => 'Sort',
            'temp1' => 'Temp1',
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
        $criteria->compare('color', $this->color, true);
        $criteria->compare('sort', $this->sort);
        $criteria->compare('temp1', $this->temp1, true);

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
     * @return Colors the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

}
