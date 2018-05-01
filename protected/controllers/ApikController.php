<?php

class ApikController extends Controller {

    public $PROJECT_NAME = "Mobile API";
    public $MESSAGE_SUCCESS = "success";
    public $MESSAGE_FAIL = "fail";
    public $MESSAGE_ERROR = "error";
    public $MESSAGE_FAIL_EX = "fail_ex";
    public $MESSAGE_ACCESS_DENIED = "access_denied";
    public $MESSAGE_REGISTERED_BEFORE = "registered_before";
    public $MESSAGE_EMAIL_NOT_FOUND = "email_not_found";
    public $MESSAGE_INVALID_OLD_PASSWORD = "invalid_old_pasword";
    public $MESSAGE_USER_NOT_FOUND = "user_not_found";

    public function actionGetProducts() {
        try {
            $request = $this->parseRequest();
            if ($request != false) {
                $all = Product::model()->findAll();
                $response['message'] = $this->MESSAGE_SUCCESS;
                $response['count'] = count($all);

                $criteria = new CDbCriteria();
                $criteria->limit = $request['end'];
                $criteria->offset = $request['start'];

                $all = Product::model()->findAll($criteria);

                $all_arr = array();
                foreach ($all as $item) {
                    $arr['id'] = intval($item->id);
                    $arr['title'] = $this->stringVal($item->title);

                    $all_arr[] = $arr;
                }

                $response['products'] = $all_arr;
                echo json_encode($response);
            }
        } catch (Exception $ex) {
            $this->responseWithMessage($this->MESSAGE_FAIL_EX);
        }
    }

    public function actionGetProductById() {
        try {
            $request = $this->parseRequest();
            if ($request != false) {
                $all = Product::model()->findAll();
                $response['message'] = $this->MESSAGE_SUCCESS;
                $response['count'] = count($all);

                $criteria = new CDbCriteria();
                $criteria->limit = $request['end'];
                $criteria->offset = $request['start'];
                ;

                $all = Product::model()->findAll($criteria);

                $all_arr = array();
                foreach ($all as $item) {
                    $arr['id'] = intval($item->id);
                    $arr['title'] = $this->stringVal($item->title);

                    $all_arr[] = $arr;
                }

                $response['products'] = $all_arr;
                echo json_encode($response);
            }
        } catch (Exception $ex) {
            $this->responseWithMessage($this->MESSAGE_FAIL_EX);
        }
    }

    public function actionLogin() {
        try {
            $request = $this->parseRequest();
            if ($request != false) {
                $user = User::model()->findByAttributes(array('username' => $request['username'],
                    'password' => User::simple_encrypt($request['password'])));
                if (count($user) == 0) {
                    $this->responseWithMessage($this->MESSAGE_FAIL);
                } else {
                    $arr = $this->fetchUserObject($user);
                    $response['message'] = $this->MESSAGE_SUCCESS;
                    $response['user'] = $arr;
                    echo json_encode($response, JSON_UNESCAPED_SLASHES);
                }
            }
        } catch (Exception $ex) {
            $this->responseWithMessage($this->MESSAGE_FAIL_EX);
        }
    }

    public function fetchUserObject($user) {
        if (count($user) == 0) {
            return new stdClass();
        } else {
            $user_details = UserDetails::model()->find("user_id = $user->id");
            $arr = array();
            $address_arr = array();
            $shop_arr = array();
            $arr["id"] = intval($user->id);
            $arr['type'] = intval($user->groups_id);
            //$arr["username"] = $this->stringVal($user->username);

            $arr["fName"] = $this->stringVal($user->fname);
            $arr["lName"] = $this->stringVal($user->lname);
            $arr["phone"] = $this->stringVal($user_details->phone_no);
            $arr["website"] = $this->stringVal($user_details->website);
            $arr["facebook"] = $this->stringVal($user_details->facebook);
            $arr["twitter"] = $this->stringVal($user_details->twitter);
            $arr["phone"] = $this->stringVal($user_details->phone_no);
            $arr["instagram"] = $this->stringVal($user_details->instagram);
            $arr["linkedin"] = $this->stringVal($user_details->linkedin);
            // $arr["description"] = $this->stringVal($user_details->description);
            $arr["image"] = $this->stringVal($user->image);
            //$arr["active"] = intval($user->active);

            $address_arr['countryId'] = intval($user_details->country_id);
            $address_arr['cityId'] = intval($user_details->city_id);
            $address_arr['address'] = $this->stringVal($user_details->address);
            $address_arr['postcode'] = intval($user_details->zipcode);
            $address_arr['long'] = $this->stringVal($user_details->lng);
            $address_arr['lat'] = $this->stringVal($user_details->lat);


            $shop_arr['shopname'] = $this->stringVal($user_details->shop_name);
            $shop_arr['paypalAccount'] = $this->stringVal($user_details->paypal_account);
            $shop_arr['shopAddress'] = $this->stringVal($user_details->shop_address);
            $shop_arr['shopDesc'] = $this->stringVal($user_details->shop_description);
            $shop_arr['image'] = $this->stringVal($user_details->shop_image);


            $arr['address'] = $address_arr;
            $arr['shop'] = $shop_arr;
            return $arr;
        }
    }

    public function actionRegisterDevice() {
        try {
            $request = $this->parseRequest();
            if ($request != false) {
                if ($this->authUser($request['user']) == true) {
                    $device_id = $request['deviceId'];
                    $user_id = $request['user']['id'];

                    $user_notification_model = UserNotifications::model()->findByAttributes(array('user_id' => $user_id, 'device_id' => $device_id));
                    if (count($user_notification_model) > 0) {
                        $this->responseWithMessage($this->MESSAGE_REGISTERED_BEFORE);
                        return;
                    }

                    $user_device = new UserNotifications();
                    $user_device->user_id = $user_id;
                    $user_device->device_id = $device_id;
                    $user_device->created_at = date('Y-m-d H:i:s');

                    if ($user_device->save()) {
                        $this->responseWithMessage($this->MESSAGE_SUCCESS);
                    } else {
                        $this->responseWithMessage($this->MESSAGE_FAIL);
                    }
                }
            }
        } catch (Exception $ex) {
            $this->responseWithMessage($this->MESSAGE_FAIL_EX);
        }
    }

    public function actionTerms() {
        try {
            $response["message"] = $this->MESSAGE_SUCCESS;
            $pages = Pages::model()->findByPk(3);
            if (!empty($pages)) {
                $response["content"] = $pages->details;
            }
            echo json_encode($response);
        } catch (Exception $ex) {
            $this->responseWithMessage($this->MESSAGE_FAIL_EX);
        }
    }

    

    public function actionForgetPassword() {
        try {
            $request = $this->parseRequest();
            if ($request != false) {
                $email = $request['email'];
                $usermodel = User::model()->findByAttributes(array('email' => $email));
                //print_r($usermodel);die;
                if (count($usermodel) == 0) {
                    $this->responseWithMessage($this->MESSAGE_EMAIL_NOT_FOUND);
                } else {
                    // create randomkey
                    $key = Helper::GenerateRandomKey();
                    $usermodel->pass_reset = 1;
                    $usermodel->pass_code = $key;
                    $usermodel->save(false);
                    // send email
                    $message = 'Dear customer,
					Please follow this link to reset your password :
					Username:' . $usermodel->username . '
					URL: ' . Yii::app()->params['webSite'] . '/home/reset/hash/' . $usermodel->pass_code . '
					';
                    $sent = $this->sendEmail(Yii::app()->params['email'], $usermodel->email, $this->PROJECT_NAME . ' Admininstrator', $this->PROJECT_NAME . ' - password reset', $message);
                    /* if($sent === true)
                      {
                      $this->responseWithMessage($this->MESSAGE_SUCCESS);
                      }else{
                      $this->responseWithMessage($this->MESSAGE_FAIL);
                      } */
                }
            }
        } catch (Exception $ex) {
            $this->responseWithMessage($this->MESSAGE_FAIL_EX);
        }
    }

    public function actionContactInfo() {
        try {
            $settings = Settings::model()->findByPk(1);
            if (empty($settings)) {
                $this->responseWithMessage($this->MESSAGE_FAIL);
            } else {
                $info['address'] = $settings['adress'];
                $info['city'] = $settings['city'];
                $info['state'] = $settings['state'];
                $info['postcode'] = $settings['post_code'];
                $info['longitude'] = $settings['long'];
                $info['latitude'] = $settings['lat'];
                $info['phone'] = $settings['phone'];

                $response["message"] = $this->MESSAGE_SUCCESS;
                $response['info'] = $info;
                echo json_encode($response);
            }
        } catch (Exception $ex) {
            $this->responseWithMessage($this->MESSAGE_FAIL_EX);
        }
    }

