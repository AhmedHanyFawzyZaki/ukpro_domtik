<?php

class ApiController extends Controller {

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
    public $MESSAGE_MSG_NOT_FOUND = "message_not_found";
    public $MESSAGE_ITEM_NOT_FOUND = "item_not_found";
    public $MESSAGE_ITEM_USER_FOUND = "item_already_liked_by_this_user";

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

            $arr["email"] = $this->stringVal($user->email);
            $arr["username"] = $this->stringVal($user->username);
            $arr["fName"] = $this->stringVal($user->fname);
            $arr["lName"] = $this->stringVal($user->lname);
            $arr["phone"] = $this->stringVal($user_details->phone_no);
            $arr["website"] = $this->stringVal($user_details->website);
            $arr["facebook"] = $this->stringVal($user_details->facebook);
            $arr["twitter"] = $this->stringVal($user_details->twitter);
            $arr["phone"] = $this->stringVal($user_details->phone_no);
            $arr["instagram"] = $this->stringVal($user_details->instagram);
            $arr["linkedin"] = $this->stringVal($user_details->linkedin);
            $arr["description"] = $this->stringVal($user->details);
            // $arr["description"] = $this->stringVal($user_details->description);
            $arr["image"] = $this->stringVal($user->image);
            //$arr["active"] = intval($user->active);

            $address_arr['countryId'] = intval($user_details->country_id);
            $address_arr['cityId'] = intval($user_details->city_id);
            $address_arr['address'] = $this->stringVal($user_details->address);
            $address_arr['postcode'] = intval($user_details->zipcode);
            $address_arr['longt'] = $this->stringVal($user_details->lng);
            $address_arr['lat'] = $this->stringVal($user_details->lat);


            $shop_arr['shopid'] = intval($user->id);
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

