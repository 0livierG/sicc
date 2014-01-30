<?php

namespace Sicc\Bundle\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Fichier
 *
 * @ORM\Table(name="fichier")
 * @ORM\Entity(repositoryClass="Sicc\Bundle\AdminBundle\Repository\FichierRepository")
 */
class Fichier
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
     * @ORM\Column(name="titre", type="string", length=255)
     */
    private $titre;

    /**
     * @var text
     *
     * @ORM\Column(name="description", type="text")
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="url", type="string", length=255)
     */
    private $url;

    /**
     * @ORM\ManyToMany(targetEntity="GroupeMembre", inversedBy="fichiers")
     * @ORM\JoinTable(name="fichiers_groupes")
     */
    private $groupes;

    public function __construct() {
        $this->groupes = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set titre
     *
     * @param string $titre
     * @return Fichier
     */
    public function setTitre($titre)
    {
        $this->titre = $titre;

        return $this;
    }

    /**
     * Get titre
     *
     * @return string 
     */
    public function getTitre()
    {
        return $this->titre;
    }

    /**
     * Set url
     *
     * @param string $url
     * @return Fichier
     */
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    public function getGroupes(){
        return $this->groupes;
    }

    /**
     * Get url
     *
     * @return string 
     */
    public function getUrl()
    {
        return $this->url;
    }

    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }


    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Add groupes
     *
     * @param \Sicc\Bundle\AdminBundle\Entity\GroupeMembre $groupes
     * @return Fichier
     */
    public function addGroupe(\Sicc\Bundle\AdminBundle\Entity\GroupeMembre $groupes)
    {
        $this->groupes[] = $groupes;

        return $this;
    }

    /**
     * Remove groupes
     *
     * @param \Sicc\Bundle\AdminBundle\Entity\GroupeMembre $groupes
     */
    public function removeGroupe(\Sicc\Bundle\AdminBundle\Entity\GroupeMembre $groupes)
    {
        $this->groupes->removeElement($groupes);
    }
}
