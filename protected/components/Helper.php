<?php

/**
 *
 *
 * @version $Id$
 * @copyright 2013
 */
class Helper {

    public static function PlayVideo($model) {
        $player = Yii::app()->controller->widget('ext.Yiitube', array('v' => $model->video, 'size' => 'small'));


        return '<div class="VideoPlay">' . $player->play() . '</div>';
    }

    public static function yiiparam($name, $default = null) {
        if (isset(Yii::app()->params[$name]))
            return Yii::app()->params[$name];
        else
            return $default;
    }

    public static function DrawPageLink($page_id) {
        $page = Pages::model()->findByPk($page_id);
        if ($page === null) {
            return 'Not-Found';
        }

        return 'home/page/view/' . $page->url;
    }

    public static function GenerateRandomKey($length = 10) {

        $chars = array_merge(range(0, 9), range('a', 'z'), range('A', 'Z'));
        shuffle($chars);
        $password = implode(array_slice($chars, 0, $length));

        return $password;
    }

    public static function getGalleryImages($gallery_id) {

        $criteria = new CDbCriteria();

        $criteria->condition = 'gallery_id=:UID';

        $criteria->params = array(':UID' => $gallery_id);
        $criteria->order = 'rank';

        $gallery = GalleryPhoto::model()->findAll($criteria);

        return $gallery;
    }

    public static function slugify($text) {
        // replace non letter or digits by -
        $text = preg_replace('~[^\\pL\d]+~u', '-', $text);

        // trim
        $text = trim($text, '-');

        // transliterate
        $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

        // lowercase
        $text = strtolower($text);

        // remove unwanted characters
        $text = preg_replace('~[^-\w]+~', '', $text);

        if (empty($text)) {
            return 'n-a';
        }

        return $text;
    }

    public static function active_admin($controller_id) {
        if (Yii::app()->controller->id == $controller_id) {
            return 'active';
        }
        return '';
    }

    public static function getStatus($status, $yes = 'yes', $no = 'no') {
        if ($status == 1) {
            return $yes;
        } else {
            return $no;
        }
    }

    public static function checkFav($id) {
        $criteria = new CDbCriteria;
        $criteria->condition = 'user_id=:UserID and product_id=:ProductID';
        $criteria->params = array(':UserID' => Yii::app()->user->id, ':ProductID' => $id);
        $fav = Favourite::model()->find($criteria);
        if (!empty($fav)) {
            return 1;
        } else {
            return 0;
        }
    }

    public static function displayColor($color) {
        return '<label style="width:30px;">' . $color . '</label><label style="display:inline-flex;width:20px;padding:15px;background:' . $color . '"> </label>';
    }

    public static function PaypalExpress($total_price, $admin_total_commission, $return_url = '', $cancel_url = '') {
        // echo 'exp';
        $paymentInfo['Order']['theTotal'] = $total_price;
        $paymentInfo['Order']['description'] = Yii::app()->name . ' Payment';
        $paymentInfo['Order']['quantity'] = '1';
        if ($return_url) {
            Yii::app()->PaypalExpress->returnUrl = $return_url;
        }
        if ($cancel_url) {
            Yii::app()->PaypalExpress->cancelUrl = $cancel_url;
        }
        $payPalURL = '';
        $token = '';
        // call paypal
        $result = Yii::app()->PaypalExpress->SetExpressCheckout($paymentInfo);
        if (!Yii::app()->PaypalExpress->isCallSucceeded($result)) {
            if (Yii::app()->PaypalExpress->apiLive === true) {
                //Live mode basic error message
                $error = 'We were unable to process your request. Please try again later';
            } else {
                //Sandbox output the actual error message to dive in.
                $error = $result['L_LONGMESSAGE0'];
            }
            echo $error;
            Yii::app()->end();
        } else {
            $token = urldecode($result["TOKEN"]);
            $payPalURL = Yii::app()->PaypalExpress->paypalUrl . $token;
        }
        $payPalURL['url'] = $payPalURL;
        $payPalURL['token'] = $token;
        $arr = array();
        $arr['url'] = $payPalURL;
        $arr['token'] = $token;
        //  print_r($arr);die;
        return $arr;
    }

