<?php
$this->breadcrumbs = array(
    'Settings' => array('index'),
    $model->id,
);

$this->menu = array(
    array('label' => 'List Settings', 'url' => array('index')),
);
?>

<h1>View Settings</h1>

<?php
$this->widget('bootstrap.widgets.TbDetailView', array(
    'data' => $model,
    'attributes' => array(
        'facebook',
        'google',
        'twitter',
        'pinterest',
        'email',
        
        /*
          'press_email',
          'support_email',
          'blog_email',
         */

        /*
          'temp1',
          'temp2',
          'temp3',
          'temp4',
         */
        'paypal_email',
        'api_username',
        'api_password',
        'signature',
        'appid',
        /*
          'paypal_fee',
          'paypalextra_fee',
          'site_commession',
         */
        'phone',
        'mobile',
        'fax',
        'address',
        'exclusive_app',
        'instgram_app',
        
        'api_key',
        'ts_code',
        
        'aws_api_key'
        ,'aws_api_secret_key'
        ,'aws_associate_tag',
        'affiliate_window_key',
        'junction_key',
        'junction_website_id',
        'trade_doubler_key',
        'zanox_connect_id',
        'zanox_secret_key'
    ),
));
?>
