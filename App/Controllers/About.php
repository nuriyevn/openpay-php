<?php

namespace App\Controllers;

use \Core\View;

class About extends \Core\Controller
{
    public function indexAction()
    {
        View::renderTemplate('About/index.html');
    }


}