    public function actionContactus() {
        try {
            $request = $this->parseRequest();
            if ($request != false) {
                $this->sendEmail($request['email'], Yii::app()->params['email'], $this->PROJECT_NAME . ' Contactus', $request['subject'], $request['message']);
            }
        } catch (Exception $ex) {
            $this->responseWithMessage($this->MESSAGE_FAIL_EX);
        }
    }

    public function actionCountries() {
        try {
            $regions = Regions::model()->findAll();
            $all_arr = array();
            foreach ($regions as $region) {
                $arr["id"] = intval($region->id);
                $arr["title"] = $this->stringVal($region->country);

                $all_arr[] = $arr;
            }

            $response["message"] = $this->MESSAGE_SUCCESS;
            $response["countries"] = $all_arr;
            echo json_encode($response);
        } catch (Exception $ex) {
            $this->responseWithMessage($this->MESSAGE_FAIL_EX);
        }
    }

    public function actionStates() {
        try {
            $request = $this->parseRequest();
            if ($request != false) {
                $criteria = new CDbCriteria();
                $criteria->condition = "region_id = " . $request["countryId"];
                $subregion = Subregions::model()->findAll($criteria);

                $response["message"] = $this->MESSAGE_SUCCESS;
                $all_arr = array();

                foreach ($subregion as $region) {
                    $arr["id"] = intval($region->id);
                    $arr["title"] = $this->stringVal($region->name);

                    $all_arr[] = $arr;
                }

                $response["message"] = $this->MESSAGE_SUCCESS;
                $response["states"] = $all_arr;
                echo json_encode($response);
            }
        } catch (Exception $ex) {
            $this->responseWithMessage($this->MESSAGE_FAIL_EX);
        }
    }

    public function actionCategories() {
        try {
            $categories = $this->selectCategories('0');
            $all_arr = array();
            $response["categories"] = $all_arr;

            if (count($categories) > 0) {
                foreach ($categories as $category) {
                    $arr = $this->fetchCategories($this->convertCategoryToArray($category));
                    $all_arr [] = $arr;
                }
            }

            $response["message"] = $this->MESSAGE_SUCCESS;
            $response["categories"] = $all_arr;
            echo json_encode($response);
        } catch (Exception $ex) {
            echo $ex;
            $this->responseWithMessage($this->MESSAGE_FAIL_EX);
        }
    }

    private function fetchCategories($row) {
        $categories = $this->selectCategories($row['id']);
        $sub_arr = array();

        foreach ($categories as $category) {
            $sub = $this->convertCategoryToArray($category);
            // check for parent -> true recursion
            if (count($this->selectCategories($sub['id'])) > 0) {
                $sub = $this->fetchCategories($sub);
            }

            $sub_arr[] = $sub;
        }

        $row['subCategories'] = $sub_arr;
        return $row;
    }

    public function selectCategories($parent_id = '0') {
        $criteria = new CDbCriteria();
        $criteria->condition = "parent_id = " . $parent_id;
        $categories = Category::model()->findAll($criteria);
        return $categories;
    }

    private function convertCategoryToArray($category) {
        $arr["id"] = intval($category->id);
        $arr["title"] = $this->stringVal($category->title);
        $arr["desc"] = $this->stringVal($category->desc);
        $arr["parentId"] = intval($category->parent_id);

        return $arr;
    }


    /**
     * Default actions and methods
     */
    public function init() {
        Yii::app()->setComponents(array(
            'errorHandler' => array(
                'errorAction' => '/api/error'
            )
        ));
    }

    public function actionError() {
        $this->responseWithMessage($this->MESSAGE_ERROR);
    }

    public function actionIndex() {
        $this->actionError();
    }

    public function responseWithMessage($message) {
        $response['message'] = $message;
        echo json_encode($response);
    }

    public function parseRequest() {
        try {
            if (isset($_POST) && count($_POST) > 0) {
                $request = json_decode($_POST['data'], true);
                if ($request) {
                    return $request;
                } else {
                    $this->responseWithMessage($this->MESSAGE_ERROR);
                }
            } else {
                $this->responseWithMessage($this->MESSAGE_ERROR);
            }
        } catch (Exception $ex) {
            $this->responseWithMessage($this->MESSAGE_ERROR);
            // return false;
        }
        die();
        // return false;
    }

    public function stringVal($val) {
        return $val == null ? "" : $val;
    }

    public function authUser($user) {
        $model = User::model()->findByAttributes(array('id' => $user['id'], 'email' => $user["email"], 'password' => User::simple_encrypt($user['password'])));
        if (count($model) == 0) {
            $this->responseWithMessage($this->MESSAGE_ACCESS_DENIED);
            return false;
        }
        return true;
    }

    public function checkUserDataFound($key, $value, $id = '') {
        $user_model = User::model()->findByAttributes(array($key => $value));
        if ($user_model) {
            if ($id != '') {
                if ($user_model->id != $id) {
                    $this->responseWithMessage($key . '_found');
                    die();
                }
            } else {
                $this->responseWithMessage($key . '_found');
                die();
            }
        }
    }

    public function sendEmail($from, $to, $from_title, $subject, $message) {
        $mail = new YiiMailer();
        $mail->setFrom($from, $from_title);
        $mail->setTo($to);
        $mail->setSubject($subject);
        $mail->setBody($message);
        if ($mail->send()) {
            $this->responseWithMessage($this->MESSAGE_SUCCESS);
        } else {
            $this->responseWithMessage($this->MESSAGE_FAIL);
        }
    }

    public function integerVal($val) {
        return $val == null ? 0 : $val;
    }

    public function actionGetLeads() {
        // echo"yes";
        $start = $_REQUEST['start'];
        $end = $_REQUEST['end'];
        $return = array();
        $arr = array();
        $result = array();
        //// if no parameters /////
        if ($start == '' or $end == '') {
            $return = array('message' => 'error');
        } else {
            $leads = Lead::model()->findAll();

            $count = $start;

            $employee = array();
            foreach ($leads as $lead) {
                if ($count <= $end) {
                    $result['id'] = $this->integerVal($lead->id);
                    $result['name'] = $this->stringVal($lead->salutation) . '. ' . $this->stringVal($lead->first_name) . ' ' . $this->stringVal($lead->last_name);
                    $result['status'] = $this->stringVal($lead->status->title);
                    $result['accountName'] = $this->stringVal($lead->account_name);
                    $result['phone'] = $this->stringVal($lead->mobile);
                    $result['email'] = $this->stringVal($lead->email);
                    $employee['name'] = $this->stringVal($lead->employee->fname) . ' ' . $this->stringVal($lead->employee->lname);
                    $employee['id'] = $this->integerVal($lead->employee_id);
                    $result['ukEmployee'] = $employee;
                    $arr[] = $result;
                }
                $count++;
            }
            $return = array('message' => 'success', 'count' => count($leads), 'leads' => $arr);
        }
        echo json_encode($return);
    }

    public function actionGetLeadsDetails() {
        $id = $_REQUEST['id'];
        $return = array();
        $account = array();
        $contact = array();

        //// if no parameters /////
        if ($id == '') {
            $return = array('message' => 'error');
        } else {
            $lead = Lead::model()->findByPk($id);

            $account['name'] = $this->stringVal(Lead::model()->getApiAccount($id)->title);
            $account['id'] = $this->integerVal(Lead::model()->getApiAccount($id)->id);
            $contact['name'] = $this->stringVal(Lead::model()->getApiContact($id)->salutation) . '. ' . $this->stringVal(Lead::model()->getApiContact($id)->first_name) . ' ' . $this->stringVal(Lead::model()->getApiContact($id)->last_name);
            $contact['id'] = $this->integerVal(Lead::model()->getApiContact($id)->id);
            $return = array('message' => 'success', 'jobTitle' => $this->stringVal($lead->title), 'country' => $this->stringVal($lead->primary_country), 'city' => $this->stringVal($lead->primary_city),
                'street' => $this->stringVal($lead->primary_street), 'postcode' => $this->stringVal($lead->primary_postcode), 'fax' => $lead->fax, 'twitter' => $this->stringVal($lead->twitter),
                'description' => $this->stringVal($lead->description), 'statusDescription' => $this->stringVal($lead->status_description), 'contact' => $contact, 'account' => $account);
        }
        echo json_encode($return);
    }

