<?php

namespace QuizBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class MailerController extends Controller
{


    /**
     * @Route("/Sendmail",name="Sendmail")
     */
    public function MailAction (Request $request)
    {
        $form = $this->createFormBuilder()->add('subject', TextareaType::class , array('attr'=>array('class'=>'form-control input-message','placeholder'=>'Your message here*')))->add('to', EmailType::class , array('attr'=>array('class'=>'form-control','placeholder'=>'Your mail here*')))->add('Send', SubmitType::class)->getForm();
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            dump($data);
            $message = \Swift_Message::newInstance()
                ->setSubject('My Soulmate Staff')
                ->setFrom('mysoulmatepidev@gmail.com')
                ->setTo($data['to'])
                ->setBody('We received your email. Thanks for taking a few moments to talk to us.'
                );
            $this->get('mailer')->send($message);


        }
        return $this->render('QuizBundle:Mailer:mailer.html.twig', ['form' => $form->createView()]);
    }
}
