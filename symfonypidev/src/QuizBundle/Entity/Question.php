<?php

namespace QuizBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Question
 *
 * @ORM\Table(name="question")
 * @ORM\Entity
 */
class Question
{
    /**
     * @var integer
     *
     * @ORM\Column(name="ID", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="Question", type="string", length=256, nullable=false)
     */
    private $question;

    /**
     * @var string
     *
     * @ORM\Column(name="Type", type="string", nullable=false)
     */
    private $type;

    /**
     * @var string
     *
     * @ORM\Column(name="Reponse1", type="string", length=255, nullable=false)
     */
    private $reponse1;

    /**
     * @var string
     *
     * @ORM\Column(name="Reponse2", type="string", length=255, nullable=false)
     */
    private $reponse2;

    /**
     * @var string
     *
     * @ORM\Column(name="Reponse3", type="string", length=255, nullable=false)
     */
    private $reponse3;

    /**
     * @var integer
     *
     * @ORM\Column(name="ScoreRep1", type="integer", nullable=false)
     */
    private $scorerep1;

    /**
     * @var integer
     *
     * @ORM\Column(name="ScoreRep2", type="integer", nullable=false)
     */
    private $scorerep2;

    /**
     * @var integer
     *
     * @ORM\Column(name="ScoreRep3", type="integer", nullable=false)
     */
    private $scorerep3;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getQuestion()
    {
        return $this->question;
    }

    /**
     * @param string $question
     */
    public function setQuestion($question)
    {
        $this->question = $question;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param string $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * @return string
     */
    public function getReponse1()
    {
        return $this->reponse1;
    }

    /**
     * @param string $reponse1
     */
    public function setReponse1($reponse1)
    {
        $this->reponse1 = $reponse1;
    }

    /**
     * @return string
     */
    public function getReponse2()
    {
        return $this->reponse2;
    }

    /**
     * @param string $reponse2
     */
    public function setReponse2($reponse2)
    {
        $this->reponse2 = $reponse2;
    }

    /**
     * @return string
     */
    public function getReponse3()
    {
        return $this->reponse3;
    }

    /**
     * @param string $reponse3
     */
    public function setReponse3($reponse3)
    {
        $this->reponse3 = $reponse3;
    }

    /**
     * @return int
     */
    public function getScorerep1()
    {
        return $this->scorerep1;
    }

    /**
     * @param int $scorerep1
     */
    public function setScorerep1($scorerep1)
    {
        $this->scorerep1 = $scorerep1;
    }

    /**
     * @return int
     */
    public function getScorerep2()
    {
        return $this->scorerep2;
    }

    /**
     * @param int $scorerep2
     */
    public function setScorerep2($scorerep2)
    {
        $this->scorerep2 = $scorerep2;
    }

    /**
     * @return int
     */
    public function getScorerep3()
    {
        return $this->scorerep3;
    }

    /**
     * @param int $scorerep3
     */
    public function setScorerep3($scorerep3)
    {
        $this->scorerep3 = $scorerep3;
    }



}

