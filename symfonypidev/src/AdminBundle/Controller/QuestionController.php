<?php

namespace AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use QuizBundle\Entity\Question;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;

class QuestionController extends Controller
{



    /**
     * @Route("/QuestionIndex",name="question_index")
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $questions = $em->getRepository('AdminBundle:Question')->findAll();
        $question = new Question();
        $form = $this->createForm('AdminBundle\Form\RechercheType', $question);
        $form->handleRequest($request);

        if($request->isXmlHttpRequest())
        {
            $serializer = new Serializer(array(new ObjectNormalizer()));
            $mesquestions =  $this->getDoctrine()->getRepository('AdminBundle:Question')->findByQuestion($request->get('question'));
            $data = $serializer->normalize($mesquestions);

            return new JsonResponse($data);
        }

        return $this->render('AdminBundle:Question:index.html.twig', array(
            'questions' => $questions,
            'form' => $form->createView(),
        ));
    }


    /**
     * @Route("/newquestion",name="question_new")
     */
    public function newAction(Request $request)
    {
        $question = new Question();
        $form = $this->createForm('QuizBundle\Form\QuestionType', $question);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($question);
            $em->flush();

            return $this->redirectToRoute('question_show', array('id' => $question->getId()));
        }

        return $this->render('AdminBundle:Question:new.html.twig', array(
            'question' => $question,
            'form' => $form->createView(),
        ));
    }


    /**
     * @Route("/{id}/showquestion",name="question_show")
     */
    public function showAction(Question $question)
    {
        $deleteForm = $this->createDeleteForm($question);

        return $this->render('AdminBundle:Question:show.html.twig', array(
            'question' => $question,
            'delete_form' => $deleteForm->createView(),
        ));
    }


    /**
     * @Route("/{id}/editquestion",name="question_edit")
     */
    public function editAction(Request $request, Question $question)
    {
        $deleteForm = $this->createDeleteForm($question);
        $editForm = $this->createForm('AdminBundle\Form\QuestionType', $question);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('question_edit', array('id' => $question->getId()));
        }

        return $this->render('AdminBundle:Question:edit.html.twig', array(
            'question' => $question,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }


    /**
     * @Route("/{id}/deletequestion",name="question_delete")
     */
    public function deleteAction(Request $request, Question $question)
    {
        $form = $this->createDeleteForm($question);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($question);
            $em->flush();
        }

        return $this->redirectToRoute('question_index');
    }

    private function createDeleteForm(Question $question)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('question_delete', array('id' => $question->getId())))
            ->setMethod('DELETE')
            ->getForm()
            ;
    }

}