    public function actionEditLead() {
        $lead_id = $_REQUEST['leadId'];
        $desc = $_REQUEST['description'];
        $status_desc = $_REQUEST['stausDescription'];
        $return = array();

        if ($lead_id == '' or $desc == '' or $status_desc == '') {
            $return = array('message' => 'error');
        } else {
            $lead = Lead::model()->findByPk($lead_id);
            $lead->description = $desc;
            $lead->status_description = $status_desc;
            if ($lead->save(false)) {
                $return = array('message' => 'success');
            } else {
                $return = array('message' => 'fail');
            }
        }
        echo json_encode($return);
    }

    public function actionGetUkEmployeeDetails() {
        $emp_id = $_REQUEST['id'];
        $return = array();
        if ($emp_id == '') {
            $return = array('message' => 'error');
        } else {
            $employee = User::model()->findByPk($emp_id);
            $return = array('message' => 'success', 'fname' => $this->stringVal($employee->fname), 'lname' => $this->stringVal($employee->lname),
                'title' => $this->stringVal($employee->title), 'officePhone' => $this->stringVal($employee->office_phone), 'mobile' => $this->stringVal($employee->mobile),
                'fax' => $this->stringVal($employee->fax), 'postCode' => $this->stringVal($employee->postal_code), 'email' => $this->stringVal($employee->email));
        }
        echo json_encode($return);
    }

    public function actionGetUkContactDetails() {
        $contact_id = $_REQUEST['id'];
        $return = array();
        if ($contact_id == '') {
            $return = array('message' => 'error');
        } else {
            $contact = Contact::model()->findByPk($contact_id);
            $return = array('message' => 'success', 'Salutation' => $this->stringVal($contact->salutation), 'fname' => $contact->first_name,
                'lname' => $this->stringVal($contact->last_name), 'department' => $this->stringVal($contact->department), 'title' => $this->stringVal($contact->title), 'phone' => $this->stringVal($contact->mobile),
                'fax' => $this->stringVal($contact->fax), 'country' => $this->stringVal($contact->alternate_country), 'city' => $this->stringVal($contact->alternate_city),
                'postCode' => $this->stringVal($contact->alternate_postcode), 'email' => $this->stringVal($contact->email), 'description' => $this->stringVal($contact->description));
        }
        echo json_encode($return);
    }

    public function actionGetUkAccountDetails() {
        $account_id = $_REQUEST['id'];
        $return = array();
        $employee = array();
        if ($account_id == '') {
            $return = array('message' => 'error');
        } else {
            $account = Account::model()->findByPk($account_id);
            $employee = array('name' => $this->stringVal($account->assignedTo->username), 'id' => $this->integerVal($account->assignedTo->id));
            $return = array('message' => 'success', 'name' => $this->stringVal($account->title), 'website' => $this->stringVal($account->website),
                'industry' => $this->stringVal($account->industry->title), 'assignedTo' => $employee,
                'email' => $this->stringVal($account->email), 'phone' => $this->stringVal($account->office_phone), 'billingStreet' => $this->stringVal($account->billing_street), 'billingCity' => $this->stringVal($account->billing_city),
                'billingPostcode' => $account->billing_postcode, 'billingCountry' => $this->stringVal($account->billing_country), 'fax' => $account->fax,
                'description' => $this->stringVal($account->description));
        }
        echo json_encode($return);
    }

    public function actionGetOpportunities() {
        $start = $_REQUEST['start'];
        $end = $_REQUEST['end'];
        $return = array();
        $arr = array();
        //// if no parameters /////
        if ($start == '' or $end == '') {
            $return = array('message' => 'error');
        } else {
            $opportunities = Opportunity::model()->findAll();
            $count = $start;
            $result = array();
            $employee = array();
            foreach ($opportunities as $opportunity) {
                if ($count <= $end) {
                    $result['id'] = $this->integerVal($opportunity->id);
                    $result['name'] = $this->stringVal($opportunity->title);
                    $result['accountName'] = $this->stringVal($opportunity->account->title);
                    $result['status'] = $this->stringVal($opportunity->status->title);
                    $result['likely'] = $this->stringVal($opportunity->likely);
                    $result['type'] = $this->stringVal($opportunity->type);
                    $result['leadSource'] = $this->stringVal($opportunity->source->title);
                    $result['nextStep'] = $this->stringVal($opportunity->next_step);
                    $employee['name'] = $this->stringVal($opportunity->employee->fname) . ' ' . $this->stringVal($opportunity->employee->lname);
                    $employee['id'] = $this->integerVal($opportunity->employee_id);
                    $result['ukEmployee'] = $employee;
                    $arr[] = $result;
                }
                $count++;
            }
            $return = array('message' => 'success', 'count' => count($opportunities), 'opportuinities' => $arr);
        }
        echo json_encode($return);
    }

    public function actionGetOpportuinitiesDetails() {
        $id = $_REQUEST['id'];
        $return = array();

        //// if no parameters /////
        if ($id == '') {
            $return = array('message' => 'error');
        } else {
            $opportunity = Opportunity::model()->findByPk($id);
            $return = array('message' => 'success', 'description' => $this->stringVal($opportunity->description),
                'likely' => $this->stringVal($opportunity->likely), 'worst' => $this->stringVal($opportunity->worst), 'best' => $this->stringVal($opportunity->best),
                'closeDate' => $this->stringVal($opportunity->expected_close_date));
        }
        echo json_encode($return);
    }

    public function ActionTest() {
        $this->renderPartial('test');
    }

    //// Salah Api's
    public function actionwebSiteCategories() {
        try {
            $all = Category::model()->findAll();
            $response['message'] = $this->MESSAGE_SUCCESS;
            $all_arr = array();
            foreach ($all as $item) {
                $cats_arr = array();
                $arr['id'] = intval($item->id);
                $arr['title'] = $this->stringVal($item->title);
                $arr['image'] = $this->stringVal($item->image);
                $allcats = ProductCategory::model()->findAllByAttributes(array('category_id' => $item->id));
                foreach ($allcats as $cat) {
                    $arr2['id'] = intval($cat->id);
                    $arr2['title'] = $this->stringVal($cat->title);
                    $arr['categories'][] = $arr2;
                }
                $all_arr[] = $arr;
            }

            $response['webSiteCats'] = $all_arr;
            echo json_encode($response);
        } catch (Exception $ex) {
            $this->responseWithMessage($this->MESSAGE_FAIL_EX);
        }
    }

    public function actionsubCategories() {
        try {
            $request = $this->parseRequest();
            $websitecatid = $request['webSiteCatId'];
            $catid = $request['catId'];
            if ($request != false) {
                $response['message'] = $this->MESSAGE_SUCCESS;
                $all_arr = array();
                $all = SubCategory::model()->findAllByAttributes(array('product_category_id' => $catid));
                foreach ($all as $item) {
                    $cats_arr = array();
                    $arr['id'] = intval($item->id);
                    $arr['title'] = $this->stringVal($item->title);
                    $all_arr[] = $arr;
                }

                $response['subCats'] = $all_arr;
                echo json_encode($response);
            }
        } catch (Exception $ex) {
            $this->responseWithMessage($this->MESSAGE_FAIL_EX);
        }
    }

    public function actionmainPageData() {
        try {
            $request = $this->parseRequest();
            if ($request != false) {
                $mobilesize = $request['mobileSize'];
                $response['message'] = $this->MESSAGE_SUCCESS;
                $banners = Banner::model()->findAll();
                $cats = Category::model()->recent('mobile')->findAll();
                $featuredItems = Product::model()->recent('mobile')->findAll();
                $banner_arr = array();
                foreach ($banners as $banner) {
                    $arr['id'] = intval($banner->id);
                    $arr['title'] = $this->stringVal($banner->title);
                    $this->widget('ext.SAImageDisplayer', array(
                        'image' => $banner->image,
                        'size' => $mobilesize,
                        'title' => 'My super title',
                        'defaultImage' => "defualt.jpg",
                        'originalFolderName' => 'banner',
                    ));
                    $arr['image'] = $this->stringVal($banner->image);
                    $arr['link'] = $this->stringVal($banner->link);
                    $banner_arr[] = $arr;
                }
                $response['slider'] = $banner_arr;
                $cat_arr = array();
                foreach ($cats as $cat) {
                    $cats_arr = array();
                    $arr2['id'] = intval($cat->id);
                    $arr2['title'] = $this->stringVal($cat->title);
                    $this->widget('ext.SAImageDisplayer', array(
                        'image' => $cat->image,
                        'size' => $mobilesize,
                        'title' => 'My super title',
                        'defaultImage' => "defualt.jpg",
                        'originalFolderName' => 'category',
                    ));
                    $arr2['image'] = $this->stringVal($cat->image);
                    $cat_arr[] = $arr2;
                }
                $response['cats'] = $cat_arr;
                $item_arr = array();
                foreach ($featuredItems as $item) {
                    $arr3['id'] = intval($item->id);
                    $arr3['webSiteCatId'] = intval($item->title);
                    $arr3['catId'] = intval($item->product_category_id);
                    $product_details = ProductDetails::model()->findByAttributes(array('product_id' => $item->id));
                    // echo ($item->category->title);die;
                    $arr3['subCatId'] = intval($product_details->sub_category_id);
                    $arr3['catTitle'] = $this->stringVal($item->category->title);
                    $arr3['title'] = $this->stringVal($item->title);
                    $this->widget('ext.SAImageDisplayer', array(
                        'image' => $item->main_image,
                        'size' => $mobilesize,
                        'title' => 'My super title',
                        'defaultImage' => "defualt.jpg",
                        'originalFolderName' => 'product',
                    ));
                    $arr3['image'] = $this->stringVal($item->main_image);
                    $arr3['price'] = $this->stringVal($item->price) . ' GBP';
                    $item_arr[] = $arr3;
                }
                $response['featuredItems'] = $item_arr;
                echo json_encode($response);
            }
        } catch (Exception $ex) {
            $this->responseWithMessage($this->MESSAGE_FAIL_EX);
        }
    }

