<?php

namespace StoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Friendsrequest
 *
 * @ORM\Table(name="friendsrequest", indexes={@ORM\Index(name="IDX_6E4C03117937FF22", columns={"id_sender"}), @ORM\Index(name="IDX_6E4C0311E7E07E1", columns={"id_reciver"})})
 * @ORM\Entity
 */
class Friendsrequest
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="stat", type="string", length=255, nullable=false)
     */
    private $stat = 'wait';

    /**
     * @var \Client
     *
     * @ORM\ManyToOne(targetEntity="Client")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_reciver", referencedColumnName="id")
     * })
     */
    private $idReciver;

    /**
     * @var \Client
     *
     * @ORM\ManyToOne(targetEntity="Client")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_sender", referencedColumnName="id")
     * })
     */
    private $idSender;

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
    public function getStat()
    {
        return $this->stat;
    }

    /**
     * @param string $stat
     */
    public function setStat($stat)
    {
        $this->stat = $stat;
    }

    /**
     * @return \Client
     */
    public function getIdReciver()
    {
        return $this->idReciver;
    }

    /**
     * @param \Client $idReciver
     */
    public function setIdReciver($idReciver)
    {
        $this->idReciver = $idReciver;
    }

    /**
     * @return \Client
     */
    public function getIdSender()
    {
        return $this->idSender;
    }

    /**
     * @param \Client $idSender
     */
    public function setIdSender($idSender)
    {
        $this->idSender = $idSender;
    }




}

