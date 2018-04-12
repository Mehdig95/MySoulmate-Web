<?php

namespace StoreBundle\Controller;

use StoreBundle\Form\NoterType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

class ProduitController extends Controller
{
    /**
     * @Route("/listProduit",name="listProduit")
     */
    public function listProduitAction(Request $request)
    {


        $em=$this->getDoctrine()->getManager();


        $p=$em->getRepository('AdminBundle:Produit')->findAll();
        $paginator  = $this->get('knp_paginator');

        $result= $pagination = $paginator->paginate(
            $p, /* query NOT result */
            $request->query->getInt('page', 1)/*page number*/,
            $request->query->getInt('limit', 6)
        );


        return $this->render('StoreBundle:Produit:ProduitList.html.twig',
            array('Prod'=>$result));

    }

    /**
     * @Route("/ProduitDetail/{id}",name="ProduitDetail")
     */
    public function ProduitDetailAction(Request $request,$id)
    {

        $em=$this->getDoctrine()->getManager();

        $prod = $em->getRepository('StoreBundle:Produit')->findOneBy(array('id' => $id ));
        $produit=$em->getRepository("StoreBundle:Produit")->find($id);

        $form= $this->createForm(NoterType::class,$produit);
        $form->handleRequest($request);

        if($form->isSubmitted())
        {



            $em->persist($produit);
            $em->flush();
            return $this->redirectToRoute("listProduit");
        }

        return $this->render('StoreBundle:Produit:Proddetails.html.twig',array(
            "Prod"=>$prod,
            'form'=>$form->createView()
        ));

    }



}
