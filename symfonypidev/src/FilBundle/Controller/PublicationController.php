<?php

namespace FilBundle\Controller;

use FilBundle\Entity\Client;
use FilBundle\Entity\Commentaire;
use FilBundle\Entity\Publication;
use FilBundle\Form\CommentaireType;
use FilBundle\Form\PublicationType;
use FilBundle\Form\SinForm;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
class PublicationController extends Controller
{
    /**
     * @Route("/addPublication",name="addPublication")
     */
    public function addPublicationAction(Request $request)
    {


        $user = $this->getUser();
        if (!is_object($user)) {

            return $this->redirectToRoute('fos_user_security_login');
        }
        $id = $this->getUser()->getId();

        $Publication = new Publication();
        $em = $this->getDoctrine()->getManager();
        $profile = $em->getRepository('FilBundle:Client')->findOneBy(array('id_user' => $id));

        $form = $this->createForm(PublicationType::class, $Publication  );


        $form->handleRequest($request);

        if($form->isSubmitted() ) {
            $Publication->setIdUser($profile);

            $em->persist( $Publication );
            $em->flush();
            return $this->redirect($this->generateUrl('Filpage',array('msg'=>"add successful")));
        }
        return $this->render('FilBundle:Publication:addPublication.html.twig',array(
            'form'=>$form->createView(),
            'profile'=>$profile,
            'publication'=>$Publication



        ));

    }


    /**
     * @Route("/Filpage",name="Filpage")
     */
    public function PublicationAfficherAction(Request $request)
    {
        $user = $this->getUser();
        $id = $this->getUser()->getId();
       // $Commentaire =new Commentaire();
       // $Commentaire->getIdpub();
        $publication = new Publication();
        $em=$this->getDoctrine()->getManager();
        $profile = $em->getRepository('FilBundle:Client')->findOneBy(array('id_user' => $id ));
        $publication = $em->getRepository('FilBundle:Publication')->findBy(array('idUser'=>$id));
        $commentaires = $em->getRepository('FilBundle:Commentaire')->findAll();

        if (!is_object($user)) {

            return $this->redirectToRoute('fos_user_security_login');
        }
        $em = $this->getDoctrine()->getManager();
        $event = $em->getRepository('FilBundle:Publication')->findAll();


        //  controle sur le status //


        if($request->get('Text'))
        {
            $dql   = "SELECT a FROM FilBundle:Publication a where a.text like '%".$request->get('Text')."%'";
            $query = $em->createQuery($dql);
            $paginator  = $this->get('knp_paginator');
            $pagination = $paginator->paginate(
                $query,
                $request->query->getInt('page', 1),
                5
            );
            return $this->render('FilBundle:Publication:Fil.html.twig',array(
                'pagination'=>$pagination,
            ));
        }





        $dql   = "SELECT a FROM FilBundle:Publication a ORDER BY a.idPub DESC";
        $query = $em->createQuery($dql);

        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $query,
            $request->query->getInt('page', 1),
            5
        );

        return $this->render('FilBundle:Publication:Fil.html.twig',array(

            'pagination'=>$pagination,
            'publication'=>$publication,
            'profile'=>$profile,
            'commentaire'=>$commentaires


        ));
    }



    /**
     * @Route("/deletePub/{id}",name="deletepub")
     */
    public function deletePubAction($id)
    {
        $user = $this->getUser();
        if (!is_object($user) ) {
            return $this->redirectToRoute('fos_user_security_login');
        }
        $em=$this->getDoctrine()->getManager();
        $pub = $em->getRepository('FilBundle:Publication')->findOneBy(array('idPub' => $id ));

        $em->remove($pub);

        $em->flush();
        return $this->redirect($this->generateUrl('Filpage',array('msg'=>"Delete successful")));

    }

    /**
     * @Route("/AddComm/{idp}",name="AddComm")
     */
    public function CommAction(Request $request,$idp)
    {
        $user = $this->getUser();
        if (!is_object($user)) {

            return $this->redirectToRoute('fos_user_security_login');
        }
        $id = $this->getUser()->getId();


        $Commentaire = new Commentaire();
        $em = $this->getDoctrine()->getManager();
        $profile = $em->getRepository('FilBundle:Client')->findOneBy(array('id_user' => $id));
        $em=$this->getDoctrine()->getManager();

        $rdv = $em->getRepository('FilBundle:Publication')->findOneBy(array('idPub' => $idp ));

        $form = $this->createForm(CommentaireType::class, $Commentaire  );


        $form->handleRequest($request);

        if($form->isSubmitted() ) {
            $Commentaire->setIduser($profile);

            $Commentaire->setIdpub($rdv);

            $em->persist( $Commentaire );
            $em->flush();
            return $this->redirect($this->generateUrl('Filpage',array('msg'=>"add successful")));
        }
        return $this->render('FilBundle:Commentaire:AddComment.html.twig',array(
            'form3'=>$form->createView(),
            'profile'=>$profile,

            'commentaire'=>$Commentaire



        ));

    }
    /**
     * @Route("/editPub/{idp}",name="editPub")
     */
    public function editEventAction(Request $request,$idp)
    {
        $user = $this->getUser();
        if (!is_object($user) ) {
            return $this->redirectToRoute('fos_user_security_login');
        }
        $id =  $this->getUser()->getId();

        $em=$this->getDoctrine()->getManager();
        $profile = $em->getRepository('FilBundle:Client')->findOneBy(array('id_user' => $id ));
        $Publication = $em->getRepository('FilBundle:Publication')->findOneBy(array('idPub' => $idp ));
        $form = $this->createForm(PublicationType::class,$Publication );
        $form->handleRequest($request);
        if($form->isSubmitted() ) {
            $em->persist($Publication);
            $em->flush();
            return $this->redirect($this->generateUrl('Filpage',array('msg'=>"Edit successful")));
        }
        return $this->render('FilBundle:Publication:EditPublication.html.twig',array(
            'form'=>$form->createView(),
            'profile'=>$profile,

        ));

    }



}
