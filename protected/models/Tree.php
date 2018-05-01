<?php

/**
 * This is the model class for table "sprnr_tree".
 *
 * The followings are the available columns in table 'sprnr_tree':
 * @property string $id
 * @property string $type
 * @property string $name
 * @property string $slug
 * @property string $description
 * @property string $link
 * @property string $icon
 * @property string $level
 * @property string $position
 * @property string $created
 * @property string $updated
 * @property string $parent_id
 *
 * The followings are the available model relations:
 * @property Addresses[] $addresses
 * @property Products[] $products
 * @property Tree $parent
 * @property Tree[] $trees
 */
class Tree extends Base {

    const TYPE_ROOT = 0;
//    const TYPE_EARTH = 1;
   const TYPE_PRODUCTCATEGORY = 2;
   const TYPE_PRODUCTCATEGORY2 = 3;
  

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'tree';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('type, name', 'required'),
            array('type', 'in', 'range' => array_keys(self::getTypeList())),
            array('level, position, parent_id', 'numerical', 'integerOnly' => true),
            array('level, position, parent_id', 'length', 'max' => 10),
            array('name, slug, link, icon', 'length', 'max' => 255),
            array('description', 'length', 'max' => 1000),
            //array('link', 'url'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, type, name, slug, description, link, icon, level, position, created, updated, parent_id', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'addresses' => array(self::HAS_MANY, 'Addresses', 'earth_id'),
            'products' => array(self::HAS_MANY, 'Products', 'category_id'),
            'parent' => array(self::BELONGS_TO, 'Tree', 'parent_id'),
            'childs' => array(self::HAS_MANY, 'Tree', 'parent_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'type' => 'Type',
            'name' => 'Name',
            'slug' => 'Slug',
            'description' => 'Description',
            'link' => 'Link',
            'icon' => 'Icon',
            'level' => 'Level',
            'position' => 'Position',
            'created' => 'Created',
            'updated' => 'Updated',
            'parent_id' => 'Parent',
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

        $criteria->compare('id', $this->id, true);
        $criteria->compare('type', $this->type, true);
        $criteria->compare('name', $this->name, true);
        $criteria->compare('slug', $this->slug, true);
        $criteria->compare('description', $this->description, true);
        $criteria->compare('link', $this->link, true);
        $criteria->compare('icon', $this->icon, true);
        $criteria->compare('level', $this->level, true);
        $criteria->compare('position', $this->position, true);
        $criteria->compare('created', $this->created, true);
        $criteria->compare('updated', $this->updated, true);
        $criteria->compare('parent_id', $this->parent_id, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Tree the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    ///////////// Callbacks Functions ////////////

    protected function beforeSave() {
        //prevent create or update tree root record
        if ($this->id === 0)
        	return false;

	   $this->level= $this->getLevel();
    	  return parent::beforeSave();
    }


	public function getLevel(){


		return ($this->parent_id) ? self::model()->findByPk($this->parent_id)->level + 1 : 1 ;
	}


    protected function beforeDelete() {
        //prevent delete tree root record
        return ($this->id === 0) ? false : parent::beforeDelete();
    }



    public function defaultScope()
    {
        return array(
            'order' => '`position` ASC',
        );
    }

    /////////////// Custom Functions /////////////
    /**
     * Retrieves type list
     * @param string $key
     * @return array|string based on $key value.
     */
    public static function getTypeList($key = null) {
        $list = array(
//            self::TYPE_EARTH => Yii::t('default', 'Earth'),
            self::TYPE_PRODUCTCATEGORY => Yii::t('default', 'Products Categories'),
            self::TYPE_PRODUCTCATEGORY2 => Yii::t('default', 'Products Categoriesdddd'),
          
        );
        return is_null($key) ? $list : $list[$key];
    }

    /**
     * Retrieves list of childs grouped by parent name
     * @param int $type
     * @return array
     */
    public static function getGroupedList($type) {
        if (!array_key_exists($type, Tree::getTypeList()))
            return array();
        $tree = self::model()->findAll('type = ? AND parent_id > ?', array($type, 0));
        return CHtml::listData($tree, 'id', 'name', function($node) {
                            return CHtml::encode($node->parent->name);
                        });
    }

    /**
     * Type Scope
     * @param int $type
     * @return \Tree
     */
    public function scopeType($type) {
        $criteria = new CDbCriteria;
        $this->getDbCriteria()->mergeWith($criteria->compare('type', $type));
        return $this;
    }

    /**
     * Scope used to find & generate slug using SluggableBehavior.
     * @return \Tree
     */
    public function scopeSlug() {
        $criteria = new CDbCriteria;
        $criteria->compare('id !', $this->id);
        $criteria->compare('type', $this->type);
        $this->getDbCriteria()->mergeWith($criteria);
        return $this;
    }

    /**
     * @return array of columns required to generate slug using SluggableBehavior.
     */
    protected function slugColumns() {
        return array('name');
    }

// get Skills and interests for account Deatils
	public static function getSkills($val) {
		$criteria= new CDbCriteria();
		$criteria->condition='type= 2 and  level=2 and name like "'.$val.'%"';
		$skills= Tree::model()->findAll($criteria);

		foreach ($skills as $skill) {
			$list[$skill->id] = $skill->name;
		}

		return $list;
	}

      public static function getInterests($val) {
		$criteria= new CDbCriteria();
		$criteria->condition='type= 5 and  level=1 and name like "'.$val.'%"';
		$interests= Tree::model()->findAll($criteria);

		foreach ($interests as $interest) {
			$list[$interest->id] = $interest->name;
		}

		return $list;
	}

}
