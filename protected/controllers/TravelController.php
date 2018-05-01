<?php

class TravelController extends FrontController {

    public $layout = '//layouts/travel';

    public function actionIndex() {
//        $slides = CategorySlider::model()->findAll(array('condition' => 'category_id=4', 'order' => 'id desc'));
//        $featured_products = Product::model()->findAll(array('condition' => 'category_id=4 and category_featured=1  AND  product_status_id !=2', 'limit' => '3', 'order' => 'rand()'));
//        $products = Product::model()->findAll(array('condition' => 'category_id=4 and show_in_home_page=1  AND  product_status_id !=2', 'order' => 'id desc'));
//        $newarrivalsproducts = Product::model()->findAll(array('condition' => 'category_id=4 and show_in_website_category=1 AND  product_status_id !=2', 'order' => 'id desc'));
//
//        $main_ad = Ads::model()->find("category_id =4 and main_ad = 1");
//        $ads = Ads::model()->findAll("category_id =4 and main_ad != 1");
//        
        $currencies = Currency::model()->findAll($criteria1);
//
 //$cities = IataCodes::model()->findAll("country_name = 'United Kingdom' and app_location_type = 'City' limit 9 ");

       // $countries = IataCodes::model()->findAll("1=1 distinct(country_name) ");

        $countries=IataCodes::model()->findAll(array(
    'select'=>'t.country_name',
    'group'=>'t.country_name',
    'distinct'=>true,
    'limit'=>18
));
//        $this->render('index', array('slides' => $slides, 'products' => $products, 'featured_products' => $featured_products, 'arrivals' => $newarrivalsproducts
//            , 'ads' => $ads, "main_ad" => $main_ad ,'currencies'=>$currencies));

        
        
         $cities = IataCodes::model()->findAll("country_name = 'United Kingdom' and app_location_type = 'City' limit 9 ");

        
        $this->render('index' ,array('currencies'=>$currencies ,'cities'=> $cities , 'countries'=>$countries));
    }

    
    
    
    
    public function actionSubCategory() {
        $cond = 'category_id=4  AND  product_status_id !=2';
        if (isset($_REQUEST['cat_id'])) { //must find the product main category in order to set the left filters
            $cond.= ' and product_category_id=' . $_REQUEST['cat_id'];
        } elseif (isset($_REQUEST['subcat_id']) && !isset($_REQUEST['cat_id'])) {
            $subCategory = SubCategory::model()->findByPk($_REQUEST['subcat_id']);
            if ($subCategory)
                $cond.= ' and product_category_id=' . $subCategory->product_category_id;
        }



        if (isset($_REQUEST['shop'])) {
            $cond.=' and user_id=' . $_REQUEST['shop'];
        }
        $ids = array();
        $cond_det = '1=1';
        if (isset($_REQUEST['subcat_id'])) {
            $cond_det.=' and sub_category_id=' . $_REQUEST['subcat_id'];
        }
        if (isset($_REQUEST['brand'])) {
            $cond_det.=' and brand_id=' . $_REQUEST['brand'];
        }
        if ($cond_det != '1=1') {
            $pro_dets = ProductDetails::model()->findAll(array('condition' => $cond_det));
            if ($pro_dets) {
                foreach ($pro_dets as $pd) {
                    if ($pd->product->category_id == 4) {
                        $ids[] = $pd->product_id;
                    }
                }
            }
        }
        if ($cond_det != '1=1' && empty($ids)) { //there is a filteration the subcat and no result
            $cond.=' and 1=2';
        }

        if (isset($_REQUEST['price'])) {
            $arr = explode('_', $_REQUEST['price']);
            $min = $arr[0];
            $max = $arr[1];
            $pros = Product::model()->findAll(array('condition' => 'price between ' . $min . ' and ' . $max));
            $cond.=' and price between ' . $min . ' and ' . $max;
            //    echo $cond ; 
            // die;

            if ($pros) {
                foreach ($pros as $pr) {
                    if ($pr->category_id == 4) {
                        $ids[] = $pr->id;
                        $ids2[] = $pr->id;
                    }
                }
            }
            /*
              if(empty($ids2))
              {
              $cond.=' and 2=3'; //searching with price and no products found
              }
             */
        }
        if ($ids) {
            $cond.= ' and id in (' . implode(",", $ids) . ')';
        }


        $sub = SubCategory::model()->findByPk($_REQUEST['subcat_id']);

        if (isset($_REQUEST['size'])) {

            if ($sub) {

                $product_sizes = ProductSizes::model()->findAll(array('condition' => ' sizes_id ="' . $_REQUEST['size'] . '" and product_id in (select id from product where category_id = 4 and product_category_id = ' . $sub->productCategory->id . ')'));
            } elseif (isset($_REQUEST['cat_id'])) {
                $product_sizes = ProductSizes::model()->findAll(array('condition' => ' sizes_id ="' . $_REQUEST['size'] . '" and product_id in (select id from product where category_id = 4 and product_category_id = ' . $_REQUEST['cat_id'] . ')'));
            }

            if ($product_sizes) {
                foreach ($product_sizes as $product_size) {
                    $ids3[] = $product_size->product_id;
                }
            }

            if ($ids3) {
                $cond.= ' and id in (' . implode(",", $ids3) . ')';
            }

            if (empty($ids3)) { //there is a filteration by either the brand or the subcat and no result
                $cond.=' and 1=2';
            }
        }





        $order = "title asc";
        if (isset($_REQUEST['sort'])) {
            $order = $_REQUEST['sort'];
        }


        /*
          $products=Product::model()->findAll(array('condition'=>$cond,'order'=>$order));
          $count=count($products);
          $pages = new CPagination($count);
          $pages->pageSize = 12;
         */


        ///////////////////pagination/////////////////////////

        $criteria = new CDbCriteria();
        $criteria->condition = $cond;
        $criteria->order = $order;

        $count = Product::model()->count($criteria);
        $pages = new CPagination($count);

        // results per page
        $pages->pageSize = 20;
        $pages->applyLimit($criteria);
        $products = Product::model()->findAll($criteria);

        ///////////////////////////////////////////////////////////////////  

        $brands = Brand::model()->findAll("category_id = 4");
        $users = User::model()->findAll('groups_id = 1 or groups_id = 4');

        $this->render('sub-category', array('products' => $products, 'count' => $count, 'pages' => $pages, 'users' => $users, "brands" => $brands));
    }

    public function actionItem() {
        $review = new Review;
        $id = $_REQUEST['id'];
        $product = Product::model()->findByPk($id);
        // $sizes = Size::model()->findAllByAttributes(array('product_id' => $id));
        $sizes = Sizes::model()->findAll(array('condition' => ' id in (select sizes_id from product_sizes where  product_id = ' . $id . ')'));
        $photos = GalleryPhoto::model()->findAllByAttributes(array('gallery_id' => $product->gallery_id));
        $newarrivalsproducts = Product::model()->findAll(array('condition' => 'category_id=4'));
        if (!empty($product->product_category_id))
            $newarrivalsproducts = Product::model()->findAll(array('condition' => 'category_id=4 and product_category_id=' . $product->product_category_id . ' and id!=' . $id . '', 'order' => 'id desc'));
        if (isset($_POST['Review'])) {
            $userid = Yii::app()->user->id;
            if ($userid != '') {
                //print_r($_POST['Review']);die;

                $review->attributes = $_POST['Review'];
                $review->user_id = Yii::app()->user->id;
                $review->product_id = $product->id;
                $review->comment_date = date('Y-m-d');

                if ($review->save()) {
                    Yii::app()->user->setFlash('add-success', 'Your Review has been added sucessfuly.');
                } else {

                    Yii::app()->user->setFlash('add-error', 'Please Add your review');
                }
            } else {
                $this->redirect(array('home/confirm/flag/3'));
            }
        }
        $reviews = Review::model()->findAllByAttributes(array('product_id' => $id));
        $this->render('item', array('product' => $product, 'sizes' => $sizes, 'reviews' => $reviews, 'arrivals' => $newarrivalsproducts, 'photos' => $photos, 'revs' => $revs, 'count' => $count, 'review' => $review, 'sub' => $sub));
    }

