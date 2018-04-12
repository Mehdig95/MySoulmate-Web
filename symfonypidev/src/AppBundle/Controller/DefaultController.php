<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use AppBundle\Entity\Mail;

use AppBundle\Form\MailType;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction()
    {


        return $this->redirectToRoute('fos_user_registration_register');

    }


    /**
     * @Route("/email", name="email")
     */
    public function afficheAction(Request $request)
    {
        $mail = new Mail();
        $form= $this->createForm(MailType::class, $mail);
        $form->handleRequest($request) ;
        if ($form->isValid()) {
            $message = \Swift_Message::newInstance()
                ->setSubject('Accusé de réception')
                ->setFrom('espritplus2016@gmail.com')
                ->setTo($mail->getEmail())
                ->setBody(
                    $this->renderView(
                        'email.html.twig',
                        array('nom' => $mail->getNom(), 'prenom'=>$mail->getPrenom())
                    ),
                    'text/html'
                );
            $this->get('mailer')->send($message);
            return $this->redirect($this->generateUrl('emailsuccses'));

        }
        return $this->render('index.html.twig', array('form'=>$form
            ->createView()));
    }

    /**
     * @Route("/emailsuccses", name="emailsuccses")
     */
    public function successAction(){
        return new Response("email envoyé avec succès, Merci de vérifier votre adresse mail
.");
    }

}
