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
     * @ORM\ManyToOne(targetEntity="Sicc\Bundle\AdminBundle\Entity\GroupeMembre", inversedBy="membres")
     * @ORM\JoinColumn(name="groupe_id", referencedColumnName="id")
     */
    protected $groupe;

    public function __construct() {
        parent::__construct();

    }

    public function setGroupe($groupe){
        $this->groupe = $groupe;
    }

    public function getGroupe(){
        return $this->groupe;
    }


}