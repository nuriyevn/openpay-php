<?php

namespace App\Controllers;

use \Core\View;
use \App\Config;


class Charge extends \Core\Controller
{
    public function indexAction()
    {
        View::renderTemplate("Charge/index.twig");
    }

    public function customer()
    {
        View::renderTemplate("Charge/customer.twig");
    }

    public function doCustomer()
    {
        $openpay = \Openpay::getInstance(Config::DB_ID, Config::DB_PRIVATE_KEY);

        $customer_id = $_REQUEST['customer_id'];

        $customer = array(
            'name' => 'Juan',
            'last_name' => 'Vazquez Juarez',
            'phone_number' => '4423456723',
            'email' => 'juan.vazquez@empresa.com.mx');

        $date_str = date("Y-m-d H:i:s");

        $chargeData = array(
            'source_id' => $_REQUEST['source_id'],
            'method' => $_REQUEST['method'],
            'amount' => $_REQUEST['amount'],
            'description' => $_REQUEST['description'] . $date_str,
            'order_id' => $date_str,
            'device_session_id' => $_REQUEST['device_session_id'],
            'customer' => $customer
        );

        $customer = $openpay->customers->get($customer_id);
        $charge = $openpay->charges->create($chargeData);

        View::renderTemplate("Charge/index.twig");
    }


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

    public function listAction()
    {
        View::renderTemplate("Charge/list.twig");
    }

    public function doListAction($start_date = '', $end_date = '' , $offset = 0, $limit = 5)
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
                'status' => $chargeList[$i]->status
            );

            array_push($charges, $charge);
        }


        View::renderTemplate("Charge/list.twig", array('charges' => $charges) );
    }

    public function createGlobalAction()
    {
        View::renderTemplate("Charge/createGlobal.twig");
    }

    public function doCreateGlobalAction()
    {
        $openpay = \Openpay::getInstance(Config::DB_ID, Config::DB_PRIVATE_KEY);

        $date_str = date("Y-m-d H:i:s");

        $chargeData = array(
            'source_id' => $_REQUEST['source_id'],
            'method' => "card",
            'amount' => $_REQUEST['amount'],
            'description' => $_REQUEST['description'] . $date_str,
            'order_id' => $date_str,
            'device_session_id' => $_REQUEST['device_session_id']
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

    public function getAction()
    {
        View::renderTemplate("Charge/get.twig");
    }

    public function doGetAction()
    {
        $openpay = \Openpay::getInstance(Config::DB_ID, Config::DB_PRIVATE_KEY);

        $transaction_id = $_REQUEST['transaction_id'];

        $charge = $openpay->charges->get($transaction_id);
        //var_dump($charge);

        View::renderTemplate("Charge/get.twig", array('charge' => $charge));
    }
}


?>