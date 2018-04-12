<?php

namespace FilBundle\Controller;

use FilBundle\Entity\Client;
use FOS\UserBundle\Event\FormEvent;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use FOS\UserBundle\Event\GetResponseUserEvent;
use FOS\UserBundle\FOSUserEvents;
use FilBundle\Form\ClientType;
use Symfony\Component\HttpFoundation\RedirectResponse;

class clientController extends Controller
{
    /**
     * @Route("/")
     */
    public function indexAction()
    {
        return $this->render('FilBundle:Default:index.html.twig');
    }

    /**
     * @Route("/userprofile",name="profilehomme")
     */
    public function profileAction()
    {

        $user = $this->getUser();
        $id = $this->getUser()->getId();

        $email = $this->getUser()->getemail();

        if (!is_object($user)) {

            return $this->redirectToRoute('fos_user_security_login');
        }

        $em = $this->getDoctrine()->getManager();
        $profile = $em->getRepository('FilBundle:Client')->findOneBy(array('id_user' => $id));
        $newid = $em->getRepository('AppBundle:User')->findOneBy(array('id' => $id));

        if (empty($profile)) {
            $profile = new Client();

            $profile->setIdUser($newid);
            $profile->setDateInscrit(new \DateTime());


            $em->persist($profile);
            $em->flush();

            return $this->render('FilBundle:interface:profile.html.twig', array(
                'profile' => $profile,
                'email' => $email
            ));
        }
        return $this->render('FilBundle:interface:profile.html.twig',array(
            'profile'=>$profile,
            'email'=>$email
        ));

    }

    /**
     * @Route("/usersetting",name="setting")
     */
    public function usersettingAction(Request $request)
    {


        $user = $this->getUser();
        $id =  $this->getUser()->getId();

        $em=$this->getDoctrine()->getManager();
        $profile = $em->getRepository('FilBundle:Client')->findOneBy(array('id_user' => $id ));
        $form = $this->createForm(ClientType::class,$profile );


        $form->handleRequest($request);

        if($form->isSubmitted() )
        {

            $em->persist($profile);
            $em->flush();
            return $this->redirect($this->generateUrl('profilehomme'));
        }
        /** @var $dispatcher EventDispatcherInterface */
        $dispatcher = $this->get('event_dispatcher');

        $event = new GetResponseUserEvent($user, $request);
        $dispatcher->dispatch(FOSUserEvents::CHANGE_PASSWORD_INITIALIZE, $event);

        if (null !== $event->getResponse()) {
            return $event->getResponse();
        }

        /** @var $formFactory FactoryInterface */
        $formFactory = $this->get('fos_user.change_password.form.factory');

        $form1 = $formFactory->createForm();
        $form1->setData($user);

        $form1->handleRequest($request);

        if ($form1->isSubmitted() && $form1->isValid()) {
            /** @var $userManager UserManagerInterface */
            $userManager = $this->get('fos_user.user_manager');

            $event = new FormEvent($form1, $request);
            $dispatcher->dispatch(FOSUserEvents::CHANGE_PASSWORD_SUCCESS, $event);

            $userManager->updateUser($user);

            if (null === $response = $event->getResponse()) {
                $url = $this->generateUrl('fos_user_profile_show');
                $response = new RedirectResponse($url);
            }

            $dispatcher->dispatch(FOSUserEvents::CHANGE_PASSWORD_COMPLETED, new FilterUserResponseEvent($user, $request, $response));

            return $response;
        }

        return $this->render('FilBundle:interface:SettingProfile.html.twig',array(
            'form1'=>$form1->createView(),
            'form'=>$form->createView(),
            'profile'=>$profile

        ));

    }
}
