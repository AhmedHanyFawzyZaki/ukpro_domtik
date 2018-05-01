<?php

/**
 * This is the model class for table "product".
 *
 * The followings are the available columns in table 'product':
 * @property integer $category_id
 * @property string $description
 * @property integer $featured_in_home_page
 * @property integer $gallery_id
 * @property integer $has_stock
 * @property integer $id
 * @property string $main_image
 * @property string $old_price
 * @property integer $on_sale
 * @property integer $price
 * @property integer $product_category_id
 * @property integer $product_status_id
 * @property integer $quantity
 * @property integer $show_in_home_page
 * @property integer $sort
 * @property string $show_in_website_category
 * @property string $category_featured
 * @property string $flag
 * @property string $thumb
 * @property string $title
 * @property integer $type
 * @property string $url
 * @property integer $user_id
 *
 * The followings are the available model relations:
 * @property Color[] $colors
 * @property Gallery $gallery
 * @property ProductCategory $productCategory
 * @property ProductStatus $productStatus
 * @property Room[] $rooms
 * @property Size[] $sizes
 */
class Product extends CActiveRecord implements IECartPosition {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'product';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('category_id, title, description, user_id,main_image', 'required'),
            array('featured_in_home_page, gallery_id, has_stock, on_sale, product_category_id, product_status_id, quantity, show_in_home_page, sort, type, user_id', 'numerical', 'integerOnly' => true),
            array('main_image, old_price, price, category_featured, flag, thumb, title, url,show_in_website_category', 'length', 'max' => 255),
            array('description ,merchant_id , merchant_name , url ,data_feed_id, mlink , prod_id , pid', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('category_id, description, featured_in_home_page, gallery_id, has_stock, id, main_image, old_price, on_sale, price, product_category_id, product_status_id, quantity, show_in_home_page, sort, show_in_website_category, category_featured, flag, thumb, title, type, url, user_id', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'colors' => array(self::HAS_MANY, 'Color', 'product_id'),
            'gallery' => array(self::BELONGS_TO, 'Gallery', 'gallery_id'),
            'category' => array(self::BELONGS_TO, 'Category', 'category_id'),
            'productCategory' => array(self::BELONGS_TO, 'ProductCategory', 'product_category_id'),
            'productStatus' => array(self::BELONGS_TO, 'ProductStatus', 'product_status_id'),
            'rooms' => array(self::HAS_MANY, 'Room', 'product_id'),
            'sizes' => array(self::HAS_MANY, 'Size', 'product_id'),
            'user' => array(self::BELONGS_TO, 'User', 'user_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'category_id' => 'Website Category',
            'description' => 'Description',
            'featured_in_home_page' => 'Featured in website main page',
            'gallery_id' => 'Gallery',
            'has_stock' => 'Has Stock',
            'id' => 'ID',
            'main_image' => 'Main Image',
            'old_price' => 'Old Price/ Promo',
            'on_sale' => 'On Sale',
            'price' => 'Price',
            'product_category_id' => 'Product Category',
            'product_status_id' => 'Product Status',
            'quantity' => 'Quantity',
            'show_in_home_page' => 'Show In Category HomePage',
            'sort' => 'Sort',
            'show_in_website_category' => 'Arrivals',
            'category_featured' => 'Show in category featrued',
            'flag' => 'Flag',
            'thumb' => 'Thumb',
            'title' => 'Product Name',
            'type' => 'Type',
            'url' => 'Url',
            'user_id' => 'Owner',
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

        $criteria->compare('category_id', $this->category_id);
        $criteria->compare('description', $this->description, true);
        $criteria->compare('featured_in_home_page', $this->featured_in_home_page);
        $criteria->compare('gallery_id', $this->gallery_id);
        $criteria->compare('has_stock', $this->has_stock);
        $criteria->compare('id', $this->id);
        $criteria->compare('main_image', $this->main_image, true);
        $criteria->compare('old_price', $this->old_price, true);
        $criteria->compare('on_sale', $this->on_sale);
        $criteria->compare('price', $this->price, true);
        $criteria->compare('product_category_id', $this->product_category_id);
        $criteria->compare('product_status_id', $this->product_status_id);
        $criteria->compare('quantity', $this->quantity);
        $criteria->compare('show_in_home_page', $this->show_in_home_page);
        $criteria->compare('sort', $this->sort);
        $criteria->compare('show_in_website_category', $this->show_in_website_category, true);
        $criteria->compare('category_featured', $this->category_featured, true);
        $criteria->compare('flag', $this->flag, true);
        $criteria->compare('thumb', $this->thumb, true);
        $criteria->compare('title', $this->title, true);
        $criteria->compare('type', $this->type);
        $criteria->compare('url', $this->url, true);
        $criteria->compare('user_id', $this->user_id);

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
     * @return Product the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function getProduct() {
        return CHtml::listData(Product::model()->findAll(array('order' => 'id DESC')), 'id', 'title');
    }

    public function scopes($type = '') {
        if ($type == 'mobile') {
            return array(
                'recent' => array(
                    'condition' => 'featured_in_home_page=1 and product_status_id=1',
                    'order' => 'rand()',
            ));
        } else {
            return array(
                'recent' => array(
                    'condition' => 'featured_in_home_page=1 and product_status_id=1',
                    'order' => 'rand()',
                    'limit' => 4
                )
            );
        }
    }

    function getId() {

        return $this->id;
    }

    function getPrice() {
        return $this->price;
    }

    public function saveXml($attributes, $details_attributes, $pro_colors, $pro_sizes, $cosmetic_arr_all) {
        $id = $attributes['category_id'];
        $model = new Product;
        $productdetails = new ProductDetails();
        $make = new Make();
        $motor = new MotorModel();

        $gallery_ob = new Gallery();

        $model_col = new ProductColor();
        $model_siz = new ProductSizes();
        $sizees = Sizes::model()->findAllByAttributes(array('category_id' => 3));



        if ($id == 1) {
//        $criteria = new CDbCriteria;
//        $criteria->condition = 'category_id=' . $id;
//        $productcategory = ProductCategory::model()->findAll($criteria);


            $model->category_id = $id;
            $model->type = 0;
            $model->user_id = Yii::app()->user->id;
        }
        if ($id == 3) {
            $model->category_id = $id;
            $model->type = 0;
            $model->user_id = Yii::app()->user->id;
        }

        if ($id == 5) {
            $model->category_id = $id;
            $model->type = 1;
            $model->user_id = Yii::app()->user->id;
        }
        if ($id == 4) {
            $model->category_id = $id;
            $model->type = 0;
            $model->user_id = Yii::app()->user->id;
        }
        if ($id == 6) {
            $model->category_id = $id;
            $model->type = 0;
            $model->user_id = Yii::app()->user->id;
        }
        if ($id == 7) {
            $model->category_id = $id;
            $model->type = 0;
            $model->user_id = Yii::app()->user->id;
            $criteria = new CDbCriteria;
        }
        if ($id == 8) {

            $model->category_id = $id;
            $model->type = 0;
            $model->user_id = Yii::app()->user->id;
        }
        if ($id == 9) {
            $model->category_id = $id;
            $model->user_id = Yii::app()->user->id;
        }
        if ($id == 10) {
            $model->category_id = $id;
            $model->type = 1;
            $model->user_id = Yii::app()->user->id;
        }if ($id == 2) {
            $model->category_id = $id;
            $model->type = 1;
            $model->user_id = Yii::app()->user->id;
        }
//        if ($model->main_image != '') {
//                $attributes['main_image'] = $model->main_image;
//            }




        if (isset($attributes)) {
            //  print_r($_POST['ProductDetails']);die;
            $model->attributes = $attributes;
            $model->flag = 1; //xml

            $productdetails->attributes = $details_attributes;
//            $model->gallery_id = $gallery_ob->id;
//           $productdetails->address  =$_POST['location'];
//            $rnd = rand(0, 9999);  // generate random number between 0-9999
//            $uploadedFile = CUploadedFile::getInstance($model, 'main_image');
//
//            if (!empty($uploadedFile)){
//                $fileName = "{$rnd}-{$uploadedFile}";  // random number + file name
//                $model->main_image = $fileName;
//                $uploadedFile->saveAs(Yii::app()->basePath . '/../media/product/' . $fileName);
//            }
            if ($model->save(false)) {
                $productdetails->product_id = $model->id;
                $productdetails->attributes = $details_attributes;
                $productdetails->save(FALSE);

                if (isset($pro_colors)) {

                    // print_r ($_POST['ProductColor']);die;
                    for ($i = 0; $i < count($pro_colors); $i++) {
                        $model_col = new ProductColor;
                        //   echo $_POST['ProductColor']['colors_id'][$i];die;
                        $model_col->colors_id = $pro_colors[$i];
                        //  echo $model_col->colors_id ;die;
                        $model_col->product_id = $model->id;

                        if (!$model_col->save(false)) {
                            throw new CHttpException(400, 'DataBase Error Please Try Again Later.');
                        }
                    }
                }
                if ($id == 1 or $id == 4 or $id == 8 or $id == 6) {
                    if (isset($pro_sizes)) {

                        // print_r ($_POST['ProductSizes']);die;
                        for ($i = 0; $i < count($pro_sizes); $i++) {
                            $model_siz = new ProductSizes;
                            //   echo $_POST['ProductSizes']['sizes_id'][$i];die;
                            $model_siz->sizes_id = $pro_sizes[$i];
                            //  echo $model_siz->sizes_id ;die;
                            $model_siz->product_id = $model->id;

                            if (!$model_siz->save(false)) {
                                throw new CHttpException(400, 'DataBase Error Please Try Again Later.');
                            }
                        }
                    }
                }

                if ($id == 3 and $cosmetic_arr_all['flag'] != 1) {


//                    echo 'cccccc'.$id;
//                    echo '<pre>';
//                    print_r($cosmetic_arr_all);
//                    echo '<pre>';

                    if ($cosmetic_arr_all) {

                        for ($p = 0; $p < sizeof($cosmetic_arr_all); $p++) {
                            //  echo  $_POST['product']['size'][$i];die;
                            //  echo$_POST['product']['quantity'][$i];die;
                            $size = new Size();
                            $size->product_id = $model->id;
                            $size->type = 0;
                            $size->size_id = $cosmetic_arr_all[$p]['size'];
                            $sizee = Sizes::model()->findByAttributes(array('id' => $size->size_id));
                            $size->title = $sizee->title;
                            // echo $size->title;die;
                            $size->price = $cosmetic_arr_all[$p]['price'];
                            $size->quantity = $cosmetic_arr_all[$p]['quantity'];

                            // echo  $size->quantity;die;
                            if (!empty($size->product_id) and ! empty($size->title)) {
                                $size->save(false);
                            }
                            // $i++;
                        }
                    }
                    // }
                } else if ($id == 3 and $cosmetic_arr_all['flag'] == 1) {
                    
                }
//                if ($id == 2) {
//                    // print_r( $_POST['room']);die;
//                    // print_r( $_POST['room']['roomoptions']);die;
//                    //  if (!empty($_POST['room']['roomoptions'])) {
//                    $i = 0;
//                    foreach ($_POST['room'] as $rooms) {
//                        $room = new Room();
//                        $room->product_id = $model->id;
//                        $room->room_options = $_POST['room']['roomoptions'][$i];
//                        $room->bed_options = $_POST['room']['bedoptions'][$i];
//                        $room->adult_price = $_POST['room']['adultprice'][$i];
//                        $room->children_price = $_POST['room']['childrenprice'][$i];
//                        $room->infant_price = $_POST['room']['infantprice'][$i];
//                        if (!empty($room->product_id) and ! empty($room->room_options)) {
//                            $room->save(false);
//                        }
//                        $i++;
//                    }
//                    //}
//                }
                // $this->redirect(array('view', 'id' => $model->id));
                return $model->id;
            }
        }
    }

    //mobile
    public function itemsListing($catId, $productcatId, $start, $end, $all) {
        $criteria = new CDbCriteria();
        $criteria->condition = "category_id=:category_id And product_category_id=:product_category_id ";
        $criteria->params = array(':category_id' => $catId, ':product_category_id' => $productcatId);
        if ($all != 1) {
            $criteria->offset = $start;
            $criteria->limit = $end;
        }
        return Product::model()->findAll($criteria);
    }
    
      public function itemsListingFeatured($catId, $productcatId, $start, $end, $all) {
        $criteria = new CDbCriteria();
        $criteria->condition = "category_id=:category_id And featured_in_home_page=:featured_in_home_page ";
        $criteria->params = array(':category_id' => $catId, ':featured_in_home_page' => 1);
        if ($all != 1) {
            $criteria->offset = $start;
            $criteria->limit = $end;
        }
        return Product::model()->findAll($criteria);
    }
    
     public function itemsListingFavorite($catId, $productcatId, $start, $end, $all) {
        $criteria = new CDbCriteria();
        $criteria->condition = " category_id = $catId AND id IN (select product_id from favourite) ";
        
        if ($all != 1) {
            $criteria->offset = $start;
            $criteria->limit = $end;
        }
        return Product::model()->findAll($criteria);
    }
      public function itemsListingall($catId, $productcatId, $start, $end, $all) {
        $criteria = new CDbCriteria();
        $criteria->condition = " category_id = $catId ";
        
        if ($all != 1) {
            $criteria->offset = $start;
            $criteria->limit = $end;
        }else{
             $criteria->offset = 0;
            $criteria->limit = 30;
        }
        return Product::model()->findAll($criteria);
    }

    public function allfav($userid, $start, $end, $all) {
        $criteria = new CDbCriteria();
        $criteria->condition = " id IN(SELECT product_id from favourite where user_id=:user_id) ";
        $criteria->params = array(':user_id' => $userid);
        if ($all != 1) {
            $criteria->offset = $start;
            $criteria->limit = $end;
        }
        //print_r($criteria);
        return Product::model()->findAll($criteria);
    }

    public function real($title, $type, $start, $end, $all) {
        $criteria = new CDbCriteria();
       // echo $title;die;
        $criteria->condition = "lower(title) like lower('%$title%') and id IN(SELECT product_id from product_details where real_estate_type=:type) ";
        $criteria->params = array(':type' => $type);
        if ($all != 1) {
            $criteria->offset = $start;
            $criteria->limit = $end;
        }
        //print_r($criteria);
        return Product::model()->findAll($criteria);
    }
    
    
    

    public function cosmitcsSearch($text, $subcat_id, $brand_id, $shop_id, $start_price, $end_price, $size_id, $color_id, $start, $end) {
         $user_id = UserDetails::model()->findByPk($shop_id)->user_id;
        $criteria = new CDbCriteria();
        $criteria->condition = "category_id=3 AND price between '$start_price' AND '$end_price' AND product_category_id='$subcat_id' AND user_id = $user_id "
                . " AND id IN(SELECT product_id FROM product_details WHERE brand_id=$brand_id) "
                . " AND id IN(SELECT product_id from size where size_id = $size_id) "
                . " AND id IN(SELECT product_id from product_color where colors_id = $color_id) "
                . "";

        //$criteria->params = array(":title" => $text, ":startPrice" => $start_price, ":endPrice" => $end_price, ":sub_category_id" => $subcat_id, ":brand_id" => $brand_id,);

        $criteria->limit = $end;
        $criteria->offset = $start;
        $items = Product::model()->findAll($criteria);

        return $items;
    }
    
    public function jewelrySearch($text, $subcat_id, $brand_id, $shop_id, $start_price, $end_price, $size_id, $color_id, $start, $end) {
        $user_id = UserDetails::model()->findByPk($shop_id)->user_id;
        $criteria = new CDbCriteria();
        $criteria->condition = "category_id=4 AND price between '$start_price' AND '$end_price' AND product_category_id='$subcat_id' AND user_id = $user_id "
                . " AND id IN(SELECT product_id FROM product_details WHERE brand_id=$brand_id) "
                . " AND id IN(SELECT product_id from size where size_id = $size_id) "
                . " AND id IN(SELECT product_id from product_color where colors_id = $color_id) "
                . "";
        
        
        //$criteria->params = array(":title" => $text, ":startPrice" => $start_price, ":endPrice" => $end_price, ":sub_category_id" => $subcat_id, ":brand_id" => $brand_id,);

        $criteria->limit = $end;
        $criteria->offset = $start;
        $items = Product::model()->findAll($criteria);

        return $items;
    }
    
    
//     public function carsSearch($text, $subcat_id, $brand_id, $shop_id, $start_price, $end_price, $size_id, $color_id, $start, $end) {
//        $criteria = new CDbCriteria();
//        $criteria->condition = "category_id=5 AND price between '$start_price' AND '$end_price' "
//                . " AND id IN(SELECT product_id FROM product_details WHERE brand_id=$brand_id) "
//                . " AND id IN(SELECT product_id from size where size_id = $size_id) "
//                . " AND id IN(SELECT product_id from product_color where colors_id = $color_id) "
//                . "";
//        
//        
//        //$criteria->params = array(":title" => $text, ":startPrice" => $start_price, ":endPrice" => $end_price, ":sub_category_id" => $subcat_id, ":brand_id" => $brand_id,);
//
//        $criteria->limit = $end;
//        $criteria->offset = $start;
//        $items = Product::model()->findAll($criteria);
//
//        return $items;
//    }
    
    public function lifeStyleSearch($subcat_id, $brand_id, $shop_id, $start_price, $end_price, $start, $end) {
        $user_id = UserDetails::model()->findByPk($shop_id)->user_id;
        $criteria = new CDbCriteria();
        $criteria->condition = " category_id =9 AND price between '$start_price' and '$end_price' AND product_category_id='$subcat_id' AND user_id = $user_id"
                . " AND id IN(SELECT product_id FROM product_details WHERE brand_id= $brand_id) "
               // . " AND id IN(SELECT product_id from size where size_id=$size_id) "
             //   . " AND id IN(SELECT product_id from color where colors_id=$color_id) "
                ;
        
        
        //$criteria->params = array(":title" => $text, ":startPrice" => $start_price, ":endPrice" => $end_price, ":sub_category_id" => $subcat_id, ":brand_id" => $brand_id,);

        $criteria->limit = $end;
        $criteria->offset = $start;
        $items = Product::model()->findAll($criteria);

        return $items;
    }
}