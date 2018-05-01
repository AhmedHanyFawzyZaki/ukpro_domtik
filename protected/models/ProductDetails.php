<?php

/**
 * This is the model class for table "product_details".
 *
 * The followings are the available columns in table 'product_details':
 * @property string $address
 * @property integer $brand_id
 * @property integer $city_id
 * @property string $conditions
 * @property integer $county_id
 * @property integer $decor_style_id
 * @property integer $decor_type_id
 * @property integer $destination_city
 * @property integer $destination_country
 * @property string $dimensions
 * @property string $flight_date
 * @property integer $gender
 * @property integer $id
 * @property integer $kids_for
 * @property integer $kids_type
 * @property string $latitude
 * @property string $longitude
 * @property integer $make_id
 * @property integer $motor_model_id
 * @property integer $product_id
 * @property string $real_estate_facilities
 * @property integer $real_estate_type
 * @property integer $sort
 * @property integer $source_city
 * @property integer $source_country
 * @property integer $sub_category_id
 * @property integer $gas_id
 * @property integer $door_id
 * @property integer $kmage_id
 * @property integer $age_id
 * @property integer $engine_id
 * @property integer $emission_id
 * @property integer $travel_type
 * @property integer $country_id
 *
 * The followings are the available model relations:
 * @property Product $product
 * @property Brand $brand
 * @property City $city
 * @property Country $county
 * @property DecorStyle $decorStyle
 * @property DecorType $decorType
 * @property City $destinationCity
 * @property Country $destinationCountry
 * @property Make $make
 * @property MotorModel $motorModel
 * @property City $sourceCity
 * @property Country $sourceCountry
 * @property SubCategory $subCategory
 */
