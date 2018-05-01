<?php

/**
 * This is the model class for table "iata_codes".
 *
 * The followings are the available columns in table 'iata_codes':
 * @property string $app_location_type
 * @property string $name
 * @property string $iata_code
 * @property string $city_name
 * @property string $city_code
 * @property string $country_name
 * @property string $country_code
 */
class IataCodes extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return IataCodes the static model class
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
		return 'iata_codes';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('app_location_type, iata_code', 'length', 'max'=>200),
			array('name, city_name, city_code, country_name, country_code', 'length', 'max'=>300),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('app_location_type, name, iata_code, city_name, city_code, country_name, country_code', 'safe', 'on'=>'search'),
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
			'app_location_type' => 'App Location Type',
			'name' => 'Name',
			'iata_code' => 'Iata Code',
			'city_name' => 'City Name',
			'city_code' => 'City Code',
			'country_name' => 'Country Name',
			'country_code' => 'Country Code',
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

		$criteria->compare('app_location_type',$this->app_location_type,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('iata_code',$this->iata_code,true);
		$criteria->compare('city_name',$this->city_name,true);
		$criteria->compare('city_code',$this->city_code,true);
		$criteria->compare('country_name',$this->country_name,true);
		$criteria->compare('country_code',$this->country_code,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}