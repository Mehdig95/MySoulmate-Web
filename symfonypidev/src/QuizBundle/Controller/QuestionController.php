<?php

namespace QuizBundle\Controller;

use QuizBundle\Entity\Question;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * Question controller.
 *
 */
class QuestionController extends Controller
{


    /**
     * @Route("/ShowQuiz",name="ShowQuiz")
     */
    public function quizAction()
    {
        $em = $this->getDoctrine()->getManager();
        $questions = $em->getRepository('QuizBundle:Question')->findAll();
        return $this->render('QuizBundle:Quiz:quiz.html.twig', array(
            'questions' => $questions,
        ));

    }


    /**
     * @Route("/QuizResult",name="QuizResult")
     */

    public function quizResultAction()
    {
        $request = $this->container->get('request_stack')->getCurrentRequest();

        $scoreVC = $request->request->get('scoreVC');
        $scoreSo = $request->request->get('scoreSo');
        $scorePh = $request->request->get('scorePh');
        $scorePe = $request->request->get('scorePe');
        $response = new Response();
        $response->headers->set('Content-Type', 'application/json');
        $userManager = $this->get('fos_user.user_manager');
        $currentuser = $userManager->findUserByUsername($this->container->get('security.token_storage')->getToken()->getUser());
        $currentuser->setVieCouplePercent($scoreVC);
        $currentuser->setSocialePercent($scoreSo);
        $currentuser->setPhysiquePercent($scorePh);
        $currentuser->setPersonalitePercent($scorePe);
        $userManager->updateUser($currentuser);
        $response->setContent(json_encode($scoreVC));
        return $response;


    }

    /**
     * Creates a form to delete a question entity.
     *
     * @param Question $question The question entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Question $question)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('question_delete', array('id' => $question->getId())))
            ->setMethod('DELETE')
            ->getForm()
            ;
    }


    private function  createIndexForm()
    {
        return $this->createFormBuilder()->add('Sexe', ChoiceType::class, array('attr'=>array('class'=>'selectpicker'),'choices'=>['Homme'=>'Homme','Femme'=>'Femme']))
            ->add('From', ChoiceType::class, array('attr'=>array('class'=>'selectpicker'),'choices'=> [18=>18,20=>20,22=>22,24=>24,26=>26,28=>28,30=>30]))
            ->add('To',ChoiceType::class, array('attr'=>array('class'=>'selectpicker'),'choices'=> [18=>18,20=>20,22=>22,24=>24,26=>26,28=>28,30=>30]))

            ->getForm();

    }

    /**
     *
     *
     * Create Form - Index Matching
     *
     */


    /*  public function MatchingIndexAction()
      {
          return $this->render('QuizBundle:Matching:index.html.twig');
      }*/

    /**
     * @Route("/ShowmatchIndex",name="ShowmatchIndex")
     */
    public function MatchingIndexAction(Request $request)
    {
        $Form = $this->createIndexForm();
        $Form->handleRequest($request);

        if($Form->isSubmitted() && $Form->isValid())
        {
            $data = $Form->getData();
            dump($data);
            $from = $Form->getData()['From'];;
            $to = $Form->getData()['To'];
            $sexe = $Form->getData()['Sexe'];
            $userManager = $this->get('fos_user.user_manager');
            $currentuser = $userManager->findUserByUsername($this->container->get('security.token_storage')->getToken()->getUser());
            $em = $this->getDoctrine()->getManager();
            $users = $em->getRepository('AppBundle:User')->findMatches($currentuser, $sexe, $from, $to);

            return $this->render('QuizBundle:Matching:matching.html.twig',array('users'=>$users));
        }

        return $this->render('QuizBundle:Matching:index.html.twig', array('form'=> $Form->createView()));
    }

    /**
     * @Route("/ViewProfile/{user}", name="ViewProfile")
     */
    public function ProfileAction(Request $request)
    {

        $id = $request->get('user');
        $em = $this->getDoctrine()->getManager();
        $user =  $em->getRepository('AppBundle:User')->find($id);
        $profile =  $em->getRepository('FilBundle:Client')->findOneBy(array('id_user'=> $id));
        return $this->render('QuizBundle:Matching:profile.html.twig', array('user'=>$user , 'profile'=>$profile));
    }

}
