<?php

namespace AdminBundle\Controller;


use AdminBundle\Entity\Produit;
use AdminBundle\Form\ProduitType;
use AdminBundle\Form\rechercheProduitForm;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;


class ProduitController extends Controller
{
    /**
     * @Route("/AddProduit",name="AddProduit")
     */
    public function ajouterProduitAction(Request $request)
    {
        $produit = new Produit();
        $form = $this->createForm(ProduitType::class, $produit);

        $form->handleRequest($request);
        if ($form->isSubmitted()) {

            $em = $this->getDoctrine()->getManager();
            $produit->uploadProfilePicture();

            $em->persist($produit);
            $em->flush();
            return $this->redirectToRoute("ShowProduit");

        }
        return $this->render("AdminBundle:Produit:ajouterproduit.html.twig",array(
            'form'=>$form->createView()
        ));

    }


    /**
     * @Route("/DeliteProduit/{id}",name="DeliteProduit")
     */
    public function supprimerProduitAction(Request $request , $id)
    {

        $em = $this->getDoctrine()->getManager();

        $produit=$em->getRepository("AdminBundle:Produit")->find($id);

        $em->remove($produit);
        $em->flush();

        return $this->redirectToRoute("ShowProduit");
    }
    /**
     * @Route("/EditProduit/{id}",name="EditProduit")
     */
    public function modifierProduitAction(Request $request , $id)
    {
        $em=$this->getDoctrine()->getManager();

        $produit=$em->getRepository("AdminBundle:Produit")->find($id);

        $form= $this->createForm(ProduitType::class,$produit);
        $form->handleRequest($request);

        if($form->isSubmitted())
        {



            $em->persist($produit);
            $em->flush();
            return $this->redirectToRoute("ShowProduit");
        }
        return $this->render("AdminBundle:Produit:modifierproduit.html.twig",array(
            'form'=>$form->createView()
        ));

    }


    /**
     * @Route("/ShowProduit",name="ShowProduit")
     */
public function rechercheProd(Request $request)
{
    $produit =new Produit();
    $em =$this->getDoctrine()->getManager();
    $produits=$em->getRepository('AdminBundle:Produit')->findAll();
    $Form=$this->createForm(rechercheProduitForm::class,$produit);
    $Form->handleRequest($request);
    if($request->isXmlHttpRequest())
    {
        $serializer = new Serializer(array(new ObjectNormalizer()));

        $produits=$em->getRepository('AdminBundle:Produit')->findProduitName($request->get('nom'));
        $data = $serializer->normalize($produits);

        return new JsonResponse($data);
    }
    return $this->render('AdminBundle:Produit:afficherproduit.html.twig',array('Form'=>$Form->createView(),'Prod'=>$produits));
}
}
