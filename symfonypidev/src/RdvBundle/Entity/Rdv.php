<?php

namespace RdvBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Rdv
 *
 * @ORM\Table(name="rdv")
 * @ORM\Entity
 */
class Rdv
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
     * @ORM\Column(name="nomrdv", type="string", length=255, nullable=false)
     */
    private $nomrdv;

    /**
     * @var string
     *
     * @ORM\Column(name="nom_image", type="string", length=255, nullable=true)
     */
    private $nomImage;

    /**
     * @var integer
     *
     * @ORM\Column(name="capaciteacceuil", type="integer", nullable=false)
     */
    private $capaciteacceuil;

    /**
     * @var integer
     *
     * @ORM\Column(name="nbrplacedispo", type="integer", nullable=false)
     */
    private $nbrplacedispo;

    /**
     * @var string
     *
     * @ORM\Column(name="prix", type="string", length=255, nullable=false)
     */
    private $prix;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255, nullable=false)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="disponibilite", type="string", length=255, nullable=false)
     */
    private $disponibilite;

    /**
     * @var string
     *
     * @ORM\Column(name="etat", type="string", length=255, nullable=false)
     */
    private $etat;
    /**
     * @var string
     *
     * @ORM\Column(name="longitude", type="string", length=255, nullable=true)
     */
    private $longitude;
    /**
     * @var string
     *
     * @ORM\Column(name="altitude", type="string", length=255, nullable=true)
     */
    private $altitude;
    /**
     * @var string
     *
     * @ORM\Column(name="adresse", type="string", length=255, nullable=true)
     */
    private $adresse;
    /**
     * @var string
     *
     * @ORM\Column(name="codepostal", type="string", length=255, nullable=false)
     */
    private $codepostal;

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
    public function getNomrdv()
    {
        return $this->nomrdv;
    }

    /**
     * @param string $nomrdv
     */
    public function setNomrdv($nomrdv)
    {
        $this->nomrdv = $nomrdv;
    }

    /**
     * @return string
     */
    public function getNomImage()
    {
        return $this->nomImage;
    }

    /**
     * @param string $nomImage
     */
    public function setNomImage($nomImage)
    {
        $this->nomImage = $nomImage;
    }

    /**
     * @return int
     */
    public function getCapaciteacceuil()
    {
        return $this->capaciteacceuil;
    }

    /**
     * @param int $capaciteacceuil
     */
    public function setCapaciteacceuil($capaciteacceuil)
    {
        $this->capaciteacceuil = $capaciteacceuil;
    }

    /**
     * @return int
     */
    public function getNbrplacedispo()
    {
        return $this->nbrplacedispo;
    }

    /**
     * @param int $nbrplacedispo
     */
    public function setNbrplacedispo($nbrplacedispo)
    {
        $this->nbrplacedispo = $nbrplacedispo;
    }

    /**
     * @return string
     */
    public function getPrix()
    {
        return $this->prix;
    }

    /**
     * @param string $prix
     */
    public function setPrix($prix)
    {
        $this->prix = $prix;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return string
     */
    public function getDisponibilite()
    {
        return $this->disponibilite;
    }

    /**
     * @param string $disponibilite
     */
    public function setDisponibilite($disponibilite)
    {
        $this->disponibilite = $disponibilite;
    }

    /**
     * @return string
     */
    public function getEtat()
    {
        return $this->etat;
    }

    /**
     * @param string $etat
     */
    public function setEtat($etat)
    {
        $this->etat = $etat;
    }

    /**
     * @return string
     */
    public function getCodepostal()
    {
        return $this->codepostal;
    }

    /**
     * @param string $codepostal
     */
    public function setCodepostal($codepostal)
    {
        $this->codepostal = $codepostal;
    }

    /**
     * @return string
     */
    public function getLongitude()
    {
        return $this->longitude;
    }

    /**
     * @param string $longitude
     */
    public function setLongitude($longitude)
    {
        $this->longitude = $longitude;
    }

    /**
     * @return string
     */
    public function getAltitude()
    {
        return $this->altitude;
    }

    /**
     * @param string $altitude
     */
    public function setAltitude($altitude)
    {
        $this->altitude = $altitude;
    }

    /**
     * @return string
     */
    public function getAdresse()
    {
        return $this->adresse;
    }

    /**
     * @param string $adresse
     */
    public function setAdresse($adresse)
    {
        $this->adresse = $adresse;
    }


}

