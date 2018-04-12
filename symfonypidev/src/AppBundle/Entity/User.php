<?php
// src/AppBundle/Entity/User.php

namespace AppBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="QuizBundle\Repository\UserRepository")
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
     *
     * @ORM\Column(name="Age", type="integer", nullable=true)
     */
    private $Age;

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

    /**
     * @var integer
     *
     * @ORM\Column(name="imageName", type="string", length=250, nullable=true)
     */
    private $imageName;

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

    /**
     * @return int
     */
    public function getAge()
    {
        return $this->Age;
    }

    /**
     * @param int $Age
     */
    public function setAge($Age)
    {
        $this->Age = $Age;
    }

    /**
     * @return int
     */
    public function getImageName()
    {
        return $this->imageName;
    }

    /**
     * @param int $imageName
     */
    public function setImageName($imageName)
    {
        $this->imageName = $imageName;
    }





}