<?php

namespace FilBundle\Controller;

use FilBundle\Entity\Commentaire;
use FilBundle\Entity\Publication;
use FilBundle\Form\CommentaireType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use FilBundle\Form\SinForm;

class CommentaireController extends Controller
{
    /**
     * @Route("/addComm/{idp}",name="addComm")
     */
    public function addCommAction(Request $request,$idp)
    {


        $user = $this->getUser();
        if (!is_object($user)) {

            return $this->redirectToRoute('fos_user_security_login');
        }
        $id = $this->getUser()->getId();


        $Commentaire = new Commentaire();
        $em = $this->getDoctrine()->getManager();
        $profile = $em->getRepository('FilBundle:Client')->findOneBy(array('id_user' => $id));
        $pub=$em->getRepository('FilBundle:Publication')->findOneBy(array('idPub'=>$idp));

        $form = $this->createForm(CommentaireType::class, $Commentaire  );


        $form->handleRequest($request);

        if($form->isSubmitted() ) {
            $Commentaire->setIduser($profile);
            $Commentaire->setIdpub($pub);

            $em->persist( $Commentaire );
            $em->flush();
            return $this->redirect($this->generateUrl('Filpage',array('msg'=>"add successful")));
        }
        return $this->render('FilBundle:Commentaire:AddComment.html.twig',array(
            'form3'=>$form->createView(),
            'profile'=>$profile,
            'publication'=>$pub,
            'commentaire'=>$Commentaire



        ));

    }

    /**
     * @Route("/AddSin/{idp}",name="AddSin")
     */
    public function AddSinAction(Request $request,$idp)
    {

        $user = $this->getUser();
        if (!is_object($user)) {

            return $this->redirectToRoute('fos_user_security_login');
        }
        // $id = $this->getUser()->getId();
        $Publication =new Commentaire();
        $em=$this->getDoctrine()->getManager();
        // $profile = $em->getRepository('FilBundle:Client')->findOneBy(array('id_user' => $id ));
        $pub = $em->getRepository('FilBundle:Commentaire')->findOneBy(array('id' => $idp));
        $form = $this->createForm(SinForm::class,$Publication );
        $form->handleRequest($request);

        //$Publication->setIdUser($profile);
        if($form->isSubmitted() ) {
            $pub->setSignalercount($pub->getSignalercount() + 1);
            $Publication->setSignalercount($pub);
            $em->persist($Publication);

            return $this->redirect($this->generateUrl('Filpage', array('msg' => "add successful")));
        }

        return $this->render('FilBundle:Commentaire:sin.html.twig',array(
            'form'=>$form->createView()


        ));

    }


    /**
     * @Route("/deleteComm/{id}",name="deleteComm")
     */
    public function deleteComm($id)
    {
        $user = $this->getUser();
        if (!is_object($user) ) {
            return $this->redirectToRoute('fos_user_security_login');
        }
        $em=$this->getDoctrine()->getManager();
        $com = $em->getRepository('FilBundle:Commentaire')->findOneBy(array('id' => $id ));
        $em->remove($com);
        $em->flush();
        return $this->redirect($this->generateUrl('Filpage',array('msg'=>"Delete successful")));

    }

}
