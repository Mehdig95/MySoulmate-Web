<?php

namespace StoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Commande
 *
 * @ORM\Table(name="commande")
 * @ORM\Entity(repositoryClass="StoreBundle\Repository\CommandeRepository")
 */
class Commande
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

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
     * @var \Produit
     *
     * @ORM\ManyToOne(targetEntity="Produit")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idprod", referencedColumnName="id")
     * })
     */
    private $idprod;
    /**
     * @var integer
     *
     * @ORM\Column(name="quantite", type="integer", nullable=false)
     */
    private $quantite;

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
     * @return \Produit
     */
    public function getIdprod()
    {
        return $this->idprod;
    }

    /**
     * @param \Produit $idprod
     */
    public function setIdprod($idprod)
    {
        $this->idprod = $idprod;
    }

    /**
     * @return int
     */
    public function getQuantite()
    {
        return $this->quantite;
    }

    /**
     * @param int $quantite
     */
    public function setQuantite($quantite)
    {
        $this->quantite = $quantite;
    }


}

