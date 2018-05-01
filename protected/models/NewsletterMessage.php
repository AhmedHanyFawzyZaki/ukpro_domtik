<?php

/**
 * This is the model class for table "newsletter_message".
 *
 * The followings are the available columns in table 'newsletter_message':
 * @property integer $id
 * @property string $message
 * @property string $subject
 * @property string $users_id
 * @property string $date_sent
 * @property integer $start_flag
 * @property integer $end_flag
 * @property integer $temp1
 * @property integer $temp2
 */
class NewsletterMessage extends SortableCActiveRecord
{
	public $user_selection;
	public $userList;
	public $List_arr2;
        public $orderField = 'sort';

	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return NewsletterMessage the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'newsletter_message';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('start_flag, end_flag, temp1, temp2', 'numerical', 'integerOnly'=>true),
			array('subject, users_id, date_sent', 'length', 'max'=>255),
			array('message', 'safe'),
			array('user_selection, userList', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, message, subject, users_id, date_sent, start_flag, end_flag, temp1, temp2', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'message' => 'Message',
			'subject' => 'Subject',
			'users_id' => 'Users',
			'date_sent' => 'Date Sent',
			'start_flag' => 'Start Flag',
			'end_flag' => 'End Flag',
			'temp1' => 'Temp1',
			'temp2' => 'Temp2',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('message',$this->message,true);
		$criteria->compare('subject',$this->subject,true);
		$criteria->compare('users_id',$this->users_id,true);
		$criteria->compare('date_sent',$this->date_sent,true);
		$criteria->compare('start_flag',$this->start_flag);
		$criteria->compare('end_flag',$this->end_flag);
		$criteria->compare('temp1',$this->temp1);
		$criteria->compare('temp2',$this->temp2);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	public function beforeSave() {
		$this->users_id=implode(',',$this->user_selection);
		$this->date_sent = date('Y-m-d H:i:s');
		return true;
	}
	public function afterFind() {

		$this->user_selection=explode(',',$this->users_id);

		//// users
		foreach($this->user_selection as $item)
		{
			$this->List_arr2[]=Newsletter::model()->findByPk($item)->email;
		}
		$this->userList=implode(',',$this->List_arr2);


		return true;
	}
}