<?php

namespace App\Controllers;

use \Core\View;


class Token extends \Core\Controller
{
    public function indexAction()
    {
        View::renderTemplate("Token/index.twig");
    }

    public function testAction()
    {
        View::renderTemplate("Token/test.twig");
    }
}

?>