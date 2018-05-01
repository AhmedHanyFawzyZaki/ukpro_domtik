<?php

/**
 * This is the model class for table "errormessage".
 *
 * The followings are the available columns in table 'errormessage':
 * @property integer $id
 * @property string $error_home
 * @property integer $error_homeactive
 * @property string $error_image
 * @property string $error_prev
 * @property integer $error_prevactive
 * @property string $error_subhead
 * @property string $error_heading
 * @property string $error_message
 * @property string $error_body
 */
class Errormessage extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Errormessage the static model class
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
		return 'errormessage';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('error_home, error_homeactive, error_prev, error_prevactive, error_subhead, error_heading, error_message, error_body', 'required'),
			array('error_homeactive, error_prevactive', 'numerical', 'integerOnly'=>true),
			array('error_home, error_prev, error_message', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.

         array('error_home,error_homeactive, error_prev,error_prevactive, error_subhead,error_heading, error_message, error_body','safe'),

			array('id, error_home, error_homeactive, error_prev, error_prevactive, error_subhead, error_heading, error_message, error_body', 'safe', 'on'=>'search'),
                    
                      array('error_image', 'file', 'types'=>'jpg, gif, png,jpeg','allowEmpty'=>'true'), //add this
                    
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
			'error_home' => 'Error Home',
			'error_homeactive' => 'Error Homeactive',
			'error_image' => 'Error Image',
			'error_prev' => 'Error Prev',
			'error_prevactive' => 'Error Prevactive',
			'error_subhead' => 'Error Subhead',
			'error_heading' => 'Error Heading',
			'error_message' => 'Error Message',
			'error_body' => 'Error Body',
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
		$criteria->compare('error_home',$this->error_home,true);
		$criteria->compare('error_homeactive',$this->error_homeactive);
		$criteria->compare('error_image',$this->error_image,true);
		$criteria->compare('error_prev',$this->error_prev,true);
		$criteria->compare('error_prevactive',$this->error_prevactive);
		$criteria->compare('error_subhead',$this->error_subhead,true);
		$criteria->compare('error_heading',$this->error_heading,true);
		$criteria->compare('error_message',$this->error_message,true);
		$criteria->compare('error_body',$this->error_body,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
        
        

        
     
   
    
    
    
    
}
