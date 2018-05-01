<?php

/**
 * This is the model class for table "pages".
 *
 * The followings are the available columns in table 'pages':
 * @property integer $id
 * @property string $title
 * @property string $intro
 * @property string $details
 * @property string $image
 * @property string $video
 * @property integer $publish
 */
class Pages extends SortableCActiveRecord {

    public $orderField = 'sort';

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Pages the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'pages';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('publish,page_cat', 'numerical', 'integerOnly' => true),
            array('title, image, video, meta_author,url', 'length', 'max' => 255),
            array('intro, details, meta_keywords, meta_desc,url', 'safe'),
            array('title,details', 'required'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, title, intro, details, image, video, publish,page_cat,url', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'pagecat' => array(self::BELONGS_TO, 'PageCat', 'page_cat'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'title' => 'Title',
            'intro' => 'Intro',
            'details' => 'Details',
            'image' => 'Optional Image',
            'video' => 'Optional Video ',
            'publish' => 'Published',
            'page_cat' => 'Page Category',
            'url' => 'Url',
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

        $criteria->compare('id', $this->id);
        $criteria->compare('title', $this->title, true);
        $criteria->compare('intro', $this->intro, true);
        $criteria->compare('details', $this->details, true);
        $criteria->compare('image', $this->image, true);
        $criteria->compare('video', $this->video, true);
        $criteria->compare('publish', $this->publish);
        $criteria->compare('page_cat', $this->page_cat);
        $criteria->compare('url', $this->url);

        return new CActiveDataProvider($this, array(
            'pagination' => array(
                'pageSize' => 40,
            ),
            'criteria' => $criteria,
        ));
    }

    public function defaultScope() {
        return array("order" => "title");
    }

    public function getStatus($value) {
        return $value = 0 ? 'Unpublished' : 'Published';
    }

}
