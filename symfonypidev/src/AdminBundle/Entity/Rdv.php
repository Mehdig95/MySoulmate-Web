<?php

namespace AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Rdv
 *
 * @ORM\Table(name="rdv")
 * @ORM\Entity (repositoryClass="AdminBundle\Repository\PubRepository")
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
     * @Assert\File(maxSize="500k")
     */
    public $file;
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
     * @ORM\Column(name="codepostal", type="string", length=255, nullable=false)
     */
    private $codepostal;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set nomrdv
     *
     * @param string $nomrdv
     *
     * @return Rdv
     */
    public function setNomrdv($nomrdv)
    {
        $this->nomrdv = $nomrdv;

        return $this;
    }

    /**
     * Get nomrdv
     *
     * @return string
     */
    public function getNomrdv()
    {
        return $this->nomrdv;
    }

    /**
     * Set capaciteacceuil
     *
     * @param integer $capaciteacceuil
     *
     * @return Rdv
     */
    public function setCapaciteacceuil($capaciteacceuil)
    {
        $this->capaciteacceuil = $capaciteacceuil;

        return $this;
    }

    /**
     * Get capaciteacceuil
     *
     * @return int
     */
    public function getCapaciteacceuil()
    {
        return $this->capaciteacceuil;
    }

    /**
     * Set nbrplacedispo
     *
     * @param integer $nbrplacedispo
     *
     * @return Rdv
     */
    public function setNbrplacedispo($nbrplacedispo)
    {
        $this->nbrplacedispo = $nbrplacedispo;

        return $this;
    }

    /**
     * Get nbrplacedispo
     *
     * @return int
     */
    public function getNbrplacedispo()
    {
        return $this->nbrplacedispo;
    }

    /**
     * Set prix
     *
     * @param string $prix
     *
     * @return Rdv
     */
    public function setPrix($prix)
    {
        $this->prix = $prix;

        return $this;
    }

    /**
     * Get prix
     *
     * @return string
     */
    public function getPrix()
    {
        return $this->prix;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Rdv
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set disponibilite
     *
     * @param string $disponibilite
     *
     * @return Rdv
     */
    public function setDisponibilite($disponibilite)
    {
        $this->disponibilite = $disponibilite;

        return $this;
    }

    /**
     * Get disponibilite
     *
     * @return string
     */
    public function getDisponibilite()
    {
        return $this->disponibilite;
    }

    /**
     * Set etat
     *
     * @param string $etat
     *
     * @return Rdv
     */
    public function setEtat($etat)
    {
        $this->etat = $etat;

        return $this;
    }

    /**
     * Get etat
     *
     * @return string
     */
    public function getEtat()
    {
        return $this->etat;
    }

    /**
     * Set codepostal
     *
     * @param string $codepostal
     *
     * @return Rdv
     */
    public function setCodepostal($codepostal)
    {
        $this->codepostal = $codepostal;

        return $this;
    }

    /**
     * Get codepostal
     *
     * @return string
     */
    public function getCodepostal()
    {
        return $this->codepostal;
    }
    public function getWebPath()
    {
        return null === $this->nomImage ? null : $this->getUploadDir().'/'.$this->nomImage;
    }

    protected function getUploadRootDir()
    {
        // le chemin absolu du répertoire dans lequel sauvegarder les photos de profil
        return __DIR__.'/../../../../web/'.$this->getUploadDir();
    }

    protected function getUploadDir()
    {
        // get rid of the __DIR__ so it doesn't screw when displaying uploaded doc/image in the view.
        return 'images';
    }

    public function uploadProfilePicture()
    {
        // Nous utilisons le nom de fichier original, donc il est dans la pratique
        // nécessaire de le nettoyer pour éviter les problèmes de sécurité

        // move copie le fichier présent chez le client dans le répertoire indiqué.
        $this->file->move($this->getUploadRootDir(), $this->file->getClientOriginalName());

        // On sauvegarde le nom de fichier
        $this->nomImage = $this->file->getClientOriginalName();

        // La propriété file ne servira plus
        $this->file = null;
    }

    /**
     * Set nomImage
     *
     * @param string $nomImage
     *
     * @return Boutique
     */
    public function setNomImage($nomImage)
    {
        $this->nomImage = $nomImage;

        return $this;
    }

    /**
     * Get nomImage
     *
     * @return string
     */
    public function getNomImage()
    {
        return $this->nomImage;
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

