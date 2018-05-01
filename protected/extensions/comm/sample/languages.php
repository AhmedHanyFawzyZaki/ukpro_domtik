<?php
//require dirname(__DIR__) . '/vendor/autoload.php';
require dirname(__DIR__) . '/lib/CROSCON/CommissionJunction/Client.php';
require dirname(__DIR__) . '/lib/CROSCON/CommissionJunction/Exception.php';

$api_key = "00913e47db74b3f06ed5e6fda2e5a21e248890b1dca770f6ee514d8bdcf5b7e6f17524646d13fd45d22f12aa4c9486d2e4b35f414deda958fdf0bba937fefbb861/7a059bf30859bfee2df0b137f0ba419ea9c8fe5485abc718b2df76587d6b322e737d4ec962f710ccfa594c7c50e53e7fb54ef297ba34b4ac18bc34227df93c4d";

$client = new CROSCON\CommissionJunction\Client($api_key);

try {
    var_export($client->supportLookup('languages'));
} catch (\CROSCON\CommissionJunction\Exception $e) {
    echo "!! ERROR: {$e->getMessage()}";
}

$parameters = array(
//    "authorization"=>'00913e47db74b3f06ed5e6fda2e5a21e248890b1dca770f6ee514d8bdcf5b7e6f17524646d13fd45d22f12aa4c9486d2e4b35f414deda958fdf0bba937fefbb861/7a059bf30859bfee2df0b137f0ba419ea9c8fe5485abc718b2df76587d6b322e737d4ec962f710ccfa594c7c50e53e7fb54ef297ba34b4ac18bc34227df93c4d',
    "website-id"=>7684083,
    "keywords"=>"GPS",
    "serviceable-area"=>"US"
);
echo '<pre>';
print_r($client->productSearch($parameters));
echo '<pre>';
echo "\n";