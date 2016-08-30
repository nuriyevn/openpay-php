<?php

namespace App\Controllers;

use \Core\View;


class Token extends \Core\Controller
{
    public function indexAction()
    {
        View::renderTemplate("Token/index.twig");
    }

    public function sessionIdAction()
    {
        View::renderTemplate("Token/sessionId.twig");
    }

    public function createCardTokenAction()
    {
        View::renderTemplate("Token/createCardToken.twig");
    }

    public function getCardTokenAction()
    {
        View::renderTemplate("Token/getCardToken.twig");
    }

    // Javascipt is responsible for creation of card token
    /*public function doCreateCardAction()
    {
        View::renderTemplate("Token/createCard.twig");
    }*/
}

?>