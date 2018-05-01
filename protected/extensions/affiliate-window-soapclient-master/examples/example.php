<?php
require '/var/www/affiliate-window-soapclient-master/library/AffiliateWindow/ProductServeSoapClient.php';
$awPsClient = new \AffiliateWindow\ProductServeSoapClient('29284adbf57856c55360c15d0d5d98c2');
$response = $awPsClient->getProductList(array(
    'sQuery' => 'IPhone 4',
    'iLimit' => 10
));

//$response = $awPsClient->getCategory(array(
//    'iCategoryId' => '173',
//   
//));

echo '<pre>';
$output= '';
$output.= $awPsClient->__getLastRequest();
$output.= $awPsClient->__getLastResponse();
$output= str_replace('><', ">\n<", $output);
print $output;
print_r($response);
echo '</pre>';