    public function actionLocation_search() {
        $result = "";

        $api_key = Yii::app()->params['api_key'];
        $ts_code = Yii::app()->params['ts_code'];

        $query = $_GET['term'];
        $test = @file_get_contents("http://uk.wego.com/hotels/api/locations/search?key=" . $api_key . "&ts_code=" . $ts_code . "&q=" . urlencode($query));
        $res = json_decode($test);
        // print_r($res);die;
        if ($res->count) {
            $result = array();
            for ($i = 0; $i < $res->count; $i++) {
                $result[$i]['id'] = $res->locations[$i]->id;
                $result[$i]['value'] = $res->locations[$i]->name;
            }
        }
        echo json_encode($result);
    }

    public function actionSearch_hotels() {
        $location = $_GET['location_id'];
        $check_in = $_GET['check_in'];
        $check_out = $_GET['check_out'];

        $guests = '1';

        $name = $_GET['name'];
        $rooms = $_GET['rooms'];

        if ($_GET['guests']) {
            $guests = $_GET['guests'];
        }

        $api_key = Yii::app()->params['api_key'];
        $ts_code = Yii::app()->params['ts_code'];

        $query = "";

        $query .= "&user_ip=" . $_SERVER['REMOTE_ADDR'];

        if ($location) {
            $query .= "&location_id=" . $location;
        }
        if ($check_in) {
            $query .= "&check_in=" . $check_in;
        }
        if ($check_out) {
            $query .= "&check_out=" . $check_out;
        }
        if ($rooms) {
            $query .= "&rooms=" . $rooms;
        }
        if ($guests) {
            $query .= "&guests=" . $guests;
        }
       //     $query .= "&price_min=" . 500;

        $currency = "GBP";
        if ($_GET['currency']) {
            $cur_ch = Currency::model()->findByAttributes(array('iso_code' => $_GET['currency']));
            if ($cur_ch) {
                $currency = $cur_ch->iso_code;
            }
        }

        $d1 = explode("/", $check_in);
        $r1 = explode("/", $check_out);

        $days = (mktime(0, 0, 0, $r1[1], $r1[0], $r1[2]) - mktime(0, 0, 0, $d1[1], $d1[0], $d1[2])) / (60 * 60 * 24);

        $data = @file_get_contents("http://uk.wego.com/hotels/api/search/new?key=" . $api_key . "&ts_code=" . $ts_code . $query);

        $res = json_decode($data);

        Yii::app()->session['hotel_search_keyword_' . $res->search_id] = $_GET['search_keyword'];
        Yii::app()->session['hotel_name_' . $res->search_id] = $name;
        Yii::app()->session['hotel_check_in_' . $res->search_id] = $check_in;
        Yii::app()->session['hotel_check_out_' . $res->search_id] = $check_out;
        Yii::app()->session['hotel_rooms_' . $res->search_id] = $rooms;
        Yii::app()->session['hotel_guests_' . $res->search_id] = $guests;
        Yii::app()->session['hotel_location_id_' . $res->search_id] = $location;
        //Yii::app()->session['price_min' . $res->search_id] = 500;


        //$this->redirect(array('hotel_results', 'search_id' => $res->search_id, 'currency' => $currency, 'flag' => 1));

        $this->render("hotel_waiting", array(
            'search_id' => $res->search_id,
            'currency' => $currency,
        ));
    }

    public function actionHotel_results() {
        $api_key = Yii::app()->params['api_key'];
        $ts_code = Yii::app()->params['ts_code'];

        $search_id = 0;
        if ($_GET['search_id']) {
            $search_id = $_GET['search_id'];
        } else {
            Yii::app()->setComponents(array(
                'errorHandler' => array(
                    'errorAction' => '/home/hotel_error'
                )
            ));
            throw new CHttpException(404, "this page doesn't exist");
        }
        $currency = "GBP";

        if (!(Yii::app()->session['hotel_search_keyword_' . $search_id] && Yii::app()->session['hotel_location_id_' . $search_id] && Yii::app()->session['hotel_check_in_' . $search_id] && Yii::app()->session['hotel_check_out_' . $search_id] && Yii::app()->session['hotel_rooms_' . $search_id] && Yii::app()->session['hotel_guests_' . $search_id])) {
            $this->redirect(array("index"));
        }


//        if ($_GET['currency']) {
//            $cur_ch = Currency::model()->findByAttributes(array('iso_code' => $_GET['currency']));
//            if ($cur_ch) {
//                $currency = $cur_ch->iso_code;
//            }
//        }

        $filter = 'popularity';
        $filter_key = 'popularity';
        $all_filters = array('popularity' => 'popularity', 'price' => 'price', 'name' => 'name', 'stars' => 'stars');
        if ($_GET['filter']) {
            if ($all_filters[$_GET['filter']]) {
                $filter = $all_filters[$_GET['filter']];
                $filter_key = $_GET['filter'];
            }
        }

        $order = 'desc';
        if ($_GET['order']) {
            if ($_GET['order'] == "asc") {
                $order = 'asc';
            }
        }

        $per_page = 15;
        $page = 1;
        if ($_GET['page']) {
            if ($_GET['page'] > 0 && $_GET['page'] <= 100) {
                $page = $_GET['page'];
            }
        }
        if($_GET['price_min']){
            $min_price = $_GET['price_min'];
        }
         if($_GET['price_max']){
            $max_price = $_GET['price_max'];
        }
        
         if($_GET['text_filter']){
            $text_filter = $_GET['text_filter'];
        }

        if($stars = $_GET['stars']){
            $output='';
            foreach ($stars as $star){
                $output.="&stars[]=".$star;
            }
            $star_filter = $output;
        }
        
         if($amenities = $_GET['amenities']){
            $output='';
            foreach ($amenities as $amenity){
                $output.="&amenities[]=".$amenity;
            }
            $amenities_filter = $output;
        }
         if($property_types = $_GET['property_types']){
            $output='';
            foreach ($property_types as $property_type){
                $output.="&property_types[]=".$property_type;
            }
            $property_types = $output;
        }
//        echo $property_types;die;

        
        if (Yii::app()->session['hotel_name_' . $search_id]) {
            $name = Yii::app()->session['hotel_name_' . $search_id];
            Yii::app()->session['hotel_name_' . $search_id] = '';
        }
        //echo "http://api.wego.com/hotels/api/search/" . $search_id . "?currency_code=" . $currency . "&sort=" . $filter . "&order=" . $order . "&page=" . $page . "&per_page=" . $per_page . "&refresh=true&text_filter=" . $name . "&key=" . $api_key . "&ts_code=" . $ts_code;die;
        $data2 = @file_get_contents("http://api.wego.com/hotels/api/search/" . $search_id . "?currency_code=" . $currency . "&sort=" . $filter . "&order=" . $order . "&page=" . $page . "&per_page=" . $per_page . "&refresh=true&text_filter=" . $name . "&key=" . $api_key . "&ts_code=" . $ts_code."&price_min=".$min_price."&max_price=".$max_price."&text_filter=".$text_filter.$star_filter.$amenities_filter.$property_types);
        $res2 = json_decode($data2);

        $total_pages = ceil($res2->total_count / $per_page);

        $hotels = $res2->hotels;
        $hotel_location = $res2->location;

        $d1 = explode("/", Yii::app()->session['hotel_check_in_' . $search_id]);
        $r1 = explode("/", Yii::app()->session['hotel_check_out_' . $search_id]);

        $days = (mktime(0, 0, 0, $r1[1], $r1[0], $r1[2]) - mktime(0, 0, 0, $d1[1], $d1[0], $d1[2])) / (60 * 60 * 24);
//        echo '<pre>';
// print_r($res2);
// echo '<pre>';die;
        $this->render("hotels_search", array(
            'hotels' => $hotels,
            'hotel_location' => $hotel_location,
            'from' => Yii::app()->session['hotel_check_in_' . $search_id],
            'to' => Yii::app()->session['hotel_check_out_' . $search_id],
            'per_page' => $per_page,
            'total_pages' => $total_pages,
            'page' => $page,
            'rooms' => Yii::app()->session['hotel_rooms_' . $search_id],
            'search_keyword' => Yii::app()->session['hotel_search_keyword_' . $search_id],
            'location_id' => Yii::app()->session['hotel_location_id_' . $search_id],
            'days' => $days,
            'name' => Yii::app()->session['hotel_name_' . $search_id],
            'guests' => Yii::app()->session['hotel_guests_' . $search_id],
            'search_id' => $search_id,
            'currency' => $currency,
            'filter' => $filter,
            'order' => $order,
            'filter_key' => $filter_key
        ));
    }

