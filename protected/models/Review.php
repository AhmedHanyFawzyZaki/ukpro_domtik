<?php

/**
 * This is the model class for table "review".
 *
 * The followings are the available columns in table 'review':
 * @property integer $id
 * @property integer $user_id
 * @property integer $product_id
 * @property string $comment
 * @property integer $rate
 * @property string $comment_date
 * @property string $temp1
 * @property string $temp2
 * @property integer $sort
 *
 * The followings are the available model relations:
 * @property Product $product
 * @property User $user
 */
class Review extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'review';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_id, product_id, rate, sort,published', 'numerical', 'integerOnly'=>true),
			array('comment_date, temp1, temp2', 'length', 'max'=>255),
			array('comment', 'safe'),
                    array('user_id, product_id,comment,rate', 'required'),

			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, user_id, product_id, comment, rate, comment_date, temp1, temp2, sort,published', 'safe', 'on'=>'search'),
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
			'product' => array(self::BELONGS_TO, 'Product', 'product_id'),
			'user' => array(self::BELONGS_TO, 'User', 'user_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'user_id' => 'User',
			'product_id' => 'Product',
			'comment' => 'Comment',
			'rate' => 'Rate',
			'comment_date' => 'Comment Date',
			'temp1' => 'Temp1',
			'temp2' => 'Temp2',
			'sort' => 'Sort',
                        'published'=>'Published',
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
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('product_id',$this->product_id);
		$criteria->compare('comment',$this->comment,true);
		$criteria->compare('rate',$this->rate);
		$criteria->compare('comment_date',$this->comment_date,true);
		$criteria->compare('temp1',$this->temp1,true);
		$criteria->compare('temp2',$this->temp2,true);
		$criteria->compare('sort',$this->sort);
		$criteria->compare('published',$this->published);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Review the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
