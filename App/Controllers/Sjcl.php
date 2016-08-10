<?php
namespace App\Controllers;




class Sjcl extends \Core\Controller
{
    public function indexAction()
    {
        \Core\View::renderTemplate("Sjcl/index.twig");
    }

    public function generateVectorAction()
    {

    }
}

?>