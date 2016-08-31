<?php

namespace App\Controllers;
use App\Config;


class Payout extends \Core\Controller
{
    public function indexAction()
    {
        \Core\View::renderTemplate("Payout/index.twig");
    }
    public function debitAction()
    {
        \Core\View::renderTemplate("Payout/debit.twig");
    }
    public function doDebitAction()
    {
        $openpay = \Openpay::getInstance(Config::DB_ID, Config::DB_PRIVATE_KEY);

        $method = "card";

        $card = $_REQUEST['card'];
        $amount = $_REQUEST['amount'];
        $order_id = date("Y-m-d H:i:s");
        $description = $_REQUEST['description'] . $order_id;

        $payoutData = array(
            'method' => $method,
            'destination_id' => $card,
            'amount' => $amount,
            'description' => $description,
            'order_id' => $order_id
        );

        $payout = $openpay->payouts->create($payoutData);

        var_dump($payout);
    }

    public function getdateAction()
    {
        $date_str = date("Y-m-d H:i:s");
        \Core\View::renderTemplate("Payout/getdate.twig", array("date" => $date_str));
    }


    public function payoutAction()
    {
        \Core\View::renderTemplate("Payout/payout.twig");
    }

    public function doPayoutAction()
    {
        $destination_id = $_REQUEST['destination_id'];
        $amount = $_REQUEST['amount'];
        $date_str = date("Y-m-d H:i:s");
        $description = $_REQUEST['description'] . " " . $date_str;
        $order_id = $date_str;
        $method = "card";

        $openpay = \Openpay::getInstance(Config::DB_ID, Config::DB_PRIVATE_KEY);

        $payoutData = array(
            'method' => $method,
            'destination_id' => $destination_id,
            'amount' => $amount,
            'description' => $description,
            'order_id' => $order_id
        );

        $payout = $openpay->payouts->create($payoutData);
    }


    public function getPayoutAction()
    {
        $openpay = \Openpay::getInstance(Config::DB_ID, Config::DB_PRIVATE_KEY);

        $creation_gte = $_REQUEST['creation_gte'];
        $creation_lte = $_REQUEST['creation_lte'];
        $offset = $_REQUEST['offset'];
        $limit = $_REQUEST['limit'];


        $findData = array(
            'creation[gte]' => $creation_gte,
            'creation[lte]' => $creation_lte,
            'offset' => $offset,
            'limit' =>  $limit
        );

        $payoutList = $openpay->payouts->getList($findData);
    }


}