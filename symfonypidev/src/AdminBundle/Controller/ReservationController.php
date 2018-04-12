<?php

namespace AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class ReservationController extends Controller
{

    /**
     * @Route("/ShowReservation",name="ShowReservation")
     */
    public function afficherReservationAction()
    {
        $em=$this->getDoctrine()->getManager();

        $rdvs = $em->getRepository('AdminBundle:Reservation')->findAll();

        return $this->render("AdminBundle:Reservation:afficherreservation.html.twig",array(
            'rdvs'=>$rdvs
        ));

    }
}