    public function actionitemsListing() {
        try {
            $request = $this->parseRequest();
            if ($request != false) {
                $mobilesize = $request['mobileSize'];
                $catId = $request['catId'];
                $productcatId = $request['subCatId'];
                $start = $request['start'];
                $end = $request['end'];

                $response['message'] = $this->MESSAGE_SUCCESS;
                $allitems = Product::model()->itemsListing($catId, $productcatId, $start, $end, 1);
                $count = count($allitems);
                $response['count'] = intval($count);
                $subitems = Product::model()->itemsListing($catId, $productcatId, $start, $end);
                $item_arr = array();
                foreach ($subitems as $item) {
                    $arr3['id'] = intval($item->id);
                    // $arr3['webSiteCatId'] = intval($item->title);
                    // $arr3['catId'] = intval($item->product_category_id);
                    // $product_details = ProductDetails::model()->findByAttributes(array('product_id' => $item->id));
                    // echo ($item->category->title);die;
                    // $arr3['subCatId'] = intval($product_details->sub_category_id);
                    // $arr3['catTitle'] = $this->stringVal($item->category->title);
                    $arr3['title'] = $this->stringVal($item->title);
                    $this->widget('ext.SAImageDisplayer', array(
                        'image' => $item->main_image,
                        'size' => $mobilesize,
                        'title' => 'My super title',
                        'defaultImage' => "defualt.jpg",
                        'originalFolderName' => 'product',
                    ));
                    $arr3['image'] = $this->stringVal($item->main_image);
                    $arr3['price'] = $this->stringVal($item->price) . ' GBP';
                    $item_arr[] = $arr3;
                }
                $response['items'] = $item_arr;
                echo json_encode($response);
            }
        } catch (Exception $ex) {
            $this->responseWithMessage($this->MESSAGE_FAIL_EX);
        }
    }

    public function actionitemDetails() {
        try {
            $request = $this->parseRequest();
            if ($request != false) {
                $mobilesize = $request['mobileSize'];
                $Id = $request['Id'];
                $response['message'] = $this->MESSAGE_SUCCESS;
                $proitem = Product::model()->findBypk($Id);
                $itemcolors = ProductColor::model()->findByAttributes(array('product_id' => $Id));
                $itemsizes = ProductSizes::model()->findByAttributes(array('product_id' => $Id));
                $itemrevs = Review::model()->findAllByAttributes(array('product_id' => $Id));
                $itemphotos = GalleryPhoto::model()->findAllByAttributes(array('gallery_id' => $proitem->gallery_id));
                $colors = array();
                //print_r($itemcolors);die;
                foreach ($itemcolors as $color) {
                    print_r($color);
                    die;
                    $arr1['id'] = intval($color->colors->id);
                    $arr1['title'] = $this->stringVal($color->colors->title);
                    $arr1['color'] = $this->stringVal($color->colors->color);
                    $colors[] = $arr1;
                }
                $response['colors'] = $colors;
                $item['id'] = intval($proitem->id);

                $item['title'] = $this->stringVal($proitem->title);
                $this->widget('ext.SAImageDisplayer', array(
                    'image' => $proitem->main_image,
                    'size' => $mobilesize,
                    'title' => 'My super title',
                    'defaultImage' => "defualt.jpg",
                    'originalFolderName' => 'product',
                ));
                $item['image'] = $this->stringVal($proitem->main_image);
                $item['price'] = $this->stringVal($proitem->price) . ' GBP';
                $response['itemDetails'] = $item;
                echo json_encode($response);
            }
        } catch (Exception $ex) {
            $this->responseWithMessage($this->MESSAGE_FAIL_EX);
        }
    }

    public function actionuserFavourites() {
        try {
            $request = $this->parseRequest();

            if ($request != false) {
                $id = $request['userAuth']['id'];
                $hash = $request['userAuth']['hash'];
                $mobilesize = $request['mobileSize'];
                $start = $request['start'];
                $end = $request['end'];
                $model = User::model()->findByPk($id);
                if (count($model) == 1) {
                    $authuser = $this->authUser2($hash, $id);
                    //echo md5($model->id . "-" . $model->email . "-" . User::simple_decrypt($model->password));
                    //die;
                    if ($authuser === true) {
                        $response['message'] = $this->MESSAGE_SUCCESS;
                        $allvavs = Product::model()->allfav($id, $start, $end, 1);
                        $count = count($allvavs);
                        $response['count'] = intval($count);
                        $subfavs = Product::model()->allfav($id, $start, $end);
                        $item_arr = array();
                        foreach ($subfavs as $fav) {
                            $arr3['id'] = intval($fav->id);
                            $this->widget('ext.SAImageDisplayer', array(
                                'image' => $fav->main_image,
                                'size' => $mobilesize,
                                'title' => 'My super title',
                                'defaultImage' => "defualt.jpg",
                                'originalFolderName' => 'product',
                            ));
                            $arr3['image'] = $this->stringVal($fav->main_image);
                            $arr3['title'] = $this->stringVal($fav->title);
                            $arr3['price'] = $this->stringVal($fav->price) . ' GBP';
                            $arr3['webSiteCategory']['id'] = intval($fav->category_id);
                            // echo ($item->category->title);die;
                            $arr3['webSiteCategory']['title'] = $this->stringVal($fav->category->title);
                            $item_arr[] = $arr3;
                        }
                        $response['items'] = $item_arr;
                        echo json_encode($response);
                    } else {
                        $this->responseWithMessage($this->MESSAGE_USER_NOT_FOUND);
                    }
                } else {
                    $this->responseWithMessage($this->MESSAGE_USER_NOT_FOUND);
                }
            }
        } catch (Exception $ex) {
            $this->responseWithMessage($this->MESSAGE_FAIL_EX);
        }
    }

    // Wael Api's
    public function actionChangePassword() {
        try {
            $request = $this->parseRequest();
            if ($request != false) {

                $id = $request['userAuth']['id'];
                $hash = $request['userAuth']['hash'];
                $oldpass = $request['oldPassword'];
                $newpass = $request['newPassword'];
                $user = User::model()->findBypk($id);
                if (count($user) == 1) {

                    $authuser = $this->authUser2($hash, $id);
                    if ($authuser != false) {

                        //  if ($oldpass == User::simple_decrypt($user->password)) {
                        $update = User::model()->updateByPk($id, array('password' => User::simple_encrypt($newpass)));

                        if ($update) {
                            $this->responseWithMessage($this->MESSAGE_SUCCESS);
                        } else {
                            $this->responseWithMessage($this->MESSAGE_FAIL);
                        }
                    } else {
                        $this->responseWithMessage($this->MESSAGE_INVALID_OLD_PASSWORD);
                    }
                    /* } else {
                      $this->responseWithMessage($this->MESSAGE_FAIL);
                      } */
                } else {
                    $this->responseWithMessage($this->MESSAGE_USER_NOT_FOUND);
                }
            }
        } catch (Exception $ex) {
            $this->responseWithMessage($this->MESSAGE_FAIL_EX);
        }
    }

