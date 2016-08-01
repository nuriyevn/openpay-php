<?php

require_once "./credentials.php";
require_once "./vendor/autoload.php";

function addCustomer($name, $last_name, $email, $phone_number, $address)
{
	global $id;
	global $private_key;

	$openpay = Openpay::getInstance($id, $private_key);

//	$address = array('line1' => $line1, 'line2' => $line2, 'line3' => $line3,
//			'postal_code' => $postal_code, 'state' => $state, 'city' => $city,
//			'country_code' => $country_code);

	$customerData = array(
		'name' => $name,
		'last_name' => $last_name,
		'email' => $email,
		'phone_number' => $phone_number,
		'address' => $address);

	$customer = $openpay->customers->add($customerData);

	return $customer;

}

$pupkin_address = array(
	'line1' => $_REQUEST['line1'],
	'line2' => $_REQUEST['line2'],
	'line3' => $_REQUEST['line3'],
	'postal_code' => $_REQUEST['postal_code'],
	'state' => $_REQUEST['state'],
	'city' => $_REQUEST['city'],
	'country_code' => $_REQUEST['country_code']
);

addCustomer($_REQUEST['name'], $_REQUEST['last_name'], $_REQUEST['email'], $_REQUEST['phone_number'], $pupkin_address);

?>
