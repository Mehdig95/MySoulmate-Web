<?php

namespace RdvBundle\Controller;

use RdvBundle\Entity\Reservation;
use RdvBundle\Form\ReservationType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

class ReservationController extends Controller
{
    /**
     * @Route("/addreservation/{idR}",name="addreservation")
     */
    public function addreservationAction(Request $request, $idR)
    {
        $user = $this->getUser();
        if (!is_object($user)) {

            return $this->redirectToRoute('fos_user_security_login');
        }
        $id = $this->getUser()->getId();

        $reservation = new Reservation();
        $em = $this->getDoctrine()->getManager();
        $profile = $em->getRepository('RdvBundle:Client')->findOneBy(array('id_user' => $id));
        $Rdv = $em->getRepository('RdvBundle:Rdv')->findOneBy(array('id' => $idR));


        $form = $this->createForm(ReservationType::class, $reservation);


        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            $Rdv->setNbrplacedispo($Rdv->getNbrplacedispo() - $reservation->getNbrplacereserver());
            $reservation->setIdguser($profile);
            $reservation->setIdreservationrdv($Rdv);
            $em->persist($reservation);
            $em->flush();
            return $this->redirect($this->generateUrl('listRes', array('msg' => "add successful")));
        }
        return $this->render('RdvBundle:Reservation:addreservation.html.twig', array(
            'form' => $form->createView(),
            'profile' => $profile,
            'Rdv'=>$Rdv
        ));
    }

    /**
     * @Route("/listRes",name="listRes")
     */
    public function afficherReservationAction()
    {
        $em=$this->getDoctrine()->getManager();

        $rdvs = $em->getRepository('RdvBundle:Reservation')->findAll();

        return $this->render("RdvBundle:Reservation:ShowRes.html.twig",array(
            'rdvs'=>$rdvs
        ));

    }
}
