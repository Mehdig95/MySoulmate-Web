<?php

namespace StoreBundle\Controller;

use StoreBundle\Entity\Commande;
use StoreBundle\Form\CommandeType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

class CommandeController extends Controller
{
    /**
     * @Route("/addCommm/{idR}",name="addCommm")
     */
    public function addCommandeAction(Request $request, $idR)
    {
        $user = $this->getUser();
        if (!is_object($user)) {

            return $this->redirectToRoute('fos_user_security_login');
        }
        $id = $this->getUser()->getId();

        $commande = new Commande();
        $em = $this->getDoctrine()->getManager();
        $profile = $em->getRepository('StoreBundle:Client')->findOneBy(array('id_user' => $id));
        $Comm = $em->getRepository('StoreBundle:Produit')->findOneBy(array('id' => $idR));


        $form = $this->createForm(CommandeType::class, $commande);


        $form->handleRequest($request);

        if ($form->isSubmitted()) {

            $commande->setIdguser($profile);
            $commande->setIdprod($Comm);
            $em->persist($commande);
            $em->flush();
            return $this->redirect($this->generateUrl('profilehomme', array('msg' => "add successful")));
        }
        return $this->render('RdvBundle:Commande:addcommande.html.twig', array(
            'form' => $form->createView(),
            'profile' => $profile,
            'Rdv'=>$commande
        ));
    }


}
