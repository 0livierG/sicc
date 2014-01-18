<?php

namespace Sicc\Bundle\ContactBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Mapping\ClassMetadata;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Email as ValidatorEmail;
use Symfony\Component\Validator\Constraints\MinLenght;
use Symfony\Component\Validator\Constraints\MaxLength;

/**
 * Email
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Email
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
     * @ORM\Column(name="nom", type="string", length=255)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="prenom", type="string", length=255)
     */
    private $prenom;

    /**
     * @var string
     *
     * @ORM\Column(name="telephone", type="string", length=10)
     */
    private $telephone;

    /**
     * @var string
     *
     * @ORM\Column(name="civilite", type="string", length=10)
     */
    private $civilite;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="objet", type="string", length=255)
     */
    private $objet;

    /**
     * @var string
     *
     * @ORM\Column(name="contenu", type="text")
     */
    private $contenu;


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
     * Set nom
     *
     * @param string $nom
     * @return Email
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string 
     */
    public function getNom()
    {
        return $this->nom;
    }


    public function getPrenom()
    {
        return $this->prenom;
    }

    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getTelephone()
    {
        return $this->telephone;
    }

    public function setTelephone($telephone)
    {
        $this->telephone = $telephone;

        return $this;
    }

    public function getCivilite()
    {
        return $this->civilite;
    }

    public function setCivilite($civilite)
    {
        $this->civilite = $civilite;

        return $this;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return Email
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string 
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set objet
     *
     * @param string $objet
     * @return Email
     */
    public function setObjet($objet)
    {
        $this->objet = $objet;

        return $this;
    }

    /**
     * Get objet
     *
     * @return string 
     */
    public function getObjet()
    {
        return $this->objet;
    }

    /**
     * Set contenu
     *
     * @param string $contenu
     * @return Email
     */
    public function setContenu($contenu)
    {
        $this->contenu = $contenu;

        return $this;
    }



    /**
     * Get contenu
     *
     * @return string 
     */
    public function getContenu()
    {
        return $this->contenu;
    }

    public static function loadValidatorMetadata(ClassMetadata $metadata)
    {
        $metadata->addPropertyConstraint('nom', new NotBlank(array(
            'message' => 'Ce champ ne peut pas être vide'
        )));

        $metadata->addPropertyConstraint('prenom', new NotBlank(array(
            'message' => 'Ce champ ne peut pas être vide'
        )));

        $metadata->addPropertyConstraint('civilite', new NotBlank(array(
            'message' => 'Ce champ ne peut pas être vide'
        )));

        $metadata->addPropertyConstraint('email', new ValidatorEmail(array(
            'message' => "Cette adresse email n'est pas valide. Veuillez en rensignez une."
        )));

        $metadata->addPropertyConstraint('objet', new NotBlank());

    }
}
