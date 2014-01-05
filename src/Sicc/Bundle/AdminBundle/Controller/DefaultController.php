<?php

namespace Sicc\Bundle\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $countArticles = $em->getRepository('SiccAdminBundle:Article')->findOneByCounted();
        $countRealisations = $em->getRepository('SiccAdminBundle:Realisation')->findOneByCounted();
        $countFichiers = $em->getRepository('SiccAdminBundle:Realisation')->findOneByCounted();



        return $this->render('SiccAdminBundle:Default:index.html.twig',array('nbr_articles'=>$countArticles,
                                                                             'nbr_realisations'=>$countRealisations
                                                                            ));
    }
}
