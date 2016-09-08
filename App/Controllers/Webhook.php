<?php

namespace App\Controllers;
use \Core\View;

class Webhook extends \Core\Controller
{
    public function indexAction()
    {
        View::renderTemplate("Webhook/index.twig");
    }
    public function createAction()
    {
        View::renderTemplate("Webhook/create.twig");
    }


    public function doCreateAction()
    {
        $openpay = \Openpay::getInstance(\App\Config::DB_ID, \App\Config::DB_PRIVATE_KEY);

        $webhookDate = array(
            'url' => 'http://requestb.in/1dh1txz1',
            'user' => 'nusik',
            'password' => 'passnusik',
            'event_types' => array( "payout.created",
                                    "payout.succeeded",
                                    "payout.failed")
        );

       // $openpay->

        View::renderTemplate("Webhook/create.twig");
    }


    public function getAction()
    {
        View::renderTemplate("Webhook/get.twig");
    }

    public function doGetAction()
    {
        $url = $_REQUEST["url"];

        $result = file_get_contents($url);
        var_dump($result);


        View::renderTemplate("Webhook/get.twig", array('result' => $result));

    }
}

?>