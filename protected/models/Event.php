<?php

/**
 * This is the model class for table "event".
 *
 * The followings are the available columns in table 'event':
 * @property integer $id
 * @property string $title
 * @property string $start
 * @property string $end
 * @property string $allDay
 * @property string $color
 */
class Event extends SortableCActiveRecord {

    public $orderField = 'sort';
    public $search_key;
    public $search_value;

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Event the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'event';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('title, start, end, allDay, color', 'length', 'max' => 255),
            array('title, start, end', 'required'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, title, start, end, allDay, color, search_key, search_value', 'safe', 'on' => 'search'),
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
        return array('search_value' => 'Filter',
            'id' => 'ID',
            'title' => 'Title',
            'start' => 'Start',
            'end' => 'End',
            'allDay' => 'All Day',
            'color' => 'Color',
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
        if ($this->search_key == 'all' && isset($this->search_value)) {
            $criteria->compare('id', $this->search_value, true, 'OR');
            $criteria->compare('title', $this->search_value, true, 'OR');
            $criteria->compare('start', $this->search_value, true, 'OR');
            $criteria->compare('end', $this->search_value, true, 'OR');
            $criteria->compare('allDay', $this->search_value, true, 'OR');
            $criteria->compare('color', $this->search_value, true, 'OR');
        } elseif (isset($this->search_value) && $this->search_key != 'all') {
            $criteria->compare($this->search_key, $this->search_value, true);
        } else {
            $criteria->compare('id', $this->id);
            $criteria->compare('title', $this->title, true);
            $criteria->compare('start', $this->start, true);
            $criteria->compare('end', $this->end, true);
            $criteria->compare('allDay', $this->allDay, true);
            $criteria->compare('color', $this->color, true);
        }


        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    public function defaultScope() {
        return array("order" => "title");
    }

}
