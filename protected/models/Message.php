<?php

/**
 * This is the model class for table "message".
 *
 * The followings are the available columns in table 'message':
 * @property integer $id
 * @property integer $sender_id
 * @property integer $reciever_id
 * @property string $title
 * @property string $details
 * @property string $message_date
 * @property integer $sort
 * @property integer $published
 */
class Message extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'message';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('sender_id, reciever_id, sort, published,product_id', 'numerical', 'integerOnly' => true),
            array('sender_id, reciever_id, title, details ', 'required'),
            array('title, details, message_date', 'length', 'max' => 255),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, sender_id, reciever_id, title, details, message_date,product_id, sort, published', 'safe', 'on' => 'search'),
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
            'sender_id' => 'Sender',
            'reciever_id' => 'Reciever',
            'title' => 'Title',
            'details' => 'Details',
            'message_date' => 'Message Date',
            'sort' => 'Sort',
            'published' => 'Published',
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
        $criteria->compare('sender_id', $this->sender_id);
        $criteria->compare('reciever_id', $this->reciever_id);
        $criteria->compare('title', $this->title, true);
        $criteria->compare('details', $this->details, true);
        $criteria->compare('message_date', $this->message_date, true);
        $criteria->compare('sort', $this->sort);
        $criteria->compare('published', $this->published);
        $criteria->compare('product_id', $this->product_id);
        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Message the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function allMsgs($userid, $start, $end, $flag, $all) {
        $criteria = new CDbCriteria();
        $id = ($flag == 0) ? "reciever_id" : "sender_id";

        $criteria->condition = "  $id=:rec_id ";
        $criteria->params = array(':rec_id' => $userid);

        if ($all != 1) {
            $criteria->offset = $start;
            $criteria->limit = $end;
        }
        return Message::model()->findAll($criteria);
    }
}