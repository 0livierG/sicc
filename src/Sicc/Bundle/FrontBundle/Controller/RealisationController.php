<?php

namespace Sicc\Bundle\FrontBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sicc\Bundle\AdminBundle\Entity\Realisation;

class RealisationController extends Controller
{
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('SiccAdminBundle:Realisation')->findAll();
        return $this->render('SiccFrontBundle:Realisation:realisation.html.twig',array('realisations'=>$entities));
    }

    public function detailAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SiccAdminBundle:Realisation')->findOneById($id);

        return $this->render('SiccFrontBundle:Realisation:detail.html.twig',array('realisation'=>$entity));
    }
}
