<?php

namespace AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AdminBundle\Entity\Boutique;
use AdminBundle\Form\BoutiqueType;
use Symfony\Component\HttpFoundation\Request;

class BoutiqueController extends Controller
{


    /**
     * @Route("/addBoutique",name="addBoutique")
     */
    public function ajouterBoutiqueAction(Request $request)
    {
        $boutique = new Boutique();
        $form = $this->createForm(BoutiqueType::class, $boutique);

        $form->handleRequest($request);
        if ($form->isSubmitted()) {

            $em = $this->getDoctrine()->getManager();
            $boutique->uploadProfilePicture();

            $em->persist($boutique);
            $em->flush();

            return $this->redirectToRoute("ShowBoutique");
        }
        return $this->render("AdminBundle:Boutique:ajouterboutique.html.twig",array(
            'form'=>$form->createView()
        ));

    }


    /**
     * @Route("/ShowBoutique",name="ShowBoutique")
     */

    public function afficherBoutiqueAction()
    {
        $em=$this->getDoctrine()->getManager();

        $boutiques = $em->getRepository(Boutique::class)->findAll();

        return $this->render("AdminBundle:Boutique:AfficherBoutique.html.twig",array(
            'boutiques'=>$boutiques
        ));

    }
    /**
     * @Route("/DeliteBoutique/{id}",name="DeliteBoutique")
     */
    public function supprimerBoutiqueAction(Request $request , $id)
    {

        $em = $this->getDoctrine()->getManager();

        $boutique=$em->getRepository("AdminBundle:Boutique")->find($id);

        $em->remove($boutique);
        $em->flush();

        return $this->redirectToRoute("ShowBoutique");
    }


    /**
     * @Route("/EditBoutique/{id}",name="EditBoutique")
     */
    public function modifierBoutiqueAction(Request $request , $id)
    {
        $em=$this->getDoctrine()->getManager();

        $boutique=$em->getRepository("AdminBundle:Boutique")->find($id);

        $form= $this->createForm(BoutiqueType::class,$boutique);
        $form->handleRequest($request);

        if($form->isSubmitted())
        {



            $em->persist($boutique);
            $em->flush();
            return $this->redirectToRoute("ShowBoutique");
        }
        return $this->render("AdminBundle:Boutique:ModiferBoutique.html.twig",array(
            'form'=>$form->createView()
        ));

    }
}
