<?php

namespace Sicc\Bundle\FrontBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sicc\Bundle\AdminBundle\Entity\Fichier;

class FichierController extends Controller
{
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();


        $entities = $em->getRepository('SiccAdminBundle:Fichier')->findAll();
        return $this->render('SiccFrontBundle:Fichier:index.html.twig',array('fichiers'=>$entities));

    }
}
