<?php

namespace App\Controllers;
use App\Config;
use Core\View;

class Customer extends \Core\Controller
{
    public function indexAction()
    {
        View::renderTemplate("Customer/index.twig");
    }
    
    public function addAction()
    {
        View::renderTemplate("Customer/add.twig");
    }

    public function doAddAction()
    {
        $openpay = \Openpay::getInstance(Config::DB_ID, Config::DB_PRIVATE_KEY);
        
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

        View::renderTemplate("Customer/index.twig");
    }
    

    public function deleteAction()
    {
        View::renderTemplate("Customer/delete.twig");
    }

    public function doDelete()
    {
        $id = $_REQUEST['id'];
        $openpay = \Openpay::getInstance(Config::DB_ID, Config::DB_PRIVATE_KEY);
        $customer = $openpay->customers->get($id);
        $customer->delete();
        View::renderTemplate("Customer/index.twig");
    }
    
    public function listAction()
    {
        View::renderTemplate("Customer/list.twig");
    }
    
    public function listAllAction()
    {
        $this->doListAction();
    }
    
    public function doListAction($start_date = '', $end_date = '', $offset = 0, $limit = 10 )
    {
        if (isset($_REQUEST['creation_lte']) AND
            isset($_REQUEST['creation_gte']) AND
            isset($_REQUEST['offset']) AND
            isset($_REQUEST['limit']))
        {
            $start_date = $_REQUEST['creation_gte'];
            $end_date = $_REQUEST['creation_lte'];
            $offset = $_REQUEST['offset'];
            $limit = $_REQUEST['limit'];
        }

        $openpay = \Openpay::getInstance(Config::DB_ID, Config::DB_PRIVATE_KEY);

        $findData = array(
            'creation[gte]' => $start_date,
            'creation[lte]' => $end_date,
            'offset' => $offset,
            'limit' => $limit
        );

        $customerList = $openpay->customers->getList($findData);

        $customers = [];

        for ($i = 0; $i < sizeof($customerList); $i++)
        {
            $customer =   array('name' => $customerList[$i]->name,
                                'last_name' => $customerList[$i]->last_name,
                                'phone_number' => $customerList[$i]->phone_number,
                                'id' => $customerList[$i]->id,
                                'creation_date' => $customerList[$i]->creation_date);
            array_push($customers, $customer);
        }

/*
        $customerCount = sizeof($customerList);
        echo "<a href='/customer/list'>Back</a><br>";
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
        }*/
        
        View::renderTemplate("Customer/list.twig", array('customers' => $customers));
    }

}