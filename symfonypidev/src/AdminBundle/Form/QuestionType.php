<?php

namespace AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class QuestionType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('question')->add('type', ChoiceType::class, array('choices' => ['QuestSociale' => 'QuestSociale', 'QuestPersonalite' => 'QuestPersonalite' , 'QuestVieCouple' => 'QuestVieCouple' , 'QuestPhysique'=>'QuestPhysique']))->add('reponse1')->add('reponse2')->add('reponse3')->add('scorerep1')->add('scorerep2')->add('scorerep3');
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AdminBundle\Entity\Question'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'adminbundle_question';
    }


}