    public function actionRegisterold() {
        try {
            $request = $this->parseRequest();
            if ($request != false) {
                // if the username or email found it returns found and die after that
                $this->checkUserDataFound('username', $request["username"]);
                $this->checkUserDataFound('email', $request["email"]);

                $model = new User;
                $model->username = $request["username"];
                $model->password = $request["password"];
                $model->fname = $request["firstName"];
                $model->lname = $request["lastName"];
                $model->email = $request["email"];

                if ($model->save()) {
                    $details = $request["address"];

                    $model_details = new UserDetails();
                    $model_details->user_id = $model->id;
                    $model_details->address = $details["address"];
                    $model_details->city = $details["city"];
                    $model_details->state = $details["state"];
                    $model_details->zipcode = $details["postcode"];
                    $model_details->phone_no = $details["phone"];

                    if ($model_details->save()) {
                        $arr = $this->fetchUserObject($model);
                        $response["message"] = $this->MESSAGE_SUCCESS;
                        $response["user"] = $arr;
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
                    if ($sent === false) {
                        $this->responseWithMessage($this->MESSAGE_SUCCESS);
                    } else {
                        $this->responseWithMessage($this->MESSAGE_FAIL . 'uu');
                    }
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

    public function actionUploadold() {
        try {
            $request = $this->parseRequest();
            if ($request != false) {
                if ($this->authUser($request['user']) == true) {
                    $binary = $request['binary'];
                    $ext = $request['ext'];
                    $type = $request['type'];
                    // decode binary data
                    $decoded = base64_decode($binary);
                    // make the path
                    $file_name = md5(uniqid(rand(), 1)) . "." . strtolower($ext);
                    $root_dir = explode("protected", Yii::app()->basePath);

                    $path = $root_dir[0] . "/media/" . $type;
                    // if the folder not found it will make the directory
                    if (!file_exists($path)) {
                        mkdir($path);
                    }

                    $upload_path = $path . "/" . $file_name;
                    // write data
                    $fp = fopen($upload_path, 'wb');
                    if (!fwrite($fp, $decoded)) {
                        $this->responseWithMessage($this->MESSAGE_FAIL);
                        //     die();
                    }
                    fclose($fp);
                    header('Content-Type: application/json');
                    $response["message"] = $this->MESSAGE_SUCCESS;
                    $response["file"] = $file_name;
                    echo json_encode($response);
                }
            }
        } catch (Exception $ex) {
            $this->responseWithMessage($this->MESSAGE_FAIL_EX);
        }
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
        //();
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
                    //     die();
                }
            } else {
                $this->responseWithMessage($key . '_found');
                // die();
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
            $type = 0;
            foreach ($all as $item) {
                $cats_arr = array();
                $arr['id'] = intval($item->id);
                $arr['title'] = $this->stringVal($item->title);
                $arr['image'] = $this->stringVal($item->image);
                $allcats = ProductCategory::model()->findAllByAttributes(array('category_id' => $item->id));
                foreach ($allcats as $cat) {
                    $arr2['id'] = intval($cat->id);
                    $arr2['title'] = $this->stringVal($cat->title);
                    if ($cat->id == 5 or $cat->id == 10) {
                        $arr2['type'] = 1;
                    } elseif ($cat->id == 9) {
                        $arr2['type'] = 2;
                    } else {
                        $arr2['type'] = $type;
                    }
                    $arr['categories'][] = $arr2;
                }
                $all_arr[] = $arr;
            }


            $response['webSiteCats'] = $all_arr;
            echo json_encode($response);
//            echo '<pre>';
//            print_r($response);
//            echo ' <pre>';
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
                $all = SubCategory::model()->findAllByAttributes(array('product_category_id' => $websitecatid));
                foreach ($all as $item) {
                    $cats_arr = array();
                    $arr['id'] = intval($item->id);
                    $arr['title'] = $this->stringVal($item->title);
                    $all_arr[] = $arr;
                }

                $response['subCats'] = $all_arr;
//                 echo '<pre>';
//            print_r($response);
//            echo ' <pre>';
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
                    $arr['webSiteCatId'] = intval(0);
                    $arr['catId'] = intval(0);
                    $arr['subCatId'] = intval(0);
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
                    $arr3['price'] = $this->stringVal($item->price) . ' $';
                    $item_arr[] = $arr3;
                }
                $response['featuredItems'] = $item_arr;
//                   echo '<pre>';
//            print_r($response);
//            echo ' <pre>';die;
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
                $id = $request['userAuth']['id'];
                $hash = $request['userAuth']['hash'];
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
//               print_r($subitems);die;
                $user = User::model()->findByPk($id);
//                echo md5($user->id . "-" . $user->email . "-" . User::simple_decrypt($user->password));
//                die;
                if (count($user) == 1) {
                    $authuser = $this->authUser2($hash, $id);

                    if ($authuser === true) {
                        if ($subitems) {
                            foreach ($subitems as $item) {
                                $favorite = Favourite::model()->find("product_id = $item->id");
                                $arr3['id'] = intval($item->id);
                                // $arr3['webSiteCatId'] = intval($item->title);
                                // $arr3['catId'] = intval($item->product_category_id);
                                // $product_details = ProductDetails::model()->findByAttributes(array('product_id' => $item->id));
                                // echo ($item->category->title);die;
                                // $arr3['subCatId'] = intval($product_details->sub_category_id);
                                // $arr3['catTitle'] = $this->stringVal($item->category->title);
                                $arr3['title'] = $this->stringVal($item->title);
                                //  $arr3['description'] = $this->stringVal($item->description);
                                //  $arr3['status'] = $this->stringVal(ProductStatus::model()->findByPk($item->product_status_id)->title);
                                //  $arr3['quantity'] = intval($item->quantity);


                                $this->widget('ext.SAImageDisplayer', array(
                                    'image' => $item->main_image,
                                    'size' => $mobilesize,
                                    'title' => 'My super title',
                                    'defaultImage' => "defualt.jpg",
                                    'originalFolderName' => 'product',
                                ));
                                $arr3['image'] = $this->stringVal($item->main_image);

                                if ($item->flag == 1) {
                                    $arr3['externalLink'] = 1;
                                } else {
                                    $arr3['externalLink'] = 0;
                                }
                                $arr3['price'] = intval($item->price);
                                if ($favorite != null) {
                                    $arr3['isFavourite'] = 1;
                                } else {
                                    $arr3['isFavourite'] = 0;
                                }
                                $item_arr[] = $arr3;
                            }
                        }
                        $response['items'] = $item_arr;
                        echo json_encode($response, JSON_UNESCAPED_SLASHES);

//                echo '<pre>';
//                print_r($response);
//                echo '<pre>';
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

    public function actionitemDetails() {
        try {
            $request = $this->parseRequest();
            if ($request != false) {
//                print_r($request);die;
                $mobilesize = $request['mobileSize'];
                $Id = $request['Id'];
                $proitem = Product::model()->findBypk($Id);
                //echo $proitem->id;
                //die;

                if (count($proitem) > 0) {
                    $response['message'] = $this->MESSAGE_SUCCESS;
                    $itemcolors = ProductColor::model()->findAllByAttributes(array('product_id' => $Id));
                    //print_r($itemcolors);
                    //die;
                    $itemsizes = ProductSizes::model()->findAllByAttributes(array('product_id' => $Id));
                    $itemrevs = Review::model()->findAllByAttributes(array('product_id' => $Id));
                    $itemphotos = GalleryPhoto::model()->findAllByAttributes(array('gallery_id' => $proitem->gallery_id));
                    $product_owner_id = intval($proitem->user_id);
                    $product_owner_name = $this->stringVal(User::model()->findByPk($product_owner_id)->fname . " " . User::model()->findByPk($product_owner_id)->lname);
                    $userdetails = UserDetails::model()->findByAttributes(array("user_id" => $product_owner_id));
                    $product_owner_paypal = $this->stringVal($userdetails->paypal_account);

                    $item['id'] = intval($proitem->id);

                    $item['title'] = $this->stringVal($proitem->title);
                    $this->widget('ext.SAImageDisplayer', array(
                        'image' => $proitem->main_image,
                        'size' => $mobilesize,
                        'title' => 'My super title',
                        'defaultImage' => "defualt.jpg",
                        'originalFolderName' => 'product',
                    ));

                    if ($proitem->flag == 1) {
                        $item['externalLink'] = 1;
                    } else {
                        $item['externalLink'] = 0;
                    }

                    $item['image'] = $this->stringVal($proitem->main_image);
                    $item['price'] = $this->stringVal($proitem->price) . ' $';
                    $item['description'] = $this->stringVal($proitem->description);
                    $item['productOwner'] = array("id" => $product_owner_id, "name" => $product_owner_name, "paypalAccount" => $product_owner_paypal);
                    $colors = array();
//                     print_r($itemsizes);
//                        die;
                    foreach ($itemcolors as $color) {

                        $arr1['id'] = intval($color->colors->id);
                        $arr1['title'] = $this->stringVal($color->colors->title);
                        $arr1['color'] = $this->stringVal($color->colors->color);
                        $colors[] = $arr1;
                    }
                    $item['colors'] = $colors;
                    $sizes = array();
                    foreach ($itemsizes as $size) {
                        $arr2['id'] = intval($size->sizes_id);
                        $arr2['size'] = $this->stringVal(Sizes::model()->findByPk($size->sizes_id)->title);

                        $sizes[] = $arr2;
                    }
                    $item['sizes'] = $sizes;
                    $reviews = array();
                    foreach ($itemrevs as $rev) {
                        $arr3['id'] = intval($rev->id);
                        $arr3['comment'] = $this->stringVal($rev->comment);
                        $reviews[] = $arr3;
                    }
                    $item['reviews'] = $reviews;
                    $photos = array();
                    foreach ($itemphotos as $photo) {
                        $arr4['id'] = intval($photo->id);
                        $arr4['image'] = $this->stringVal($photo->file_name);
                        $arr4['rank'] = $this->stringVal($photo->rank);

                        $photos[] = $arr4;
                    }
                    $item['subImages'] = $photos;
                    //$response['colors'] = $colors;
                    $response['itemDetails'] = $item;
//                    echo '<pre>';
//                    print_r($response);
//                     echo '<pre>';die;
                    echo json_encode($response);
                } else {
                    $response['message'] = $this->MESSAGE_ITEM_NOT_FOUND;
                    $response['itemDetails'] = array();

                    echo json_encode($response);
                }
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

                            if ($fav->flag == 1) {
                                $arr3['externalLink'] = 1;
                            } else {
                                $arr3['externalLink'] = 0;
                            }

                            $arr3['image'] = $this->stringVal($fav->main_image);
                            $arr3['title'] = $this->stringVal($fav->title);
                            $arr3['price'] = intval($fav->price) . ' $';
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
//                echo User::model()->simple_decrypt($user->password) . "<br/>";
//                echo md5($user->id . "-" . $user->email . "-" . User::simple_decrypt($user->password));
//                die;
                if (count($user) == 1) {
//print_r($user);die;
                    $authuser = $this->authUser2($hash, $id);
                    if ($authuser != false) {
                        if ($oldpass == User::model()->simple_decrypt($user->password)) {
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

    public function actionEditProfile() {
        try {
            $request = $this->parseRequest();
            if ($request != false) {
                $id = $request['userAuth']['id'];
                $hash = $request['userAuth']['hash'];

                $user = $request['user'];
                $model = User::model()->findByPk($id);
// print_r($model);die;
                if (count($model) == 1) {

                    $authuser = $this->authUser2($hash, $id);
//                    echo md5($model->id . "-" . $model->email . "-" . User::simple_decrypt($model->password));
//                    die;
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
                        $submsgs = Message::model()->allMsgs($id, $start, $end, $flag);

                        $arr_message = array();
                        if ($submsgs != null) {
                            foreach ($submsgs as $message) {

                                $arr['id'] = intval($message['id']);
                                $arr['subject'] = $this->stringVal($message['title']);
                                $username_from = User::model()->findByPk($message['reciever_id'])->username;
                                $username_to = User::model()->findByPk($message['sender_id'])->username;
                                $arr['from'] = $this->stringVal($username_from);
                                $arr['to'] = $this->stringVal($username_to);
                                $arr['date'] = $this->stringVal($message['message_date']);
                                $replies = Reply::model()->findAllByAttributes(array('message_id' => $message['id']));
//                                echo '<pre>';
//print_r($replies);echo '<pre>';die;
                                if (count($replies) > 0) {
                                    foreach ($replies as $reply) {
                                        $user = User::model()->findByPk($reply->user_id);
                                        $test = array();
                                        $arr_['id'] = intval($reply->id);
                                        $arr_['message'] = $this->stringVal($reply->details);
                                        $arr_['date'] = $this->stringVal($reply->reply_date);
                                        $arr_['user'] = $this->fetchUserObject($user);
                                    }
                                }
                                $arr['replys'] = $arr_;
                                $arr_message[] = $arr;
                            }
                            $response['messages'] = $arr_message;
//                             echo '<pre>';
//                                print_r($response);
//                                 echo '<pre>';
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

    public function actionCreateMessage() {
        try {
            $request = $this->parseRequest();
            if ($request != false) {
                $id = $request['userAuth']['id'];
                $hash = $request['userAuth']['hash'];
                $send_to = $request['id'];
                $title = $request['title'];
                $content = $request['content'];
                $model = User::model()->findByPk($id);
                //echo md5($model->id . "-" . $model->email . "-" . User::simple_decrypt($model->password));
                //die;
                if (count($model) == 1) {
                    $authuser = $this->authUser2($hash, $id);
                    if ($authuser == true) {
                        $msg = new Message();
                        $msg->sender_id = $id;
                        $msg->reciever_id = $send_to;
                        $msg->title = $title;
                        $msg->details = $content;
                        $msg->message_date = date("Y-m-d");
                        $msg->published = 1;
                        if ($msg->save()) {
                            $this->responseWithMessage($this->MESSAGE_SUCCESS);
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

    public function actionDeleteMessage() {
        try {
            $request = $this->parseRequest();
            if ($request != false) {
                $id = $request['userAuth']['id'];
                $hash = $request['userAuth']['hash'];
                $msg_id = $request['id'];
                $model = User::model()->findByPk($id);
//echo md5($model->id . "-" . $model->email . "-" . User::simple_decrypt($model->password));
                //die;
                if (count($model) == 1) {
                    $authuser = $this->authUser2($hash, $id);
                    if ($authuser == true) {
                        $msg = Message::model()->findByPk($msg_id);
                        //echo $msg_id;
                        //die;
                        if ($msg === null) {
                            $this->responseWithMessage($this->MESSAGE_MSG_NOT_FOUND);
                        } else {

                            if ($msg->delete()) {
                                $this->responseWithMessage($this->MESSAGE_SUCCESS);
                            } else {
                                $this->responseWithMessage($this->MESSAGE_FAIL);
                            }
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

    public function actionReplyToMessage() {
        try {
            $request = $this->parseRequest();
            if ($request != false) {
                $id = $request['userAuth']['id'];
                $hash = $request['userAuth']['hash'];
                $msg_id = $request['id'];
                $content = $request['content'];
                $model = User::model()->findByPk($id);
//echo md5($model->id . "-" . $model->email . "-" . User::simple_decrypt($model->password));
                //die;
                if (count($model) == 1) {
                    $msg = Message::model()->findByPk($msg_id);
                    if ($msg === null) {
                        $this->responseWithMessage($this->MESSAGE_MSG_NOT_FOUND);
                    } else {
                        $authuser = $this->authUser2($hash, $id);
                        if ($authuser == true) {
                            $reply = new Reply();
                            $reply->message_id = $msg_id;
                            $reply->user_id = $id;
                            $reply->details = $content;
                            $reply->reply_date = date("Y-m-d H:i:s");
                            $reply->published = 1;
                            if ($reply->save()) {
                                $this->responseWithMessage($this->MESSAGE_SUCCESS);
                            } else {
                                $this->responseWithMessage($this->MESSAGE_FAIL);
                            }
                        }
                    }
                } else {
                    $this->responseWithMessage($this->MESSAGE_USER_NOT_FOUND);
                }
            }
        } catch (Exception $ex) {
            $this->responseWithMessage($this->MESSAGE_FAIL_EX);
        }
    }

    public function actionOrders() {
        try {
            $request = $this->parseRequest();

            if ($request != false) {

                $id = $request['userAuth']['id'];
                $hash = $request['userAuth']['hash'];
                $start = $request['start'];
                $end = $request['end'];
                $flag = $request['flag'];
                $model = User::model()->findByPk($id);

//                echo md5($model->id . "-" . $model->email . "-" . User::simple_decrypt($model->password));
//                die;
                if (count($model) == 1) {
                    $authuser = $this->authUser2($hash, $id);
                    if ($authuser == true) {
                        $response['message'] = $this->MESSAGE_SUCCESS;
                        $orders = Order::model()->allOrders($id, $start, $end, 1, $flag);
                        $count = count($orders);
                        $response['count'] = intval($count);
                        //buyer
                        if ($flag != 1) {
                            $suborders = Order::model()->allOrders($id, $start, $end, $flag);
                        } else {
                            $orders_details = OrderDetails::model()->findAll("seller_id = $id");
                            $orders_ids = array();
                            if ($orders_details) {
                                foreach ($orders_details as $ord) {
                                    $orders_ids[] = $ord->order_id;
                                }
                            }
//                            echo'<pre>';
//                             print_r($orders_ids);die;
                            //  $orders_ids= array(1,2);
                            $orders_ids_ = implode(',', $orders_ids);
                            if ($orders_ids_) {
                                $suborders = Order::model()->findAll("1=1 and id IN ($orders_ids_)");
                            } else {
                                $suborders = null;
                            }
//print_r($suborders);die;
                        }
                        $order_arr = array();
                        if ($suborders != null) {
                            $counter = 0;
                            foreach ($suborders as $order) {
                                $counter++;
                                $arr['id'] = intval($order['id']);
                                $arr['orderNo'] = intval($counter);
                                $arr['date'] = $this->stringVal($order['creation_date']);
                                $arr['status'] = $this->stringVal(OrderStatus::model()->findByPk($order['status_id'])->title);
                                $orderDetails = OrderDetails::model()->findAllByAttributes(array('order_id' => $order['id']));
                                foreach ($orderDetails as $det) {
                                    //  echo $det['product_id'];die;
                                    $arr['orderDetail']['title'] = $this->stringVal(Product::model()->findByPk($det['product_id'])->title);
                                    $client_name = $this->stringVal(User::model()->findByPk($det['seller_id'])->fname) . " " . $this->stringVal(User::model()->findByPk($det['seller_id'])->lname);

                                    $arr['orderDetail']['client'] = $client_name;
                                    $arr['orderDetail']['clientAddress'] = $this->stringVal($det['shipping_address']);
                                    $arr['orderDetail']['shippingCity'] = $this->stringVal(City::model()->findByPk($det['shipping_city'])->title);
                                    $arr['orderDetail']['shippingCountry'] = $this->stringVal(Country::model()->findByPk($det['shipping_country'])->title);
                                    $arr['orderDetail']['shippingPostCode'] = $this->stringVal($det['shipping_postcode']);
                                    $arr['orderDetail']['shippingPrice'] = $this->stringVal($det['shipping_price'] . " $");
                                    $arr['orderDetail']['totalPrice'] = $this->stringVal($det['total_price'] . " $");
                                    $arr['orderDetail']['netPrice'] = $this->stringVal($det['net_price'] . " $");
                                    $arr['orderDetail']['commision'] = $this->stringVal($det['commission_price'] . " $");
                                    $arr['orderDetail']['quantity'] = intval($det['quantity']);
                                    $arr['orderDetail']['color'] = $this->stringVal($det['color']);
                                    $arr['orderDetail']['size'] = $this->stringVal($det['size']);
                                    // $order_details[] = $arr;
                                }
                                //$response['orderDetail'] = $arr;
                                $order_array[] = $arr;
                            }
                            $response['orders'] = $order_array;
                            echo json_encode($response);
//                            echo '<pre>';
//                            print_r($response);
//                            echo '<pre>';
                        } else {
                            $response['orders'] = array();
                            echo json_encode($response);
//                            echo '<pre>';
//                            print_r($response);
//                            echo '<pre>';
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

    public function actionSearchOptions() {
        try {
            $request = $this->parseRequest();
            if ($request != false) {
                $catid = $request['catId'];
                $subcat_id = $request['subCatId'];


                $model = Category::model()->findByPk($catid);
                //print_r(count($model));
                //die;
                if (count($model) == 0) {
                    $this->responseWithMessage($this->MESSAGE_ITEM_NOT_FOUND);
                } else {
                    $subcats = ProductCategory::model()->findAllByAttributes(array('category_id' => $catid));
                    $subcats_arr = array();
                    foreach ($subcats as $sub) {
                        $arr['id'] = intval($sub['id']);
                        $arr['title'] = $this->stringVal($sub['title']);
                        $subcats_arr[] = $arr;
                    }
                    $response['subCats'] = $subcats_arr;
                    $brands = Brand::model()->findAllByAttributes(array('category_id' => $catid));
                    $brand_arr = array();
                    foreach ($brands as $brand) {
                        $arr2['id'] = intval($brand['id']);
                        $arr2['title'] = $this->stringVal($brand['title']);
                        $brand_arr[] = $arr2;
                    }
                    $response['brands'] = $brand_arr;
                    $cr = new CDbCriteria();
                    $cr->alias = 'user_details';
                    $cr->condition = "groups_id = 1 or groups_id = 4";
                    $cr->join = 'INNER JOIN user ON user.id=user_details.user_id';
                    $users = UserDetails::model()->findAll($cr);
                    //print_r($users);
                    //die;
                    $user_arr = array();
                    foreach ($users as $user) {
                        $arr13['id'] = intval($user['id']);
                        $arr13['name'] = $this->stringVal($user['shop_name']);
                        $arr13['address'] = $this->stringVal($user['shop_address']);
                        $arr13['description'] = $this->stringVal($user['shop_description']);
                        $user_arr[] = $arr13;
                    }
                    $response['shops'] = $user_arr;
                    $sizes = Sizes::model()->findAllByAttributes(array('category_id' => $catid));
                    $sizes_arr = array();
                    foreach ($sizes as $size) {
                        $arr3['id'] = intval($size['id']);
                        $arr3['title'] = $this->stringVal($size['title']);
                        $sizes_arr[] = $arr3;
                    }
                    $response['sizes'] = $sizes_arr;
                    $colors = Colors::model()->findAll();
                    $colors_arr = array();
                    foreach ($colors as $color) {
                        $arr4['id'] = intval($color['id']);
                        $arr4['title'] = $this->stringVal($color['title']);
                        $colors_arr[] = $arr4;
                    }
                    $response['colors'] = $colors_arr;

                    if ($catid == 6) {
                        $decoretype = DecorType::model()->findAll();
                        $decorestyle = DecorStyle::model()->findAll();
                        $decoretype_arr = array();
                        $decorestyle_arr = array();
                        foreach ($decoretype as $type) {
                            $arr5['id'] = intval($type['id']);
                            $arr5['title'] = $this->stringVal($type['title']);
                            $decoretype_arr[] = $arr5;
                        }
                        foreach ($decorestyle as $style) {
                            $arr6['id'] = intval($style['id']);
                            $arr6['title'] = $this->stringVal($style['title']);
                            $decorestyle_arr[] = $arr6;
                        }
                        $response['decoreType'] = $decoretype_arr;
                        $response['decoreStyle'] = $decorestyle_arr;
                    }
                    $response['startPrice'] = intval(0);
                    $response['endPrice'] = intval(Product::model()->find(array('condition' => 'category_id=' . $catid, 'order' => 'price desc'))->price);
                    if ($catid == 3 && !empty($subcat_id)) {
                        $special_products = Product::model()->findAll(array('condition' => 'category_id=3 and product_category_id=' . $subcat_id . ' and category_featured=1', 'limit' => '2', 'order' => 'rand()'));
                        if ($special_products) {
                            $special_prods = array();
                            foreach ($special_products as $i => $fp) {
                                $arr7['id'] = intval($fp->id);
                                $arr7['title'] = $this->stringVal($fp->title);
                                $this->widget('ext.SAImageDisplayer', array(
                                    'image' => $fp->main_image,
                                    'size' => "xhimage",
                                    'title' => 'My super title',
                                    'defaultImage' => "defualt.jpg",
                                    'originalFolderName' => 'product',
                                ));
                                $arr7['image'] = $this->stringVal($fp->main_image);

                                if ($fp->flag == 1) {
                                    $arr7['externalLink'] = 1;
                                } else {
                                    $arr7['externalLink'] = 0;
                                }

                                if ($fp->price) {
                                    $arr7['price'] = intval($fp->price) . ' $';
                                } else {
                                    $min_price = Size::model()->find(array('condition' => 'product_id=' . $fp->id, 'order' => 'price asc'))->price;
                                    $arr7['price'] = intval($min_price) . ' $';
                                }
                                $special_prods[] = $arr7;
                            }
                        }
                        $response['special'] = $special_prods;
                    } else {
                        $response['special'] = array();
                    }
                    if (($catid == 1 || $catid == 9 || $catid == 10) && !empty($subcat_id)) {
                        $featured_products = Product::model()->findAll(array('condition' => 'category_id=' . $catid . ' and category_featured=1 AND product_status_id !=2', 'limit' => '6', 'order' => 'rand()'));

                        if (count($featured_products) > 0) {
                            $feat_prods = array();
                            foreach ($featured_products as $i => $fp) {
                                $arr12['id'] = intval($fp->id);
                                $arr12['title'] = $this->stringVal($fp->title);
                                $this->widget('ext.SAImageDisplayer', array(
                                    'image' => $fp->main_image,
                                    'size' => "xhimage",
                                    'title' => 'My super title',
                                    'defaultImage' => "defualt.jpg",
                                    'originalFolderName' => 'product',
                                ));

                                if ($fp->flag == 1) {
                                    $arr12['externalLink'] = 1;
                                } else {
                                    $arr12['externalLink'] = 0;
                                }

                                $arr12['image'] = $this->stringVal($fp->main_image);
                                if ($fp->price) {
                                    $arr12['price'] = intval($fp->price) . ' $';
                                } else {
                                    $min_price = Size::model()->find(array('condition' => 'product_id=' . $fp->id, 'order' => 'price asc'))->price;
                                    $arr12['price'] = intval($min_price) . ' $';
                                }
                                $feat_prods[] = $arr12;
                            }
                            $response['featured'] = $feat_prods;
                        } else {
                            $response['featured'] = array();
                        }
                    } else {
                        //  print_r($featured_products);die;
                        $response['featured'] = array();
                    }
                    if (($catid == 1 || $catid == 2 || $catid == 4 || $catid == 9) && !empty($subcat_id)) {
                        $arrival_cond = 'show_in_website_category=1';
                        $arrival_cond.= ' and category_id=1';
                        $criteria = new CDbCriteria;
                        $criteria->condition = $arrival_cond;
                        $arrivels = Product::model()->findAll($criteria);
                        if ($arrivels) {
                            $arri_prods = array();
                            foreach ($arrivels as $i => $fp) {
                                $arr8['id'] = intval($fp->id);
                                $arr8['title'] = $this->stringVal($fp->title);
                                $this->widget('ext.SAImageDisplayer', array(
                                    'image' => $fp->main_image,
                                    'size' => "xhimage",
                                    'title' => 'My super title',
                                    'defaultImage' => "defualt.jpg",
                                    'originalFolderName' => 'product',
                                ));
                                $arr8['image'] = $this->stringVal($fp->main_image);

                                if ($fp->flag == 1) {
                                    $arr8['externalLink'] = 1;
                                } else {
                                    $arr8['externalLink'] = 0;
                                }

                                if ($fp->price) {
                                    $arr8['price'] = intval($fp->price) . ' $';
                                } else {
                                    $min_price = Size::model()->find(array('condition' => 'product_id=' . $fp->id, 'order' => 'price asc'))->price;
                                    $arr8['price'] = intval($min_price) . ' $';
                                }
                                $arri_prods[] = $arr8;
                            }
                            $response['newArrival'] = $arri_prods;
                        }
                    } else {
                        $response['newArrival'] = array();
                    }
                    if ($catid == 9 && !empty($subcat_id)) {
                        $latest_products = Product::model()->findAll(array('condition' => 'category_id=' . $catid . ' and show_in_home_page=1 AND product_status_id !=2', 'order' => 'id desc', 'limit' => 6));
                        if ($latest_products) {
                            $lat_prods = array();
                            foreach ($latest_products as $i => $fp) {
                                $arr9['id'] = intval($fp->id);
                                $arr9['title'] = $this->stringVal($fp->title);
                                $this->widget('ext.SAImageDisplayer', array(
                                    'image' => $fp->main_image,
                                    'size' => "xhimage",
                                    'title' => 'My super title',
                                    'defaultImage' => "defualt.jpg",
                                    'originalFolderName' => 'product',
                                ));
                                $arr9['image'] = $this->stringVal($fp->main_image);
                                if ($fp->price) {
                                    $arr9['price'] = intval($fp->price) . ' $';
                                } else {
                                    $min_price = Size::model()->find(array('condition' => 'product_id=' . $fp->id, 'order' => 'price asc'))->price;
                                    $arr9['price'] = intval($min_price) . ' $';
                                }
                                $lat_prods[] = $arr9;
                            }
                            $response['latest'] = $lat_prods;
                        }
                    } else {
                        $response['latest'] = array();
                    }
                    if ($catid == 7 && !empty($subcat_id)) {
                        $felec_products = Product::model()->findAll(array('condition' => 'category_id = ' . $catid . ' and category_featured = 1 AND product_status_id !=2', 'limit' => 6, 'order' => 'id DESC'));
                        if ($felec_products) {
                            $feat_prods = array();
                            foreach ($felec_products as $i => $fp) {
                                $arr10['id'] = intval($fp->id);
                                $arr10['title'] = $this->stringVal($fp->title);
                                $this->widget('ext.SAImageDisplayer', array(
                                    'image' => $fp->main_image,
                                    'size' => "xhimage",
                                    'title' => 'My super title',
                                    'defaultImage' => "defualt.jpg",
                                    'originalFolderName' => 'product',
                                ));
                                $arr10['image'] = $this->stringVal($fp->main_image);


                                if ($fp->flag == 1) {
                                    $arr10['externalLink'] = 1;
                                } else {
                                    $arr10['externalLink'] = 0;
                                }

                                if ($fp->price) {
                                    $arr10['price'] = intval($fp->price) . ' $';
                                } else {
                                    $min_price = Size::model()->find(array('condition' => 'product_id=' . $fp->id, 'order' => 'price asc'))->price;
                                    $arr10['price'] = intval($min_price) . ' $';
                                }
                                $feat_prods[] = $arr10;
                            }
                            $response['electronicsFeatured'] = $feat_prods;
                        }
                        $deals = Product::model()->findAll(array('condition' => 'category_id =' . $catid . ' and show_in_website_category = 1 AND product_status_id !=2 ', 'limit' => 3, 'order' => 'id DESC'));
                        if ($deals) {
                            $deals_prods = array();
                            foreach ($deals as $i => $fp) {
                                $arr11['id'] = intval($fp->id);
                                $arr11['title'] = $this->stringVal($fp->title);
                                $this->widget('ext.SAImageDisplayer', array(
                                    'image' => $fp->main_image,
                                    'size' => "xhimage",
                                    'title' => 'My super title',
                                    'defaultImage' => "defualt.jpg",
                                    'originalFolderName' => 'product',
                                ));
                                $arr11['image'] = $this->stringVal($fp->main_image);

                                if ($fp->flag == 1) {
                                    $arr11['externalLink'] = 1;
                                } else {
                                    $arr11['externalLink'] = 0;
                                }

                                if ($fp->price) {
                                    $arr11['price'] = intval($fp->price) . ' $';
                                } else {
                                    $min_price = Size::model()->find(array('condition' => 'product_id=' . $fp->id, 'order' => 'price asc'))->price;
                                    $arr11['price'] = intval($min_price) . ' $';
                                }
                                $deals_prods[] = $arr11;
                            }
                            $response['electronicsHotDeals'] = $deals_prods;
                        }
                    } else {
                        $response['electronicsFeatured'] = array();
                        $response['electronicsHotDeals'] = array();
                    }
                    echo json_encode($response);
                    echo '<pre>';
                    print_r($response);
                    echo '<pre>';
                }
            }
        } catch (Exception $ex) {
            $this->responseWithMessage($this->MESSAGE_FAIL_EX);
        }
    }

    public function actionWriteReview() {
        try {
            $request = $this->parseRequest();
            if ($request != false) {
                $id = $request['userAuth']['id'];
                $hash = $request['userAuth']['hash'];
                $content = $request['content'];
                $rate = $request['rate'];
                $productid = $request['mediaId'];
                $model = User::model()->findByPk($id);
                if (count($model) == 1) {
                    $authuser = $this->authUser2($hash, $id);
//                     echo md5($model->id . "-" . $model->email . "-" . User::simple_decrypt($model->password));
//                    die;
                    if ($authuser == true) {
                        $review = new Review();
                        $review->user_id = $id;
                        $review->product_id = $productid;
                        $review->comment = $content;
                        $review->rate = $rate;
                        $review->comment_date = date("Y-m-d");
                        $review->published = 1;
                        if ($review->save()) {
                            $this->responseWithMessage($this->MESSAGE_SUCCESS);
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

    public function actionMakeOrder() {
        try {
            $request = $this->parseRequest();
//            print_r($request);
//            die;
            if ($request != false) {
                $id = $request['userAuth']['id'];
                $hash = $request['userAuth']['hash'];
                $paykey = $request['payKey'];
                $netPrice = $request['netPrice'];
                $shippingValue = $request['shippingValue'];
                $totalPrice = $request['totalPrice'];
                $totalCommission = $request['totalCommission'];

                // shipping
                $shipping_country = $request['shipping']['country'];
                $shipping_city = $request['shipping']['city'];
                $shipping_postcode = $request['shipping']['postcode'];
                $shipping_address = $request['shipping']['address'];
                // pilling
                $pilling_country = $request['pilling']['country'];
                $pilling_city = $request['pilling']['city'];
                $pilling_postcode = $request['pilling']['postcode'];
                $pilling_address = $request['pilling']['address'];
                // other details
                $product_id = $request['details'][0]['id'];
                $quantity = $request['details'][0]['quantity'];
                $price = $request['details'][0]['price'];
                $sizeid = $request['details'][0]['sizeId'];
                $colorid = $request['details'][0]['colorId'];


                $user = User::model()->findByPk($id);
//                print_r($user);die;
                if (count($user) == 1) {
//                         echo md5($user->id . "-" . $user->email . "-" . User::simple_decrypt($user->password));
//                    die;
                    $authuser = $this->authUser2($hash, $id);
                    if ($authuser == true) {
                        $model = new Order;
                        $model->shipping_country = $shipping_country;
                        $model->shipping_city = $shipping_city;
                        $model->shipping_post_code = $shipping_postcode;
                        $model->shipping_address = $shipping_address;

                        $model->billing_country = $pilling_country;
                        $model->billing_city = $pilling_city;
                        $model->billing_post_code = $pilling_postcode;
                        $model->billing_address = $pilling_address;

                        $model->total_price = $totalPrice;
                        $model->total_commission = $totalCommission;
                        $model->shipping_price = $shippingValue;
                        $model->status_id = 1; //pending
                        $model->buyer_id = $id;
                        $model->net_price = $netPrice;
                        $model->token = $paykey;
                        //echo $totalCommission;
                        //die;
                        $userid = Product::model()->findByPk($product_id)->user_id;

                        if ($model->save(false)) {

                            $order_det = new OrderDetails;
                            $order_det->order_id = $model->id;
                            $order_det->product_id = $product_id;
                            $order_det->shipping_address = $model->shipping_address;
                            $order_det->shipping_city = $model->shipping_city;
                            $order_det->shipping_country = $model->shipping_country;
                            $order_det->shipping_postcode = $model->shipping_post_code;
                            $order_det->shipping_price = $price;
                            $order_det->seller_id = $userid;

                            $order_det->color = Color::model()->findByPk($colorid)->title;
                            $order_det->size = Sizes::model()->findByPk($sizeid)->title;
                            //echo $totalCommission;
                            //die;
                            $order_det->quantity = $quantity;
                            $order_det->total_price = $totalPrice;
                            $order_det->net_price = $netPrice;
                            $order_det->commission_price = $totalCommission;

                            $order_det->save(false);
                            $reponse['message'] = $this->MESSAGE_SUCCESS;
                            $reponse['orderId'] = $model->id;
                            echo json_encode($reponse);
                        } else {
                            $this->responseWithMessage($this->MESSAGE_FAIL);
                        }
                    } else {
                        $this->responseWithMessage($this->MESSAGE_USER_NOT_FOUND . 'yy');
                    }
                } else {
                    $this->responseWithMessage($this->MESSAGE_USER_NOT_FOUND);
                }
            }
        } catch (Exception $ex) {
            $this->responseWithMessage($this->MESSAGE_FAIL_EX);
        }
    }

    public function actionOrderStatus() {
        try {
            $request = $this->parseRequest();
            if ($request != false) {
                $id = $request['userAuth']['id'];
                $hash = $request['userAuth']['hash'];
                $orderid = $request['orderId'];
                $status_id = $request['status'];
                $status_id_ = OrderStatus::model()->find("title like '%$status_id%'")->id;
//print_r($status_id_);die;
                $user = User::model()->findByPk($id);


                if (count($user) == 1) {
                    $authuser = $this->authUser2($hash, $id);
//                    echo md5($user->id . "-" . $user->email . "-" . User::simple_decrypt($user->password));
//                    die;
                    if ($authuser == true) {
                        $order = Order::model()->findByPk($orderid);
//                        echo $order->status_id;die;
                        if (count($order) > 0) {
                            if ($order->status_id == 1) {
//                            echo ' tt';die;
                                $order->status_id = $status_id_;
                                $order->save(false);
                                $orderdets = OrderDetails::model()->findAllByAttributes(array('order_id' => $order->id));
                                if (!empty($orderdets)) {
                                    foreach ($orderdets as $orderdet) {
                                        $seller = User::model()->findByPk($orderdet->seller_id);
                                        $product = Product::model()->findByPk($orderdet->product_id);
                                        $product->quantity = $product->quantity - $orderdet->quantity;
                                        $product->save(false);

                                        ///////////////////////send mail to buyer
                                        $mail = new YiiMailer();
                                        $mail->setFrom(Yii::app()->params['adminEmail'], Yii::app()->name . '  New Order ');
                                        $mail->setTo($seller->email, Yii::app()->name . ' New Order');
                                        $mail->setSubject(Yii::app()->name . '  New Order ');
                                        $message = 'Dear Customer,
                          New  order has been done successfully with this destails:<br/>
               Products Name : ' . $product->title . '. <br/>  
               Product Price : ' . $product->price . ' $. <br/>  
               Qty : ' . $product->quantity . ' $. <br/> 
               Shipping Price : ' . $orderdet->shipping_price . ' $. <br/>
               Web Site Commission : ' . $orderdet->commission_price . ' $. <br/> 
               Net Price : ' . $orderdet->net_price . ' $. <br/> 
               please check your orders in your dashboard on ' . Yii::app()->name . ''
                                        ;
                                        $mail->setBody($message);
                                        $mail->send();
                                    }
                                }
                                ////////////////////////////update user table 
                                $key = Helper::GenerateRandomKey(4);
                                $user->token = $key;
                                $user->instgram_access = 1;
                                $user->save(false);

                                //////////////////////////////////send mail to Admin
                                $mail = new YiiMailer();
                                $mail->setFrom(Yii::app()->params['adminEmail'], Yii::app()->name . ' New Order');
                                $mail->setTo(Yii::app()->params['adminEmail']);
                                $mail->setSubject(Yii::app()->name . ' New Order');

                                $message = 'Dear Admin,

			New order has been done successfully with this destails:<br/>
               Total Price:' . $order->total_price . ' $. <br/> 
               Shipping Price:' . $order->shipping_price . ' $. <br/>
               Web Site Commission:' . $order->total_commission . ' $. <br/>
               to view the order by details please go to these link : <a href="' . Yii::app()->params['webSite'] . '/admin/order/view/id/' . $order->id . '">' . Yii::app()->params['webSite'] . '/admin/order/view/id/' . $order->id . '</a>'
                                ;
                                $mail->setBody($message);
                                $mail->send();

                                ///////////////////////send mail to buyer
                                $mail2 = new YiiMailer();
                                $mail2->setFrom(Yii::app()->params['adminEmail'], Yii::app()->name . '  ');
                                $mail2->setTo($user->email, Yii::app()->name . '  New Order');
                                $mail2->setSubject(Yii::app()->name . ' New Order');
                                $message2 = 'Dear client,
                          Your  order has been done successfully with this destails:<br/>
               Products Price:' . $order->net_price . ' $. <br/>   
               Shipping Price:' . $order->shipping_price . ' $. <br/>
               Total Price:' . $order->total_price . ' $. <br/> 
               please check your orders in your dashboard on ' . Yii::app()->name . ''
                                ;
                                $mail2->setBody($message2);
                                $mail2->send();

                                $this->responseWithMessage($this->MESSAGE_SUCCESS);
                            } else {
                                //  echo 'ggg';die;
                                $order = Order::model()->findByPk($orderid);
                                $order->status_id = $status_id_;
                                $order->save(false);
                                $this->responseWithMessage($this->MESSAGE_SUCCESS);
                            }
                        } else {
                            $this->responseWithMessage($this->MESSAGE_ITEM_NOT_FOUND);
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

    public function actionRealStateItemDetails() {
        try {
            $request = $this->parseRequest();
            if ($request != false) {

                $id = $request['Id'];
                $mobileSize = $request['mobileSize'];

                $product = Product::model()->findByPk($id);
                if (count($product) == 1) {
                    $product_owner_id = intval($product->user_id);
                    $product_owner_name = $this->stringVal(User::model()->findByPk($product_owner_id)->fname . " " . User::model()->findByPk($product_owner_id)->lname);

                    $item['productOwner'] = array("id" => $product_owner_id, "name" => $product_owner_name);

                    $details = ProductDetails::model()->findByAttributes(array("product_id" => $id));
                    //print_r($request);
                    //die;
                    $country = $this->stringVal(Country::model()->findByPk($details->country_id)->title);
                    $city = $this->stringVal(City::model()->findByPk($details->city_id)->title);
                    $placeName = $this->stringVal($product->title);
                    $desc = $this->stringVal($product->description);
                    $facilities = $this->stringVal($details->real_estate_facilities);
                    $long = $this->stringVal($details->longitude);
                    $lat = $this->stringVal($details->latitude);
                    $itemrevs = Review::model()->findAllByAttributes(array('product_id' => $id));
                    if ($product->gallery_id != null)
                        $itemphotos = GalleryPhoto::model()->findAllByAttributes(array('gallery_id' => $product->gallery_id));
                    $reviews = array();

                    foreach ($itemrevs as $rev) {
                        $arr3['id'] = intval($rev->id);
                        $arr3['username'] = $this->stringVal(User::model()->findByPk($rev->user_id)->username);
                        $arr3['date'] = $this->stringVal(date("d-m-Y", strtotime($rev->comment_date)));
                        $arr3['review'] = $this->stringVal($rev->comment);
                        $arr3['rate'] = $this->stringVal($rev->rate);
                        $reviews[] = $arr3;
                    }
                    $item['reviews'] = $reviews;
                    $photos = array();
                    $photos_ = array();
                    if (count($itemphotos) > 0) {
                        foreach ($itemphotos as $photo) {
                            $this->widget('ext.SAImageDisplayer', array(
                                'image' => $photo->file_name,
                                'size' => $mobileSize,
                                'title' => 'My super title',
                                'defaultImage' => "defualt.jpg",
                                'originalFolderName' => 'product',
                            ));
                            $arr4['externalLink'] = 0;

                            //$arr4['id'] = intval($photo->id);
                            $arr4["image"] = $this->stringVal($photo->file_name);
                            //$arr4['rank'] = $this->stringVal($photo->rank);

                            $photos[] = $arr4;
                        }
                    } else {

                        $itemphotos = XmlGallery::model()->findAll("product_id = $product->id");
                        //  print_r($itemphotos);die;
                        foreach ($itemphotos as $photo) {

                            $arr4['externalLink'] = 1;

                            //$arr4['id'] = intval($photo->id);
                            $arr4["image"] = $this->stringVal($photo->image);
                            //$arr4['rank'] = $this->stringVal($photo->rank);

                            $photos[] = $arr4;
                        }
                    }
                    $item['subImages'] = $photos;
                    $response['message'] = $this->MESSAGE_SUCCESS;
                    $cont['productOwner'] = $item['productOwner'];
                    $cont['country'] = $country;
                    $cont['city'] = $city;
                    $cont['placeName'] = $placeName;
                    $cont['desc'] = $desc;
                    $cont['faci'] = $facilities;
                    $cont['longt'] = $long;
                    $cont['lat'] = $lat;
                    $cont['subImages'] = $item['subImages'];
                    $cont['reviews'] = $item['reviews'];
                    $response['itemDetails'] = $cont;

//                     echo '<pre>';
//                    print_r($response);
//                     echo '<pre>';die;
                    echo json_encode($response);
                } else {
                    $this->responseWithMessage($this->MESSAGE_ITEM_NOT_FOUND);
                }
            }
        } catch (Exception $ex) {
            $this->responseWithMessage($this->MESSAGE_FAIL_EX);
        }
    }

    public function actionRealStateSearch() {
        try {
            $request = $this->parseRequest();
            if ($request != false) {
                $id = $request['userAuth']['id'];
                $hash = $request['userAuth']['hash'];
                $search_text = $request['search']['search'];
                $kind = $request['kind'];
                $start = $request['start'];
                $end = $request['end'];
                $mobileSize = $request['mobileSize'];



                $model = User::model()->findByPk($id);
                if (count($model) == 1) {
                    $authuser = $this->authUser2($hash, $id);
//                    echo md5($model->id . "-" . $model->email . "-" . User::simple_decrypt($model->password));
//                    die;
                    if ($authuser === true) {

                        $response['message'] = $this->MESSAGE_SUCCESS;
                        $prods = Product::model()->real($search_text, $kind, $start, $end, 1);
                        $count = count($prods);
                        $response['count'] = intval($count);
                        $subprods = Product::model()->real($search_text, $kind, $start, $end);

                        if (count($subprods) > 0) {
                            foreach ($subprods as $item) {
//                        $product_owner_id = intval($prod->user_id);
//                        $product_owner_name = $this->stringVal(User::model()->findByPk($product_owner_id)->fname . " " . User::model()->findByPk($product_owner_id)->lname);
//
//                        $item['productOwner'] = array("id" => $product_owner_id, "name" => $product_owner_name);
//
//
//                        $details = ProductDetails::model()->findByAttributes(array("product_id" => $prod["id"]));
//                        //print_r($details);
//                        //die;
//
//                        $country = $this->stringVal(Country::model()->findByPk($details['country_id'])->title);
//                        $city = $this->stringVal(City::model()->findByPk($details['city_id'])->title);
//                        $desc = $this->stringVal(City::model()->findByPk($details['destination_city'])->title);
//                        $facilities = $this->stringVal($details['real_estate_facilities']);
//                        $long = $this->stringVal($details['longitude']);
//                        $lat = $this->stringVal($details['latitude']);
//                        $itemrevs = Review::model()->findAllByAttributes(array('product_id' => $prod['id']));
//                        $itemphotos = GalleryPhoto::model()->findAllByAttributes(array('gallery_id' => $prod['gallery_id']));
//                        $reviews = array();
//
//                        foreach ($itemrevs as $rev) {
//                            $arr3['id'] = intval($rev->id);
//                            $arr3['username'] = $this->stringVal(User::model()->findByPk($rev->user_id)->username);
//                            $arr3['date'] = $this->stringVal(date("d-m-Y", strtotime($rev->comment_date)));
//                            $arr3['review'] = $this->stringVal($rev->comment);
//                            $arr3['rate'] = $this->stringVal($rev->rate);
//                            $reviews[] = $arr3;
//                        }
//                        $item['reviews'] = $reviews;
//                        $photos = array();
//                        //print_r($photo->file_name);
//                        //die;
//                        foreach ($itemphotos as $photo) {
//
//                            //$arr4['id'] = intval($photo->id);
//                            $arr4[] = $this->stringVal($photo->file_name);
//                            //$arr4['rank'] = $this->stringVal($photo->rank);
//
//                            $photos[] = $arr4;
//                        }
//                        $item['subImages'] = $photos;
//                        $response['message'] = $this->MESSAGE_SUCCESS;
//                        $cont['productOwner'] = $item['productOwner'];
//                        $cont['country'] = $country;
//                        $cont['city'] = $city;
//                        $cont['desc'] = $desc;
//                        $cont['faci'] = $facilities;
//                        $cont['longt'] = $long;
//                        $cont['lat'] = $lat;
//                        $cont['subImages'] = $item['subImages'];
//                        $cont['reviews'] = $item['reviews'];
//                        $response['items'][] = $cont;

                                $favorite = Favourite::model()->find("product_id = $item->id");
                                $arr['id'] = intval($item->id);
                                $this->widget('ext.SAImageDisplayer', array(
                                    'image' => $item->main_image,
                                    'size' => $mobileSize,
                                    'title' => 'My super title',
                                    'defaultImage' => "defualt.jpg",
                                    'originalFolderName' => 'product',
                                ));

                                if ($item->flag == 1) {
                                    $arr['externalLink'] = 1;
                                } else {
                                    $arr['externalLink'] = 0;
                                }

                                $arr['image'] = $this->stringVal($item->main_image);
                                $arr['title'] = $this->stringVal($item->title);
                                $arr['price'] = intval($item->price);

                                if ($favorite != null) {
                                    $arr['isFavourite'] = 1;
                                } else {
                                    $arr['isFavourite'] = 0;
                                }
                            }
                            $all_arr[] = $arr;
                            $response['items'] = $all_arr;
                            echo json_encode($response);
//                            echo '<pre>';
//                            print_r($response);
//                            echo '<pre>';
                        } else {
                            $this->responseWithMessage($this->MESSAGE_ITEM_NOT_FOUND);
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

    public function actionCosmeticsItemDetails() {
        try {
            //echo("test");
            //die;
            $request = $this->parseRequest();

            if ($request != false) {
                $id = $request['Id'];
                $mobileSize = $request['mobileSize'];

                $product = Product::model()->findByPk($id);
                if (count($product) == 1) {
                    $product_owner_id = intval($product->user_id);
                    $product_owner_name = $this->stringVal(User::model()->findByPk($product_owner_id)->fname . " " . User::model()->findByPk($product_owner_id)->lname);
                    $user_details = UserDetails::model()->findByAttributes(array("user_id" => $product_owner_id));

                    //echo($user_details->paypal_account);
                    //die;
                    $item['productOwner'] = array("id" => $product_owner_id, "name" => $product_owner_name, "paypalAccount" => $this->stringVal($user_details->paypal_account));

                    $details = ProductDetails::model()->findByAttributes(array("product_id" => $id));
                    //print_r($request);
                    //die;
                    $itemrevs = Review::model()->findAllByAttributes(array('product_id' => $id));
                    if ($product->gallery_id != null)
                        $itemphotos = GalleryPhoto::model()->findAllByAttributes(array('gallery_id' => $product->gallery_id));
                    $shippingValues = ShippingValue::model()->findByAttributes(array("country_id" => $product->user_id));
                    //print_r($shippingValues);
                    //die;
                    $sizes = Sizes::model()->findAllByAttributes(array('category_id' => $product->category_id));
                    $sizes_arr = array();
                    foreach ($sizes as $size) {
                        $arr2["id"] = intval($size['id']);
                        $arr2["title"] = $this->stringVal($size['title']);
                        $sizes_arr[] = $arr2;
                    }
                    $item['sizes'] = $sizes_arr;
                    $reviews = array();
                    foreach ($itemrevs as $rev) {
                        $arr3['id'] = intval($rev->id);
                        $arr3['username'] = $this->stringVal(User::model()->findByPk($rev->user_id)->username);
                        $arr3['date'] = $this->stringVal(date("d-m-Y", strtotime($rev->comment_date)));
                        $arr3['review'] = $this->stringVal($rev->comment);
                        $arr3['rate'] = $this->stringVal($rev->rate);
                        $reviews[] = $arr3;
                    }
                    $item['reviews'] = $reviews;
                    $photos = array();
                    if (count($itemphotos) > 0) {
                        foreach ($itemphotos as $photo) {
                            $this->widget('ext.SAImageDisplayer', array(
                                'image' => $photo->file_name,
                                'size' => $mobileSize,
                                'title' => 'My super title',
                                'defaultImage' => "defualt.jpg",
                                'originalFolderName' => 'product',
                            ));

                            $arr4['externalLink'] = 0;

                            //$arr4['id'] = intval($photo->id);
                            $arr4["image"] = $this->stringVal($photo->file_name);


                            $photos[] = $arr4;
                        }
                    } else {

                        $itemphotos = XmlGallery::model()->findAll("product_id= $product->id");
                        foreach ($itemphotos as $photo) {
                            $arr4["image"] = $this->stringVal($photo->image);
                            $arr4['externalLink'] = 1;
                            $photos[] = $arr4;
                        }
                    }
                    $shipping_array = array();
                    foreach ($shippingValues as $ship) {
                        $arr5["id"] = intval($ship['id']);
                        $arr5["title"] = $this->stringVal(City::model()->findByPk($ship['city'])->title);
                        $arr5["value"] = intval($ship['title']);

                        $shipping_array[] = $arr5;
                    }
                    $item['shipping'] = $shipping_array;
                    $item['subImages'] = $photos;
                    $response['message'] = $this->MESSAGE_SUCCESS;

                    $cont['sizes'] = $item['sizes'];
                    $cont['quantity'] = $this->stringVal($product->quantity);
                    $cont['desc'] = $this->stringVal($product->description);
                    $cont['reviews'] = $item['reviews'];
                    $cont['subImages'] = $item['subImages'];
                    $cont['productOwner'] = $item['productOwner'];
                    $cont['shippingTo'] = $item['shipping'];
                    $response['itemDetails'] = $cont;

//                    echo '<pre>';
//                    print_r($response);
//                      echo '<pre>';
                    echo json_encode($response);
                } else {
                    $this->responseWithMessage($this->MESSAGE_ITEM_NOT_FOUND);
                }
            }
        } catch (Exception $ex) {
            $this->responseWithMessage($this->MESSAGE_FAIL_EX);
        }
    }

    public function actionCosmeticsSearch() {
        try {
            $request = $this->parseRequest();
            if ($request != false) {
                $id = $request['userAuth']['id'];
                $hash = $request['userAuth']['hash'];
                $search = $request['search']['text'];
                $subCatId = $request['search']['subCatId'];
                $brandId = $request['search']['brandId'];
                $shopId = $request['search']['shopId'];
                $startPrice = floatval($request['search']['startPrice']);
                $endPrice = floatval($request['search']['endPrice']);
                $sizeId = $request['search']['sizeId'];
                $colorId = $request['search']['colorId'];
                $mobileSize = $request['search']['mobileSize'];
                $start = $request['start'];
                $end = $request['end'];

                $items = Product::model()->cosmitcsSearch($search, $subCatId, $brandId, $shopId, $startPrice, $endPrice, $sizeId, $colorId, $start, $end);

                $model = User::model()->findByPk($id);
                //   echo md5($model->id . "-" . $model->email . "-" . User::simple_decrypt($model->password));
//                    die;
                if (count($model) == 1) {
                    $authuser = $this->authUser2($hash, $id);

                    if ($authuser === true) {

                        if ($items) {
                            $response['message'] = $this->MESSAGE_SUCCESS;
                            $arr = array();
                            $all_arr = array();

                            foreach ($items as $item) {

//                        $sizes = Sizes::model()->findAllByAttributes(array('category_id' => $item->category_id));
//                        $sizes_arr = array();
//                        foreach ($sizes as $size) {
//                            $arr2["id"] = intval($size['id']);
//                            $arr2["title"] = $this->stringVal($size['title']);
//                            $sizes_arr[] = $arr2;
//                        }
//                        $ret['sizes'] = $sizes_arr;
//                        $cont['sizes'] = $ret['sizes'];
//                        $cont['quantity'] = $this->stringVal($item->quantity);
//                        $cont['desc'] = $this->stringVal($item->description);
//                        $itemrevs = Review::model()->findAllByAttributes(array('product_id' => $item->id));
//
//                        $reviews = array();
//                        foreach ($itemrevs as $rev) {
//                            $arr3['id'] = intval($rev->id);
//                            $arr3['username'] = $this->stringVal(User::model()->findByPk($rev->user_id)->username);
//                            $arr3['date'] = $this->stringVal(date("d-m-Y", strtotime($rev->comment_date)));
//                            $arr3['review'] = $this->stringVal($rev->comment);
//                            $arr3['rate'] = $this->stringVal($rev->rate);
//                            $reviews[] = $arr3;
//                        }
//                        $ret['reviews'] = $reviews;
//                        $cont['reviews'] = $ret['reviews'];
//                        $itemphotos = GalleryPhoto::model()->findAllByAttributes(array('gallery_id' => $item->gallery_id));
//                        $photos = array();
//                        foreach ($itemphotos as $photo) {
//                            $this->widget('ext.SAImageDisplayer', array(
//                                'image' => $photo->file_name,
//                                'size' => $mobileSize,
//                                'title' => 'My super title',
//                                'defaultImage' => "defualt.jpg",
//                                'originalFolderName' => 'product',
//                            ));
//                            //$arr4['id'] = intval($photo->id);
//                            $arr4[] = $this->stringVal($photo->file_name);
//                            //$arr4['rank'] = $this->stringVal($photo->rank);
//
//                            $photos[] = $arr4;
//                        }
//                        $ret['subImages'] = $arr4;
//                        $cont['subImages'] = $ret['subImages'];
//                        $product_owner_id = intval($item->user_id);
//                        $product_owner_name = $this->stringVal(User::model()->findByPk($product_owner_id)->fname . " " . User::model()->findByPk($product_owner_id)->lname);
//                        $user_details = UserDetails::model()->findByAttributes(array("user_id" => $product_owner_id));
                                //echo($user_details->paypal_account);
                                //die;
//                        $ret['productOwner'] = array("id" => $product_owner_id, "name" => $product_owner_name, "paypalAccount" => $this->stringVal($user_details->paypal_account));
//                        $cont['productOwner'] = $ret['productOwner'];
//                        $shippingValues = ShippingValue::model()->findByAttributes(array("country_id" => $item->user_id));
//                        $shipping_array = array();
//                        foreach ($shippingValues as $ship) {
//                            $arr5["id"] = intval($ship['id']);
//                            $arr5["title"] = $this->stringVal(City::model()->findByPk($ship['city'])->title);
//                            $arr5["value"] = intval($ship['title']);
//
//                            $shipping_array[] = $arr5;
//                        }
//                        $ret['shipping'] = $shipping_array;
//                        $cont['shippingTo'] = $ret['shipping'];
                                //$response['itemDetails'] = $cont;
                                //  $all_arr[] = $cont;


                                $arr["id"] = intval($item->id);
                                $arr["title"] = $this->stringVal($item->title);
                                $arr["price"] = intval($item->price);

                                $this->widget('ext.SAImageDisplayer', array(
                                    'image' => $item->main_image,
                                    'size' => $mobileSize,
                                    'title' => 'My super title',
                                    'defaultImage' => "defualt.jpg",
                                    'originalFolderName' => 'product',
                                ));

                                if ($item->flag == 1) {
                                    $arr['externalLink'] = 1;
                                } else {
                                    $arr['externalLink'] = 0;
                                }

                                $arr["image"] = $this->stringVal($item->main_image);
                                $favorite = Favourite::model()->find("product_id = $item->id");
                                if ($favorite == null) {
                                    $arr["isFavourite"] = 0;
                                } else {
                                    $arr["isFavourite"] = 1;
                                }
                                $all_arr[] = $arr;
                            }
                            $response['items'] = $all_arr;
                            echo json_encode($response);
                        } else {
                            $response['message'] = $this->MESSAGE_ITEM_NOT_FOUND;
                            $response['items'] = array();
                            echo json_encode($response);
                        }
                    } else {
                        $this->responseWithMessage($this->MESSAGE_USER_NOT_FOUND);
                    }
                } else {
                    $this->responseWithMessage($this->MESSAGE_USER_NOT_FOUND);
                }

//                echo'<pre>';
//                print_r($response);
//                echo'<pre>';
            }
        } catch (Exception $ex) {
            $this->responseWithMessage($this->MESSAGE_FAIL_EX);
        }
    }

    public function actionJewelryItemDetails() {
        try {
            $request = $this->parseRequest();

            if ($request != false) {
                $id = $request['Id'];
                $mobileSize = $request['mobileSize'];

                $product = Product::model()->findByPk($id);
                if (count($product) == 1) {
                    $product_owner_id = intval($product->user_id);
                    $product_owner_name = $this->stringVal(User::model()->findByPk($product_owner_id)->fname . " " . User::model()->findByPk($product_owner_id)->lname);
                    $user_details = UserDetails::model()->findByAttributes(array("user_id" => $product_owner_id));

                    $item['productOwner'] = array("id" => $product_owner_id, "name" => $product_owner_name, "paypalAccount" => $this->stringVal($user_details->paypal_account));

                    $details = ProductDetails::model()->findByAttributes(array("product_id" => $id));

                    $itemrevs = Review::model()->findAllByAttributes(array('product_id' => $id));
                    if ($product->gallery_id != null)
                        $itemphotos = GalleryPhoto::model()->findAllByAttributes(array('gallery_id' => $product->gallery_id));
                    $shippingValues = ShippingValue::model()->findByAttributes(array("country_id" => $product->user_id));

                    $sizes = Sizes::model()->findAllByAttributes(array('category_id' => $product->category_id));
                    $sizes_arr = array();
                    foreach ($sizes as $size) {
                        $arr2["id"] = intval($size['id']);
                        $arr2["title"] = $this->stringVal($size['title']);
                        $sizes_arr[] = $arr2;
                    }
                    $item['sizes'] = $sizes_arr;
                    $reviews = array();
                    foreach ($itemrevs as $rev) {
                        $arr3['id'] = intval($rev->id);
                        $arr3['username'] = $this->stringVal(User::model()->findByPk($rev->user_id)->username);
                        $arr3['date'] = $this->stringVal(date("d-m-Y", strtotime($rev->comment_date)));
                        $arr3['review'] = $this->stringVal($rev->comment);
                        $arr3['rate'] = $this->stringVal($rev->rate);
                        $reviews[] = $arr3;
                    }
                    $item['reviews'] = $reviews;
                    $photos = array();
                    if (count($itemphotos) > 0) {
                        foreach ($itemphotos as $photo) {
                            $this->widget('ext.SAImageDisplayer', array(
                                'image' => $photo->file_name,
                                'size' => $mobileSize,
                                'title' => 'My super title',
                                'defaultImage' => "defualt.jpg",
                                'originalFolderName' => 'product',
                            ));

                            $arr4['externalLink'] = 0;


                            //$arr4['id'] = intval($photo->id);
                            $arr4["image"] = $this->stringVal($photo->file_name);
                            //$arr4['rank'] = $this->stringVal($photo->rank);

                            $photos[] = $arr4;
                        }
                    } else {
                        $itemphotos = XmlGallery::model()->findAll("product_id = $product->id");
                        foreach ($itemphotos as $photo) {


                            $arr4['externalLink'] = 1;

                            //$arr4['id'] = intval($photo->id);
                            $arr4["image"] = $this->stringVal($photo->image);
                            //$arr4['rank'] = $this->stringVal($photo->rank);

                            $photos[] = $arr4;
                        }
                    }
                    $shipping_array = array();
                    foreach ($shippingValues as $ship) {
                        $arr5["id"] = intval($ship['id']);
                        $arr5["title"] = $this->stringVal(City::model()->findByPk($ship['city'])->title);
                        $arr5["value"] = intval($ship['title']);

                        $shipping_array[] = $arr5;
                    }
                    $item['shipping'] = $shipping_array;
                    $item['subImages'] = $photos;
                    $response['message'] = $this->MESSAGE_SUCCESS;

                    $cont['sizes'] = $item['sizes'];
                    $cont['quantity'] = $this->stringVal($product->quantity);
                    $cont['desc'] = $this->stringVal($product->description);
                    $cont['reviews'] = $item['reviews'];
                    $cont['subImages'] = $item['subImages'];
                    $cont['productOwner'] = $item['productOwner'];
                    $cont['shippingTo'] = $item['shipping'];
                    $response['itemDetails'] = $cont;

//                    echo '<pre>';
//                    print_r($response);die;
//                    echo '<pre>';die;
                    echo json_encode($response);
                } else {
                    $this->responseWithMessage($this->MESSAGE_ITEM_NOT_FOUND);
                }
            }
        } catch (Exception $ex) {
            $this->responseWithMessage($this->MESSAGE_FAIL_EX);
        }
    }

    public function actionJewelrysSearch() {
        try {
            $request = $this->parseRequest();

            if ($request != false) {
                $id = $request['userAuth']['id'];
                $hash = $request['userAuth']['hash'];
                $search = $request['search']['text'];
                $subCatId = $request['search']['subCatId'];
                $brandId = $request['search']['brandId'];
                $shopId = $request['search']['shopId'];
                $startPrice = floatval($request['search']['startPrice']);
                $endPrice = floatval($request['search']['endPrice']);
                $sizeId = $request['search']['sizeId'];
                $colorId = $request['search']['colorId'];
                $mobileSize = $request['search']['mobileSize'];
                $start = $request['start'];
                $end = $request['end'];

                $items = Product::model()->jewelrySearch($search, $subCatId, $brandId, $shopId, $startPrice, $endPrice, $sizeId, $colorId, $start, $end);
                $model = User::model()->findByPk($id);
                if (count($model) == 1) {
                    $authuser = $this->authUser2($hash, $id);
//                   echo md5($model->id . "-" . $model->email . "-" . User::simple_decrypt($model->password));
//                    die;
                    if ($authuser === true) {
                        if ($items) {
                            $response['message'] = $this->MESSAGE_SUCCESS;
                            $arr = array();
                            $all_arr = array();
                            foreach ($items as $item) {

//                        $sizes = Sizes::model()->findAllByAttributes(array('category_id' => $item->category_id));
//                        $sizes_arr = array();
//                        foreach ($sizes as $size) {
//                            $arr2["id"] = intval($size['id']);
//                            $arr2["title"] = $this->stringVal($size['title']);
//                            $sizes_arr[] = $arr2;
//                        }
//                        $ret['sizes'] = $sizes_arr;
//                        $cont['sizes'] = $ret['sizes'];
//                        $cont['quantity'] = $this->stringVal($item->quantity);
//                        $cont['desc'] = $this->stringVal($item->description);
//
//                        $itemrevs = Review::model()->findAllByAttributes(array('product_id' => $item->id));
//
//                        $reviews = array();
//                        foreach ($itemrevs as $rev) {
//                            $arr3['id'] = intval($rev->id);
//                            $arr3['username'] = $this->stringVal(User::model()->findByPk($rev->user_id)->username);
//                            $arr3['date'] = $this->stringVal(date("d-m-Y", strtotime($rev->comment_date)));
//                            $arr3['review'] = $this->stringVal($rev->comment);
//                            $arr3['rate'] = $this->stringVal($rev->rate);
//                            $reviews[] = $arr3;
//                        }
//                        $ret['reviews'] = $reviews;
//                        $cont['reviews'] = $ret['reviews'];
//                        $itemphotos = GalleryPhoto::model()->findAllByAttributes(array('gallery_id' => $item->gallery_id));
//                        $photos = array();
//                        foreach ($itemphotos as $photo) {
//                            $this->widget('ext.SAImageDisplayer', array(
//                                'image' => $photo->file_name,
//                                'size' => $mobileSize,
//                                'title' => 'My super title',
//                                'defaultImage' => "defualt.jpg",
//                                'originalFolderName' => 'product',
//                            ));
//                            //$arr4['id'] = intval($photo->id);
//                            $arr4[] = $this->stringVal($photo->file_name);
//                            //$arr4['rank'] = $this->stringVal($photo->rank);
//
//                            $photos[] = $arr4;
//                        }
//                        $ret['subImages'] = $arr4;
//                        $cont['subImages'] = $ret['subImages'];
//                        $product_owner_id = intval($item->user_id);
//                        $product_owner_name = $this->stringVal(User::model()->findByPk($product_owner_id)->fname . " " . User::model()->findByPk($product_owner_id)->lname);
//                        $user_details = UserDetails::model()->findByAttributes(array("user_id" => $product_owner_id));
//
//                        //echo($user_details->paypal_account);
//                        //die;
//                        $ret['productOwner'] = array("id" => $product_owner_id, "name" => $product_owner_name, "paypalAccount" => $this->stringVal($user_details->paypal_account));
//                        $cont['productOwner'] = $ret['productOwner'];
//                        $shippingValues = ShippingValue::model()->findByAttributes(array("country_id" => $item->user_id));
//                        $shipping_array = array();
//                        foreach ($shippingValues as $ship) {
//                            $arr5["id"] = intval($ship['id']);
//                            $arr5["title"] = $this->stringVal(City::model()->findByPk($ship['city'])->title);
//                            $arr5["value"] = intval($ship['title']);
//
//                            $shipping_array[] = $arr5;
//                        }
//                        $ret['shipping'] = $shipping_array;
//                        $cont['shippingTo'] = $ret['shipping'];
                                //$response['itemDetails'] = $cont;

                                $arr["id"] = intval($item->id);
                                $arr["title"] = $this->stringVal($item->title);
                                $arr["price"] = intval($item->price);

                                $this->widget('ext.SAImageDisplayer', array(
                                    'image' => $item->main_image,
                                    'size' => $mobileSize,
                                    'title' => 'My super title',
                                    'defaultImage' => "defualt.jpg",
                                    'originalFolderName' => 'product',
                                ));

                                $arr["image"] = $this->stringVal($item->main_image);
                                if ($item->flag == 1) {
                                    $arr['externalLink'] = 1;
                                } else {
                                    $arr['externalLink'] = 0;
                                }
                                $favorite = Favourite::model()->find("product_id = $item->id");
                                if ($favorite == null) {
                                    $arr["isFavourite"] = 0;
                                } else {
                                    $arr["isFavourite"] = 1;
                                }
                                $all_arr[] = $arr;
                            }
                            $response['items'] = $all_arr;
                            echo json_encode($response);
                        } else {
                            $response['message'] = $this->MESSAGE_ITEM_NOT_FOUND;
                            $response['items'] = array();
                            echo json_encode($response);
                        }
                    } else {
                        $this->responseWithMessage($this->MESSAGE_USER_NOT_FOUND);
                    }
                } else {
                    $this->responseWithMessage($this->MESSAGE_USER_NOT_FOUND);
                }

//                echo '<pre>';
//                print_r($response);
//                 echo '<pre>';
            }
        } catch (Exception $ex) {
            $this->responseWithMessage($this->MESSAGE_FAIL_EX);
        }
    }

    public function actionLifeStyleItemDetails() {
        try {
            $request = $this->parseRequest();

            if ($request != false) {
                $id = $request['Id'];
                $mobileSize = $request['mobileSize'];

                $product = Product::model()->findByPk($id);
                if (count($product) == 1) {
                    $product_owner_id = intval($product->user_id);
                    $product_owner_name = $this->stringVal(User::model()->findByPk($product_owner_id)->fname . " " . User::model()->findByPk($product_owner_id)->lname);
                    $user_details = UserDetails::model()->findByAttributes(array("user_id" => $product_owner_id));

                    $item['productOwner'] = array("id" => $product_owner_id, "name" => $product_owner_name, "paypalAccount" => $this->stringVal($user_details->paypal_account));

                    $details = ProductDetails::model()->findByAttributes(array("product_id" => $id));

                    $itemrevs = Review::model()->findAllByAttributes(array('product_id' => $id));
                    if ($product->gallery_id != null)
                        $itemphotos = GalleryPhoto::model()->findAllByAttributes(array('gallery_id' => $product->gallery_id));
                    $shippingValues = ShippingValue::model()->findByAttributes(array("country_id" => $product->user_id));

                    $sizes = Sizes::model()->findAllByAttributes(array('category_id' => $product->category_id));
                    $sizes_arr = array();
                    foreach ($sizes as $size) {
                        $arr2["id"] = intval($size['id']);
                        $arr2["title"] = $this->stringVal($size['title']);
                        $sizes_arr[] = $arr2;
                    }
                    $item['sizes'] = $sizes_arr;
                    $reviews = array();
                    foreach ($itemrevs as $rev) {
                        $arr3['id'] = intval($rev->id);
                        $arr3['username'] = $this->stringVal(User::model()->findByPk($rev->user_id)->username);
                        $arr3['date'] = $this->stringVal(date("d-m-Y", strtotime($rev->comment_date)));
                        $arr3['review'] = $this->stringVal($rev->comment);
                        $arr3['rate'] = $this->stringVal($rev->rate);
                        $reviews[] = $arr3;
                    }
                    $item['reviews'] = $reviews;
                    $photos = array();
                    if (count($itemphotos) > 0) {
                        foreach ($itemphotos as $photo) {
                            $this->widget('ext.SAImageDisplayer', array(
                                'image' => $photo->file_name,
                                'size' => $mobileSize,
                                'title' => 'My super title',
                                'defaultImage' => "defualt.jpg",
                                'originalFolderName' => 'product',
                            ));

                            $arr4['externalLink'] = 0;

                            $arr4["image"] = $this->stringVal($photo->file_name);
                            //$arr4['rank'] = $this->stringVal($photo->rank);

                            $photos[] = $arr4;
                        }
                    } else {
                        $itemphotos = XmlGallery::model()->findAll("product_id = $product->id");
                        foreach ($itemphotos as $photo) {

                            $arr4['externalLink'] = 1;

                            //$arr4['id'] = intval($photo->id);
                            $arr4["image"] = $this->stringVal($photo->image);
                            //$arr4['rank'] = $this->stringVal($photo->rank);

                            $photos[] = $arr4;
                        }
                    }
                    $shipping_array = array();
                    foreach ($shippingValues as $ship) {
                        $arr5["id"] = intval($ship['id']);
                        $arr5["title"] = $this->stringVal(City::model()->findByPk($ship['city'])->title);
                        $arr5["value"] = intval($ship['title']);

                        $shipping_array[] = $arr5;
                    }
                    $item['shipping'] = $shipping_array;
                    $item['subImages'] = $photos;
                    $response['message'] = $this->MESSAGE_SUCCESS;

                    $cont['sizes'] = $item['sizes'];
                    $cont['quantity'] = $this->stringVal($product->quantity);
                    $cont['desc'] = $this->stringVal($product->description);
                    $cont['reviews'] = $item['reviews'];
                    $cont['subImages'] = $item['subImages'];
                    $cont['productOwner'] = $item['productOwner'];
                    $cont['shippingTo'] = $item['shipping'];
                    $response['itemDetails'] = $cont;

//                    echo '<pre>';
//                    print_r($response);
//                     echo '<pre>';
                    echo json_encode($response);
                } else {
                    $this->responseWithMessage($this->MESSAGE_ITEM_NOT_FOUND);
                }
            }
        } catch (Exception $ex) {
            $this->responseWithMessage($this->MESSAGE_FAIL_EX);
        }
    }

    public function actionLifeStyleSearch() {
        try {
            $request = $this->parseRequest();
            //print_r($request);
            if ($request != false) {
                $id = $request['userAuth']['id'];
                $hash = $request['userAuth']['hash'];
//                $search = $request['search']['text'];
                $subCatId = $request['search']['subCatId'];
                $brandId = $request['search']['brandId'];
                $shopId = $request['search']['shopId'];
                $startPrice = floatval($request['search']['startPrice']);
                $endPrice = floatval($request['search']['endPrice']);
                //$sizeId = $request['search']['sizeId'];
                //  $colorId = $request['search']['colorId'];
                $mobileSize = $request['search']['mobileSize'];
                $start = $request['start'];
                $end = $request['end'];


//                print_r($items);
//                die;
                $model = User::model()->findByPk($id);

                if (count($model) == 1) {
                    $authuser = $this->authUser2($hash, $id);
//                    echo md5($model->id . "-" . $model->email . "-" . User::simple_decrypt($model->password));
//                    die;
                    if ($authuser === true) {
                        $items = Product::model()->lifeStyleSearch($subCatId, $brandId, $shopId, $startPrice, $endPrice, $start, $end);
                        if ($items) {
                            $response['message'] = $this->MESSAGE_SUCCESS;
                            foreach ($items as $item) {
//                        $sizes = Sizes::model()->findAllByAttributes(array('category_id' => $item->category_id));
//                        $sizes_arr = array();
//                        foreach ($sizes as $size) {
//                            $arr2["id"] = intval($size['id']);
//                            $arr2["title"] = $this->stringVal($size['title']);
//                            $sizes_arr[] = $arr2;
//                        }
//                        $ret['sizes'] = $sizes_arr;
//                        $cont['sizes'] = $ret['sizes'];
//                        $cont['quantity'] = $this->stringVal($item->quantity);
//                        $cont['desc'] = $this->stringVal($item->description);
//
//                        $itemrevs = Review::model()->findAllByAttributes(array('product_id' => $item->id));
//
//                        $reviews = array();
//                        foreach ($itemrevs as $rev) {
//                            $arr3['id'] = intval($rev->id);
//                            $arr3['username'] = $this->stringVal(User::model()->findByPk($rev->user_id)->username);
//                            $arr3['date'] = $this->stringVal(date("d-m-Y", strtotime($rev->comment_date)));
//                            $arr3['review'] = $this->stringVal($rev->comment);
//                            $arr3['rate'] = $this->stringVal($rev->rate);
//                            $reviews[] = $arr3;
//                        }
//                        $ret['reviews'] = $reviews;
//                        $cont['reviews'] = $ret['reviews'];
//                        $itemphotos = GalleryPhoto::model()->findAllByAttributes(array('gallery_id' => $item->gallery_id));
//                        $photos = array();
//                        foreach ($itemphotos as $photo) {
//                            $this->widget('ext.SAImageDisplayer', array(
//                                'image' => $photo->file_name,
//                                'size' => $mobileSize,
//                                'title' => 'My super title',
//                                'defaultImage' => "defualt.jpg",
//                                'originalFolderName' => 'product',
//                            ));
//                            //$arr4['id'] = intval($photo->id);
//                            $arr4[] = $this->stringVal($photo->file_name);
//                            //$arr4['rank'] = $this->stringVal($photo->rank);
//
//                            $photos[] = $arr4;
//                        }
//                        $ret['subImages'] = $arr4;
//                        $cont['subImages'] = $ret['subImages'];
//                        $product_owner_id = intval($item->user_id);
//                        $product_owner_name = $this->stringVal(User::model()->findByPk($product_owner_id)->fname . " " . User::model()->findByPk($product_owner_id)->lname);
//                        $user_details = UserDetails::model()->findByAttributes(array("user_id" => $product_owner_id));
//
//                        //echo($user_details->paypal_account);
//                        //die;
//                        $ret['productOwner'] = array("id" => $product_owner_id, "name" => $product_owner_name, "paypalAccount" => $this->stringVal($user_details->paypal_account));
//                        $cont['productOwner'] = $ret['productOwner'];
//                        $shippingValues = ShippingValue::model()->findByAttributes(array("country_id" => $item->user_id));
//                        $shipping_array = array();
//                        foreach ($shippingValues as $ship) {
//                            $arr5["id"] = intval($ship['id']);
//                            $arr5["title"] = $this->stringVal(City::model()->findByPk($ship['city'])->title);
//                            $arr5["value"] = intval($ship['title']);
//
//                            $shipping_array[] = $arr5;
//                        }
//                        $ret['shipping'] = $shipping_array;
//                        $cont['shippingTo'] = $ret['shipping'];
                                //$response['itemDetails'] = $cont;

                                $arr["id"] = intval($item->id);
                                $arr["title"] = $this->stringVal($item->title);
                                $arr["price"] = intval($item->price);

                                $this->widget('ext.SAImageDisplayer', array(
                                    'image' => $item->main_image,
                                    'size' => $mobileSize,
                                    'title' => 'My super title',
                                    'defaultImage' => "defualt.jpg",
                                    'originalFolderName' => 'product',
                                ));

                                $arr["image"] = $this->stringVal($item->main_image);
                                if ($item->flag == 1) {
                                    $arr['externalLink'] = 1;
                                } else {
                                    $arr['externalLink'] = 0;
                                }

                                $favorite = Favourite::model()->find("product_id = $item->id");
                                if ($favorite == null) {
                                    $arr["isFavourite"] = 0;
                                } else {
                                    $arr["isFavourite"] = 1;
                                }
                                $all_arr[] = $arr;

                                $response['items'] = $all_arr;

                                echo json_encode($response);
//                echo '<pre>';
//                print_r($response);
//                echo '<pre>';
                            }
                        } else {
                            $response['message'] = $this->MESSAGE_ITEM_NOT_FOUND;
                            $response['items'] = array();
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

    /////Karem

    public function actionUpload() {
        try {
            $request = $this->parseRequest();
            if ($request != false) {
                $id = $request['userAuth']['id'];
                $hash = $request['userAuth']['hash'];
                //$model = User::model()->findByPk($id);
                //echo md5($model->id . "-" . $model->email . "-" . User::simple_decrypt($model->password));
                //die;
                if ($this->authUser2($hash, $id) == true) {
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

    public function actionSellerRegister() {
        try {
            $request = $this->parseRequest();
            if ($request != false) {

                $fName = $request["fName"];
                $lName = $request["lName"];
                $username = $request["username"];
                $email = $request["email"];
                $password = $request["password"];
                $countryId = $request["countryId"];
                $cityId = $request["cityId"];
                $postCode = $request["postCode"];
                $address = $request["address"];
                $shopName = $request["shopName"];
                $shopAddress = $request["shopAddress"];
                $paypalAccount = $request["paypalAccount"];
                $shopImage = $request["shopImage"];
                // print_r($request);die;
                // if the username or email found it returns found and die after that
                $this->checkUserDataFound('username', $username);
                $this->checkUserDataFound('email', $email);

                $model = new User;
                $user_details = new UserDetails;
                $model->username = $username;
                $model->password = $password;
                $model->email = $email;
                $model->fname = $fName;
                $model->lname = $lName;
                $model->groups_id = 4;

                if ($model->save()) {
                    //  $details = $request["address"];
//print_r($request);die;
                    $user_details = new UserDetails();
                    $user_details->user_id = $model->id;
                    $user_details->country_id = $countryId;
                    $user_details->city_id = $cityId;
                    $user_details->zipcode = $postCode;
                    $user_details->address = $address;
                    $user_details->shop_name = $shopName;
                    $user_details->shop_address = $shopAddress;
                    $user_details->paypal_account = $paypalAccount;
                    $user_details->shop_name = $shopName;
                    $user_details->shop_image = $shopImage;
                    if ($user_details->save(false)) {
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

                $id = $request['userAuth']['id'];
                $hash = $request['userAuth']['hash'];
                $catId = $request['catId'];
                $subCatId = $request['subCatId'];
                $mobileSize = $request['mobileSize'];
                $start = $request['start'];
                $end = $request['end'];

                if ($subCatId != '') {
                    $criteria = new CDbCriteria();
                    $criteria->condition = "category_id=:category_id";
                    $criteria->params = array(':category_id' => $catId);

                    $criteria->offset = $start;
                    $criteria->limit = $end;
                    $car_items = Product::model()->findAll($criteria);
                } else {
                    $criteria = new CDbCriteria();
                    $criteria->condition = "sub_category_id=:sub_category_id";
                    $criteria->params = array(':sub_category_id' => $subCatId);

                    $criteria->offset = $start;
                    $criteria->limit = $end;
                    $car_items = ProductDetails::model()->findAll($criteria);
                }

                $user = User::model()->findByPk($id);
//                echo md5($user->id . "-" . $user->email . "-" . User::simple_decrypt($user->password));
//                die;
                if (count($user) == 1) {
                    $authuser = $this->authUser2($hash, $id);

                    if ($authuser === true) {
                        if ($car_items) {
                            $response['message'] = $this->MESSAGE_SUCCESS;
                            $response['count'] = intval(count($car_items));


                            $arr = array();
                            $all_arr = array();
                            foreach ($car_items as $item) {
                                $favorite = Favourite::model()->find("product_id = $item->id");

                                $arr['id'] = intval($item->id);
                                $this->widget('ext.SAImageDisplayer', array(
                                    'image' => $item->main_image,
                                    'size' => $mobileSize,
                                    'title' => 'My super title',
                                    'defaultImage' => "defualt.jpg",
                                    'originalFolderName' => 'product',
                                ));
                                $arr['image'] = $this->stringVal($item->main_image);

                                if ($item->flag == 1) {
                                    $arr['externalLink'] = 1;
                                } else {
                                    $arr['externalLink'] = 0;
                                }

                                $arr['title'] = $this->stringVal($item->title);
                                $arr['price'] = intval($item->price);

                                if ($favorite != null) {
                                    $arr['isFavourite'] = 1;
                                } else {
                                    $arr['isFavourite'] = 0;
                                }


                                $all_arr[] = $arr;
                            }
                            $response['items'] = $all_arr;

                            echo json_encode($response);

//                    echo '<pre>';
//                    print_r($response);
//                    echo '<pre>';
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

    public function actionCarItemDetails() {
        try {
            $request = $this->parseRequest();
            if ($request != false) {

                $Id = $request['Id'];
                $mobileSize = $request['mobileSize'];


                $car = Product::model()->findByPk($Id);

                if ($car) {
                    $car_details = ProductDetails::model()->find("product_id = $car->id");
                    $car_reviews = Review::model()->findAll("product_id = $car->id");

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
                            //  $review_arr['image'] = $this->stringVal($user->image);

                            if ($car->flag == 1) {
                                $review_arr['externalLink'] = 1;
                            } else {
                                $review_arr['externalLink'] = 0;
                            }

                            $review_arr['image'] = $this->stringVal($user->main_image);
                            $review_arr['date'] = intval($review->comment_date);
                            $review_arr['review'] = intval($review->comment);
                            $review_arr['rate'] = intval($review->rate);
                            $arr['reviews'][] = $review_arr;
                        }
                    } else {
                        $arr['reviews'] = array();
                    }

                    if ($car->gallery_id != '')
                        $gallery_images = GalleryPhoto::model()->findAll("gallery_id = $car->gallery_id");
//                 print_r($gallery_images);die;
                    // $arr["subImages"]='[';
                    $subimage_arr = array();
                    $subimage_arr_ = array();
                    if ($gallery_images) {
                        foreach ($gallery_images as $img) {
                            $this->widget('ext.SAImageDisplayer', array(
                                'image' => intval($img->rank) . '.jpg',
                                'size' => $this->stringVal($mobileSize),
                                'title' => 'My super title',
                                'defaultImage' => "defualt.jpg",
                                'originalFolderName' => '../gallery',
                            ));
                            $subimage_arr["image"] = $this->stringVal($img->rank . '.jpg');
                            $subimage_arr["externalLink"] = 0;
                            $subimage_arr_ [] = $subimage_arr;
                        }

                        $arr["subImages"] = $subimage_arr;
                    } else {
                        $gallery_images = XmlGallery::model()->findAll("product_id = $car->id");
                        // print_r($gallery_images);die;
                        foreach ($gallery_images as $imag) {

                            $subimage_arr["image"] = $this->stringVal($imag->image);
                            $subimage_arr["externalLink"] = 1;
                            $subimage_arr_ [] = $subimage_arr;
                        }


                        $arr["subImages"] = $subimage_arr_;
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
                    $this->responseWithMessage($this->MESSAGE_ITEM_NOT_FOUND);
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
                $id = $request['userAuth']['id'];
                $hash = $request['userAuth']['hash'];
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
                $mobileSize = $request['mobileSize'];


                $start = $request['start'];
                $end = $request['end'];

                //$criteria='1=1 ';
//                if($maxPrice != '' or $minPrice != '') $criteria .= " AND price > $minPrice and price < $maxPrice";
                //  $criteria_det='1=1 JOIN product_details ON product.id = product_details.product_id';
                $query = '';
                if ($makeId != null) {
                    $query .= " make_id=:make_id";
                }
                if ($modelId != null) {
                    $query .= " AND motor_model_id=:motor_model_id";
                }
                if ($gasId != null) {
                    $query .= " AND gas_id=:gas_id";
                }
                if ($doorsId != null) {
                    $query .= " AND door_id=:door_id";
                }
                if ($kmId != null) {
                    $query .= " AND kmage_id=:kmage_id";
                }

                if ($agesId != null) {
                    $query .= " AND age_id=:age_id";
                }
                if ($emissonsId != null) {
                    $query .= " AND emission_id=:emission_id";
                }
                if ($engines != null) {
                    $query .= " AND engine_id=:engine_id";
                }
                if ($powerEngine != null) {
                    $query .= " AND power_engine=:power_engine";
                }
                if ($motorStatus != null) {
                    $query .= " AND motor_status=:motor_status";
                }



                $criteria = new CDbCriteria();
                $criteria->condition = "category_id = 5 AND  price>=:min_price and price<=:max_price and id IN(SELECT product_id FROM product_details  WHERE $query"
                        . ")";

                $criteria->params = array(":min_price" => $minPrice, ":max_price" => $maxPrice);

                if ($makeId != null) {
                    $criteria->params[':make_id'] = $makeId;
                }
                if ($modelId != null) {
                    $criteria->params[':motor_model_id'] = $modelId;
                }
                if ($gasId != null) {
                    $criteria->params[':gas_id'] = $gasId;
                }
                if ($doorsId != null) {
                    $criteria->params[':door_id'] = $doorsId;
                }
                if ($kmId != null) {
                    $criteria->params[':kmage_id'] = $kmId;
                }

                if ($agesId != null) {
                    $criteria->params[':age_id'] = $agesId;
                }
                if ($emissonsId != null) {
                    $criteria->params[':emission_id'] = $emissonsId;
                }
                if ($engines != null) {
                    $criteria->params[':engine_id'] = $engines;
                }
                if ($powerEngine != null) {
                    $criteria->params[':power_engine'] = $powerEngine;
                }

                $criteria->limit = $end;
                $criteria->offset = $start;
                $items = Product::model()->findAll($criteria);
                $model = User::model()->findByPk($id);
                if (count($model) == 1) {
                    $authuser = $this->authUser2($hash, $id);
//                    echo md5($model->id . "-" . $model->email . "-" . User::simple_decrypt($model->password));
//                    die;
                    if ($authuser === true) {
                        if ($items) {
                            $response['message'] = $this->MESSAGE_SUCCESS;
                            $response['count'] = count($items);

                            $arr = array();
                            // $review_arr = array();
                            $all_arr = array();
                            foreach ($items as $item) {

                                $favorite = Favourite::model()->find("product_id = $item->id");

                                $arr['id'] = intval($item->id);
                                $this->widget('ext.SAImageDisplayer', array(
                                    'image' => $item->main_image,
                                    'size' => $mobileSize,
                                    'title' => 'My super title',
                                    'defaultImage' => "defualt.jpg",
                                    'originalFolderName' => 'product',
                                ));

                                if ($item->flag == 1) {
                                    $arr['externalLink'] = 1;
                                } else {
                                    $arr['externalLink'] = 0;
                                }


                                $arr['image'] = $this->stringVal($item->main_image);
                                $arr['title'] = $this->stringVal($item->title);
                                $arr['price'] = intval($item->price);

                                if ($favorite != null) {
                                    $arr['isFavourite'] = 1;
                                } else {
                                    $arr['isFavourite'] = 0;
                                }



//                   
                                $all_arr[] = $arr;
                            }
                            $response['items'] = $all_arr;
//                    echo '<pre>';
//                    print_r($response);
//                    echo '<pre>';
                        } else {
//                    echo 'fff';car
//                    die;
                            $response['message'] = $this->MESSAGE_ITEM_NOT_FOUND;
                            $response['items'] = array();
                        }
                    } else {
                        $this->responseWithMessage($this->MESSAGE_USER_NOT_FOUND);
                    }
                } else {
                    $this->responseWithMessage($this->MESSAGE_USER_NOT_FOUND);
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

                    if ($decor_item->gallery_id != null)
                        $gallery_images = GalleryPhoto::model()->findAll("gallery_id = $decor_item->gallery_id");
                    // $arr["subImages"]='[';
                    $subimage_arr = array();
                    $subimage_arr_ = array();
                    if ($gallery_images) {
                        foreach ($gallery_images as $img) {
                            $this->widget('ext.SAImageDisplayer', array(
                                'image' => intval($img->rank) . '.jpg',
                                'size' => $this->stringVal($mobileSize),
                                'title' => 'My super title',
                                'defaultImage' => "defualt.jpg",
                                'originalFolderName' => '../gallery',
                            ));
                            $subimage_arr["image"] = $this->stringVal($img->rank . '.jpg');
                            $subimage_arr["externalLink"] = 0;
                            $subimage_arr_[] = $subimage_arr;
                        }

                        $arr["subImages"] = $subimage_arr_;
                    } else {
                        $gallery_images = XmlGallery::model()->findAll("product_id = $decor_item->id");
                        foreach ($gallery_images as $img) {

                            $subimage_arr["image"] = $this->stringVal($img->image);
                            $subimage_arr["externalLink"] = 1;
                            $subimage_arr_[] = $subimage_arr;
                        }
                        $arr["subImages"] = $subimage_arr_;
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
                $query = '';
                if ($subCatId != null) {
                    $query .= " sub_category_id=:sub_category_id";
                }
                if ($brandId != null) {
                    $query .= " and brand_id=:brand_id";
                }
                if ($decoreTypeId != null) {
                    $query .= " and decor_type_id=:decor_type_id";
                }
                if ($decoreStyleId != null) {
                    $query .= " and decor_style_id=:decor_style_id";
                }




                $criteria = new CDbCriteria();
                $criteria->condition = "Category_id = 6 and price>=:startPrice and price<=:endPrice "
                        . " AND id IN(SELECT product_id FROM product_details  WHERE $query"
                        . " and id IN(select product_id from size where size_id = $sizeId )"
                        . " and id IN(select product_id from color where id = $colorId)"
                        . " and user_id IN (select user_id from user_details where user_id = $shopId))";

                $criteria->params = array(":startPrice" => $startPrice, ":endPrice" => $endPrice);

                if ($subCatId != null) {
                    $criteria->params[':sub_category_id'] = $subCatId;
                }
                if ($brandId != null) {
                    $criteria->params[':brand_id'] = $brandId;
                }
                if ($decoreTypeId != null) {
                    $criteria->params[':decor_type_id'] = $decoreTypeId;
                }
                if ($decoreStyleId != null) {
                    $criteria->params[':decor_style_id'] = $decoreStyleId;
                }


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
                        if ($item->flag == 1) {
                            $arr['externalLink'] = 1;
                        } else {
                            $arr['externalLink'] = 0;
                        }

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
                    $response['message'] = $this->MESSAGE_FAIL;
                    $response['items'] = array();
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

                $id = $request['userAuth']['id'];
                $hash = $request['userAuth']['hash'];
                $catId = $request['catId'];
                $subCatId = $request['subCatId'];
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
                $model = User::model()->findByPk($id);
                if (count($model) == 1) {
                    $authuser = $this->authUser2($hash, $id);
                    //echo md5($model->id . "-" . $model->email . "-" . User::simple_decrypt($model->password));
                    //die;
                    if ($authuser === true) {

                        if ($elec_items) {
                            $response['message'] = $this->MESSAGE_SUCCESS;
                            $response['count'] = intval(count($elec_items));


                            $arr = array();
                            $all_arr = array();
                            foreach ($elec_items as $item) {
                                $favorite = Favourite::model()->find("product_id = $item->id");
                                $arr['id'] = intval($item->id);
                                $this->widget('ext.SAImageDisplayer', array(
                                    'image' => $item->main_image,
                                    'size' => $mobileSize,
                                    'title' => 'My super title',
                                    'defaultImage' => "defualt.jpg",
                                    'originalFolderName' => 'product',
                                ));
                                $arr['image'] = $this->stringVal($item->main_image);
                                if ($item->flag == 1) {
                                    $arr['externalLink'] = 1;
                                } else {
                                    $arr['externalLink'] = 0;
                                }

                                $arr['title'] = $this->stringVal($item->title);
                                $arr['price'] = intval($item->price);

                                if ($favorite != null) {
                                    $arr['isFavourite'] = 1;
                                } else {
                                    $arr['isFavourite'] = 0;
                                }
                                //$arr['publishDate']= $this->stringVal($)
                                $all_arr[] = $arr;
                            }
                            $response['items'] = $all_arr;
//                    echo '<pre>';
//                    print_r($response);
//                    echo '<pre>';
//                    die;

                            echo json_encode($response);
                        } else {
//                    echo 'fff';
//                    die;
                            $this->responseWithMessage($this->MESSAGE_ITEM_NOT_FOUND);
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

    public function actionElectronicsSearch() {
        try {
            $request = $this->parseRequest();

            if ($request != false) {
                $id = $request['userAuth']['id'];
                $hash = $request['userAuth']['hash'];
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

                $model = User::model()->findByPk($id);
                if (count($model) == 1) {
                    $authuser = $this->authUser2($hash, $id);
//                    echo md5($model->id . "-" . $model->email . "-" . User::simple_decrypt($model->password));
//                    die;
                    if ($authuser === true) {
                        $query = '';
                        if ($subCatId != null) {
                            $query .= " sub_category_id=:sub_category_id";
                        }
                        if ($brandId != null) {
                            $query .= " and brand_id=:brand_id";
                        }
//                if ($decoreTypeId != null) { $query .= " or decor_type_id=:decor_type_id";} 
//                if ($decoreStyleId != null) { $query .= " or decor_style_id=:decor_style_id";} 




                        $criteria = new CDbCriteria();
                        $criteria->condition = "Category_id = 6 and price>=:startPrice and price<=:endPrice "
                                . " and id IN(SELECT product_id FROM product_details  WHERE $query"
                                . " and id IN(select product_id from size where size_id = $sizeId )"
                                . " and id IN(select product_id from color where id = $colorId)"
                                . " and user_id IN (select user_id from user_details where user_id = $shopId))";

                        $criteria->params = array(":startPrice" => $startPrice, ":endPrice" => $endPrice);

                        if ($subCatId != null) {
                            $criteria->params[':sub_category_id'] = $subCatId;
                        }
                        if ($brandId != null) {
                            $criteria->params[':brand_id'] = $brandId;
                        }
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

                                if ($item->flag == 1) {
                                    $arr['externalLink'] = 1;
                                } else {
                                    $arr['externalLink'] = 0;
                                }

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
                            $response['message'] = $this->MESSAGE_ITEM_NOT_FOUND;
                            $response['items'] = array();
                        }
                    } else {
                        $this->responseWithMessage($this->MESSAGE_USER_NOT_FOUND);
                    }
                } else {
                    $this->responseWithMessage($this->MESSAGE_USER_NOT_FOUND);
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
                $id = $request['userAuth']['id'];
                $hash = $request['userAuth']['hash'];
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

                $user = User::model()->findByPk($id);
//                echo md5($user->id . "-" . $user->email . "-" . User::simple_decrypt($user->password));
//                die;
                if (count($user) == 1) {
                    $authuser = $this->authUser2($hash, $id);

                    if ($authuser === true) {
                        $query = '';
                        if ($subCatId != null) {
                            $query .= " sub_category_id=:sub_category_id";
                        }
                        if ($brandId != null) {
                            $query .= " and brand_id=:brand_id";
                        }
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

                        $criteria->params = array(":startPrice" => $startPrice, ":endPrice" => $endPrice);

                        if ($subCatId != null) {
                            $criteria->params[':sub_category_id'] = $subCatId;
                        }
                        if ($brandId != null) {
                            $criteria->params[':brand_id'] = $brandId;
                        }
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
                                if ($item->flag == 1) {
                                    $arr['externalLink'] = 1;
                                } else {
                                    $arr['externalLink'] = 0;
                                }


                                $arr['price'] = $this->stringVal($item->price);


//                   
                                $all_arr[] = $arr;
                            }
                            $response['items'] = $all_arr;
//                    echo '<pre>';
//                    print_r($response);
//                    echo '<pre>';
//                    echo '<pre>';
//                    print_r($response);
//                    echo '<pre>';
                        } else {
//                    echo 'fff';
//                    die;
                            $response['message'] = $this->MESSAGE_FAIL;
                            $response['items'] = array();
                        }
                    } else {
                        $this->responseWithMessage($this->MESSAGE_USER_NOT_FOUND);
                    }
                } else {
                    $this->responseWithMessage($this->MESSAGE_USER_NOT_FOUND);
                }
                echo json_encode($response);
            }
        } catch (Exception $ex) {

            $this->responseWithMessage($this->MESSAGE_FAIL_EX);
        }
    }

    public function ActionFeaturedItems() {

        try {
            $request = $this->parseRequest();
            if ($request != false) {
                $id = $request['userAuth']['id'];
                $hash = $request['userAuth']['hash'];
                $mobilesize = $request['mobileSize'];
                $catId = $request['catId'];
//                $productcatId = $request['subCatId'];
//                $start = $request['start'];
//                $end = $request['end'];

                $response['message'] = $this->MESSAGE_SUCCESS;
                $allitems = Product::model()->findAll("category_id = $catId AND category_featured = 1");
                $count = count($allitems);
                $response['count'] = intval($count);
//                $subitems = Product::model()->itemsListing($catId, $productcatId, $start, $end);
                $item_arr = array();
//               print_r($allitems);die;
                $user = User::model()->findByPk($id);
//                echo md5($user->id . "-" . $user->email . "-" . User::simple_decrypt($user->password));
//                die;
                if (count($user) == 1) {
                    $authuser = $this->authUser2($hash, $id);

                    if ($authuser === true) {
                        if ($allitems) {
                            foreach ($allitems as $item) {
                                $favorite = Favourite::model()->find("product_id = $item->id");
                                $arr3['id'] = intval($item->id);
                                // $arr3['webSiteCatId'] = intval($item->title);
                                // $arr3['catId'] = intval($item->product_category_id);
                                // $product_details = ProductDetails::model()->findByAttributes(array('product_id' => $item->id));
                                // echo ($item->category->title);die;
                                // $arr3['subCatId'] = intval($product_details->sub_category_id);
                                // $arr3['catTitle'] = $this->stringVal($item->category->title);
                                $arr3['title'] = $this->stringVal($item->title);
                                // $arr3['description'] = $this->stringVal($item->description);
                                //  $arr3['status'] = $this->stringVal(ProductStatus::model()->findByPk($item->product_status_id)->title);
                                //  $arr3['quantity'] = intval($item->quantity);
                                $this->widget('ext.SAImageDisplayer', array(
                                    'image' => $item->main_image,
                                    'size' => $mobilesize,
                                    'title' => 'My super title',
                                    'defaultImage' => "defualt.jpg",
                                    'originalFolderName' => 'product',
                                ));
                                $arr3['image'] = $this->stringVal($item->main_image);
                                if ($item->flag == 1) {
                                    $arr3['externalLink'] = 1;
                                } else {
                                    $arr3['externalLink'] = 0;
                                }

                                $arr3['price'] = $this->stringVal($item->price) . ' $';
                                if ($favorite != null) {
                                    $arr3['isFavourite'] = 1;
                                } else {
                                    $arr3['isFavourite'] = 0;
                                }
                                $item_arr[] = $arr3;
                            }
                        }
                        $response['items'] = $item_arr;
                        echo json_encode($response, JSON_UNESCAPED_SLASHES);

//                echo '<pre>';
//                print_r($response);
//                echo '<pre>';
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

    public function ActionSearch() {

        try {
            $request = $this->parseRequest();
            if ($request != false) {
                $id = $request['userAuth']['id'];
                $hash = $request['userAuth']['hash'];
                $mobilesize = $request['mobileSize'];
                $catId = $request['catId'];
                $search = $request['search'];
//                $start = $request['start'];
//                $end = $request['end'];

                $response['message'] = $this->MESSAGE_SUCCESS;
                if ($catId != 0) {
                    $allitems = Product::model()->findAll("category_id = $catId AND lower(title) like lower('%$search%')");
                } else {
                    $allitems = Product::model()->findAll("lower(title) like lower('%$search%')");
                }
                $count = count($allitems);
                $response['count'] = intval($count);
//                $subitems = Product::model()->itemsListing($catId, $productcatId, $start, $end);
                $item_arr = array();
//               print_r($subitems);die;
                $user = User::model()->findByPk($id);
//                echo md5($user->id . "-" . $user->email . "-" . User::simple_decrypt($user->password));
//                die;
                if (count($user) == 1) {
                    $authuser = $this->authUser2($hash, $id);

                    if ($authuser === true) {
                        if ($allitems) {
                            foreach ($allitems as $item) {
                                $favorite = Favourite::model()->find("product_id = $item->id");
                                $arr3['id'] = intval($item->id);
                                // $arr3['webSiteCatId'] = intval($item->title);
                                // $arr3['catId'] = intval($item->product_category_id);
                                // $product_details = ProductDetails::model()->findByAttributes(array('product_id' => $item->id));
                                // echo ($item->category->title);die;
                                // $arr3['subCatId'] = intval($product_details->sub_category_id);
                                // $arr3['catTitle'] = $this->stringVal($item->category->title);
                                $arr3['title'] = $this->stringVal($item->title);
                                //   $arr3['description'] = $this->stringVal($item->description);
                                //   $arr3['status'] = $this->stringVal(ProductStatus::model()->findByPk($item->product_status_id)->title);
                                //   $arr3['quantity'] = intval($item->quantity);
                                $this->widget('ext.SAImageDisplayer', array(
                                    'image' => $item->main_image,
                                    'size' => $mobilesize,
                                    'title' => 'My super title',
                                    'defaultImage' => "defualt.jpg",
                                    'originalFolderName' => 'product',
                                ));
                                $arr3['image'] = $this->stringVal($item->main_image);
                                if ($item->flag == 1) {
                                    $arr3['externalLink'] = 1;
                                } else {
                                    $arr3['externalLink'] = 0;
                                }

                                $arr3['price'] = intval($item->price) . ' $';
                                if ($favorite != null) {
                                    $arr3['isFavourite'] = 1;
                                } else {
                                    $arr3['isFavourite'] = 0;
                                }
                                $item_arr[] = $arr3;
                            }
                        }
                        $response['items'] = $item_arr;
                        echo json_encode($response, JSON_UNESCAPED_SLASHES);

//                echo '<pre>';
//                print_r($response);
//                echo '<pre>';
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

    public function ActionAddRemoveFavourite() {

        try {
            $request = $this->parseRequest();
            if ($request != false) {
                $id = $request['userAuth']['id'];
                $hash = $request['userAuth']['hash'];
                $itemId = $request['itemId'];



//                $allitems = Product::model()->findAll("category_id = $catId AND lower(title) like lower('%$search%')");
//                $count = count($allitems);
//                $response['count'] = intval($count);
////                $subitems = Product::model()->itemsListing($catId, $productcatId, $start, $end);
//                $item_arr = array();
//               print_r($subitems);die;
                $user = User::model()->findByPk($id);
//                echo md5($user->id . "-" . $user->email . "-" . User::simple_decrypt($user->password));
//                die;
                if (count($user) == 1) {
                    $authuser = $this->authUser2($hash, $id);

                    if ($authuser === true) {
                        $favorite = Favourite::model()->find("product_id = $itemId and user_id=$id");
                        if ($favorite == NULL) {
                            $fav_model = new Favourite;
                            $fav_model->product_id = $itemId;
                            $fav_model->user_id = $id;
                            $fav_model->save();
                            $response['message'] = $this->MESSAGE_SUCCESS;
                        } else {
                            $favorite->delete();
                            $response['message'] = $this->MESSAGE_SUCCESS;
                        }
                        echo json_encode($response, JSON_UNESCAPED_SLASHES);

//                echo '<pre>';
//                print_r($response);
//                echo '<pre>';
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

    public function ActionAddProduct() {

        try {

            $request = $this->parseRequest();


            if ($request != false) {
                $id = $request['userAuth']['id'];
                $hash = $request['userAuth']['hash'];
                $product = $request['product'];
                $webSiteCatId = $product['webSiteCatId'];
                $productCatId = $product['productCatId'];
                $subCatId = $product['subCatId'];
                $productName = $product['productName'];
                $image = $product['image'];
                $price = $product['price'];
                $description = $product['description'];
                $quantity = $product['quantity'];
                $onSale = $product['onSale'];
                $oldPrice = $product['oldPrice'];
                $images = $product['images'];
                $brandId = $product['brandId'];
                $sizes = $product['sizes'];
                $colors = $product['colors'];
                $realStateType = $product['realStateType'];
                $realStateFacilites = $product['realStateFacilites'];
                $decorStyleId = $product['decorStyleId'];
                $decoreTypeId = $product['decoreTypeId'];
                $countryId = $product['countryId'];
                $cityId = $product['cityId'];
                $type = $product['type'];
                $longt = $product['longt'];
                $lat = $product['lat'];
                $address = $product['address'];
                $postCode = $product['postCode'];
                $manufactureId = $product['manufactureId'];
                $modelId = $product['modelId'];
                $motorCondition = $product['motorCondition'];
                $gasId = $product['gasId'];
                $doorId = $product['doorId'];
                $kmageId = $product['kmageId'];
                $ageId = $product['ageId'];
                $emissionId = $product['emissionId'];
                $engineId = $product['engineId'];
                $powerEngineId = $product['powerEngineId'];
                $motorStatusId = $product['motorStatusId'];
                $conditions = $product['conditions'];



                $user = User::model()->findByPk($id);
//                echo md5($user->id . "-" . $user->email . "-" . User::simple_decrypt($user->password));
//                die;
                if (count($user) == 1) {
                    $authuser = $this->authUser2($hash, $id);

                    if ($authuser === true) {

                        $attributes = array();

                        $attributes['category_id'] = $webSiteCatId;
                        $attributes['product_category_id'] = $productCatId;
                        $attributes['title'] = $productName;
                        $attributes['description'] = $description;
                        $attributes['price'] = $price;
                        $attributes['old_price'] = $oldPrice;
                        $attributes['on_sale'] = $onSale;
                        $attributes['quantity'] = $quantity;
                        $attributes['user_id'] = $id;
                        $attributes['type'] = $type;
                        $attributes['main_image'] = $image;


                        $detail_attributes = array();
                        if (SubCategory::model()->findByPk($subCatId) != null) {
                            $detail_attributes['sub_category_id'] = $subCatId;
                        }
                        $detail_attributes['user_id'] = $id;
                        if (Brand::model()->findByPk($brandId) != null) {
                            $detail_attributes['brand_id'] = $brandId;
                        }

                        $detail_attributes['real_estate_type'] = $realStateType;
                        $detail_attributes['real_estate_facilities'] = $realStateFacilites;
                        if (DecorStyle::model()->findByPk($decorStyleId) != null) {
                            $detail_attributes['decor_style_id'] = $decorStyleId;
                        }
                        if (DecorType::model()->findByPk($decoreTypeId) != null) {
                            $detail_attributes['decor_type_id'] = $decoreTypeId;
                        }
                        if (Country::model()->findByPk($countryId) != null) {
                            $detail_attributes['country_id'] = $countryId;
                        }
                        if (City::model()->findByPk($cityId) != null) {
                            $detail_attributes['city_id'] = $cityId;
                        }
                        $detail_attributes['longitude'] = $longt;
                        $detail_attributes['latitude'] = $lat;
                        $detail_attributes['address'] = $address;
                        $detail_attributes['post_code'] = $postCode;
                        if (Make::model()->findByPk($manufactureId) != null) {
                            $detail_attributes['make_id'] = $manufactureId;
                        }
                        if (MotorModel::model()->findByPk($modelId) != null) {
                            $detail_attributes['motor_model_id'] = $modelId;
                        }

                        $detail_attributes['conditions'] = $motorCondition;
                        if (Gas::model()->findByPk($gasId) != null) {
                            $detail_attributes['gas_id'] = $gasId;
                        }
                        if (Door::model()->findByPk($doorId) != null) {
                            $detail_attributes['door_id'] = $doorId;
                        }
                        if (Kmage::model()->findByPk($kmageId) != null) {
                            $detail_attributes['kmage_id'] = $kmageId;
                        }
                        if (Age::model()->findByPk($ageId) != null) {
                            $detail_attributes['age_id'] = $ageId;
                        }
                        if (Emission::model()->findByPk($emissionId) != null) {
                            $detail_attributes['emission_id'] = $emissionId;
                        }
                        if (Engine::model()->findByPk($engineId) != null) {
                            $detail_attributes['engine_id'] = $engineId;
                        }

                        //$detail_attributes['power_engine'] = $powerEngineId;

                        $detail_attributes['motor_status'] = $motorStatusId;
                        $detail_attributes['conditions'] = $conditions;

                        $model = new Product;
                        $model->attributes = $attributes;

                        if ($model->save(false)) {
                            $product_details = new ProductDetails;
                            $product_details->attributes = $detail_attributes;
//               
                            // $product_details->user_id = $id;
                            $product_details->product_id = $model->id;
//                     echo '<pre>';
//                  print_r($product_details->attributes);
//                  echo '<pre>';die;
                            if ($product_details->save(false)) {
                                if ($sizes) {
                                    foreach ($sizes as $size) {
                                        if ($model->category_id != 3) {
                                            if (Sizes::model()->findByPk($size['id']) != null) {
                                                $product_size = new ProductSizes;
                                                $product_size->sizes_id = $size['id'];
                                                $product_size->product_id = $model->id;
                                                $product_size->save(false);
                                            }
                                        } else {

                                            if (Sizes::model()->findByPk($size['id']) != null) {
                                                $size_ = new Size;
                                                // print_r($size_->attributes);die;
                                                $size_->size_id = $size['id'];
                                                $size_->product_id = $model->id;
                                                $size_->price = $size['price'];
                                                $size_->quantity = $model->quantity;

                                                $size_->save(false);
                                            }
                                        }
                                    }
                                }

                                if ($colors) {
                                    foreach ($colors as $color) {

                                        if (Colors::model()->findByPk($color['id']) != null) {
                                            $product_color = new ProductColor;
                                            $product_color->colors_id = $color['id'];
                                            $product_color->product_id = $model->id;
                                            $product_color->save(false);
                                        }
                                    }
                                }
                            }
                            $response['message'] = $this->MESSAGE_SUCCESS;
                        } else {
                            $this->responseWithMessage($this->MESSAGE_FAIL_EX);
                        }



                        echo json_encode($response, JSON_UNESCAPED_SLASHES);

//                echo '<pre>';
//                print_r($response);
//                echo '<pre>';
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

    public function ActionEditSellerProduct() {

        try {

            $request = $this->parseRequest();

            //print_r($request);die;
            if ($request != false) {
                $id = $request['userAuth']['id'];
                $hash = $request['userAuth']['hash'];
                $product = $request['product'];
                $product_id = $product['id'];
                $webSiteCatId = $product['webSiteCatId'];
                $productCatId = $product['productCatId'];
                $subCatId = $product['subCatId'];
                $productName = $product['productName'];
                $image = $product['image'];
                $price = $product['price'];
                $description = $product['description'];
                $quantity = $product['quantity'];
                $onSale = $product['onSale'];
                $oldPrice = $product['oldPrice'];
                $images = $product['images'];
                $brandId = $product['brandId'];
                $sizes = $product['sizes'];
                $colors = $product['colors'];
                $realStateType = $product['realStateType'];
                $realStateFacilites = $product['realStateFacilites'];
                $decorStyleId = $product['decorStyleId'];
                $decoreTypeId = $product['decoreTypeId'];
                $countryId = $product['countryId'];
                $cityId = $product['cityId'];
                $type = $product['type'];
                $longt = $product['longt'];
                $lat = $product['lat'];
                $address = $product['address'];
                $postCode = $product['postCode'];
                $manufactureId = $product['manufactureId'];
                $modelId = $product['modelId'];
                $motorCondition = $product['motorCondition'];
                $gasId = $product['gasId'];
                $doorId = $product['doorId'];
                $kmageId = $product['kmageId'];
                $ageId = $product['ageId'];
                $emissionId = $product['emissionId'];
                $engineId = $product['engineId'];
                $powerEngineId = $product['powerEngineId'];
                $motorStatusId = $product['motorStatusId'];
                $conditions = $product['conditions'];



                $user = User::model()->findByPk($id);
//                echo md5($user->id . "-" . $user->email . "-" . User::simple_decrypt($user->password));
//                die;
                if (count($user) == 1) {
                    $authuser = $this->authUser2($hash, $id);

                    if ($authuser === true) {

                        $attributes = array();

                        $attributes['category_id'] = $webSiteCatId;
                        $attributes['product_category_id'] = $productCatId;
                        $attributes['title'] = $productName;
                        $attributes['description'] = $description;
                        $attributes['price'] = $price;
                        $attributes['old_price'] = $oldPrice;
                        $attributes['on_sale'] = $onSale;
                        $attributes['quantity'] = $quantity;
                        $attributes['user_id'] = $id;
                        $attributes['type'] = $type;
                        $attributes['main_image'] = $image;


                        $detail_attributes = array();
                        if (SubCategory::model()->findByPk($subCatId) != null) {
                            $detail_attributes['sub_category_id'] = $subCatId;
                        }
                        $detail_attributes['user_id'] = $id;
                        if (Brand::model()->findByPk($brandId) != null) {
                            $detail_attributes['brand_id'] = $brandId;
                        }

                        $detail_attributes['real_estate_type'] = $realStateType;
                        $detail_attributes['real_estate_facilities'] = $realStateFacilites;
                        if (DecorStyle::model()->findByPk($decorStyleId) != null) {
                            $detail_attributes['decor_style_id'] = $decorStyleId;
                        }
                        if (DecorType::model()->findByPk($decoreTypeId) != null) {
                            $detail_attributes['decor_type_id'] = $decoreTypeId;
                        }
                        if (Country::model()->findByPk($countryId) != null) {
                            $detail_attributes['country_id'] = $countryId;
                        }
                        if (City::model()->findByPk($cityId) != null) {
                            $detail_attributes['city_id'] = $cityId;
                        }
                        $detail_attributes['longitude'] = $longt;
                        $detail_attributes['latitude'] = $lat;
                        $detail_attributes['address'] = $address;
                        $detail_attributes['post_code'] = $postCode;
                        if (Make::model()->findByPk($manufactureId) != null) {
                            $detail_attributes['make_id'] = $manufactureId;
                        }
                        if (MotorModel::model()->findByPk($modelId) != null) {
                            $detail_attributes['motor_model_id'] = $modelId;
                        }

                        $detail_attributes['conditions'] = $motorCondition;
                        if (Gas::model()->findByPk($gasId) != null) {
                            $detail_attributes['gas_id'] = $gasId;
                        }
                        if (Door::model()->findByPk($doorId) != null) {
                            $detail_attributes['door_id'] = $doorId;
                        }
                        if (Kmage::model()->findByPk($kmageId) != null) {
                            $detail_attributes['kmage_id'] = $kmageId;
                        }
                        if (Age::model()->findByPk($ageId) != null) {
                            $detail_attributes['age_id'] = $ageId;
                        }
                        if (Emission::model()->findByPk($emissionId) != null) {
                            $detail_attributes['emission_id'] = $emissionId;
                        }
                        if (Engine::model()->findByPk($engineId) != null) {
                            $detail_attributes['engine_id'] = $engineId;
                        }

                        //$detail_attributes['power_engine'] = $powerEngineId;

                        $detail_attributes['motor_status'] = $motorStatusId;
                        $detail_attributes['conditions'] = $conditions;

                        $model = Product::model()->findByPk($product_id);
//                        print_r($model);die;
                        $model->attributes = $attributes;

                        if ($model->save(false)) {
                            //echo 'dsf';die;
                            $product_details = ProductDetails::model()->find("product_id = $product_id");
                            $product_details->attributes = $detail_attributes;
//               
                            // $product_details->user_id = $id;
                            $product_details->product_id = $model->id;
//                     echo '<pre>';
//                  print_r($product_details->attributes);
//                  echo '<pre>';die;
                            if ($product_details->save(false)) {
//                                echo 'fd';die;
                                if ($sizes) {
                                    foreach ($sizes as $size) {
                                        if ($model->category_id != 3) {
                                            if (Sizes::model()->findByPk($size['id']) != null) {
                                                ProductSizes::model()->deleteAllByAttributes(array("product_id" => $product_id));
                                                $product_size = new ProductSizes;
                                                $product_size->sizes_id = $size['id'];
                                                $product_size->product_id = $model->id;
                                                $product_size->save(false);
                                            }
                                        } else {

                                            if (Sizes::model()->findByPk($size['id']) != null) {
                                                $size_ = new Size;
                                                // print_r($size_->attributes);die;
                                                Size::model()->deleteAllByAttributes(array("product_id" => $product_id));
                                                $size_->size_id = $size['id'];
                                                $size_->product_id = $model->id;
                                                $size_->price = $size['price'];
                                                $size_->quantity = $model->quantity;

                                                $size_->save(false);
                                            }
                                        }
                                    }
                                }

                                if ($colors) {
                                    foreach ($colors as $color) {

                                        if (Colors::model()->findByPk($color['id']) != null) {
                                            ProductColor::model()->deleteAllByAttributes(array("product_id" => $product_id));
                                            $product_color = new ProductColor;
                                            $product_color->colors_id = $color['id'];
                                            $product_color->product_id = $model->id;
                                            $product_color->save(false);
                                        }
                                    }
                                }
                            }
//                            $response['message'] = $this->MESSAGE_SUCCESS;
                        } else {
                            $this->responseWithMessage($this->MESSAGE_FAIL_EX);
                        }



                        echo json_encode($response, JSON_UNESCAPED_SLASHES);

//                echo '<pre>';
//                print_r($response);
//                echo '<pre>';
                    } else {
                        $this->responseWithMessage($this->MESSAGE_USER_NOT_FOUND);
                    }
                } else {
                    $this->responseWithMessage($this->MESSAGE_USER_NOT_FOUND);
                }
            }
        } catch (Exception $ex) {
            $this->responseWithMessage($this->MESSAGE_FAIL_EX . ';');
        }
    }

    public function ActionMotorData() {
        try {

            $manufactures = Make::model()->findAll();
            $gases = Gas::model()->findAll();
            $doors = Door::model()->findAll();
            $kmages = Kmage::model()->findAll();
            $ages = Age::model()->findAll();
            $emissions = Emission::model()->findAll();
            $engines = Engine::model()->findAll();
            $powerEngines = array(
                array(
                    "id" => "1",
                    "title" => "100 CV"
                ),
                array(
                    "id" => "2",
                    "title" => "1200 CV"
                )
            );
            $motorStatuses = array(
                array(
                    "id" => "1",
                    "title" => "Used"
                ),
                array(
                    "id" => "2",
                    "title" => "Newly Used"
                ),
                array(
                    "id" => "3",
                    "title" => "New"
                ),
            );
            $response['message'] = $this->MESSAGE_SUCCESS;

            $man_arr = array();
            $man_arr_ = array();
            if ($manufactures) {
                foreach ($manufactures as $man) {

                    $man_arr['id'] = intval($man->id);
                    $man_arr['title'] = $this->stringVal($man->title);
                    $man_arr_[] = $man_arr;
                }
            }
            $response['manufactures'] = $man_arr_;

            $gas_arr = array();
            $gas_arr_ = array();
            if ($gases) {
                foreach ($gases as $gas) {

                    $gas_arr['id'] = intval($gas->id);
                    $gas_arr['title'] = $this->stringVal($gas->title);
                    $gas_arr_[] = $gas_arr;
                }
            }
            $response['gases'] = $gas_arr_;

            $door_arr = array();
            $door_arr_ = array();
            if ($doors) {
                foreach ($doors as $door) {

                    $door_arr['id'] = intval($door->id);
                    $door_arr['title'] = $this->stringVal($door->title);
                    $door_arr_[] = $door_arr;
                }
            }
            $response['doors'] = $gas_arr_;

            $kmage_arr = array();
            $kmage_arr_ = array();
            if ($kmages) {
                foreach ($kmages as $kmage) {

                    $kmage_arr['id'] = intval($kmage->id);
                    $kmage_arr['title'] = $this->stringVal($kmage->title);
                    $kmage_arr_[] = $kmage_arr;
                }
            }
            $response['kmages'] = $kmage_arr_;

            $age_arr = array();
            $age_arr_ = array();
            if ($ages) {
                foreach ($ages as $age) {

                    $age_arr['id'] = intval($age->id);
                    $age_arr['title'] = $this->stringVal($age->title);
                    $age_arr_[] = $age_arr;
                }
            }
            $response['ages'] = $age_arr_;

            $emission_arr = array();
            $emission_arr_ = array();
            if ($emissions) {
                foreach ($emissions as $emission) {

                    $emission_arr['id'] = intval($emission->id);
                    $emission_arr['title'] = $this->stringVal($emission->title);
                    $emission_arr_[] = $emission_arr;
                }
            }
            $response['emissions'] = $emission_arr_;



            if ($engines) {
                foreach ($engines as $engine) {

                    $engine_arr['id'] = intval($engine->id);
                    $engine_arr['title'] = $this->stringVal($engine->title);
                    $engine_arr_[] = $engine_arr;
                }
            }
            $response['engines'] = $engine_arr_;

            $response['powerEngines'] = $powerEngines;
            $response['motorStatuses'] = $motorStatuses;

            echo json_encode($response, JSON_UNESCAPED_SLASHES);

//                echo '<pre>';
//                print_r($response);
//              echo '<pre>';
        } catch (Exception $ex) {
            $this->responseWithMessage($this->MESSAGE_FAIL_EX);
        }
    }

    public function ActionMotorModel() {
        try {
            $request = $this->parseRequest();

            if ($request != false) {

                $manufactureId = $request['manufactureId'];
                $motor_models = MotorModel::model()->findAll("make_id = $manufactureId");

                $response['message'] = $this->MESSAGE_SUCCESS;


                $model_arr = array();
                $model_arr_ = array();
                if ($motor_models) {
//                    echo 'dfdf';
                    foreach ($motor_models as $model) {

                        $model_arr['id'] = intval($model->id);
                        $model_arr['title'] = $this->stringVal($model->title);
                        $model_arr_[] = $model_arr;
                    }
                }
                $response['models'] = $model_arr_;


                echo json_encode($response, JSON_UNESCAPED_SLASHES);

//                echo '<pre>';
//                print_r($response);
//                echo '<pre>';
            }
        } catch (Exception $ex) {
            $this->responseWithMessage($this->MESSAGE_FAIL_EX . 'r');
        }
    }

    public function actionSellerProducts() {
        try {
            $request = $this->parseRequest();
            if ($request != false) {
                $id = $request['userAuth']['id'];
                $hash = $request['userAuth']['hash'];
                $mobilesize = $request['mobileSize'];

                $start = $request['start'];
                $end = $request['end'];

                $response['message'] = $this->MESSAGE_SUCCESS;


                $user = User::model()->findByPk($id);
//
//                                echo md5($user->id . "-" . $user->email . "-" . User::simple_decrypt($user->password));
//                die;
                if (count($user) == 1) {

                    $allitems = Product::model()->findAll("user_id = $id");
                    $count = count($allitems);
                    $response['count'] = intval($count);
                    $subitems = Product::model()->findAll(array("condition" => "user_id = $id", 'limit' => $end, 'offset' => $start));
                    $item_arr = array();
                    // print_r($subitems);die;
                    $authuser = $this->authUser2($hash, $id);

                    if ($authuser === true) {
                        if ($subitems) {
                            foreach ($subitems as $item) {
                                //  $favorite = Favourite::model()->find("product_id = $item->id");
                                $arr3['id'] = intval($item->id);

                                $arr3['title'] = $this->stringVal($item->title);

                                $this->widget('ext.SAImageDisplayer', array(
                                    'image' => $item->main_image,
                                    'size' => $mobilesize,
                                    'title' => 'My super title',
                                    'defaultImage' => "defualt.jpg",
                                    'originalFolderName' => 'product',
                                ));
                                $arr3['image'] = $this->stringVal($item->main_image);
                                if ($item->flag == 1) {
                                    $arr3['externalLink'] = 1;
                                } else {
                                    $arr3['externalLink'] = 0;
                                }

                                $arr3['price'] = $this->stringVal($item->price) . ' $';

                                $category = Category::model()->findByPk($item->category_id);
                                $arr3['webSiteCategory']['id'] = intval($category->id);
                                $arr3['webSiteCategory']['title'] = $this->stringVal($category->title);

                                $item_arr[] = $arr3;

                                // $item_arr_[]=$item_arr;
                            }
                        }
                        $response['products'] = $item_arr;
                        echo json_encode($response, JSON_UNESCAPED_SLASHES);

//                echo '<pre>';
//                print_r($response);
//                echo '<pre>';
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

    public function actionSellerProductDetails() {
        try {

            $request = $this->parseRequest();

            if ($request != false) {
                $id = $request['userAuth']['id'];
                $hash = $request['userAuth']['hash'];
                $mobilesize = $request['mobileSize'];
                $itemId = $request['itemId'];



                $response['message'] = $this->MESSAGE_SUCCESS;


                $user = User::model()->findByPk($id);
//                echo md5($user->id . "-" . $user->email . "-" . User::simple_decrypt($user->password));
//                die;
                if (count($user) == 1) {

                    $item = Product::model()->findByPk($itemId);
                    $item_arr = array();
                    //print_r($item);die;
                    $authuser = $this->authUser2($hash, $id);

                    if ($authuser === true) {
                        if ($item) {
                            // foreach ($subitems as $item) {
                            $product_details = ProductDetails::model()->find("product_id = $item->id");
//                             print_r($product_details);die;

                            $colors = ProductColor::model()->findAll("product_id = $item->id");
//                          if($item->gallery_id)  $images = GalleryPhoto::model()->findAll("gallery_id = $item->gallery_id");
//                             print_r($images);die;

                            $arr3['id'] = intval($item->id);

                            $arr3['productName'] = $this->stringVal($item->title);
                            $this->widget('ext.SAImageDisplayer', array(
                                'image' => $item->main_image,
                                'size' => $mobilesize,
                                'title' => 'My super title',
                                'defaultImage' => "defualt.jpg",
                                'originalFolderName' => 'product',
                            ));
                            $arr3['image'] = $this->stringVal($item->main_image);
                            if ($item->flag == 1) {
                                $arr3['externalLink'] = 1;
                            } else {
                                $arr3['externalLink'] = 0;
                            }

                            $arr3['price'] = $this->stringVal($item->price) . ' $';

                            $arr3['description'] = $this->stringVal($item->description);

                            $arr3['webSiteCatId'] = intval($item->category_id);
                            $arr3['productCatId'] = intval($item->product_category_id);
                            $arr3['subCatId'] = intval($product_details->sub_category_id);
                            $arr3['quantity'] = intval($item->quantity);
                            $arr3['onSale'] = intval($item->on_sale);
                            $arr3['oldPrice'] = intval($item->old_price);

                            $arr4 = array();
                            if ($item->flag != 1) {
                                $images = GalleryPhoto::model()->findAll("gallery_id = $item->gallery_id");
//                                 print_r($images);die;
                                if ($images) {
                                    foreach ($images as $image) {
                                        $arr4['name'] = $this->stringVal($image->name);
                                        $arr4['description'] = $this->stringVal($image->description);
                                        $arr4['image'] = $this->stringVal($image->file_name);
                                        $arr4['externalLink'] = 1;
                                        $arr4_[] = $arr4;
                                    }
                                }
                                $arr3['images'] = $arr4_;
                            } else {
                                //echo 'gf';
                                $ex_images = XmlGallery::model()->findAll("product_id = $item->id");
// print_r($ex_images);die;
                                if ($ex_images) {
                                    foreach ($ex_images as $imag) {
                                        $arr4['name'] = "";
                                        $arr4['description'] = "";
                                        $arr4['image'] = $this->stringVal($imag->image);
                                        $arr4['externalLink'] = 1;
                                        $arr4_[] = $arr4;
                                    }
                                }
                                $arr3['images'] = $arr4_;
                            }
                            if ($item->category_id != 3) {
                                $sizes = ProductSizes::model()->findAll("product_id = $item->id");
                                if ($sizes) {
                                    foreach ($sizes as $size) {
                                        $arr5['id'] = intval($size->sizes_id);
                                        $arr5['title'] = $this->stringVal(Sizes::model()->findByPk($size->sizes_id)->title);
                                        // $arr4['image'] = $this->stringVal($image->file_name);
                                        $arr5_[] = $arr5;
                                    }
                                }
                                $arr3['sizes'] = $arr5_;
                            } else {
                                // echo 'gfg';die;
                                $sizes = Size::model()->findAll("product_id = $item->id");
                                if ($sizes) {
                                    foreach ($sizes as $size) {
                                        $arr5['id'] = intval($size->size_id);
                                        $arr5['title'] = $this->stringVal($size->title);
                                        // $arr4['image'] = $this->stringVal($image->file_name);
                                        $arr5_[] = $arr5;
                                    }
                                }
                                $arr3['sizes'] = $arr5_;
                            }

                            $arr6 = array();
                            if ($colors) {
                                foreach ($colors as $color) {
                                    $arr6['id'] = intval($color->colors_id);
                                    $arr6['title'] = $this->stringVal(Colors::model()->findByPk($color->colors_id)->title);
                                    // $arr4['image'] = $this->stringVal($image->file_name);
                                    $arr6_[] = $arr6;
                                }
                            }
                            $arr3['colors'] = $arr6_;

                            $arr3['brandId'] = intval($product_details->brand_id);
                            $arr3['decorStyleId'] = intval($product_details->decor_style_id);
                            $arr3['decoreTypeId'] = intval($product_details->decor_type_id);
                            $arr3['countryId'] = intval($product_details->country_id);
                            $arr3['cityId'] = intval($product_details->city_id);
                            $arr3['type'] = intval($item->type);
                            $arr3['longt'] = $this->stringVal($product_details->longitude);
                            $arr3['lat'] = $this->stringVal($product_details->latitude);
                            $arr3['address'] = $this->stringVal($product_details->address);
                            $arr3['postCode'] = intval($product_details->post_code);
                            $arr3['manufactureId'] = intval($product_details->make_id);
                            $arr3['modelId'] = intval($product_details->motor_model_id);
                            $arr3['motorCondition'] = $this->stringVal($product_details->conditions);
                            $arr3['gasId'] = intval($product_details->gas_id);
                            $arr3['doorId'] = intval($product_details->door_id);
                            $arr3['kmageId'] = intval($product_details->kmage_id);
                            $arr3['emissionId'] = intval($product_details->emission_id);
                            $arr3['engineId'] = intval($product_details->engine_id);
                            $arr3['powerEngineId'] = intval($product_details->power_engine);
                            $arr3['motorStatusId'] = intval($product_details->motor_status);
                            $arr3['conditions'] = $this->stringVal($product_details->conditions);





                            $item_arr[] = $arr3;

                            // $item_arr_[]=$item_arr;
                            // }
                        } else {
                            $response['message'] = $this->MESSAGE_ITEM_NOT_FOUND;
                        }
                        $response['product'] = $item_arr;
                        echo json_encode($response, JSON_UNESCAPED_SLASHES);

//                        echo '<pre>';
//                        print_r($response);
//                        echo '<pre>';
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

    public function ActionRemoveSellerProduct() {
        try {
            $request = $this->parseRequest();
            if ($request != false) {
                $id = $request['userAuth']['id'];
                $hash = $request['userAuth']['hash'];
                $itemId = $request['itemId'];






                $user = User::model()->findByPk($id);
//                echo md5($user->id . "-" . $user->email . "-" . User::simple_decrypt($user->password));
//                die;
                if (count($user) == 1) {

                    $authuser = $this->authUser2($hash, $id);

                    if ($authuser === true) {
                        $item = Product::model()->findByPk($itemId);
                        //print_r($item);
                        if ($item != null) {

                            $item->delete();

                            $response['message'] = $this->MESSAGE_SUCCESS;
                            // $item_arr_[]=$item_arr;
                        } else {
                            $response['message'] = $this->MESSAGE_ITEM_NOT_FOUND;
                        }



                        echo json_encode($response, JSON_UNESCAPED_SLASHES);

//                echo '<pre>';
//                print_r($response);
//                echo '<pre>';
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

    public function ActionShippingList() {
        try {
            $request = $this->parseRequest();
            if ($request != false) {
                $id = $request['userAuth']['id'];
                $hash = $request['userAuth']['hash'];

                $user = User::model()->findByPk($id);
//                echo md5($user->id . "-" . $user->email . "-" . User::simple_decrypt($user->password));
//                die;
                if (count($user) == 1) {

                    $authuser = $this->authUser2($hash, $id);

                    if ($authuser === true) {
                        $shippings = ShippingValue::model()->findAll("user_id = $id");

                        if ($shippings != null) {

                            $response['message'] = $this->MESSAGE_SUCCESS;

                            $arr = array();
                            $arr_ = array();
                            foreach ($shippings as $ship) {
                                $arr['countryId'] = intval($ship->country_id);
                                $arr['value'] = intval($ship->title);
                                $arr['id'] = intval($ship->id);
                                $arr['countryName'] = $this->stringVal(Country::model()->findByPk($ship->country_id)->title);
                                $ship_arr[] = $arr;
                            }

                            $response['shippings'] = $ship_arr;
                        }



                        echo json_encode($response, JSON_UNESCAPED_SLASHES);

//                echo '<pre>';
//                print_r($response);
//                echo '<pre>';
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

    public function ActionAddShipping() {
        try {
            $request = $this->parseRequest();
            if ($request != false) {
                $id = $request['userAuth']['id'];
                $hash = $request['userAuth']['hash'];
                $countryId = $request['countryId'];
                $value = $request['value'];
                $id2 = $request['id'];

                $user = User::model()->findByPk($id);
                // print_r($user);die;
//                echo md5($user->id . "-" . $user->email . "-" . User::simple_decrypt($user->password));
//                die;
                if (count($user) == 1) {

                    $authuser = $this->authUser2($hash, $id);

                    if ($authuser === true) {

                        $model = new ShippingValue;
                        $model->title = $value;
                        $model->country_id = $countryId;
                        $model->user_id = $id;
                        if ($model->save(false)) {
                            $response['message'] = $this->MESSAGE_SUCCESS;
                        } else {
                            $this->responseWithMessage($this->MESSAGE_FAIL_EX);
                        }





                        echo json_encode($response, JSON_UNESCAPED_SLASHES);

//                echo '<pre>';
//                print_r($response);
//                echo '<pre>';
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

    public function ActionRemoveShippingItem() {
        try {
            $request = $this->parseRequest();
            if ($request != false) {
                $id = $request['userAuth']['id'];
                $hash = $request['userAuth']['hash'];
                $shipping_id = $request['id'];

                $user = User::model()->findByPk($id);
//                echo md5($user->id . "-" . $user->email . "-" . User::simple_decrypt($user->password));
//                die;
                if (count($user) == 1) {

                    $authuser = $this->authUser2($hash, $id);

                    if ($authuser === true) {
                        $shipping = ShippingValue::model()->findByPk($shipping_id);
                        //  print_r($shipping);die;
                        if ($shipping != null) {

                            $shipping->delete();

                            $response['message'] = $this->MESSAGE_SUCCESS;
                            // $item_arr_[]=$item_arr;
                        } else {
                            $response['message'] = $this->MESSAGE_ITEM_NOT_FOUND;
                        }



                        echo json_encode($response, JSON_UNESCAPED_SLASHES);

//                echo '<pre>';
//                print_r($response);
//                echo '<pre>';
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

    public function ActionListChatWithAdmin() {
        try {
            $request = $this->parseRequest();
//            print_r($request);die;
            if ($request != false) {
                $id = $request['userAuth']['id'];
                $hash = $request['userAuth']['hash'];
                $start = $request['start'];
                $end = $request['end'];

                $user = User::model()->findByPk($id);
//                echo md5($user->id . "-" . $user->email . "-" . User::simple_decrypt($user->password));
//                die;
                if (count($user) == 1) {

                    $authuser = $this->authUser2($hash, $id);

                    if ($authuser === true) {
                        $user_ = User::model()->findByPk($id);
                        $fullname = $user_->fname . ' ' . $user_->lname;
                        $chats = YiichatPost::model()->findAll(array("condition" => "owner = '$fullname'", 'limit' => $end, 'offset' => $start));
                        //  print_r($chats);die;
                        if ($chats != null) {

                            $response['message'] = $this->MESSAGE_SUCCESS;

                            $arr = array();
                            $arr_ = array();
                            foreach ($chats as $chat) {
                                $arr['id'] = intval($chat->id);
                                $arr['date'] = $this->stringVal(date('Y/m/d H:i:s', $chat->created));
                                $arr['username'] = $this->stringVal($chat->owner);
                                $arr['userMessage'] = $this->stringVal($chat->text);
                                $fullname = explode(' ', $chat->owner);
                                $fname = $fullname[0];
                                $lname = $fullname[1];
                                $user = User::model()->find("fname = '$fname' AND lname='$lname' ");
                                //print_r($user);die;
                                if ($user->groups_id == 1) {
                                    $arr['flag'] = 1;
                                } else {
                                    $arr['flag'] = 2;
                                }
                                $arr_[] = $arr;
                            }

                            $response['chats'] = $arr_;
                        }



                        echo json_encode($response, JSON_UNESCAPED_SLASHES);

//                echo '<pre>';
//                print_r($response);
//                echo '<pre>';
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

    public function ActionSendChat() {
        try {
            $request = $this->parseRequest();
//            print_r($request);die;
            if ($request != false) {
                $id = $request['userAuth']['id'];
                $hash = $request['userAuth']['hash'];
                $userMessage = $request['userMessage'];

                $user = User::model()->findByPk($id);
//                echo md5($user->id . "-" . $user->email . "-" . User::simple_decrypt($user->password));
//                die;
                if (count($user) == 1) {

                    $authuser = $this->authUser2($hash, $id);

                    if ($authuser === true) {
                        $user_ = User::model()->findByPk($id);
                        $fullname = $user_->fname . ' ' . $user_->lname;

                        $chat = new YiichatPost;
                        $chat->text = $userMessage;
                        $chat->owner = $fullname;
                        $chat->post_identity = $id;
                        $chat->chat_id = $id;
                        $chat->id = Helper::GenerateRandomKey(50);
                        $chat->save(false);

                        $response['message'] = $this->MESSAGE_SUCCESS;

                        echo json_encode($response, JSON_UNESCAPED_SLASHES);

//                echo '<pre>';
//                print_r($response);
//                echo '<pre>';
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

    public function ActionGetCountries() {
        try {
            $request = $this->parseRequest();

            // if ($request != false) {
//                $id = $request['userAuth']['id'];
//                $hash = $request['userAuth']['hash'];
            //  $user = User::model()->findByPk($id);
//                echo md5($user->id . "-" . $user->email . "-" . User::simple_decrypt($user->password));
//                die;
//                if (count($user) == 1) {
//                
//                    $authuser = $this->authUser2($hash, $id);
//                
//                    if ($authuser === true) {
            $countries = Country::model()->findAll();
            //print_r($countries);die;
            if ($countries != null) {

                $response['message'] = $this->MESSAGE_SUCCESS;

                $arr = array();
                $arr_ = array();
                foreach ($countries as $country) {

                    $arr['id'] = intval($country->id);
                    $arr['title'] = $this->stringVal($country->title);
                    $arr_[] = $arr;
                }

                $response['countries'] = $arr_;
            }



            echo json_encode($response, JSON_UNESCAPED_SLASHES);

//                echo '<pre>';
//                print_r($response);
//                echo '<pre>';
//            }else{
//                $this->responseWithMessage($this->MESSAGE_USER_NOT_FOUND);
//            }
//        }else{
//            $this->responseWithMessage($this->MESSAGE_USER_NOT_FOUND);
//        }
            // }
        } catch (Exception $ex) {
            $this->responseWithMessage($this->MESSAGE_FAIL_EX);
        }
    }

    public function ActionGetCities() {
        try {
            $request = $this->parseRequest();

            if ($request != false) {
                ///print_r($request);die;
                $countryId = $request['countryId'];
//                $hash = $request['userAuth']['hash'];
                //  $user = User::model()->findByPk($id);
//                echo md5($user->id . "-" . $user->email . "-" . User::simple_decrypt($user->password));
//                die;
//                if (count($user) == 1) {
//                
//                    $authuser = $this->authUser2($hash, $id);
//                
//                    if ($authuser === true) {
                $cities = City::model()->findAllByAttributes(array("country_id" => $countryId));
                // print_r($cities);die;

                $arr = array();
                $arr_ = array();
                if ($cities != null) {

                    $response['message'] = $this->MESSAGE_SUCCESS;

                    foreach ($cities as $city) {

                        $arr['id'] = intval($city->id);
                        $arr['title'] = $this->stringVal($city->title);
                        $arr_[] = $arr;
                    }

                    $response['cities'] = $arr_;
                    echo json_encode($response, JSON_UNESCAPED_SLASHES);
                } else {
                    $response['cities'] = $arr_;
                    echo json_encode($response, JSON_UNESCAPED_SLASHES);
                }





//                echo '<pre>';
//                print_r($response);
//                echo '<pre>';
//            }else{
//                $this->responseWithMessage($this->MESSAGE_USER_NOT_FOUND);
//            }
//        }else{
//            $this->responseWithMessage($this->MESSAGE_USER_NOT_FOUND);
//        }
            }
        } catch (Exception $ex) {
            $this->responseWithMessage($this->MESSAGE_FAIL_EX);
        }
    }

    public function ActionMakeBookingOrder() {
        try {
            $request = $this->parseRequest();
//            print_r($request);die;
            if ($request != false) {
                $id = $request['userAuth']['id'];
                $hash = $request['userAuth']['hash'];
                $product_id = $request['id'];
                $description = $request['description'];
                $date = $request['date'];

                $user = User::model()->findByPk($id);
//                echo md5($user->id . "-" . $user->email . "-" . User::simple_decrypt($user->password));
//                die;
                if (count($user) == 1) {

                    $authuser = $this->authUser2($hash, $id);

                    if ($authuser === true) {
                        $product = Product::model()->findByPk($product_id);
                        if (count($product) > 0) {

                            $message = new Message;
                            $message->title = 'Purchase product ' . $product->title;
                            $message->reciever_id = $product->user_id;
                            $message->sender_id = $id;
                            $message->message_date = date('Y-m-d', strtotime($date));
                            $message->details = $description;
                            $message->product_id = $product_id;
                            $message->save(false);

                            $response['message'] = $this->MESSAGE_SUCCESS;
                        } else {
                            $response['message'] = $this->MESSAGE_ITEM_NOT_FOUND;
                        }
                        echo json_encode($response, JSON_UNESCAPED_SLASHES);

//                echo '<pre>';
//                print_r($response);
//                echo '<pre>';
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

}

?>