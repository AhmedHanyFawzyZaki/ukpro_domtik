<?php

/**
 * This is the model class for table "sort_test".
 *
 * The followings are the available columns in table 'sort_test':
 * @property integer $id
 * @property integer $order
 * @property string $title
 * @property string $desc
 */
class SortTest extends SortableCActiveRecord
{

	public $orderField = 'sort';

	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return SortTest the static model class
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
		return 'sort_test';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('title, desc', 'required'),
			array('sort', 'numerical', 'integerOnly'=>true),
			array('title', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, sort, title, desc', 'safe', 'on'=>'search'),
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
			'sort' => 'Order',
			'title' => 'Title',
			'desc' => 'Desc',
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
		$criteria->compare('sort',$this->sort);
		$criteria->compare('LOWER(title)',strtolower($this->title),true);
		$criteria->compare('LOWER(desc)',strtolower($this->desc),true);

		return new CActiveDataProvider($this, array(
			'pagination' => array(
                    	'pageSize' => 40,
            	    ),
			'criteria'=>$criteria,
		));
	}
}