    public function actionEditProfile() {
        try {
            $request = $this->parseRequest();
            if ($request != false) {
                $id = $request['userAuth']['id'];
                $hash = $request['userAuth']['hash'];

                $user = $request['user'];
                $model = User::model()->findByPk($id);

                if (count($model) == 1) {
                    $authuser = $this->authUser2($hash, $id);
                    //echo md5($model->id . "-" . $model->email . "-" . User::simple_decrypt($model->password));
                    //die;
                    if ($authuser === true) {

                        //echo "test";
                        //die;

                        $model->username = $user["username"];
                        $model->email = $user["email"];
                        $model->fname = $user["fName"];
                        $model->lname = $user["lName"];
                        $model->image = $user["image"];
                        //$model->password = $user["password"];

                        if ($model->save(false)) {
                            $details = $user["address"];

                            $model_details = UserDetails::model()->findByAttributes(array('user_id' => $model->id));
                            if (!$model_details) {
                                $model_details = new UserDetails();
                                $model_details->user_id = $user['id'];
                            }

                            $model_details->website = $user['website'];
                            $model_details->facebook = $user['facebook'];
                            $model_details->twitter = $user['twitter'];
                            $model_details->instagram = $user['instagram'];
                            $model_details->linkedin = $user['linkedin'];
                            $model_details->phone_no = $user["phone"];
                            $model_details->zipcode = $user["postcode"];
                            $model_details->address = $details["address"];
                            $model_details->city_id = $details["cityId"];
                            $model_details->country_id = $details["countryId"];
                            $model_details->lng = $details["long"];
                            $model_details->lat = $details["lat"];

                            $model_details->fee_package_id = $details["fee_package_id"];
                            $model_details->ads_number = $details["ads_number"];

                            $model_details->zoom = $details["zoom"];
                            $model_details->google = $details["google"];

                            //$model_details->description = $details["description"];
                            //$model_details->phone_type = $details["phone_type"];

                            $model_details->shop_name = $user["shop"]["shopname"];
                            $model_details->paypal_account = $user["shop"]["paypalAccount"];
                            $model_details->shop_address = $user["shop"]["shopAddress"];
                            $model_details->shop_description = $user["shop"]["shopDesc"];
                            $model_details->shop_image = $user["shop"]["image"];
                            $model_details->accept_leads = $user["shop"]["accept_leads"];
                            $model_details->available_range = $user["shop"]["available_range"];
                            $model_details->company_id = $user["shop"]["company_id"];
                            $model_details->fax_no = $user["shop"]["fax_no"];



                            if ($model_details->save(false)) {
                                $arr = $this->fetchUserObject($model);
                                $response['message'] = $this->MESSAGE_SUCCESS;
                                $response['user'] = $arr;
                                echo json_encode($response, JSON_UNESCAPED_SLASHES);
                                //$this->responseWithMessage($this->MESSAGE_SUCCESS);
                            } else {
                                $this->responseWithMessage($this->MESSAGE_FAIL);
                            }
                        } else {
                            $this->responseWithMessage($this->MESSAGE_FAIL);
                        }
                    } else {
                        $this->responseWithMessage($this->MESSAGE_USER_NOT_FOUND);
                    }
                } else {
                    $this->responseWithMessage($this->MESSAGE_USER_NOT_FOUND);
                }
            }
        } catch (Exception $ex) {
            $this->responseWithMessage($this->MESSAGE_FAIL_EX);
        }
    }

    public function ActionUserMessages() {

        try {
            $request = $this->parseRequest();
            if ($request != false) {

                $id = $request['userAuth']['id'];
                $hash = $request['userAuth']['hash'];
                $start = $request['start'];
                $end = $request['end'];
                $flag = $request['flag'];
                $model = User::model()->findByPk($id);
                //echo md5($model->id . "-" . $model->email . "-" . User::simple_decrypt($model->password));
                //die;
                if (count($model) == 1) {
                    $authuser = $this->authUser2($hash, $id);
                    if ($authuser == true) {
                        $response['message'] = $this->MESSAGE_SUCCESS;
                        $messages = Message::model()->allMsgs($id, $start, $end, $flag, 1);
                        $count = count($messages);
                        $response['count'] = intval($count);
                        //echo $count;
                        //die;
                        //$subfavs = Product::model()->allfav($id, $start, $end);
                        //$item_arr = array();
                        $arr_message = array();
                        if ($messages != null) {
                            foreach ($messages as $message) {

                                $arr['id'] = intval($message['id']);
                                $arr['subject'] = $this->stringVal($message['title']);
                                $username_from = User::model()->findByPk($message['reciever_id'])->username;
                                $username_to = User::model()->findByPk($message['sender_id'])->username;
                                $arr['from'] = $this->stringVal($username_from);
                                $arr['to'] = $this->stringVal($username_to);
                                $arr['date'] = $this->stringVal($message['message_date']);
                                $replies = Reply::model()->findByAttributes(array('message_id' => $message['id'], 'user_id' => $id));
                                $arr_reply = array();
                                foreach ($replies as $reply) {
                                    $arr['replys'] = $this->stringVal($reply['details']);
                                    $arr_reply[] = $arr;
                                }
                                $arr_message[] = $arr;
                            }
                            $response['messages'] = $arr_message;
                            echo json_encode($response);
                        }
                    } else {
                        $this->responseWithMessage($this->MESSAGE_USER_NOT_FOUND);
                    }
                } else {
                    $this->responseWithMessage($this->MESSAGE_USER_NOT_FOUND);
                }
            }
        } catch (Exception $ex) {
            $this->responseWithMessage($this->MESSAGE_FAIL_EX);
        }
    }

    public function authUser2($hash, $id) {
        $model = User::model()->findByPk($id);
        $hash2 = md5($model->id . "-" . $model->email . "-" . User::simple_decrypt($model->password));
        if ($hash2 == $hash) {
            return true;
        } else {
            //$this->responseWithMessage($this->MESSAGE_ACCESS_DENIED);
            return false;
        }
    }
    public function authUserbyPass($user) {
        // echo $user['hash'];die;
        $model = User::model()->findByAttributes(array('id' => $user['id'], 'password' => User::simple_encrypt($user['hash'])));
        if (count($model) == 0) {
            $this->responseWithMessage($this->MESSAGE_ACCESS_DENIED);
            return false;
        }
        return true;
    }
    public function actionUpload() {
        try {
            $request = $this->parseRequest();
            if ($request != false) {
                $id = $request['userAuth']['id'];
                $hash = $request['userAuth']['hash'];
                if ($this->authUser2($hash,$id) == true) {
                    $binary = $request['binary'];
                    $ext = $request['ext'];
                    $type = $request['type'];
                    $media_type = $request['mediaType'];
                    // decode binary data
                    $decoded = base64_decode($binary);
                    // make the path
                    $file_name = md5(uniqid(rand(), 1)) . "." . strtolower($ext);
                    $root_dir = explode("protected", Yii::app()->basePath);

                    if ($type == 1) {
                        $type_folder = "product";
                    } elseif ($type == 2) {
                        $type_folder = "members";
                    } elseif ($type == 3) {
                        $type_folder = "shop";
                    } elseif ($type == 4) {
                        $type_folder = "gallery";
                    }
                    $path = $root_dir[0] . "/media/" . $type_folder;
                    // if the folder not found it will make the directory
                    if (!file_exists($path)) {
                        mkdir($path);
                    }

                    $upload_path = $path . "/" . $file_name;
                    // write data
                    $fp = fopen($upload_path, 'wb');
                    if (!fwrite($fp, $decoded)) {
                        $this->responseWithMessage($this->MESSAGE_FAIL);
                        die();
                    }
                    fclose($fp);
                    header('Content-Type: application/json');
                    $response["message"] = $this->MESSAGE_SUCCESS;
                    $response["fileName"] = $file_name;
                    echo json_encode($response);
                }
            }
        } catch (Exception $ex) {
            $this->responseWithMessage($this->MESSAGE_FAIL_EX);
        }
    }
    
    public function actionRegister() {
        try {
            $request = $this->parseRequest();
            if ($request != false) {

                // if the username or email found it returns found and die after that
                $this->checkUserDataFound('username', $request["username"]);
                $this->checkUserDataFound('email', $request["email"]);

                $model = new User;
                $model->username = $request["username"];
                $model->password = $request["password"];
                $model->groups_id = 3;
//                $model->lname = $request["lastName"];
                $model->email = $request["email"];

                if ($model->save()) {
                    //  $details = $request["address"];
//print_r($request);die;
                    $model_details = new UserDetails();
                    $model_details->user_id = $model->id;
//                    $model_details->address = $details["address"];
//                    $model_details->city = $details["city"];
//                    $model_details->state = $details["state"];
//                    $model_details->zipcode = $details["postcode"];
//                    $model_details->phone_no = $details["phone"];

                    if ($model_details->save(false)) {
                        $arr = $this->fetchUserObject($model);
                        $response["message"] = $this->MESSAGE_SUCCESS;
                        $response["user"] = $arr;
//                        echo '<pre>';
//                        print_r($response);
//                        echo '<pre>';
                        echo json_encode($response);
                    } else {
                        $model->delete();
                        $this->responseWithMessage($this->MESSAGE_FAIL);
                    }
                } else {
                    $this->responseWithMessage($this->MESSAGE_FAIL);
                }
            }
        } catch (Exception $ex) {
            $this->responseWithMessage($this->MESSAGE_FAIL_EX);
        }
    }