    public function actionHotel_details($search_id = 0, $id = 0, $days = 0, $rooms = 0) {
        if ($id & $search_id && $days > 0 && $days < 1000 && $rooms > 0 && $rooms < 1000) {

            $api_key = Yii::app()->params['api_key'];
            $ts_code = Yii::app()->params['ts_code'];

            $currency = "GBP";
            if ($_GET['currency']) {
                $cur_ch = Currency::model()->findByAttributes(array('iso_code' => $_GET['currency']));
                if ($cur_ch) {
                    $currency = $cur_ch->iso_code;
                }
            }

            $test = @file_get_contents("http://uk.wego.com/hotels/api/search/show/historical?key=" . $api_key . "&ts_code=" . $ts_code . "&hotel_id=" . $id);
            $hotel = json_decode($test);

            //print_r($hotel->summary_room_rates);die;
            $test2 = @file_get_contents("http://uk.wego.com/hotels/api/search/" . $search_id . "?currency_code=" . $currency . "&key=" . $api_key . "&ts_code=" . $ts_code . "&hotel_id=" . $id . "&room_rate_id=");
            $hotel_rates = json_decode($test2);
            $this->render('hotel_detail', array('hotel' => $hotel, 'rates' => $hotel_rates->hotel->room_rates, 'search_id' => $search_id, 'days' => $days, 'rooms' => $rooms, 'currency' => $currency));
        } else {
            throw new CHttpException(404, "this page doesn't exist");
        }
    }

    public function actionBook($hotel_id = 0, $room_id = 0, $search_id = 0) {
        if ($hotel_id && $search_id && $room_id) {
            $api_key = Yii::app()->params['api_key'];
            $ts_code = Yii::app()->params['ts_code'];
            $this->redirect("http://uk.wego.com/hotels/api/search/redirect/" . $search_id . "?key=" . $api_key . "&ts_code=" . $ts_code . "&hotel_id=" . $hotel_id . "&room_rate_id=" . $room_id);
        } else {
            throw new CHttpException(404, "this page doesn't exist");
        }
    }

    public function actionIata_search() {
        $result = array();
        $chk = array();
        $query = $_GET['term'];
        $i = 0;


        //echo 'select * from iata_codes where (LCASE(name) like "%' . strtolower($_GET['term']) . '%" or LCASE(iata_code) like "%' . strtolower($_GET['term']) . '%" or LCASE(city_code) like "%' . strtolower($_GET['term']) . '%" or LCASE(country_code) like "%' . strtolower($_GET['term']) . '%" or  LCASE(city_name) like "%' . strtolower($_GET['term']) . '%" or LCASE(country_name) like "%' . strtolower($_GET['term']) . '%" ) order by app_location_type asc';die;
        $name_codes = IataCodes::model()->findAllBySql('select * from iata_codes where (LCASE(name) like "%' . strtolower($_GET['term']) . '%" or LCASE(iata_code) like "%' . strtolower($_GET['term']) . '%" or LCASE(city_code) like "%' . strtolower($_GET['term']) . '%" or LCASE(country_code) like "%' . strtolower($_GET['term']) . '%" or  LCASE(city_name) like "%' . strtolower($_GET['term']) . '%" or LCASE(country_name) like "%' . strtolower($_GET['term']) . '%" ) order by app_location_type desc');

        if ($name_codes) {
            foreach ($name_codes as $res) {

                if ($res->app_location_type == "Airport") {
                    $result[$i]['id'] = $res->iata_code;
                    $result[$i]['value'] = $res->name . ", " . $res->country_name;
                } else {
                    $airports = IataCodes::model()->findAllBySql('select * from iata_codes where city_name="' . $res->name . '" and app_location_type="Airport" and country_name="' . $res->country_name . '"');
                    //echo 'select * from iata_codes where city_name="'.$res->name.'" and app_location_type="Airport" and country_name="'.$res->country_name.'"';
                    if (count($airports) > 1) {
                        $result[$i]['value'] = $res->name . " (Any), " . $res->country_name;
                    } else {
                        $result[$i]['value'] = $res->name . ", " . $res->country_name;
                    }
                    $result[$i]['id'] = $res->iata_code;
                }

                if (!in_array($result[$i]['value'], $chk)) {
                    $chk[] = $result[$i]['value'];
                } else {
                    array_pop($result);
                }

                $i++;
                //}
            }
        }
        sort($result);
        echo json_encode($result);
    }

