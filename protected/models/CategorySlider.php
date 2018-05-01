<?php

/**
 * This is the model class for table "category_slider".
 *
 * The followings are the available columns in table 'category_slider':
 * @property integer $id
 * @property integer $category_id
 * @property string $image
 * @property string $title
 * @property string $description
 * @property integer $product_id
 * @property string $link
 * @property string $sort
 * @property string $temp2
 */
class CategorySlider extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'category_slider';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('category_id, title', 'required'),
            array('category_id, product_id', 'numerical', 'integerOnly' => true),
            array('image, title, description, link, sort, temp2', 'length', 'max' => 255),
            array('description', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, category_id, image, title, description, product_id, link, sort, temp2', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'category' => array(self::BELONGS_TO, 'Category', 'category_id'),
            'product' => array(self::BELONGS_TO, 'Product', 'product_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'category_id' => 'Category',
            'image' => 'Image',
            'title' => 'Title',
            'description' => 'Description',
            'product_id' => 'Product',
            'link' => 'Link',
            'sort' => 'sort',
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
        $criteria->compare('category_id', $this->category_id);
        $criteria->compare('image', $this->image, true);
        $criteria->compare('title', $this->title, true);
        $criteria->compare('description', $this->description, true);
        $criteria->compare('product_id', $this->product_id);
        $criteria->compare('link', $this->link, true);
        $criteria->compare('sort', $this->sort, true);
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
     * @return CategorySlider the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

}
