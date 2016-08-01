<?php

require_once "./credentials.php";
require_once "./vendor/autoload.php";

function getCustomerList($start_date, $end_date, $offset, $limit)
{
    global $id;
    global $private_key;
    $openpay = Openpay::getInstance($id, $private_key);

    /*$findData = array(
        'creation[gte]' => '2015-01-01',
        'creation[lte]' => '2017-01-01',
        'offset' => 0,
        'limit' => 10);*/

    $findData = array(
        'creation[gte]' => $start_date,
        'creation[lte]' => $end_date,
        'offset' => $offset,
        'limit' => $limit
    );

    $customerList = $openpay->customers->getList($findData);

    $customerCount = sizeof($customerList);
    echo "<a href='/getCustomerList.html'>Back</a><br>";
    echo "Customer count = $customerCount<br>";

    for ($i = 0; $i < $customerCount; $i++)
    {
        $customer = $customerList[$i];


        echo "Customer $i:<br>";

        printf('Id: %s<br>Creation date: %s<br>Name: %s<br>Last name: %s<br>Phone number: %s<br>',
            $customer->id, $customer->creation_date, $customer->name, $customer->last_name, $customer->phone_number);

        printf('Address Info.<br>');

        $address = $customer->address;

        printf('Line1: %s<br>Line2: %s<br>Line3: %s<br>Postal code: %s<br>State: %s<br>City: %s<br>Country code: %s<br>',
            $address>line1, $address->line2, $address->line3, $address->postal_code, $address->state, $address->city, $address->country_code);

        echo "<br><br>";
    }
}


getCustomerList($_REQUEST['creation_gte'], $_REQUEST['creation_lte'], $_REQUEST['offset'], $_REQUEST['limit']);


?>