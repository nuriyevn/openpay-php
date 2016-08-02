<?php


namespace App\Controllers;


use App\Config;
use Core\View;

class Card extends \Core\Controller
{
    public function indexAction()
    {
        \Core\View::renderTemplate("Card/index.twig");
    }
    public function addAction()
    {
        \Core\View::renderTemplate("Card/add.twig");
    }

    public function doAddAction()
    {
        $openpay = \Openpay::getInstance(\App\Config::DB_ID, \App\Config::DB_PRIVATE_KEY);

        $cardAddress = array(
            'line1' => $_REQUEST['line1'],
            'line2' => $_REQUEST['line2'],
            'line3' => $_REQUEST['line3'],
            'postal_code' => $_REQUEST['postal_code'],
            'state' => $_REQUEST['state'],
            'city' => $_REQUEST['city'],
            'country_code' => $_REQUEST['country_code']
        );

        $cardData = array(
                'holder_name' => $_REQUEST['holder_name'],
                'card_number' => $_REQUEST['card_number'],
                'cvv2' => $_REQUEST['cvv2'],
                'expiration_month' => $_REQUEST['expiration_month'],
                'expiration_year' => $_REQUEST['expiration_year'],
                'address' => $cardAddress);

        $card = $openpay->cards->add($cardData);

        View::renderTemplate("Card/index.twig");
    }

    public function listAction()
    {
        View::renderTemplate("Card/list.twig");
    }

    public function listAllAction()
    {
        $this->doListAction();
    }

    public function doListAction($start_date = '', $end_date = '', $offset = 0, $limit = 5)
    {
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

        $openpay = \Openpay::getInstance(Config::DB_ID, Config::DB_PRIVATE_KEY);

        $findData = array(
            'creation[gte]' => $start_date,
            'creation[lte]' => $end_date,
            'offset' => $offset,
            'limit' => $limit
        );

        $cardList = $openpay->cards->getList($findData);

        var_export($cardList);

        $cards = [];

        for ($i = 0; $i < sizeof($cardList); $i++)
        {
            $card = array(
                'id' => $cardList[$i]->id,
                'type' => $cardList[$i]->type,
                'brand' => $cardList[$i]->brand,
                'card_number' => $cardList[$i]->card_number,
                'holder_name' => $cardList[$i]->holder_name,
                'expiration_year' => $cardList[$i]->expiration_year,
                'expiration_month' => $cardList[$i]->expiration_month);

            array_push($cards, $card);
        }
        View::renderTemplate("Card/list.twig", array('cards' => $cards));

    }

    public function testAction()
    {
        $openpay = \Openpay::getInstance(Config::DB_ID, Config::DB_PRIVATE_KEY);

        $findData = array(
            'creation[gte]' => '2013-01-01',
            'creation[lte]' => '2017-12-31',
            'offset' => 0,
            'limit' => 5);

        $cardList = $openpay->cards->getList($findData);
        var_export($cardList);
    }
}