    public function actionSearch_flights() {

        $from = $_GET['from'];
        $to = $_GET['to'];


        $d1 = explode("/", $_GET['depart']);
        $depart = $d1[2] . "-" . $d1[1] . "-" . $d1[0];
        if (!checkdate($d1[1], $d1[0], $d1[2])) {
            $depart = date("Y-m-d", time() + (60 * 60 * 24));
        }

        if ($_GET['return']) {
            $r1 = explode("/", $_GET['return']);
            $return = $r1[2] . "-" . $r1[1] . "-" . $r1[0];
            if (!checkdate($r1[1], $r1[0], $r1[2])) {
                $return = date("Y-m-d", time() + (60 * 60 * 24 * 7));
            }
        }

        $class = $_GET['class'];
        if (!in_array($class, array("economy", "business", "first"))) {
            $class = "economy";
        }

        $adults = 1;
        if ($_GET['adults'] && $_GET['adults'] > 0 && $_GET['adults'] <= 10) {
            $adults = $_GET['adults'];
        }

        $children = 0;
        if ($_GET['children'] && $_GET['children'] >= 0 && $_GET['children'] <= 10) {
            $children = $_GET['children'];
        }

        $api_key = Yii::app()->params['api_key'];
        $ts_code = Yii::app()->params['ts_code'];

        $type = "oneWay";

        $inbound_flag = false;
        if ($_GET['type']) {
            if ($_GET['type'] == "roundTrip") {
                if ($return) {
                    $type = 'roundTrip';
                    $inbound_flag = true;
                }
            }
        }

        $dep_city_flag = false;
        $dep_loc = IataCodes::model()->findByAttributes(array('iata_code' => $from));
        if ($dep_loc->app_location_type == "CITY") {
            $dep_city_flag = true;
        }


        $arr_city_flag = false;
        $arr_loc = IataCodes::model()->findByAttributes(array('iata_code' => $to));
        if ($arr_loc->app_location_type == "CITY") {
            $arr_city_flag = true;
        }


        $currency = "GBP";
        if ($_GET['currency']) {
            $cur_ch = Currency::model()->findByAttributes(array('iso_code' => $_GET['currency']));
            if ($cur_ch) {
                // echo $currency = $cur_ch->iso_code;die;
            }
        }
        //  print_r($cur_ch);die;
        //get search id
        $dt = array();
        $dt[0] = array(
            "departure_code" => $from,
            "arrival_code" => $to,
            "outbound_date" => $depart,
            'departure_city' => $dep_city_flag,
            'arrival_city' => $arr_city_flag
        );

        if ($inbound_flag) {
            $dt[0]['inbound_date'] = $return;
        }


        $data = array(
            "trips" => $dt,
            "adults_count" => $adults,
            "children_count" => $children,
            "cabin" => $class
        );



        //print_r($data);
        //echo 'http://api.wego.com/flights/api/k/2/searches?api_key=' . $api_key . '&ts_code=' . $ts_code;
        $result = Helper::do_curl('http://api.wego.com/flights/api/k/2/searches?api_key=' . $api_key . '&ts_code=' . $ts_code, $data);
        $test = json_decode($result);

        Yii::app()->session['flight_from_airport_' . $test->id] = $_GET['from_airport'];
        Yii::app()->session['flight_to_airport_' . $test->id] = $_GET['to_airport'];
        Yii::app()->session['flight_from_' . $test->id] = $_GET['from'];
        Yii::app()->session['flight_to_' . $test->id] = $_GET['to'];
        Yii::app()->session['flight_depart_' . $test->id] = $_GET['depart'];
        if ($type == 'roundTrip') {
            Yii::app()->session['flight_return_' . $test->id] = $_GET['return'];
        }
        Yii::app()->session['flight_cabin_' . $test->id] = $class;
        Yii::app()->session['flight_adults_' . $test->id] = $adults;
        Yii::app()->session['flight_children_' . $test->id] = $children;
        Yii::app()->session['flight_type_' . $test->id] = $type;



        //$this->redirect(array('flight_results', 'search_id' => $test->id, 'trip_id'=>$test->trips[0]->id,'currency' => $currency, 'flag' => 1));

        $this->render('flight_waiting', array(
            'search_id' => $test->id,
            'trip_id' => $test->trips[0]->id,
            'currency' => $currency,
        ));
    }

    public function actionFlight_results() {
        $api_key = Yii::app()->params['api_key'];
        $ts_code = Yii::app()->params['ts_code'];

        $search_id = 0;
        $trip_id = 0;
        if ($_GET['search_id'] && $_GET['trip_id']) {
            $search_id = $_GET['search_id'];
            $trip_id = $_GET['trip_id'];
        } else {
            Yii::app()->setComponents(array(
                'errorHandler' => array(
                    'errorAction' => '/home/flight_error'
                )
            ));
            throw new CHttpException(404, "this page doesn't exist");
        }

        $filter = 'price';
        $filter_key = 'price';
        $all_filters = array('price' => 'price', 'depart' => 'outbound_departure_time', 'duration' => 'duration');
        if ($_GET['filter']) {
            if ($all_filters[$_GET['filter']]) {
                $filter = $all_filters[$_GET['filter']];
                $filter_key = $_GET['filter'];
            }
        }

        $order = 'asc';
        if ($_GET['order']) {
            if ($_GET['order'] == "desc") {
                $order = 'desc';
            }
        }

        $page = 1;
        if ($_GET['page']) {
            if ($_GET['page'] >= 1 && $_GET['page'] <= 100) {
                $page = $_GET['page'];
            }
        }
        $per_page = 6;

        $currency = "GBP";
        if ($_GET['currency']) {
            $cur_ch = Currency::model()->findByAttributes(array('iso_code' => $_GET['currency']));
            if ($cur_ch) {
                $currency = $cur_ch->iso_code;
            }
        }
        
          if ($_GET['price_min_usd']) {
                $price_min_usd = $_GET['price_min_usd'];
          }
          
          if ($_GET['price_max_usd']) {
                $price_max_usd = $_GET['price_max_usd'];
          }

        if ($_GET['stop_types']) {
                $stop_types = $_GET['stop_types'];
          }
          if ($_GET['stopover_duration_min']) {
                $stopover_duration_min = $_GET['stopover_duration_min'];
          }
           if ($_GET['stopover_duration_max']) {
                $stopover_duration_max = $_GET['stopover_duration_max'];
          }
           if ($_GET['duration_min']) {
                $duration_min = $_GET['duration_min'];
          }
          
            if ($_GET['duration_max']) {
                $duration_max = $_GET['duration_max'];
          }
          
            if ($_GET['departure_day_time_filter_type']) {
                $departure_day_time_filter_type = $_GET['departure_day_time_filter_type'];
          }
          
            if ($_GET['outbound_departure_day_time_min']) {
                $outbound_departure_day_time_min = $_GET['outbound_departure_day_time_min'];
          }
          
            if ($_GET['outbound_departure_day_time_max']) {
                $outbound_departure_day_time_max = $_GET['outbound_departure_day_time_max'];
          }
          
            if ($_GET['inbound_departure_day_time_min']) {
                $inbound_departure_day_time_min = $_GET['inbound_departure_day_time_min'];
          }
          
            if ($_GET['inbound_departure_day_time_max']) {
                $inbound_departure_day_time_max = $_GET['inbound_departure_day_time_max'];
          }
          
              if ($_GET['departure_airport_codes']) {
                $departure_airport_codes = $_GET['departure_airport_codes'];
          }
             if ($_GET['arrival_airport_codes']) {
                $arrival_airport_codes = $_GET['arrival_airport_codes'];
          }
          
         if ($_GET['designator_codes']) {
                $designator_codes = $_GET['designator_codes'];
          }
          
          $df = array(
            "id" => md5(time() . "-" . rand(0, 999999999)),
            "search_id" => $search_id,
            "trip_id" => $trip_id,
            "fares_query_type" => "route",
            "currency_code" => "GBP",
            "page" => $page,
            "per_page" => $per_page,
            "sort" => $filter,
            "order" => $order,
            'currency_code' => $currency,
            'price_min_usd'=>$price_min_usd,
            'price_max_usd'=>$price_max_usd,
            'stop_types'=>$stop_types,
            'stopover_duration_min'=>$stopover_duration_min,
            'stopover_duration_max'=>$stopover_duration_max,
            'duration_min'=>$duration_min  ,
            'duration_max'=>$duration_max,
            'departure_day_time_filter_type'=>$departure_day_time_filter_type,
            'outbound_departure_day_time_min'=>$outbound_departure_day_time_min,
            'outbound_departure_day_time_max'=>$outbound_departure_day_time_max,
            'inbound_departure_day_time_min'=>$inbound_departure_day_time_min,
            'inbound_departure_day_time_max'=>$inbound_departure_day_time_max ,
            'arrival_airport_codes'=>$arrival_airport_codes,
              'departure_airport_codes'=>$departure_airport_codes,
              'designator_codes'=>$designator_codes
              
        );

        $rf = Helper::do_curl('http://api.wego.com/flights/api/k/2/fares?api_key=' . $api_key . '&ts_code=' . $ts_code, $df);

        $fls_data = json_decode($rf);

        $flights = $fls_data->routes;
        
        $airlines = array();
        $departures = array();
        $arrivals = array();
        $providers = array();
        foreach ($flights as $flight){
            $outbounds = $flight->outbound_segments;
            foreach ($outbounds as $outbound){
               $airlines[] = $outbound->airline_name.'--'.$outbound->airline_code; 
               $departures[] = $outbound->departure_name.'--'.$outbound->departure_code; 
               $arrivals[] = $outbound->arrival_name.'--'.$outbound->arrival_code; 
            }
        }
        $airlines= array_unique($airlines);
        $departures= array_unique($departures);
        $arrivals= array_unique($arrivals);
        
        
         foreach ($flights as $flight){
            $fares_ = $flight->fares;
            foreach ($fares_ as $far){
               $providers[] = $far->provider_code; 
              
            }
        }
        $providers= array_unique($providers);
        
        
//        echo '<pre>';
//print_r($flights);
//echo '<pre>';die;
        $routes_count = $fls_data->routes_count;
        $total_pages = ceil($routes_count / $per_page);

//        if($_GET['flag']!='oo'){
//        if (!(Yii::app()->session['flight_from_airport_' . $search_id] && Yii::app()->session['flight_to_airport_' . $search_id] && Yii::app()->session['flight_from_' . $search_id] && Yii::app()->session['flight_to_' . $search_id] && Yii::app()->session['flight_depart_' . $search_id] && Yii::app()->session['flight_cabin_' . $search_id] && Yii::app()->session['flight_adults_' . $search_id] && Yii::app()->session['flight_type_' . $search_id])) {
//            $this->redirect(array("index"));
//        }
      //  }

        $this->render('flights_0', array(
            'flights' => $flights,
            'url_query' => $url_query,
            'total_pages' => $total_pages,
            'page' => $page,
            'per_page' => $per_page,
            'depart' => Yii::app()->session['flight_depart_' . $search_id],
            'return' => Yii::app()->session['flight_return_' . $search_id],
            'from_airport' => Yii::app()->session['flight_from_airport_' . $search_id],
            'to_airport' => Yii::app()->session['flight_to_airport_' . $search_id],
            'from' => Yii::app()->session['flight_from_' . $search_id],
            'to' => Yii::app()->session['flight_to_' . $search_id],
            'cabin' => Yii::app()->session['flight_cabin_' . $search_id],
            'adults' => Yii::app()->session['flight_adults_' . $search_id],
            'childs' => Yii::app()->session['flight_children_' . $search_id],
            'type' => Yii::app()->session['flight_type_' . $search_id],
            'currency' => $fls_data->currency->code,
            'search_id' => $search_id,
            'trip_id' => $trip_id,
            'user_currency' => $currency,
            'filter' => $filter,
            'order' => $order,
            'filter_key' => $filter_key,
            'airlines'=>$airlines,
            'departures'=>$departures,
            'arrivals'=>$arrivals,
            'providers'=>$providers
        ));
    }

