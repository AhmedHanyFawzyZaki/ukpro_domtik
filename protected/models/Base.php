<?php

/**
 * This is the base model class that all models inherit from".
 * @author A.Sharaf 
 */
class Base extends CActiveRecord {

    protected $oldAttributes = array();

    public function init() {
        $this->oldAttributes = $this->attributes;
        return parent::init();
    }

    public function behaviors() {
        $behaviors = array();

        $behaviors['ESaveRelatedBehavior'] = array('class' => 'application.components.ESaveRelatedBehavior');

        if ($this->hasAttribute('created') && $this->hasAttribute('updated')) {
            $behaviors['CTimestampBehavior'] = array(
                'class' => 'zii.behaviors.CTimestampBehavior',
                'createAttribute' => 'created',
                'updateAttribute' => 'updated',
                'setUpdateOnCreate' => true,
            );
        }

        if ($this->hasAttribute('position')) {
            $behaviors['SortableCActiveRecordBehavior'] = array(
                'class' => 'ext.YiiSortableModel.behaviors.SortableCActiveRecordBehavior',
                'orderField' => 'position'
            );
        }

//        if ($this->hasAttribute('slug')) {
//            $behaviors['SlugBehavior'] = array(
//                'class' => 'ext.behaviors.SlugBehavior',
//                'slug_col' => 'slug',
//                'title_col' => $this->hasAttribute('name') ? 'name' : 'title',
//                'condition' => $this->hasAttribute('type') ? 'type = ' . $this->type : true,
//            );
//        }

        if ($this->hasAttribute('slug')) {
            $behaviors['SluggableBehavior'] = array(
                'class' => 'ext.behaviors.SluggableBehavior.SluggableBehavior',
                'slugColumn' => 'slug',
                'columns' => $this->slugColumns(),
                'scope' => 'scopeSlug',
                'unique' => true,
                'update' => true,
            );
        }

        return $behaviors;
    }

    protected function afterFind() {
        $this->oldAttributes = $this->attributes;
        return parent::afterFind();
    }

    /////////////// Custom functions //////////////////

    /**
     * @return array of columns required to generate slug using SluggableBehavior.
     */
    protected function slugColumns() {
        return array();
    }

    /**
     * Scope used to find & generate slug using SluggableBehavior.
     * @return \model 
     */
    public function scopeSlug() {
        return $this;
    }

    /**
     * Retrieves CActiveDataProvider of user related models
     * @param string $modelName model name
     * @param string|array $fk foreign key, default 'user_id', ex: array('sender_id', 'reciever_id')
     * @param array $attrs Optional array of ('attr' => 'val') to compare the 'attr' with the 'val'
     * @return \CActiveDataProvider
     */
    public function getRelatedProvider($modelName, $fk = 'user_id', array $attrs = array(), array $orders = array()) {

        $criteria = new CDbCriteria;

        if (is_array($fk)) {

            foreach ($fk as $attr) {

                $criteria->compare($attr, $this->id, false, 'OR');
            }
        } else {

            $criteria->compare($fk, $this->id);
        }

        foreach ($attrs as $attr => $val) {

            $criteria->compare($attr, $val);
        }

        if (count($orders) > 0) {

            $criteria->order = implode(',', $orders);
        }

        return new CActiveDataProvider(new $modelName, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Lates Scope
     * @param string $limit
     * @return \Posts
     */
    public function scopeLatest($limit) {
        $criteria = new CDbCriteria;
        $criteria->order = 'id DESC';
        $criteria->limit = $limit;
        $this->getDbCriteria()->mergeWith($criteria);
        return $this;
    }

}

