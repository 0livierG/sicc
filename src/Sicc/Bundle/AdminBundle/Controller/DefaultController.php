<?php

namespace Sicc\Bundle\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        // Si le visiteur n'est pas identifié, on le redirige vers la page de login
        if (!$this->get('security.context')->isGranted('IS_AUTHENTICATED_REMEMBERED')) {
            return $this->redirect($this->generateUrl('login'));
        }

        $em = $this->getDoctrine()->getManager();

        $countArticles = $em->getRepository('SiccAdminBundle:Article')->findOneByCounted();
        $countRealisations = $em->getRepository('SiccAdminBundle:Realisation')->findOneByCounted();



        return $this->render('SiccAdminBundle:Default:index.html.twig',array('nbr_articles'=>$countArticles,
                                                                             'nbr_realisations'=>$countRealisations
                                                                            ));
    }
}