    public function actionOpt_search() {
        $from = $_GET['from'];
        $to = $_GET['to'];

        $flag = false;

        $d1 = explode("/", $_GET['depart']);
        $depart = $d1[2] . "-" . $d1[1] . "-" . $d1[0];
        if (!checkdate($d1[1], $d1[0], $d1[2])) {
            $depart = date("Y-m-d", time() + (60 * 60 * 24));
            $flag = true;
        }


        $r1 = explode("/", $_GET['return']);
        $return = $r1[2] . "-" . $r1[1] . "-" . $r1[0];
        if (!checkdate($r1[1], $r1[0], $r1[2])) {
            $return = date("Y-m-d", time() + (60 * 60 * 24 * 7));
            $flag = true;
        }

        $days = (mktime(0, 0, 0, $r1[1], $r1[0], $r1[2]) - mktime(0, 0, 0, $d1[1], $d1[0], $d1[2])) / (60 * 60 * 24);
        if ($flag) {
            $days = 1;
        }

        $class = $_GET['class'];
        if (!in_array($class, array("economy", "business", "first"))) {
            $class = "economy";
        }

        $adults = 1;
        if ($_GET['adults'] && $_GET['adults'] > 0 && $_GET['adults'] <= 10) {
            $adults = $_GET['adults'];
        }

        $children = 0;
        if ($_GET['children'] && $_GET['children'] >= 0 && $_GET['children'] <= 10) {
            $children = $_GET['children'];
        }

        $rooms = '1';

        $location = $_GET['location_id'];

        $guests = $adults + $children;

        $name = $_GET['name'];

        if ($_GET['rooms']) {
            $rooms = $_GET['rooms'];
        }


        $api_key = Yii::app()->params['api_key'];
        $ts_code = Yii::app()->params['ts_code'];

        $currency = "GBP";
        if ($_GET['currency']) {
            $cur_ch = Currency::model()->findByAttributes(array('iso_code' => $_GET['currency']));
            if ($cur_ch) {
                $currency = $cur_ch->iso_code;
            }
        }


        $dep_city_flag = false;
        $dep_loc = IataCodes::model()->findByAttributes(array('iata_code' => $from));
        if ($dep_loc->app_location_type == "CITY") {
            $dep_city_flag = true;
        }

        $arr_city_flag = false;
        $arr_loc = IataCodes::model()->findByAttributes(array('iata_code' => $to));
        if ($arr_loc->app_location_type == "CITY") {
            $arr_city_flag = true;
        }

        $dt = array();
        $dt[0] = array(
            "departure_code" => $from,
            "arrival_code" => $to,
            "outbound_date" => $depart,
            'departure_city' => $dep_city_flag,
            'arrival_city' => $arr_city_flag,
            'inbound_date' => $return
        );

        $data = array(
            "trips" => $dt,
            "adults_count" => $adults,
            "children_count" => $children,
            "cabin" => $class
        );

        $fresult = Helper::do_curl('http://api.wego.com/flights/api/k/2/searches?api_key=' . $api_key . '&ts_code=' . $ts_code, $data);
        $flights_data2 = json_decode($fresult);


        $query = "";

        $query .= "&user_ip=" . $_SERVER['REMOTE_ADDR'];

        if ($location) {
            $query .= "&location_id=" . $location;
        }

        $query .= "&check_in=" . $_GET['depart'];
        $query .= "&check_out=" . $_GET['return'];
        if ($rooms) {
            $query .= "&rooms=" . $rooms;
        }
        if ($guests) {
            $query .= "&guests=" . $guests;
        }


        $hdata = @file_get_contents("http://uk.wego.com/hotels/api/search/new?key=" . $api_key . "&ts_code=" . $ts_code . $query);
        $hres = json_decode($hdata);
        //print_r($hres);die;

        Yii::app()->session['opt_hotel_search_keyword_' . $flights_data2->id . $hres->search_id] = $_GET['search_keyword'];
        Yii::app()->session['opt_hotel_location_' . $flights_data2->id . $hres->search_id] = $location;
        Yii::app()->session['opt_from_airport_' . $flights_data2->id . $hres->search_id] = $_GET['from_airport'];
        Yii::app()->session['opt_to_airport_' . $flights_data2->id . $hres->search_id] = $_GET['to_airport'];
        Yii::app()->session['opt_from_' . $flights_data2->id . $hres->search_id] = $_GET['from'];
        Yii::app()->session['opt_to_' . $flights_data2->id . $hres->search_id] = $_GET['to'];
        Yii::app()->session['opt_depart_' . $flights_data2->id . $hres->search_id] = $_GET['depart'];
        Yii::app()->session['opt_return_' . $flights_data2->id . $hres->search_id] = $_GET['return'];
        Yii::app()->session['opt_cabin_' . $flights_data2->id . $hres->search_id] = $class;
        Yii::app()->session['opt_adults_' . $flights_data2->id . $hres->search_id] = $adults;
        Yii::app()->session['opt_children_' . $flights_data2->id . $hres->search_id] = $children;
        Yii::app()->session['opt_name_' . $flights_data2->id . $hres->search_id] = $name;
        Yii::app()->session['opt_rooms_' . $flights_data2->id . $hres->search_id] = $rooms;

        if (!Yii::app()->user->isGuest) {

            $search_data = array();

            $search_data['search_keyword'] = $_GET['search_keyword'];
            $search_data['location_id'] = $location;
            $search_data['name'] = $name;
            $search_data['from_airport'] = $_GET['from_airport'];
            $search_data['to_airport'] = $_GET['to_airport'];
            $search_data['check_in'] = $_GET['depart'];
            $search_data['from'] = $_GET['from'];
            $search_data['to'] = $_GET['to'];
            $search_data['return'] = $_GET['return'];
            $search_data['cabin'] = $class;
            $search_data['adults'] = $adults;
            $search_data['children'] = $children;
            $search_data['currency'] = $currency;
            $search_data['rooms'] = $rooms;

            $criteria = new CDbCriteria;
            $criteria->condition = "hash = '" . sha1(serialize($search_data)) . "'";
            $criteria->addCondition("type = 'all'");
            $criteria->addCondition("user_id = " . Yii::app()->user->id);
            $hist = SearchHistory::model()->findAll($criteria);
            if (!$hist) {
                $hist = new SearchHistory;
                $hist->user_id = Yii::app()->user->id;
                $hist->date = time();
                $hist->type = "all";
                $hist->data = serialize($search_data);
                $hist->hash = sha1(serialize($search_data));
                $hist->save(false);
            }
        }

        //$this->redirect(array('one_plus_two', 'trip_id' => $flights_data2->trips[0]->id, 'flight_search_id' => $flights_data2->id, 'hotel_search_id' => $hres->search_id, 'currency' => $currency, 'flag'=>1));

        $this->render("opt_waiting", array(
            'trip_id' => $flights_data2->trips[0]->id,
            'flight_search_id' => $flights_data2->id,
            'hotel_search_id' => $hres->search_id,
            'currency' => $currency,
        ));
    }

