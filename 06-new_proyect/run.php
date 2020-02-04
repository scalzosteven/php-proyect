<?php
namespace Refactoring;
require 'vendor/autoload.php';


// define customer
$customer = new CustomerToTravel('Steven');
$city = 'Paris';
$price = new Price($city, 3);
$travel = new Travel($price, 3);

//$travel = new Travel(new Price($city, 2), 2);
$customer->addTravel($travel);
$s = $customer->getPrice($customer->_travels);

echo $s;
$db = new Travels\addTravelesToDb($price, $city);
$db->set($customer->getPrice($customer->_travels), $city);

$city = 'Roma';
$price = new Price($city, 1);
$travel = new Travel($price, 2);
$customer->addTravel($travel);
$db = new Travels\addTravelesToDb($price, $city);
$db->set($customer->getPrice($customer->_travels), $city);


// print the statement
echo $customer->statement();