    public function actionCarListing() {
        try {
            $request = $this->parseRequest();
            if ($request != false) {

                $catId = $request['catId'];
                $mobileSize = $request['mobileSize'];
                $start = $request['start'];
                $end = $request['end'];


                $criteria = new CDbCriteria();
                $criteria->condition = "category_id=:category_id";
                $criteria->params = array(':category_id' => $catId);

                $criteria->offset = $start;
                $criteria->limit = $end;
                $car_items = Product::model()->findAll($criteria);

                if ($car_items) {
                    $response['message'] = $this->MESSAGE_SUCCESS;
                    $response['count'] = intval(count($car_items));


                    $arr = array();
                    $all_arr = array();
                    foreach ($car_items as $item) {

                        $arr['id'] = intval($item->id);
                        $this->widget('ext.SAImageDisplayer', array(
                            'image' => $item->main_image,
                            'size' => $mobileSize,
                            'title' => 'My super title',
                            'defaultImage' => "defualt.jpg",
                            'originalFolderName' => 'product',
                        ));
                        $arr['image'] = $this->stringVal($item->main_image);

                        $all_arr[] = $arr;
                    }
                    $response['items'] = $all_arr;

                    echo json_encode($response);
                } else {
//                    echo 'fff';
//                    die;
                    $this->responseWithMessage($this->MESSAGE_FAIL);
                }
            }
        } catch (Exception $ex) {
            $this->responseWithMessage($this->MESSAGE_FAIL_EX);
        }
    }

    public function actionCarItemDetails() {
        try {
            $request = $this->parseRequest();
            if ($request != false) {

                $Id = $request['Id'];
                $mobileSize = $request['mobileSize'];


                $car = Product::model()->findByPk($Id);
                $car_details = ProductDetails::model()->find("product_id = $car->id");
                $car_reviews = Review::model()->findAll("product_id = $car->id");

                if ($car) {
                    $response['message'] = $this->MESSAGE_SUCCESS;


                    $arr = array();
                    $review_arr = array();
                    $all_arr = array();
                    //    foreach ($car_items as $item) {

                    $arr['product'] = $this->stringVal($car->title);
                    $arr['price'] = $this->stringVal($car->price);
                    $arr['desc'] = $this->stringVal($car->description);
                    $motorMake = Make::model()->findByPk("$car_details->make_id")->title;
                    $arr['motorMake'] = $this->stringVal($motorMake);

                    $motorModel = MotorModel::model()->findByPk("$car_details->motor_model_id")->title;
                    $arr['motorModel'] = $this->stringVal($motorModel);
                    $arr['motorCondition'] = $this->stringVal($car_details->conditions);

                    if ($car_reviews) {
                        foreach ($car_reviews as $review) {
                            $user = User::model()->findByPk($review->user_id);
                            $review_arr['id'] = intval($review->id);
                            $review_arr['username'] = $this->stringVal($user->username);

                            $this->widget('ext.SAImageDisplayer', array(
                                'image' => $user->image,
                                'size' => $mobileSize,
                                'title' => 'My super title',
                                'defaultImage' => "defualt.jpg",
                                'originalFolderName' => 'product',
                            ));
                            $review_arr['image'] = $this->stringVal($user->image);


                            $review_arr['image'] = $this->stringVal($user->main_image);
                            $review_arr['date'] = intval($review->comment_date);
                            $review_arr['review'] = intval($review->comment);
                            $review_arr['rate'] = intval($review->rate);
                            $arr['reviews'][] = $review_arr;
                        }
                    } else {
                        $arr['reviews'] = array();
                    }

//                   
                    $all_arr[] = $arr;
//                }
                    $response['itemDetails'] = $all_arr;
//                echo '<pre>';
//                print_r($response);
//                echo '<pre>';

                    echo json_encode($response);
                } else {
//                    echo 'fff';
//                    die;
                    $this->responseWithMessage($this->MESSAGE_FAIL);
                }
            }
        } catch (Exception $ex) {
            $this->responseWithMessage($this->MESSAGE_FAIL_EX);
        }
    }

    public function actionCarsSearch() {
        try {
            $request = $this->parseRequest();

            if ($request != false) {
                $search = $request['search'];
                $makeId = $search['makeId'];
                $modelId = $search['modelId'];
                $maxPrice = $search['maxPrice'];
                $minPrice = $search['minPrice'];
                $gasId = $search['gasId'];
                $doorsId = $search['doorsId'];
                $kmId = $search['kmId'];
                $agesId = $search['agesId'];
                $emissonsId = $search['emissonsId'];
                $engines = $search['engines'];
                $powerEngine = $search['powerEngine'];
                $motorStatus = $search['motorStatus'];


                $start = $request['start'];
                $end = $request['end'];

                //$criteria='1=1 ';
//                if($maxPrice != '' or $minPrice != '') $criteria .= " AND price > $minPrice and price < $maxPrice";
                //  $criteria_det='1=1 JOIN product_details ON product.id = product_details.product_id';
               $query ='';
                if ($makeId != null) { $query .= " make_id=:make_id";}
                 if ($modelId != null) { $query .= " AND motor_model_id=:motor_model_id";}
                if ($gasId != null) { $query .= " AND gas_id=:gas_id";} 
                if ($doorsId != null) { $query .= " AND door_id=:door_id";} 
                if ($kmId != null) { $query .= " AND kmage_id=:kmage_id";} 
                
                if ($agesId != null) { $query .= " AND age_id=:age_id";} 
                if ($emissonsId != null) { $query .= " AND emission_id=:emission_id";} 
                if ($engines != null) { $query .= " AND engine_id=:engine_id";} 
                if ($powerEngine != null) { $query .= " AND power_engine=:power_engine";} 
                if ($motorStatus != null) { $query .= " AND motor_status=:motor_status";} 
                
           

                $criteria = new CDbCriteria();
                $criteria->condition = "category_id = 5 AND  price>=:min_price and price<=:max_price and id IN(SELECT product_id FROM product_details  WHERE $query"

                        . ")";

                $criteria->params = array(":min_price" => $minPrice,":max_price" => $maxPrice );
                
                 if ($makeId != null) {$criteria->params[':make_id'] = $makeId;}
                 if ($modelId != null) { $criteria->params[':motor_model_id'] = $modelId;}
                if ($gasId != null) {$criteria->params[':gas_id'] = $gasId;} 
                if ($doorsId != null) { $criteria->params[':door_id'] = $doorsId;} 
                if ($kmId != null) {$criteria->params[':kmage_id'] = $kmId;} 
                
                if ($agesId != null) { $criteria->params[':age_id'] = $agesId;} 
                if ($emissonsId != null) { $criteria->params[':emission_id'] = $emissonsId;} 
                if ($engines != null) { $criteria->params[':engine_id'] = $engines;} 
                if ($powerEngine != null) { $criteria->params[':power_engine'] = $powerEngine;} 
               
                $criteria->limit = $end;
                $criteria->offset = $start;
                $items = Product::model()->findAll($criteria);

                if ($items) {
                    $response['message'] = $this->MESSAGE_SUCCESS;
                    $response['count'] = count($items);

                    $arr = array();
                   // $review_arr = array();
                    $all_arr = array();
                    foreach ($items as $item) {

                        $arr['id'] = intval($item->id);

                        $arr['image'] = $this->stringVal($item->main_image);


//                   
                        $all_arr[] = $arr;
                    }
                    $response['items'] = $all_arr;
//                    echo '<pre>';
//                    print_r($response);
//                    echo '<pre>';

                    
                } else {
//                    echo 'fff';
//                    die;
                   $response['message']= $this->MESSAGE_FAIL;
                    $response['items']=array();
                }
                echo json_encode($response);
            }
        } catch (Exception $ex) {
            $this->responseWithMessage($this->MESSAGE_FAIL_EX);
        }
    }
    
    
    