    public function actionFlight_hotel() {
        $api_key = Yii::app()->params['api_key'];
        $ts_code = Yii::app()->params['ts_code'];

        $flight_search_id = 0;
        $hotel_search_id = 0;
        $trip_id = 0;
        if ($_GET['flight_search_id'] && $_GET['trip_id'] && $_GET['hotel_search_id']) {
            $flight_search_id = $_GET['flight_search_id'];
            $hotel_search_id = $_GET['hotel_search_id'];
            $trip_id = $_GET['trip_id'];
        } else {
            throw new CHttpException(404, "this page doesn't exist");
        }

        $currency = "GBP";
        if ($_GET['currency']) {
            $cur_ch = Currency::model()->findByAttributes(array('iso_code' => $_GET['currency']));
            if ($cur_ch) {
                $currency = $cur_ch->iso_code;
            }
        }

        $h_filter = 'popularity';
        $h_filter_key = 'popularity';
        $h_all_filters = array('popularity' => 'popularity', 'price' => 'price', 'name' => 'name', 'stars' => 'stars');
        if ($_GET['h_filter']) {
            if ($h_all_filters[$_GET['h_filter']]) {
                $h_filter = $h_all_filters[$_GET['h_filter']];
                $h_filter_key = $_GET['h_filter'];
            }
        }

        $h_order = 'desc';
        if ($_GET['h_order']) {
            if ($_GET['h_order'] == "asc") {
                $h_order = 'asc';
            }
        }



        $f_filter = 'price';
        $f_filter_key = 'price';
        $f_all_filters = array('price' => 'price', 'depart' => 'outbound_departure_time', 'duration' => 'duration');
        if ($_GET['f_filter']) {
            if ($f_all_filters[$_GET['f_filter']]) {
                $f_filter = $f_all_filters[$_GET['f_filter']];
                $f_filter_key = $_GET['f_filter'];
            }
        }

        $f_order = 'asc';
        if ($_GET['f_order']) {
            if ($_GET['f_order'] == "desc") {
                $f_order = 'desc';
            }
        }

        //flight search
        $df = array(
            "id" => md5(time() . "-" . rand(0, 999999999)),
            "search_id" => $flight_search_id,
            "trip_id" => $trip_id,
            "fares_query_type" => "route",
            "currency_code" => "GBP",
            "sort" => $f_filter,
            "order" => $f_order,
            'currency_code' => $currency,
            "per_page" => 30,
            'page' => 1
        );

        $rf = Helper::do_curl('http://api.wego.com/flights/api/k/2/fares?api_key=' . $api_key . '&ts_code=' . $ts_code, $df);
        $fls_data = json_decode($rf);
        $flights = $fls_data->routes;

        $df = array(
            "id" => md5(time() . "-" . rand(0, 999999999)),
            "search_id" => $flight_search_id,
            "trip_id" => $trip_id,
            "fares_query_type" => "route",
            "currency_code" => "GBP",
            "sort" => $f_filter,
            "order" => $f_order,
            'currency_code' => $currency,
            "per_page" => 30,
            'page' => 2
        );

        $rf = Helper::do_curl('http://api.wego.com/flights/api/k/2/fares?api_key=' . $api_key . '&ts_code=' . $ts_code, $df);
        $fls_data2 = json_decode($rf);
        if ($fls_data2->routes) {
            $flights = array_merge($flights, $fls_data2->routes);
        }

        //echo $rf;die;
        //hotel search

        if (Yii::app()->session['opt_name_' . $flight_search_id . $hotel_search_id]) {
            $name = Yii::app()->session['opt_name_' . $flight_search_id . $hotel_search_id];
            Yii::app()->session['opt_name_' . $flight_search_id . $hotel_search_id] = '';
        }

        $data2 = @file_get_contents("http://uk.wego.com/hotels/api/search/" . $hotel_search_id . "?currency_code=" . $currency . "&sort=" . $h_filter . "&order=" . $h_order . "&page=1&per_page=30&refresh=true&key=" . $api_key . "&ts_code=" . $ts_code . "&text_filter=" . $name);
        $res2 = json_decode($data2);


        $hotels = $res2->hotels;
        $hotel_location = $res2->location;

        $data2 = @file_get_contents("http://uk.wego.com/hotels/api/search/" . $hotel_search_id . "?currency_code=" . $currency . "&sort=" . $h_filter . "&order=" . $h_order . "&page=2&per_page=30&refresh=true&key=" . $api_key . "&ts_code=" . $ts_code . "&text_filter=" . $name);
        $res3 = json_decode($data2);

        if ($res3->hotels) {
            $hotels = array_merge($hotels, $res3->hotels);
        }

        //echo Yii::app()->session['opt_hotel_search_keyword_' . $flight_search_id . $hotel_search_id] ."====". Yii::app()->session['opt_rooms_' . $flight_search_id . $hotel_search_id] ."====". Yii::app()->session['opt_hotel_location_' . $flight_search_id . $hotel_search_id] ."====". Yii::app()->session['opt_from_airport_' . $flight_search_id . $hotel_search_id] ."====". Yii::app()->session['opt_to_airport_' . $flight_search_id . $hotel_search_id] ."====". Yii::app()->session['opt_from_' . $flight_search_id . $hotel_search_id] ."====". Yii::app()->session['opt_to_' . $flight_search_id . $hotel_search_id] ."====". Yii::app()->session['opt_depart_' . $flight_search_id . $hotel_search_id] ."====". Yii::app()->session['opt_return_' . $flight_search_id . $hotel_search_id] ."====". Yii::app()->session['opt_cabin_' . $flight_search_id . $hotel_search_id] ."====". Yii::app()->session['opt_adults_' . $flight_search_id . $hotel_search_id];die;

        if (!(Yii::app()->session['opt_hotel_search_keyword_' . $flight_search_id . $hotel_search_id] && Yii::app()->session['opt_rooms_' . $flight_search_id . $hotel_search_id] && Yii::app()->session['opt_hotel_location_' . $flight_search_id . $hotel_search_id] && Yii::app()->session['opt_from_airport_' . $flight_search_id . $hotel_search_id] && Yii::app()->session['opt_to_airport_' . $flight_search_id . $hotel_search_id] && Yii::app()->session['opt_from_' . $flight_search_id . $hotel_search_id] && Yii::app()->session['opt_to_' . $flight_search_id . $hotel_search_id] && Yii::app()->session['opt_depart_' . $flight_search_id . $hotel_search_id] && Yii::app()->session['opt_return_' . $flight_search_id . $hotel_search_id] && Yii::app()->session['opt_cabin_' . $flight_search_id . $hotel_search_id] && Yii::app()->session['opt_adults_' . $flight_search_id . $hotel_search_id])) {
            $this->redirect(array('index'));
        }

        $r1 = explode("/", Yii::app()->session['opt_return_' . $flight_search_id . $hotel_search_id]);
        $d1 = explode("/", Yii::app()->session['opt_depart_' . $flight_search_id . $hotel_search_id]);
        $days = (mktime(0, 0, 0, $r1[1], $r1[0], $r1[2]) - mktime(0, 0, 0, $d1[1], $d1[0], $d1[2])) / (60 * 60 * 24);


        $this->render("one_plus_two", array(
            'hotels' => $hotels,
            'flights' => $flights,
            'from_airport' => Yii::app()->session['opt_from_airport_' . $flight_search_id . $hotel_search_id],
            'to_airport' => Yii::app()->session['opt_to_airport_' . $flight_search_id . $hotel_search_id],
            'from' => Yii::app()->session['opt_from_' . $flight_search_id . $hotel_search_id],
            'to' => Yii::app()->session['opt_to_' . $flight_search_id . $hotel_search_id],
            'depart' => Yii::app()->session['opt_depart_' . $flight_search_id . $hotel_search_id],
            'return' => Yii::app()->session['opt_return_' . $flight_search_id . $hotel_search_id],
            'days' => $days,
            'location_id' => Yii::app()->session['opt_hotel_location_' . $flight_search_id . $hotel_search_id],
            'search_keyword' => Yii::app()->session['opt_hotel_search_keyword_' . $flight_search_id . $hotel_search_id],
            'name' => Yii::app()->session['opt_name_' . $flight_search_id . $hotel_search_id],
            'rooms' => Yii::app()->session['opt_rooms_' . $flight_search_id . $hotel_search_id],
            'cabin' => Yii::app()->session['opt_cabin_' . $flight_search_id . $hotel_search_id],
            'adults' => Yii::app()->session['opt_adults_' . $flight_search_id . $hotel_search_id],
            'childs' => Yii::app()->session['opt_children_' . $flight_search_id . $hotel_search_id],
            'currency' => $fls_data->currency->code,
            'hotel_search_id' => $hotel_search_id,
            'flight_search_id' => $flight_search_id,
            'trip_id' => $trip_id,
            'user_currency' => $currency,
            'h_filter' => $h_filter,
            'h_order' => $h_order,
            'h_filter_key' => $h_filter_key,
            'f_filter' => $f_filter,
            'f_order' => $f_order,
            'f_filter_key' => $f_filter_key
        ));
    }
    
    
    
    
    public function ActionGetDefaultHotels(){
        $location = 8678;
        $check_in = date('d/m/Y');
        $check_out = date("d/m/Y", time()+86400); 

        $guests = '1';

        //$name = $_GET['name'];
        $rooms = 1;
        $guests=1;
       

        $api_key = Yii::app()->params['api_key'];
        $ts_code = Yii::app()->params['ts_code'];

        $query = "";

        $query .= "&user_ip=" . $_SERVER['REMOTE_ADDR'];

        if ($location) {
            $query .= "&location_id=" . $location;
        }
        if ($check_in) {
            $query .= "&check_in=" . $check_in;
        }
        if ($check_out) {
            $query .= "&check_out=" . $check_out;
        }
        if ($rooms) {
            $query .= "&rooms=" . $rooms;
        }
        if ($guests) {
            $query .= "&guests=" . $guests;
        }
       //     $query .= "&price_min=" . 500;

        $currency = "GBP";
      

        $d1 = explode("/", $check_in);
        $r1 = explode("/", $check_out);

        $days = (mktime(0, 0, 0, $r1[1], $r1[0], $r1[2]) - mktime(0, 0, 0, $d1[1], $d1[0], $d1[2])) / (60 * 60 * 24);

        $data = @file_get_contents("http://uk.wego.com/hotels/api/search/new?key=" . $api_key . "&ts_code=" . $ts_code . $query);

        $res = json_decode($data);
           //print_r($res);
        echo($res->search_id);
    }
    
