<?php

namespace Sicc\Bundle\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Sicc\Bundle\UserBundle\Entity;

/**
 * GroupeMembre
 *
 * @ORM\Table(name="groupe_membre")
 * @ORM\Entity(repositoryClass="Sicc\Bundle\AdminBundle\Repository\GroupeMembreRepository")
 */
class GroupeMembre
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="intitule", type="string", length=255)
     */
    private $intitule;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255)
     */
    private $description;


    /**
     * @ORM\ManyToMany(targetEntity="Fichier", mappedBy="groupes")
     */
    private $fichiers;

    /**
     * @ORM\OneToMany(targetEntity="Sicc\Bundle\UserBundle\Entity\Membre", mappedBy="groupe")
     */
    protected $membres;

    public function __construct() {
        $this->fichiers = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set intitule
     *
     * @param string $intitule
     * @return GroupeMembre
     */
    public function setIntitule($intitule)
    {
        $this->intitule = $intitule;

        return $this;
    }

    /**
     * Get intitule
     *
     * @return string 
     */
    public function getIntitule()
    {
        return $this->intitule;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return GroupeMembre
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

    public function __toString(){
        return $this->intitule;
    }

    /**
     * Add fichiers
     *
     * @param \Sicc\Bundle\AdminBundle\Entity\Fichier $fichiers
     * @return GroupeMembre
     */
    public function addFichier(\Sicc\Bundle\AdminBundle\Entity\Fichier $fichiers)
    {
        $this->fichiers[] = $fichiers;

        return $this;
    }

    /**
     * Remove fichiers
     *
     * @param \Sicc\Bundle\AdminBundle\Entity\Fichier $fichiers
     */
    public function removeFichier(\Sicc\Bundle\AdminBundle\Entity\Fichier $fichiers)
    {
        $this->fichiers->removeElement($fichiers);
    }

    /**
     * Get fichiers
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getFichiers()
    {
        return $this->fichiers;
    }

    /**
     * Add membres
     *
     * @param \Sicc\Bundle\UserBundle\Entity\Membre $membres
     * @return GroupeMembre
     */
    public function addMembre(\Sicc\Bundle\UserBundle\Entity\Membre $membres)
    {
        $this->membres[] = $membres;

        return $this;
    }

    /**
     * Remove membres
     *
     * @param \Sicc\Bundle\UserBundle\Entity\Membre $membres
     */
    public function removeMembre(\Sicc\Bundle\UserBundle\Entity\Membre $membres)
    {
        $this->membres->removeElement($membres);
    }

    /**
     * Get membres
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getMembres()
    {
        return $this->membres;
    }
}
