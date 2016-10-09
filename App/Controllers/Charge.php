<?php

namespace App\Controllers;

use \Core\View;
use \App\Config;


/*
 * It's possible to create a charge with customer and without customer charge
 * First, let's have a look on customer charge.
 *
 * To create a customer charge provide customer_id from Customer List and also create tokenized card.
 * We have to use JS library to create tokenObject using Openpay.token.create
 * Specify, customer_id, card_id (tokenized) in order to create a new charge
 * And then all charges of the customer are available via:
 * $customer =  $openpay->customers->get($customer_id);
 * $chargeList = $customer->charges->getList($findData);
 *
 * Notice, that tokenized source id is valid for a single charge, you can't use it twice
 *
 * Second, customerless charge, pseudoglobal.
 * Actually, charges without customer is impossible and quite meaningless,
 * What we are achieving here is that, we can create a charge WITHOUT creating customer_id
 * So, in both cases the customer information is passed to the server.
 * In second case for customer object we need to provide
 * [name, last_name, phone_number, email] fields
 * Also we can use tokenized card id, or untokenized card is from card list, however in first case,
 * we have to provide tokenized one
 *
 * Same thing applies when you want to retrieve Charge Info
 * If you have customer charge , you need to specify two params: customer_id and transaction_id(charge_id) of arbitrary
 * charge.
 * If you have a global (without customer id) then you need to pass just transaction id.
 *
 */

class Charge extends \Core\Controller
{
    public function indexAction()
    {
        View::renderTemplate("Charge/index.twig");
    }

   /* public function customer()
    {
        View::renderTemplate("Charge/customer.twig");
    }

    public function doCustomer()
    {
        $openpay = \Openpay::getInstance(Config::DB_ID, Config::DB_PRIVATE_KEY);

        //$customer_id = $_REQUEST['customer_id'];

        $customer = array(
            'name' => 'Juan'
            //'last_name' => 'Vazquez Juarez',
            //'phone_number' => '4423456723',
            //'email' => 'juan.vazquez@empresa.com.mx'
        );

        $date_str = date("Y-m-d H:i:s");

        $chargeData = array(
            'source_id' => $_REQUEST['source_id'],
            'method' => 'card',
            'amount' => $_REQUEST['amount'],
            'description' => $_REQUEST['description'] . $date_str,
            'order_id' => $date_str,
            'device_session_id' => $_REQUEST['device_session_id'],
            'customer' => $customer
        );

        //$customer = $openpay->customers->get($customer_id);

        $charge = $openpay->charges->create($chargeData);

        View::renderTemplate("Charge/index.twig");
    }
   */


    public function merchant()
    {

    }

    public function doMerchant()
    {
        $openpay = Openpay::getInstance('moiep6umtcnanql3jrxp', 'sk_3433941e467c1055b178ce26348b0fac');

        $chargeData = array(
            'method' => 'card',
            'source_id' => 'krfkkmbvdk3hewatruem',
            'amount' => 100,
            'description' => 'Cargo inicial a mi merchant',
            'order_id' => 'ORDEN-00071');

        $charge = $openpay->charges->create($chargeData);
    }

    public function listChargesOfCustomerAction()
    {
        View::renderTemplate("Charge/listChargesOfCustomer.twig");
    }

    public function doListChargesOfCustomerAction($start_date = '', $end_date = '' , $offset = 0, $limit = 5)
    {
        $openpay = \Openpay::getInstance(Config::DB_ID, Config::DB_PRIVATE_KEY);

        $customer_id = $_REQUEST['customer_id'];

        if (isset($_REQUEST['creation_gte']) AND
            isset($_REQUEST['creation_lte']) AND
            isset($_REQUEST['offset']) AND
            isset($_REQUEST['limit']))
        {
            $start_date = $_REQUEST['creation_gte'];
            $end_date = $_REQUEST['creation_lte'];
            $offset = $_REQUEST['offset'];
            $limit = $_REQUEST['limit'];
        }

        $findData = array(
            'creation[gte]' => $start_date,
            'creation[lte]' => $end_date,
            'offset' => $offset,
            'limit' => $limit        );

        $customer =  $openpay->customers->get($customer_id);
        $chargeList = $customer->charges->getList($findData);

        $charges = [];

        for ($i = 0; $i < sizeof($chargeList);  $i++)
        {
            $charge = array(
                'customer_id' => $customer_id,
                'id' => $chargeList[$i]->id,
                'method' => $chargeList[$i]->method,
                'amount' => $chargeList[$i]->amount,
                'description' => $chargeList[$i]->description,
                'status' => $chargeList[$i]->status,
               // 'transaction_id' =>$chargeList[$i]->transaction_id
            );

            array_push($charges, $charge);
        }


        View::renderTemplate("Charge/listChargesOfCustomer.twig", array('charges' => $charges) );
    }

    public function createGlobalAction()
    {
        View::renderTemplate("Charge/createGlobal.twig");
    }

