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

        $customer = $openpay->customers->get($_REQUEST['customer_id']);
        $card = $customer->cards->add($cardData);

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

        if (isset($_REQUEST['customer_id']))
        {
            $customer = $openpay->customers->get($_REQUEST['customer_id']);
            $cardList = $customer->cards->getList($findData);
        }
        else
        {
            $cardList = $openpay->cards->getList($findData);
        }

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
                'expiration_month' => $cardList[$i]->expiration_month,
                'creation_date' => $cardList[$i]->creation_date,
                'customer_id' => $cardList[$i]->customer_id,
                'bank_name' => $cardList[$i]->bank_name);

            array_push($cards, $card);
        }
        View::renderTemplate("Card/list.twig", array('cards' => $cards));
    }

    public function deleteAction()
    {
        View::renderTemplate("Card/delete.twig");
    }
    
    public function doDeleteAction()
    {
        
        $openpay = \Openpay::getInstance(Config::DB_ID, Config::DB_PRIVATE_KEY);
        $id = $_REQUEST['id'];
        $card = $openpay->cards->get($id);
        $card->delete();
        View::renderTemplate("Card/index.twig");
    }

    public function getCardAction()
    {
        
    }
}