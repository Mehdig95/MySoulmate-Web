<?php

namespace StoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

class BoutiqueController extends Controller
{

    /**
     * @Route("/listBoutique",name="listBoutique")
     */
    public function listLogementAction(Request $request)
    {


        $em=$this->getDoctrine()->getManager();


        $Bou=$em->getRepository('AdminBundle:Boutique')->findAll();
        $paginator  = $this->get('knp_paginator');

        $result= $pagination = $paginator->paginate(
            $Bou, /* query NOT result */
            $request->query->getInt('page', 1)/*page number*/,
            $request->query->getInt('limit', 6)
        );


        return $this->render('StoreBundle:Boutique:Boutique.html.twig',
            array('Bou'=>$result));

    }
}
