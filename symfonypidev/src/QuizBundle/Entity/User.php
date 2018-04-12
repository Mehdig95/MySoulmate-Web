<?php
// src/AppBundle/Entity/User.php

namespace QuizBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="fos_user")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     *
     * @ORM\Column(type="string",columnDefinition="ENUM('femme', 'homme')")
     */
    private $type;

    /**
     * @ORM\Column(type="integer",nullable=true)
     */
    private $phone;

/**
 * @var integer

* @ORM\Column(name="VieCouplePercent", type="integer", nullable=true)
*/
    private $VieCouplePercent;

    /**
     * @var integer
     *
     * @ORM\Column(name="SocialePercent", type="integer", nullable=true)
     */
    private $SocialePercent;

    /**
     * @var integer
     *
     * @ORM\Column(name="PhysiquePercent", type="integer", nullable=true)
     */
    private $PhysiquePercent;

    /**
     * @var integer
     *
     * @ORM\Column(name="PersonalitePercent", type="integer", nullable=true)
     */
    private $PersonalitePercent;

    public function __construct()
    {
        parent::__construct();
        // your own logic
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param mixed $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * @return mixed
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * @param mixed $phone
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;
    }

    /**
     * @return mixed
     */
    public function getVieCouplePercent()
    {
        return $this->VieCouplePercent;
    }

    /**
     * @param mixed $VieCouplePercent
     */
    public function setVieCouplePercent($VieCouplePercent)
    {
        $this->VieCouplePercent = $VieCouplePercent;
    }

    /**
     * @return int
     */
    public function getSocialePercent()
    {
        return $this->SocialePercent;
    }

    /**
     * @param int $SocialePercent
     */
    public function setSocialePercent($SocialePercent)
    {
        $this->SocialePercent = $SocialePercent;
    }

    /**
     * @return int
     */
    public function getPhysiquePercent()
    {
        return $this->PhysiquePercent;
    }

    /**
     * @param int $PhysiquePercent
     */
    public function setPhysiquePercent($PhysiquePercent)
    {
        $this->PhysiquePercent = $PhysiquePercent;
    }

    /**
     * @return int
     */
    public function getPersonalitePercent()
    {
        return $this->PersonalitePercent;
    }

    /**
     * @param int $PersonalitePercent
     */
    public function setPersonalitePercent($PersonalitePercent)
    {
        $this->PersonalitePercent = $PersonalitePercent;
    }

}