    public function doCreateGlobalAction()
    {
        $openpay = \Openpay::getInstance(Config::DB_ID, Config::DB_PRIVATE_KEY);

        $date_str = date("Y-m-d H:i:s");


        $customer = array(
            'name' => 'Juan',
            'last_name' => 'Vazquez Juarez',
            'phone_number' => '4423456723',
            'email' => 'juan.vazquez@empresa.com.mx');


        $chargeData = array(
            'source_id' => $_REQUEST['source_id'],
            'method' => "card",
            'amount' => $_REQUEST['amount'],
            'description' => $_REQUEST['description'] . $date_str,
            'order_id' => $date_str,
            'device_session_id' => $_REQUEST['device_session_id'],
            'customer' => $customer
        );

        $charge = $openpay->charges->create($chargeData);
        View::renderTemplate("Charge/index.twig");
    }

    public function listGlobalAction()
    {
        View::renderTemplate("Charge/listGlobal.twig");
    }

    public function doListGlobalAction($start_date = '', $end_date = '', $offset = 0, $limit = 5)
    {
        $openpay = \Openpay::getInstance(Config::DB_ID, Config::DB_PRIVATE_KEY);

        if (isset($_REQUEST['creation_gte']) AND
            isset($_REQUEST['creation_lte']) AND
            isset($_REQUEST['offset']) AND
            isset($_REQUEST['limit']))
        {
            $start_date = $_REQUEST['creation_gte'];
            $end_date = $_REQUEST['creation_lte'];
            $offset = $_REQUEST['offset'];
            $limit = $_REQUEST['limit'];
        }

        $findData = array(
            'creation[gte]' => $start_date,
            'creation[lte]' => $end_date,
            'offset' => $offset,
            'limit' => $limit,
        );

        $chargeList = $openpay->charges->getList($findData);

        $charges = [];

        for ($i = 0; $i < sizeof($chargeList); $i++)
        {
            $charge = array(
                'id' => $chargeList[$i]->id,
                'method' => $chargeList[$i]->method,
                'amount' => $chargeList[$i]->amount,
                'description' => $chargeList[$i]->description,
                'status' => $chargeList[$i]->status
            );
            array_push($charges, $charge);
        }

        View::renderTemplate("Charge/listGlobal.twig", array('charges' => $charges));
    }

    public function createTerminalAction()
    {
        View::renderTemplate("Charge/terminal.twig");
    }
    
    public function doCreateTerminalAction()
    {
        $name = $_REQUEST['name'];
        $last_name = $_REQUEST['last_name'];
        $phone_nubmer = $_REQUEST['phone_number'];
        $email = $_REQUEST['email'];
        $amount = $_REQUEST['amount'];
        $description = $_REQUEST['description'];
        $redirect_url = $_REQUEST['redirect_url'];


        $openpay = \Openpay::getInstance(Config::DB_ID, Config::DB_PRIVATE_KEY);
        $customer = array(
            'name' => $name,
            'last_name' => $last_name,
            'phone_number' => $phone_nubmer,
            'email' => $email
        );


        $chargeRequest = array(
            "method" => "card",
            "amount" => $amount,
            'description' => $description,
            'customer' => $customer,
            'send_email' => false,
            'confirm' => false,
            'redirect_url' => $redirect_url
        );
        $charge = $openpay->charges->create($chargeRequest);
        var_dump($charge);
        View::renderTemplate("Charge/terminal.twig", array('charge' => $charge));
        
    }


    public function createChargeAsCustomerAction()
    {
        View::renderTemplate("Charge/createChargeAsCustomer.twig");
    }

    public function doCreateChargeAsCustomerAction()
    {
        $openpay = \Openpay::getInstance(Config::DB_ID, Config::DB_PRIVATE_KEY);

        $customer_id = $_REQUEST['customer_id'];

        $customer = $openpay->customers->get($customer_id);

        $date_str = date("Y-m-d H:i:s");

        $chargeData = array(
            'source_id' => $_REQUEST['source_id'],
            'method' => 'card',
            'amount' => $_REQUEST['amount'],
            'description' => 'Create charge As customer ' . $date_str,
            'order_id' => $date_str,
            'device_session_id' => $_REQUEST['device_session_id']);

        $charge = $customer->charges->create($chargeData);

    }

    public function getGlobalAction()
    {
        View::renderTemplate("Charge/getGlobal.twig");
    }

    public function doGetGlobalAction()
    {
        $openpay = \Openpay::getInstance(Config::DB_ID, Config::DB_PRIVATE_KEY);

        $transaction_id = $_REQUEST['transaction_id'];

        $charge = $openpay->charges->get($transaction_id);

        var_dump($charge->card->holder_name);

        View::renderTemplate("Charge/getGlobal.twig", array('charge' => $charge->data));
    }

    public function getChargeFromCustomerAction()
    {
        View::renderTemplate("Charge/getChargeFromCustomer.twig");
    }

    public function doGetChargeFromCustomerAction()
    {
        $openpay = \Openpay::getInstance(Config::DB_ID, Config::DB_PRIVATE_KEY);
        $transaction_id = $_REQUEST['transaction_id'];
        $customer_id = $_REQUEST['customer_id'];

        $customer = $openpay->customers->get($customer_id);

        $charge = $customer->charges->get($transaction_id);

        var_dump($charge->card->holder_name);
        View::renderTemplate("Charge/getChargeFromCustomer.twig");
    }
}


?>