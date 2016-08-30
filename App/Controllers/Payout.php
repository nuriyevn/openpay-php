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
}