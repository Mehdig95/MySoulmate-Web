<?php

namespace RdvBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

class RdvController extends Controller
{

    /**
     * @Route("/listRdv",name="listRdv")
     */
    public function listRdvAction(Request $request)
    {


        $em=$this->getDoctrine()->getManager();


        $rdv=$em->getRepository('AdminBundle:Rdv')->findAll();
        $paginator  = $this->get('knp_paginator');

        $result= $pagination = $paginator->paginate(
            $rdv, /* query NOT result */
            $request->query->getInt('page', 1)/*page number*/,
            $request->query->getInt('limit', 6)
        );


        return $this->render('RdvBundle:Rdv:RdvList.html.twig',
            array('rdv'=>$result));

    }

    /**
     * @Route("/RdvDetail/{id}",name="RdvDetail")
     */
    public function RDVDetailAction($id)
    {

        $em=$this->getDoctrine()->getManager();

        $rdv = $em->getRepository('RdvBundle:Rdv')->findOneBy(array('id' => $id ));

        return $this->render('RdvBundle:Rdv:Rdvdetails.html.twig',array("rdv"=>$rdv,
            ));

    }
}
