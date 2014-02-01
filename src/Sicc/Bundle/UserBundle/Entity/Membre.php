<?php

namespace Sicc\Bundle\UserBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="membre")
 */
class Membre extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(name="civilite", type="string", length=255)
     */
    protected $civilite;

    /**
     * @var string
     *
     * @ORM\Column(name="prenom", type="string", length=255)
     */
    protected $prenom;


    /**
     * @var string
     *
     * @ORM\Column(name="societe", type="string", length=255)
     */
    protected $societe;

    /**
     * @ORM\ManyToMany(targetEntity="Sicc\Bundle\AdminBundle\Entity\GroupeMembre", inversedBy="membres")
     * @ORM\JoinTable(name="membresgroupes_membres")
     */
    private $groupes;


    public function __construct()
    {
        parent::__construct();
        $this->groupes = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * @param mixed $civilite
     */
    public function setCivilite($civilite)
    {
        $this->civilite = $civilite;
    }

    /**
     * @return mixed
     */
    public function getCivilite()
    {
        return $this->civilite;
    }

    /**
     * @param string $prenom
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;
    }

    /**
     * @return string
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * @param string $societe
     */
    public function setSociete($societe)
    {
        $this->societe = $societe;
    }

    /**
     * @return string
     */
    public function getSociete()
    {
        return $this->societe;
    }

    public function getGroupes(){
        return $this->groupes;
    }
}