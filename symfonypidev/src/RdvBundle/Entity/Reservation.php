<?php

namespace RdvBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Reservation
 *
 * @ORM\Table(name="reservation", indexes={@ORM\Index(name="IDX_6D48A643C0C4EBCE", columns={"idreservationRdv"}), @ORM\Index(name="IDX_6D48A6437AB2F62C", columns={"idguser"})})
 * @ORM\Entity
 */
class Reservation
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idreservation", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idreservation;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="datedebut", type="date", nullable=true)
     */
    private $datedebut;



    /**
     * @var integer
     *
     * @ORM\Column(name="nbrplacereserver", type="integer", nullable=true)
     */
    private $nbrplacereserver;

    /**
     * @var float
     *
     * @ORM\Column(name="prixreservation", type="float", precision=10, scale=0, nullable=true)
     */
    private $prixreservation;

    /**
     * @var \Client
     *
     * @ORM\ManyToOne(targetEntity="Client")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idguser", referencedColumnName="id")
     * })
     */
    private $idguser;

    /**
     * @var \Rdv
     *
     * @ORM\ManyToOne(targetEntity="Rdv")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idreservationRdv", referencedColumnName="id")
     * })
     */
    private $idreservationrdv;

    /**
     * @return int
     */
    public function getIdreservation()
    {
        return $this->idreservation;
    }

    /**
     * @param int $idreservation
     */
    public function setIdreservation($idreservation)
    {
        $this->idreservation = $idreservation;
    }

    /**
     * @return \DateTime
     */
    public function getDatedebut()
    {
        return $this->datedebut;
    }

    /**
     * @param \DateTime $datedebut
     */
    public function setDatedebut($datedebut)
    {
        $this->datedebut = $datedebut;
    }



    /**
     * @return int
     */
    public function getNbrplacereserver()
    {
        return $this->nbrplacereserver;
    }

    /**
     * @param int $nbrplacereserver
     */
    public function setNbrplacereserver($nbrplacereserver)
    {
        $this->nbrplacereserver = $nbrplacereserver;
    }

    /**
     * @return float
     */
    public function getPrixreservation()
    {
        return $this->prixreservation;
    }

    /**
     * @param float $prixreservation
     */
    public function setPrixreservation($prixreservation)
    {
        $this->prixreservation = $prixreservation;
    }

    /**
     * @return \Client
     */
    public function getIdguser()
    {
        return $this->idguser;
    }

    /**
     * @param \Client $idguser
     */
    public function setIdguser($idguser)
    {
        $this->idguser = $idguser;
    }

    /**
     * @return \Rdv
     */
    public function getIdreservationrdv()
    {
        return $this->idreservationrdv;
    }

    /**
     * @param \Rdv $idreservationrdv
     */
    public function setIdreservationrdv($idreservationrdv)
    {
        $this->idreservationrdv = $idreservationrdv;
    }


}