     public function actionDecorItemDetails() {
        try {
            $request = $this->parseRequest();
            if ($request != false) {
                
                $Id = $request['Id'];
                $mobileSize = $request['mobileSize'];


                $decor_item = Product::model()->findByPk($Id);
                $decor_details = ProductDetails::model()->find("product_id = $Id");
                $decor_reviews = Review::model()->findAll("product_id = $Id");

                if ($decor_item) {
                    $response['message'] = $this->MESSAGE_SUCCESS;


                    $arr = array();
                    $size_arr = array();
                    $review_arr = array();
                    $all_arr = array();
                    //    foreach ($car_items as $item) {

                    $arr['dims']['id'] = intval($decor_item->id);
                    $arr['dims']['title'] = $this->stringVal($decor_item->title);
                    
                    $sizes = Size::model()->findAll("product_id = $decor_item->id");
                   
                     if ($sizes) {
                        foreach ($sizes as $size) {
                            $size_arr['id'] = intval($size->size_id);
                            $size_arr['title'] = $this->stringVal($size->title);

                            $arr['sizes'][] = $size_arr;
                        }
                    } else {
                        $arr['sizes'] = array();
                    }
                    
                    $arr["quantity"] = intval($decor_item->quantity);
                    $arr["description"] = $this->stringVal($decor_item->description);
                    
                    if ($decor_reviews) {
                        foreach ($decor_reviews as $review) {
                            $user = User::model()->findByPk($review->user_id);
                            $review_arr['id'] = intval($review->id);
                            $review_arr['username'] = $this->stringVal($user->username);

                            $this->widget('ext.SAImageDisplayer', array(
                                'image' => $user->image,
                                'size' => $mobileSize,
                                'title' => 'My super title',
                                'defaultImage' => "defualt.jpg",
                                'originalFolderName' => 'product',
                            ));
                            $review_arr['image'] = $this->stringVal($user->image);


                            $review_arr['image'] = $this->stringVal($user->main_image);
                            $review_arr['date'] = intval($review->comment_date);
                            $review_arr['review'] = intval($review->comment);
                            $review_arr['rate'] = intval($review->rate);
                            $arr['reviews'][] = $review_arr;
                        }
                    } else {
                        $arr['reviews'] = array();
                    }
                    
                  $gallery_images = GalleryPhoto::model()->findAll("gallery_id = $decor_item->gallery_id");
                    // $arr["subImages"]='[';
                    $subimage_arr = array();
                    if($gallery_images){
                    foreach ($gallery_images as $img) {
                        $this->widget('ext.SAImageDisplayer', array(
                            'image' => intval($img->rank) . '.jpg',
                            'size' => $this->stringVal($mobileSize),
                            'title' => 'My super title',
                            'defaultImage' => "defualt.jpg",
                            'originalFolderName' => '../gallery',
                        ));
                        $subimage_arr[] =  $this->stringVal($img->rank . '.jpg');
                    }
                    
                    $arr["subImages"] = $subimage_arr;
                }else{
                     $arr["subImages"] = array();
                }

                $owner_arr = array();
                $owner = User::model()->findByPk($decor_item->user_id);
                $owner_details = UserDetails::model()->findByPk($owner->id);
                $owner_arr["id"] = intval($owner->id);
                $owner_arr["name"] = $this->stringVal($owner->username);
                $owner_arr["paypalAccount"] = $owner_details->paypal_account;
                   $arr['productOwner'] = $owner_arr;
                   
                   
                   $shipping_arr = array();
                   $shippings = ShippingValue::model()->findAll("user_id = $owner->id");
                   
                    if ($shippings) {
                        foreach ($shippings as $ship) {
                           
                            $shipping_arr['id'] = intval($ship->id);
                            $country = Country::model()->findByPk($ship->country_id);
                            $shipping_arr['title'] = $this->stringVal($country->title);
                            $shipping_arr['value'] = intval($ship->title);

                            $arr['shippingTo'][] = $shipping_arr;
                        }
                    } else {
                        $arr['shippingTo'] = array();
                    }
                    
                    //echo 'ggg';die;
                    $color_arr = array();
                    $colors = Color::model()->findAll("product_id = $decor_item->id");
                   // print_r($colors);die;
                    
                     if ($colors) {
                        foreach ($colors as $color) {
                           
                            $color_arr['id'] = intval($color->id);
                            $color_arr['title'] = $this->stringVal($color->title);
                           
                            $arr['colors'][] = $color_arr;
                        }
                    } else {
                        $arr['colors'] = array();
                    }
                    
                    $all_arr[] = $arr;
//                }
                    $response['itemDetails'] = $all_arr;
//                echo '<pre>';
//                print_r($response);
//                echo '<pre>';

                    echo json_encode($response);
                } else {
//                    echo 'fff';
//                    die;
                    $this->responseWithMessage($this->MESSAGE_FAIL);
                }
            }
        } catch (Exception $ex) {
            $this->responseWithMessage($this->MESSAGE_FAIL_EX);
        }
    }
    
    public function actionDecorSearch() {
        try {
            $request = $this->parseRequest();

            if ($request != false) {
                $search = $request['search'];
                $subCatId = $search['brandId'];
                  $shopId = $request['shopId'];
                $startPrice = $search['startPrice'];
                $endPrice = $search['endPrice'];
                  $sizeId = $search['sizeId'];
                  $colorId = $search['colorId'];
                $decoreTypeId = $search['decoreTypeId'];
                $decoreStyleId = $search['decoreStyleId'];
               
                $start = $request['start'];
                $end = $request['end'];
                $mobileSize = $request['mobileSize'];
               
                //$criteria='1=1 ';
//                if($maxPrice != '' or $minPrice != '') $criteria .= " AND price > $minPrice and price < $maxPrice";
                //  $criteria_det='1=1 JOIN product_details ON product.id = product_details.product_id';
               $query ='';
                if ($subCatId != null) { $query .= " sub_category_id=:sub_category_id";}
                 if ($brandId != null) { $query .= " and brand_id=:brand_id";}
                if ($decoreTypeId != null) { $query .= " and decor_type_id=:decor_type_id";} 
                if ($decoreStyleId != null) { $query .= " and decor_style_id=:decor_style_id";} 
                
               
           

                $criteria = new CDbCriteria();
                $criteria->condition = "Category_id = 6 and price>=:startPrice and price<=:endPrice "
                        . " AND id IN(SELECT product_id FROM product_details  WHERE $query"

                        . " and id IN(select product_id from size where size_id = $sizeId )"
                        . " and id IN(select product_id from color where id = $colorId)"
                        . " and user_id IN (select user_id from user_details where user_id = $shopId))";

                $criteria->params = array(":startPrice" => $startPrice,":endPrice" => $endPrice );
                
                 if ($subCatId != null) {$criteria->params[':sub_category_id'] = $subCatId;}
                 if ($brandId != null) { $criteria->params[':brand_id'] = $brandId;}
                if ($decoreTypeId != null) {$criteria->params[':decor_type_id'] = $decoreTypeId;} 
                if ($decoreStyleId != null) { $criteria->params[':decor_style_id'] = $decoreStyleId;} 
               
              
                $criteria->limit = $end;
                $criteria->offset = $start;
                $items = Product::model()->findAll($criteria);
//                echo '<pre>';
//                print_r($items);
//                echo '<pre>';die;
                if ($items) {
                    $response['message'] = $this->MESSAGE_SUCCESS;
                    $response['count'] = count($items);

                    $arr = array();
                   // $review_arr = array();
                    $all_arr = array();
                    foreach ($items as $item) {

                        $arr['id'] = intval($item->id);

                        $arr['title'] = $this->stringVal($item->title);
                          $this->widget('ext.SAImageDisplayer', array(
                                'image' => $item->main_image,
                                'size' => $mobileSize,
                                'title' => 'My super title',
                                'defaultImage' => "defualt.jpg",
                                'originalFolderName' => 'product',
                            ));
                        $arr['image'] = $this->stringVal($item->main_image);
                        
                        $arr['price'] = $this->stringVal($item->price);


//                   
                        $all_arr[] = $arr;
                    }
                    $response['items'] = $all_arr;
//                    echo '<pre>';
//                    print_r($response);
//                    echo '<pre>';

                    
                } else {
//                    echo 'fff';
//                    die;
                   $response['message']= $this->MESSAGE_FAIL;
                    $response['items']=array();
                }
                echo json_encode($response);
            }
        } catch (Exception $ex) {
            $this->responseWithMessage($this->MESSAGE_FAIL_EX);
        }
    }
    
