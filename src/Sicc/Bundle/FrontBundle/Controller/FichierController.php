<?php

namespace Sicc\Bundle\FrontBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sicc\Bundle\AdminBundle\Entity\Fichier;

class FichierController extends Controller
{
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $user = $this->get('security.context')->getToken()->getUser();
        $userGroupe = $user->getGroupe();

        $fichier = $userGroupe->getFichiers();




        return $this->render('SiccFrontBundle:Fichier:index.html.twig',array('fichiers'=>$fichier));

    }
}
