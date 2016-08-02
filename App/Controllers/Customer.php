<?php


namespace App\Controllers;
use App\Config;
use Core\View;

class Customer extends \Core\Controller
{
    public function indexAction()
    {
        View::renderTemplate("Customer/addcustomer.html");
    }

    public function addAction()
    {
        $openpay = Openpay::getInstance(Config::DB_ID, Config::DB_PRIVATE_KEY);

//	$address = array('line1' => $line1, 'line2' => $line2, 'line3' => $line3,
//			'postal_code' => $postal_code, 'state' => $state, 'city' => $city,
//			'country_code' => $country_code);

        $name = $_REQUEST['name'];
        $last_name = $_REQUEST['last_name'];
        $email = $_REQUEST['email'];
        $phone_number = $_REQUEST['phone_number'];

        $customer_address = array(
            'line1' => $_REQUEST['line1'],
            'line2' => $_REQUEST['line2'],
            'line3' => $_REQUEST['line3'],
            'postal_code' => $_REQUEST['postal_code'],
            'state' => $_REQUEST['state'],
            'city' => $_REQUEST['city'],
            'country_code' => $_REQUEST['country_code']
        );

        $customerData = array(
            'name' => $name,
            'last_name' => $last_name,
            'email' => $email,
            'phone_number' => $phone_number,
            'address' => $customer_address);

        
        $customer = $openpay->customers->add($customerData);

        return $customer;
    }
}