    public function ActionGetHotelsResults(){
        
        
        $api_key = Yii::app()->params['api_key'];
        $ts_code = Yii::app()->params['ts_code'];

        $search_id = $_POST['search_id'];
//        if ($search_id) {
//            $search_id = $_GET['search_id'];
//        } else {
//            Yii::app()->setComponents(array(
//                'errorHandler' => array(
//                    'errorAction' => '/home/hotel_error'
//                )
//            ));
//            throw new CHttpException(404, "this page doesn't exist");
//        }
        $currency = "GBP";

//        if (!(Yii::app()->session['hotel_search_keyword_' . $search_id] && Yii::app()->session['hotel_location_id_' . $search_id] && Yii::app()->session['hotel_check_in_' . $search_id] && Yii::app()->session['hotel_check_out_' . $search_id] && Yii::app()->session['hotel_rooms_' . $search_id] && Yii::app()->session['hotel_guests_' . $search_id])) {
//            $this->redirect(array("index"));
//        }


//        if ($_GET['currency']) {
//            $cur_ch = Currency::model()->findByAttributes(array('iso_code' => $_GET['currency']));
//            if ($cur_ch) {
//                $currency = $cur_ch->iso_code;
//            }
//        }
//
//        $filter = 'popularity';
//        $filter_key = 'popularity';
//        $all_filters = array('popularity' => 'popularity', 'price' => 'price', 'name' => 'name', 'stars' => 'stars');
//        if ($_GET['filter']) {
//            if ($all_filters[$_GET['filter']]) {
//                $filter = $all_filters[$_GET['filter']];
//                $filter_key = $_GET['filter'];
//            }
//        }
//
//        $order = 'desc';
//        if ($_GET['order']) {
//            if ($_GET['order'] == "asc") {
//                $order = 'asc';
//            }
//        }
//
        $per_page = 9;
        $page = 1;
        if ($_POST['page']) {
            if ($_POST['page'] > 0 && $_POST['page'] <= 100) {
                $page = $_POST['page'];
            }
        }
//        if($_GET['price_min']){
//            $min_price = $_GET['price_min'];
//        }
//         if($_GET['price_max']){
//            $max_price = $_GET['price_max'];
//        }
//        
//         if($_GET['text_filter']){
//            $text_filter = $_GET['text_filter'];
//        }
//
//        if($stars = $_GET['stars']){
//            $output='';
//            foreach ($stars as $star){
//                $output.="&stars[]=".$star;
//            }
//            $star_filter = $output;
//        }
//        
//         if($amenities = $_GET['amenities']){
//            $output='';
//            foreach ($amenities as $amenity){
//                $output.="&amenities[]=".$amenity;
//            }
//            $amenities_filter = $output;
//        }
//         if($property_types = $_GET['property_types']){
//            $output='';
//            foreach ($property_types as $property_type){
//                $output.="&property_types[]=".$property_type;
//            }
//            $property_types = $output;
//        }
//        echo $property_types;die;

        
//        if (Yii::app()->session['hotel_name_' . $search_id]) {
//            $name = Yii::app()->session['hotel_name_' . $search_id];
//            Yii::app()->session['hotel_name_' . $search_id] = '';
//        }
        //echo "http://api.wego.com/hotels/api/search/" . $search_id . "?currency_code=" . $currency . "&sort=" . $filter . "&order=" . $order . "&page=" . $page . "&per_page=" . $per_page . "&refresh=true&text_filter=" . $name . "&key=" . $api_key . "&ts_code=" . $ts_code;die;
        $data2 = @file_get_contents("http://api.wego.com/hotels/api/search/" . $search_id . "?currency_code=" . $currency ."&refresh=true&key=" . $api_key . "&ts_code=" . $ts_code."&page=" . $page . "&per_page=" . $per_page);
        $res2 = json_decode($data2);

       // $total_pages = ceil($res2->total_count / $per_page);

        $hotels = $res2->hotels;
        $hotel_location = $res2->location;

//        print_r($hotels);
//        print_r($hotel_location);
//        $d1 = explode("/", Yii::app()->session['hotel_check_in_' . $search_id]);
//        $r1 = explode("/", Yii::app()->session['hotel_check_out_' . $search_id]);
//
//        $days = (mktime(0, 0, 0, $r1[1], $r1[0], $r1[2]) - mktime(0, 0, 0, $d1[1], $d1[0], $d1[2])) / (60 * 60 * 24);

        $arr=array();
        if($hotels){
            $output = "";
            foreach ($hotels as $hotel){
                $output.='   
         <div class="col-md-4 col-sm-8 col-xs-12 flight">
        <a class="flight-box col-md-12 col-xs-12" href="#"><img src="'. $hotel->image .'"></a>
        
        <div class="col-md-11 col-xs-11 flight-details">

        <a class="fav_star rate" data-dismiss="modal" id="" data-toggle="modal" data-target="#login-modal"></a>
        <a href="'.Yii::app()->createUrl('travel/hotel_details/', array("search_id" => $search_id, 'currency' => $currency, 'id' => $hotel->id, 'days' => 1, 'rooms' => 1)).'" class="flight-name">'.$hotel->name.'</a>
        <span class="place">'.$hotel->address.'</span>
        <span class="price">'.$hotel->room_rate_min->price_str.$hotel->room_rate_min->currency_sym.'</span>
        <a class="btn btn-default book-bt" target="_blank" href="'.Yii::app()->createUrl('travel/book/', array("search_id" => $search_id, 'hotel_id' => $hotel->id, 'room_id' => $hotel->summary_room_rates[0]->id)).'">book now</a>
        </div>
        </div><!--end flight-->';
            }
        }
        $arr['hotels']=$output;
        $arr['page']=$page;
        echo json_encode($arr);
        
    }
    
    
       public function actionFlight() {

       //    $criteria = new CDbCriteria;
//$criteria->limit = 10;
//$criteria->select = array('app_location_type,city_code,city_name,country_code,country_name,name,iata_code');
//$criteria->condition = ("country_name = 'United Kingdom'");
//$criteria->andCondition = ("app_locatin_type = 'City'");
//$criteria->order = 'RAND()';
        $cities = IataCodes::model()->findAll("country_name = 'United Kingdom' and app_location_type = 'City' limit 9 ");

       // $countries = IataCodes::model()->findAll("1=1 distinct(country_name) ");

        $countries=IataCodes::model()->findAll(array(
    'select'=>'t.country_name',
    'group'=>'t.country_name',
    'distinct'=>true,
    'limit'=>18
));
//        echo '<pre>';
//        print_r($countries);
//           echo '<pre>';die;
//
  
        $this->render('flight' ,array('cities'=>$cities ,'countries'=>$countries));
    }
    