    public static function PaypalAdaptive($receivers_arr, $total_price, $admin_total_commission) {
//        print_r($receivers_arr);
//        echo '<br/>';
//        print_r($total_price).'<br/>';
//        echo '<br/>';
//        print_r($admin_total_commission);
        //echo 'adap';die;
        $returnUrl = Yii::app()->createAbsoluteUrl('home/orderconfirm?token=${payKey}');
        $cancelUrl = Yii::app()->createAbsoluteUrl('home/ordercancel?token=${payKey}');
        $ipn_notification_url = Yii::app()->createAbsoluteUrl('home/ipn_notification');
        //$payPalURL='';
        //$token='';

        $paymentInfo['returnUrl'] = $returnUrl;
        $paymentInfo['cancelUrl'] = $cancelUrl;
        $paymentInfo['ipn_notification_url'] = $ipn_notification_url;
        $paymentInfo['feesPayer'] = 'EACHRECEIVER';
        //$paymentInfo['memo'] = Yii::app()->name." Payment";
        $paymentInfo['currencyCode'] = 'GBP';

        $paymentInfo['receiverList.receiver(0).amount'] = $total_price; // #The payment amount for the first receiver
        $paymentInfo['receiverList.receiver(0).email'] = Yii::app()->params['paypal_email'];
        $paymentInfo['receiverList.receiver(0).primary'] = 'true'; // #Receiver designation (there can be only 1 primary receiver)
        $paymentInfo['receiverList.receiver(0).paymentType'] = 'GOODS'; //
        if ($receivers_arr) {
            $i = 1;
            foreach ($receivers_arr as $seller_email => $val) {
                $paymentInfo['receiverList.receiver(' . $i . ').amount'] = $val;
                $paymentInfo['receiverList.receiver(' . $i . ').email'] = $seller_email; //"simplebyuer@ukprosolutions.com";//
                $paymentInfo['receiverList.receiver(' . $i . ').primary'] = 'false'; //
                $paymentInfo['receiverList.receiver(' . $i . ').paymentType'] = 'GOODS'; //
                $i++;
            }
        }
        $paymentInfo['requestEnvelope.errorLanguage'] = 'en_US';
        //var_dump($paymentInfo);die;
        // call paypal
        $result = Yii::app()->Paypal->payUrl($paymentInfo);
        $arr = array();
        // print_r($result);
        $arr['url'] = $result['url'];
        $arr['token'] = $result['payKey'];
        // print_r($arr);die;
        return $arr;

        //print_r($paymentInfo);die;
        // call paypal
        //$result = Yii::app()->Paypal->SetExpressCheckout($paymentInfo);
        //var_dump($result);die;
        // send user to paypal
        //$token = urldecode($result["TOKEN"]);
        //$payPalURL = Yii::app()->Paypal->url . $token . '&Order=1';
        //$this->redirect($payPalURL);
    }

    public static function getColors() {
        $colors = Colors::model()->findAll();
        $list = array();
        if ($colors) {
            foreach ($colors as $color) {
                $list[$color->id] = $color->title;
            }
        }
        return $list;
    }

    public static function getSizes($id) {
        $Sizes = Sizes::model()->findAll(array('condition' => 'category_id=' . $id));
        $list = array();
        if ($Sizes) {
            foreach ($Sizes as $Size) {
                $list[$Size->id] = $Size->title;
            }
        }
        return $list;
    }

