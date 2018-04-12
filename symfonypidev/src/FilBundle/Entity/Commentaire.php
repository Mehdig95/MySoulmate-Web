<?php

namespace FilBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Commentaire
 *
 * @ORM\Table(name="commentaire", indexes={@ORM\Index(name="idUser", columns={"idUser"}), @ORM\Index(name="fk4", columns={"idPub"})})
 * @ORM\Entity
 */
class Commentaire
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
     * @ORM\Column(name="commentaire", type="string", length=255, nullable=false)
     */
    private $commentaire;

    /**
     * @ORM\ManyToOne(targetEntity="Client", inversedBy="Publication")
     * @ORM\JoinColumn(name="iduser", referencedColumnName="id")
     */
    private $iduser;

    /**
     * @var integer
     *
     * @ORM\Column(name="signalercount", type="integer", nullable=false)
     */
    private $signalercount;

    /**
     * @var \Publication
     *
     * @ORM\ManyToOne(targetEntity="Publication")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idPub", referencedColumnName="id_pub",onDelete="CASCADE")
     * })
     */
    private $idpub;

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
    public function getCommentaire()
    {
        return $this->commentaire;
    }

    /**
     * @param string $commentaire
     */
    public function setCommentaire($commentaire)
    {
        $this->commentaire = $commentaire;
    }

    /**
     * @return mixed
     */
    public function getIduser()
    {
        return $this->iduser;
    }

    /**
     * @param mixed $iduser
     */
    public function setIduser($iduser)
    {
        $this->iduser = $iduser;
    }

    /**
     * @return int
     */
    public function getSignalercount()
    {
        return $this->signalercount;
    }

    /**
     * @param int $signalercount
     */
    public function setSignalercount($signalercount)
    {
        $this->signalercount = $signalercount;
    }

    /**
     * @return \Publication
     */
    public function getIdpub()
    {
        return $this->idpub;
    }

    /**
     * @param \Publication $idpub
     */
    public function setIdpub($idpub)
    {
        $this->idpub = $idpub;
    }


}