class ProductDetails extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'product_details';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('product_id,sub_category_id', 'required'),
			array('brand_id, city_id, country_id,motor_status, county_id, decor_style_id, decor_type_id, destination_city, destination_country, gender, kids_for, kids_type, make_id, motor_model_id, product_id, real_estate_type, sort, source_city, source_country, sub_category_id, travel_type, gas_id, door_id, kmage_id, age_id, emission_id, engine_id,power_engine', 'numerical', 'integerOnly'=>true),
			array('latitude, longitude,post_code', 'length', 'max'=>255),
			array('address, conditions,motor_status, dimensions, flight_date, real_estate_facilities,post_code,power_engine', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('address, brand_id,motor_status, city_id, conditions, county_id, decor_style_id, decor_type_id, destination_city, destination_country, dimensions, flight_date, gender, id, kids_for, kids_type, latitude, longitude, make_id, motor_model_id, product_id, real_estate_facilities, real_estate_type, sort, source_city, source_country, sub_category_id, temp1, temp2, temp3, temp4, temp5, temp6, travel_type,post_code,power_engine', 'safe', 'on'=>'search'),
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
			'brand' => array(self::BELONGS_TO, 'Brand', 'brand_id'),
			'city' => array(self::BELONGS_TO, 'City', 'city_id'),
			'country' => array(self::BELONGS_TO, 'Country', 'country_id'),
			'decorStyle' => array(self::BELONGS_TO, 'DecorStyle', 'decor_style_id'),
			'decorType' => array(self::BELONGS_TO, 'DecorType', 'decor_type_id'),
			'destinationCity' => array(self::BELONGS_TO, 'City', 'destination_city'),
			'destinationCountry' => array(self::BELONGS_TO, 'Country', 'destination_country'),
			'make' => array(self::BELONGS_TO, 'Make', 'make_id'),
			'motorModel' => array(self::BELONGS_TO, 'MotorModel', 'motor_model_id'),
			'sourceCity' => array(self::BELONGS_TO, 'City', 'source_city'),
			'sourceCountry' => array(self::BELONGS_TO, 'Country', 'source_country'),
			'subCategory' => array(self::BELONGS_TO, 'SubCategory', 'sub_category_id'),
                    	'gas' => array(self::BELONGS_TO, 'Gas', 'gas_id'),
			'door' => array(self::BELONGS_TO, 'Door', 'door_id'),
			'kmage' => array(self::BELONGS_TO, 'Kmage', 'kmage_id'),
			'age' => array(self::BELONGS_TO, 'Age', 'age_id'),
			'emission' => array(self::BELONGS_TO, 'Emission', 'emission_id'),
			'engine' => array(self::BELONGS_TO, 'Engine', 'engine_id'),

		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'address' => 'Address',
			'brand_id' => 'Brand',
			'city_id' => 'City',
			'conditions' => 'Conditions',
			'country_id' => 'Country',
			'decor_style_id' => 'Decor Style',
			'decor_type_id' => 'Decor Type',
			'destination_city' => 'Destination City',
			'destination_country' => 'Destination Country',
			'dimensions' => 'Dimensions',
			'flight_date' => 'Flight Date',
			'gender' => 'Gender',
			'id' => 'ID',
			'kids_for' => 'Kids For',
			'kids_type' => 'Kids Type',
			'latitude' => 'Latitude',
			'longitude' => 'Longitude',
			'make_id' => 'Make',
			'motor_model_id' => 'Motor Model',
			'product_id' => 'Product',
			'real_estate_facilities' => 'Real Estate Facilities',
			'real_estate_type' => 'Real Estate Type',
			'sort' => 'Sort',
			'source_city' => 'Source City',
			'source_country' => 'Source Country',
			'sub_category_id' => 'Sub Category',
			'gas_id' => 'Gas',
			'door_id' => 'Door',
			'kmage_id' => 'Kmage',
			'age_id' => 'Age',
			'emission_id' => 'Emission',
			'engine_id' => 'Engine',
			'travel_type' => 'Travel Type',
                        'motor_status'=>'Motor Status',
                        'post_code'=>'Post code',
                        'power_engine'=>'Power Engine',
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

		$criteria->compare('address',$this->address,true);
		$criteria->compare('brand_id',$this->brand_id);
		$criteria->compare('city_id',$this->city_id);
		$criteria->compare('conditions',$this->conditions,true);
		$criteria->compare('country_id',$this->country_id);
		$criteria->compare('decor_style_id',$this->decor_style_id);
		$criteria->compare('decor_type_id',$this->decor_type_id);
		$criteria->compare('destination_city',$this->destination_city);
		$criteria->compare('destination_country',$this->destination_country);
		$criteria->compare('dimensions',$this->dimensions,true);
		$criteria->compare('flight_date',$this->flight_date,true);
		$criteria->compare('gender',$this->gender);
		$criteria->compare('id',$this->id);
		$criteria->compare('kids_for',$this->kids_for);
		$criteria->compare('kids_type',$this->kids_type);
		$criteria->compare('latitude',$this->latitude,true);
		$criteria->compare('longitude',$this->longitude,true);
		$criteria->compare('make_id',$this->make_id);
		$criteria->compare('motor_model_id',$this->motor_model_id);
		$criteria->compare('product_id',$this->product_id);
		$criteria->compare('real_estate_facilities',$this->real_estate_facilities,true);
		$criteria->compare('real_estate_type',$this->real_estate_type);
		$criteria->compare('sort',$this->sort);
		$criteria->compare('source_city',$this->source_city);
		$criteria->compare('source_country',$this->source_country);
		$criteria->compare('sub_category_id',$this->sub_category_id);
		$criteria->compare('gas_id',$this->gas_id,true);
		$criteria->compare('door_id',$this->door_id,true);
		$criteria->compare('kmage_id',$this->kmage_id,true);
		$criteria->compare('age_id',$this->age_id,true);
		$criteria->compare('emission_id',$this->emission_id,true);
		$criteria->compare('engine_id',$this->engine_id,true);
		$criteria->compare('travel_type',$this->travel_type);
		$criteria->compare('motor_status',$this->motor_status);
		$criteria->compare('post_code',$this->post_code);
                $criteria->compare('power_engine',$this->power_engine);             
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return ProductDetails the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
        
        public function get_kids_home($kid_for){
        $criteria = new CDbCriteria;
        $criteria->condition = 'kids_for = :kids';
        $criteria->params = array(':kids' => $kid_for);
        return ProductDetails::model()->findAll($criteria);
    }
}