    public static function getvisitorinfo($ipAddr) {
        //verify the IP address for the  
        ip2long($ipAddr) == -1 || ip2long($ipAddr) === false ? trigger_error("Invalid IP", E_USER_ERROR) : "";
        // This notice MUST stay intact for legal use
        $ipDetail = array(); //initialize a blank array
        //get the XML result from hostip.info
        $xml = file_get_contents("http://api.hostip.info/?ip=" . $ipAddr);
        //get the city name inside the node <gml:name> and </gml:name>
        preg_match("@<Hostip>(\s)*<gml:name>(.*?)</gml:name>@si", $xml, $match);
        //assing the city name to the array
        $ipDetail['city'] = $match[2];
        //get the country name inside the node <countryName> and </countryName>
        preg_match("@<countryName>(.*?)</countryName>@si", $xml, $matches);
        //assign the country name to the $ipDetail array 
        $ipDetail['country'] = $matches[1];
        //get the country name inside the node <countryName> and </countryName>
        preg_match("@<countryAbbrev>(.*?)</countryAbbrev>@si", $xml, $cc_match);
        $ipDetail['country_code'] = $cc_match[1]; //assing the country code to array
        //return the array containing city, country and country code
        return $ipDetail;
    
        
    }
    public static function do_curl($url, $data) {
        $data_string = json_encode($data);

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 45);
        curl_setopt($ch, CURLOPT_TIMEOUT, 200);
        curl_setopt($ch, CURLOPT_LOW_SPEED_LIMIT, 100);
        curl_setopt($ch, CURLOPT_LOW_SPEED_TIME, 300000);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Content-Length: ' . strlen($data_string))
        );
        $result = curl_exec($ch);
        curl_close($ch);

        return $result;
    }

    public static function do_hotel_curl($url) {
//        $data_string = json_encode($data);

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 45);
        curl_setopt($ch, CURLOPT_TIMEOUT, 200);
        // curl_setopt($ch, CURLOPT_LOW_SPEED_LIMIT, 1);
        curl_setopt($ch, CURLOPT_LOW_SPEED_TIME, 300000);
        $result = curl_exec($ch);
        curl_close($ch);

        return $result;
    }

    public static function flight_date($date) {
        $result = "";

        $gmt_time = substr($date, 11, 5);
        $time_variation = substr($date, 20, 5);
        $tv_sign = substr($date, 19, 1);

        $rt_h = ((int) substr($gmt_time, 0, 2)) + ((int) substr($time_variation, 0, 2));
        $rt_m = ((int) substr($gmt_time, 3, 2)) + ((int) substr($time_variation, 3, 2));
        if ($tv_sign == "-") {
            $rt_h = ((int) substr($gmt_time, 0, 2)) - ((int) substr($time_variation, 0, 2));
            $rt_m = ((int) substr($gmt_time, 3, 2)) - ((int) substr($time_variation, 3, 2));
        }

        if ($rt_m > 60) {
            $rt_m -= 60;
            $rt_h += 1;
        }

        if ($rt_h > 24) {
            $rt_h -= 24;
        }

        $uk_ch = explode('-', substr($date, 0, 10));

        $result = str_pad($rt_h, 2, "0", STR_PAD_LEFT) . ":" . str_pad($rt_m, 2, "0", STR_PAD_LEFT) . " (" . substr($date, 0, 10) . ")";

        return $gmt_time . " (" . $uk_ch[2] . "/" . $uk_ch[1] . "/" . $uk_ch[0] . ")";
    }

    public static function get_currency_symbol($amount, $iso) {
        $ret = $amount . " " . $iso;

        $curr = Currency::model()->findByAttributes(array('iso_code' => $iso));
        if ($curr) {
            if ($curr->symbol) {
                $ret = $curr->symbol . $amount;
            }
        }

        return $ret;
    }

    public static function time_date($date) {
        $str = explode('/', $date);
        return mktime(0, 0, 0, $str[1], $str[0], $str[2]);
    }
    
    
     public static function limit_words($string, $word_limit) {
        $words = explode(" ", $string);
        return implode(" ", array_splice($words, 0, $word_limit));
    }
}

?>