    public function actionElectronicsListing() {
        try {
            $request = $this->parseRequest();
            if ($request != false) {

                $catId = $request['catId'];
                $mobileSize = $request['mobileSize'];
                $start = $request['start'];
                $end = $request['end'];


                $criteria = new CDbCriteria();
                $criteria->condition = "category_id=:category_id";
                $criteria->params = array(':category_id' => $catId);

                $criteria->offset = $start;
                $criteria->limit = $end;
                $elec_items = Product::model()->findAll($criteria);
                //print_r($elec_items);die;
                if ($elec_items) {
                    $response['message'] = $this->MESSAGE_SUCCESS;
                    $response['count'] = intval(count($elec_items));


                    $arr = array();
                    $all_arr = array();
                    foreach ($elec_items as $item) {

                        $arr['id'] = intval($item->id);
                        $this->widget('ext.SAImageDisplayer', array(
                            'image' => $item->main_image,
                            'size' => $mobileSize,
                            'title' => 'My super title',
                            'defaultImage' => "defualt.jpg",
                            'originalFolderName' => 'product',
                        ));
                        $arr['image'] = $this->stringVal($item->main_image);
                        $arr['title'] = $this->stringVal($item->title);
                        $arr['price'] = intval($item->price);

                        //$arr['publishDate']= $this->stringVal($)
                        $all_arr[] = $arr;
                    }
                    $response['items'] = $all_arr;
//                    echo '<pre>';
//                    print_r($response);
//                    echo '<pre>';
//                    die;
                    echo '<pre>';
                    print_r($response);
                    echo '<pre>';
                    die;

                    echo json_encode($response);
                } else {
//                    echo 'fff';
//                    die;
                    $this->responseWithMessage($this->MESSAGE_FAIL);
                }
            }
        } catch (Exception $ex) {
            $this->responseWithMessage($this->MESSAGE_FAIL_EX);
        }
    }

    public function actionElectronicsSearch() {
        try {
            $request = $this->parseRequest();

            if ($request != false) {
                $search = $request['search'];
                $subCatId = $search['subCatId'];
                $brandId = $search['brandId'];
                  $shopId = $search['shopId'];
                $startPrice = $search['startPrice'];
                $endPrice = $search['endPrice'];
                  $sizeId = $search['sizeId'];
                  $colorId = $search['colorId'];
//                $decoreTypeId = $request['decoreTypeId'];
//                $decoreStyleId = $request['decoreStyleId'];
               
                $start = $request['start'];
                $end = $request['end'];
                $mobileSize = $request['mobileSize'];
               
                //$criteria='1=1 ';
//                if($maxPrice != '' or $minPrice != '') $criteria .= " AND price > $minPrice and price < $maxPrice";
                //  $criteria_det='1=1 JOIN product_details ON product.id = product_details.product_id';
               $query ='';
                if ($subCatId != null) { $query .= " sub_category_id=:sub_category_id";}
                 if ($brandId != null) { $query .= " and brand_id=:brand_id";}
//                if ($decoreTypeId != null) { $query .= " or decor_type_id=:decor_type_id";} 
//                if ($decoreStyleId != null) { $query .= " or decor_style_id=:decor_style_id";} 
                
               
           

                $criteria = new CDbCriteria();
                $criteria->condition = "Category_id = 6 and price>=:startPrice and price<=:endPrice "
                        . " and id IN(SELECT product_id FROM product_details  WHERE $query"

                        . " and id IN(select product_id from size where size_id = $sizeId )"
                        . " and id IN(select product_id from color where id = $colorId)"
                        . " and user_id IN (select user_id from user_details where user_id = $shopId))";

                $criteria->params = array(":startPrice" => $startPrice,":endPrice" => $endPrice );
                
                 if ($subCatId != null) {$criteria->params[':sub_category_id'] = $subCatId;}
                 if ($brandId != null) { $criteria->params[':brand_id'] = $brandId;}
//                if ($decoreTypeId != null) {$criteria->params[':decor_type_id'] = $decoreTypeId;} 
//                if ($decoreStyleId != null) { $criteria->params[':decor_style_id'] = $decoreStyleId;} 
               
              
                $criteria->limit = $end;
                $criteria->offset = $start;
                $items = Product::model()->findAll($criteria);
//                echo '<pre>';
//                print_r($items);
//                echo '<pre>';die;
                if ($items) {
                    $response['message'] = $this->MESSAGE_SUCCESS;
                    $response['count'] = count($items);

                    $arr = array();
                   // $review_arr = array();
                    $all_arr = array();
                    foreach ($items as $item) {

                        $arr['id'] = intval($item->id);

                        $arr['title'] = $this->stringVal($item->title);
                          $this->widget('ext.SAImageDisplayer', array(
                                'image' => $item->main_image,
                                'size' => $mobileSize,
                                'title' => 'My super title',
                                'defaultImage' => "defualt.jpg",
                                'originalFolderName' => 'product',
                            ));
                        $arr['image'] = $this->stringVal($item->main_image);
                        
                        $arr['price'] = $this->stringVal($item->price);


//                   
                        $all_arr[] = $arr;
                    }
                    $response['items'] = $all_arr;
//                    echo '<pre>';
//                    print_r($response);
//                    echo '<pre>';

                    
                } else {
//                    echo 'fff';
//                    die;
                   $response['message']= $this->MESSAGE_FAIL;
                    $response['items']=array();
                }
                echo json_encode($response);
            }
        } catch (Exception $ex) {
            $this->responseWithMessage($this->MESSAGE_FAIL_EX);
        }
    }
    
    
    public function actionClothsSearch() {
        try {
            $request = $this->parseRequest();

            if ($request != false) {
                $search = $request['search'];
                $subCatId = $search['subCatId'];
                $brandId = $search['brandId'];
                  $shopId = $search['shopId'];
                $startPrice = $search['startPrice'];
                $endPrice = $search['endPrice'];
                  $sizeId = $search['sizeId'];
                  $colorId = $search['colorId'];
//                $decoreTypeId = $request['decoreTypeId'];
//                $decoreStyleId = $request['decoreStyleId'];
               
                $start = $request['start'];
                $end = $request['end'];
                $mobileSize = $request['mobileSize'];
//                echo '<pre>';
//                print_r($request);
//                echo '<pre>';
                //$criteria='1=1 ';
//                if($maxPrice != '' or $minPrice != '') $criteria .= " AND price > $minPrice and price < $maxPrice";
                //  $criteria_det='1=1 JOIN product_details ON product.id = product_details.product_id';
               $query ='';
                if ($subCatId != null) { $query .= " sub_category_id=:sub_category_id";}
                 if ($brandId != null) { $query .= " and brand_id=:brand_id";}
//                if ($decoreTypeId != null) { $query .= " or decor_type_id=:decor_type_id";} 
//                if ($decoreStyleId != null) { $query .= " or decor_style_id=:decor_style_id";} 
                
               
               

                $criteria = new CDbCriteria();
                $criteria->condition = "Category_id = 1 and price>=:startPrice and price<=:endPrice "
                        . " and id IN(SELECT product_id FROM product_details  WHERE $query"
//
                        . " or id IN(select product_id from size where size_id = $sizeId )"
                        . " or id IN(select product_id from color where id = $colorId)"
                        . " or user_id IN (select user_id from user_details where user_id = $shopId)"
                        . ")"
                        ;
 
                $criteria->params = array(":startPrice" => $startPrice,":endPrice" => $endPrice );
                
                if ($subCatId != null) {$criteria->params[':sub_category_id'] = $subCatId;}
                 if ($brandId != null) { $criteria->params[':brand_id'] = $brandId;}
//                if ($decoreTypeId != null) {$criteria->params[':decor_type_id'] = $decoreTypeId;} 
//                if ($decoreStyleId != null) { $criteria->params[':decor_style_id'] = $decoreStyleId;} 
               
              
                $criteria->limit = $end;
                $criteria->offset = $start;
                $items = Product::model()->findAll($criteria);
//                 echo 'ffffff';die;
//                echo '<pre>';
//                print_r($items);
//                echo '<pre>';die;
                if ($items) {
                    $response['message'] = $this->MESSAGE_SUCCESS;
                    $response['count'] = count($items);

                    $arr = array();
                   // $review_arr = array();
                    $all_arr = array();
                    foreach ($items as $item) {

                        $arr['id'] = intval($item->id);

                        $arr['title'] = $this->stringVal($item->title);
                          $this->widget('ext.SAImageDisplayer', array(
                                'image' => $item->main_image,
                                'size' => $mobileSize,
                                'title' => 'My super title',
                                'defaultImage' => "defualt.jpg",
                                'originalFolderName' => 'product',
                            ));
                        $arr['image'] = $this->stringVal($item->main_image);
                        
                        $arr['price'] = $this->stringVal($item->price);


//                   
                        $all_arr[] = $arr;
                    }
                    $response['items'] = $all_arr;
//                    echo '<pre>';
//                    print_r($response);
//                    echo '<pre>';
                    echo '<pre>';
                    print_r($response);
                    echo '<pre>';

                    
                } else {
//                    echo 'fff';
//                    die;
                   $response['message']= $this->MESSAGE_FAIL;
                   $response['items']= array();
                }
                echo json_encode($response);
            }
        } catch (Exception $ex) {
            
            $this->responseWithMessage($this->MESSAGE_FAIL_EX);
        }
    }
  
}

?>