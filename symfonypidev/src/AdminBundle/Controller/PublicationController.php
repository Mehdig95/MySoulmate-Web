<?php

namespace AdminBundle\Controller;


use AdminBundle\Entity\Publication;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AdminBundle\Form\recherchePubForm;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class PublicationController extends Controller
{


    /**
     * @Route("/ShowPublication",name="ShowPublication")
     */
    public function rechercheProd(Request $request)
    {
        $produit =new Publication();
        $em =$this->getDoctrine()->getManager();
        $produits=$em->getRepository('AdminBundle:Publication')->findAll();
        $Form=$this->createForm(recherchePubForm::class,$produit);
        $Form->handleRequest($request);
        if($request->isXmlHttpRequest())
        {
            $serializer = new Serializer(array(new ObjectNormalizer()));

            $produits=$em->getRepository('AdminBundle:Publication')->findPubByText($request->get('text'));
            $data = $serializer->normalize($produits);
            return new JsonResponse($data);
        }
        return $this->render('AdminBundle:Pub:afficherpPub.html.twig',array('Form'=>$Form->createView(),'Pub'=>$produits));
    }


    /**
     * @Route("/DelitePub/{id}",name="DelitePub")
     */
    public function supprimerProduitAction( $id)
    {

        $em = $this->getDoctrine()->getManager();

        $publication=$em->getRepository("AdminBundle:Publication")->find($id);

        $em->remove($publication);
        $em->flush();

        return $this->redirectToRoute("ShowPublication");
    }
}