    public function ActionLoadMoreDomCities(){
        if($_POST['page']){
            $page = $_POST['page'];
        }else{
            $page = 1;
        }
        $depart = date('d-m-Y');
        $return = date("d-m-Y", time()+(86400*7)); 
          $cities = IataCodes::model()->findAll("country_name = 'United Kingdom' and app_location_type = 'City' limit 9 offset $page");
//     
          //print_r($cities);
          $output = '';
            foreach ($cities as $city){ 
           $output=' <div class="col-md-4 col-sm-8 col-xs-12 flight">
                <a class="flight-box col-md-12 col-xs-12"  href="'. Yii::app()->getBaseUrl(true) .'/travel/search_flights?from=LON&to='. $city->iata_code.'&type=roundTrip&depart='.$depart.'&return='.$return.'&adults=1&children=0"><img src="'. Yii::app()->getBaseUrl(true) .'/image/travel/flight.png"></a>

                <div class="col-md-11 col-xs-11 flight-details">

                    <a class="fav_star rate" data-dismiss="modal" id="" data-toggle="modal" data-target="#login-modal"></a>
                    <a href="#" class="flight-name">'. $city->country_name .'</a>
                    <span class="place">'. $city->name .'</span>
                    <!--<span class="price">£325</span>-->
                    <a class="btn btn-default book-bt" href="'. Yii::app()->getBaseUrl(true) .'/travel/search_flights?from=LON&to='.$city->iata_code.'&type=roundTrip&depart='.$depart.'&return='.$return.'&adults=1&children=0">Search Flights</a>
                </div>
            </div><!--end flight-->';
            
             }
             echo $output;
    }

    
    
    public function actionError() {
        if ($error = Yii::app()->errorHandler->error) {
            if (Yii::app()->request->isAjaxRequest)
                echo $error['message'];
            else
                $this->render('error', $error);
        }
    }
    
    public function actionFlight_error() {
        if ($error = Yii::app()->errorHandler->error) {
            if (Yii::app()->request->isAjaxRequest)
                echo $error['message'];
            else
                $this->render('flight_error', $error);
        }
    }
    
    public function actionHotel_error() {
        if ($error = Yii::app()->errorHandler->error) {
            if (Yii::app()->request->isAjaxRequest)
                echo $error['message'];
            else
                $this->render('hotels_error', $error);
        }
    }
}
