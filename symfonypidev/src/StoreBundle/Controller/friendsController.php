<?php

namespace StoreBundle\Controller;

use StoreBundle\Entity\Friendsrequest;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class friendsController extends Controller
{

    /**
     * @Route("/myFriends",name="listeFriend")
     */
    public function listAction()
    {
        $user = $this->getUser();
        if (!is_object($user) ) {
            return $this->redirectToRoute('fos_user_security_login');
        }
        $id =  $this->getUser()->getId();


        $em=$this->getDoctrine()->getManager();
        $profile = $em->getRepository('StoreBundle:Client')->findOneBy(array('id_user' => $id ));

        $allUser = $em->getRepository('StoreBundle:Client')->findAll();
        $mylist = $em->getRepository('StoreBundle:Friendsrequest')->findAll();



        return $this->render('StoreBundle:Friends:myfriends.html.twig',array('profile'=>$profile
        , "alluser"=>$allUser , "mylist"=>$mylist));
    }


    /**
     * @Route("/myFriends/send/{id}",name="sendFriend")
     */
    public function sendtAction($id)
    {
        $user = $this->getUser();
        if (!is_object($user) ) {
            return $this->redirectToRoute('fos_user_security_login');
        }
        $idd =  $this->getUser()->getId();


        $em=$this->getDoctrine()->getManager();
        $profile = $em->getRepository('StoreBundle:Client')->findOneBy(array('id_user' => $idd ));
        $profileReciver = $em->getRepository('StoreBundle:Client')->findOneBy(array('id_user' => $id ));
        $allUser = $em->getRepository('StoreBundle:Client')->findAll();

        $friendRequest = new Friendsrequest();
        $friendRequest->setIdSender($profile);
        $friendRequest->setIdReciver($profileReciver);
        $friendRequest->setStat("wait");
        $em->persist($friendRequest);
        $em->flush();



        $mylist = $em->getRepository('StoreBundle:Friendsrequest')->findAll();



        return $this->render('StoreBundle:Friends:myfriends.html.twig',array('profile'=>$profile
        , "alluser"=>$allUser , "mylist"=>$mylist));
    }


    /**
     * @Route("/myFriends/action/{id}/{var}",name="actionFriend")
     */
    public function actionAction($id,$var)
    {
        $user = $this->getUser();
        if (!is_object($user) ) {
            return $this->redirectToRoute('fos_user_security_login');
        }
        $idd =  $this->getUser()->getId();


        $em=$this->getDoctrine()->getManager();
        $profile = $em->getRepository('StoreBundle:Client')->findOneBy(array('id_user' => $idd ));
        $profilesender = $em->getRepository('StoreBundle:Client')->findOneBy(array('id' => $id ));
        $allUser = $em->getRepository('StoreBundle:Client')->findAll();

        $action = $em->getRepository('StoreBundle:Friendsrequest')->findOneBy(array('idReciver' => $profile , 'idSender' => $profilesender ));

        if($var == "refus"){
            $action->setStat("refus");
        }
        if($var == "accept"){
            $action->setStat("accpet");
        }

        $em->merge($action);
        $em->flush();


        $mylist = $em->getRepository('StoreBundle:Friendsrequest')->findAll();



        return $this->render('StoreBundle:Friends:myfriends.html.twig',array('profile'=>$profile
        , "alluser"=>$allUser , "mylist"=>$mylist));
    }

}
