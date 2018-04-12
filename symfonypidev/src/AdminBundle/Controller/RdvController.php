<?php

namespace AdminBundle\Controller;

use AdminBundle\Entity\Rdv;
use AdminBundle\Form\RdvType;
use AdminBundle\Form\rechercheRdvForm;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;


class RdvController extends Controller

{
    /**
     * @Route("/addRdv",name="addRdv")
     */
    public function ajouterRdvAction(Request $request)
    {
        $rdv = new Rdv();
        $form = $this->createForm(RdvType::class, $rdv);

        $form->handleRequest($request);
        if ($form->isSubmitted()) {

            $em = $this->getDoctrine()->getManager();
            $rdv->uploadProfilePicture();

            $em->persist($rdv);
            $em->flush();
            return $this->redirect($this->generateUrl('ShowRdv',array('msg'=>"add successful")));

        }
        return $this->render("AdminBundle:Rdv:ajouterRdv.html.twig",array(
            'form'=>$form->createView()
        ));

    }


    /**
     * @Route("/ShowRdv",name="ShowRdv")
     */

    public function rechercheRdv(Request $request)
    {
        $produit =new Rdv();
        $em =$this->getDoctrine()->getManager();
        $produits=$em->getRepository('AdminBundle:Rdv')->findAll();
        $Form=$this->createForm(rechercheRdvForm::class,$produit);
        $Form->handleRequest($request);
        if($request->isXmlHttpRequest())
        {
            $serializer = new Serializer(array(new ObjectNormalizer()));

            $produits=$em->getRepository('AdminBundle:Rdv')->findBynomrdv($request->get('nomrdv'));
            $data = $serializer->normalize($produits);


            return new JsonResponse($data);
        }
        return $this->render('AdminBundle:Rdv:afficherRdv.html.twig',array('Form'=>$Form->createView(),'rdvs'=>$produits));
    }
    /**
     * @Route("/deleteRdv/{id}",name="deleteRdv")
     */
    public function supprimerRdvAction(Request $request , $id)
    {

        $em = $this->getDoctrine()->getManager();

        $rdv=$em->getRepository("AdminBundle:Rdv")->find($id);

        $em->remove($rdv);
        $em->flush();

        return $this->redirectToRoute("ShowRdv");
    }

    /**
     * @Route("/ModifierRdv/{id}",name="ModifierRdv")
     */
    public function modifierRdvAction(Request $request , $id)
    {
        $em=$this->getDoctrine()->getManager();

        $rdv=$em->getRepository("AdminBundle:Rdv")->find($id);

        $form= $this->createForm(RdvType::class,$rdv);
        $form->handleRequest($request);

        if($form->isSubmitted())
        {



            $em->persist($rdv);
            $em->flush();
            return $this->redirectToRoute("ShowRdv");
        }
        return $this->render("AdminBundle:Rdv:modiferRdv.html.twig",array(
            'form'=>$form->createView()
        ));

    }
}
