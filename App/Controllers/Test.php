<?php

namespace App\Controllers;

class Test extends \Core\Controller
{

    public function indexAction()
    {
        \Core\View::renderTemplate("Test/index.twig");
    }

    public function dumpAction()
    {
        $data = array('name' => 'Nusrat', 'age' => 26);

        \Core\View::renderTemplate('Test/dump.twig', array('data' => $data));
    }
};


?>