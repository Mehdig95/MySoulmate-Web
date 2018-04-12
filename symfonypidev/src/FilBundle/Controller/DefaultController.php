<?php

namespace FilBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class DefaultController extends Controller
{
    /**
     * @Route("/ab")
     */
    public function indexAction()
    {
        return $this->render('FilBundle:Default:index.html.twig');
    }
}
