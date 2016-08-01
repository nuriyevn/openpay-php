<?php

require_once "./vendor/autoload.php";
require_once "./credentials.php";

function deleteCustomer($customer_id)
{
    global $id;
    global $private_key;

    $openpay = Openpay::getInstance($id, $private_key);

    $customer = $openpay->customers->get($customer_id);
    $customer->delete();
}

?>