<?php

namespace Sicc\Bundle\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sicc\Bundle\AdminBundle\Entity\Article;
use Sicc\Bundle\AdminBundle\Entity\Realisation;
use Sicc\Bundle\UserBundle\Entity\Member;

class DefaultController extends Controller
{
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $members = $em->getRepository('SiccUserBundle:Member')->findall();
        $nbr_members = $this->countEntriesInArray($members);


        $nbr_articles = $em->getRepository('SiccAdminBundle:Article')->findByCounted();
        $nbr_realisations = $em->getRepository('SiccAdminBundle:Realisation')->findByCounted();

        return $this->render('SiccAdminBundle:Default:index.html.twig',array('nbr_article'=>$nbr_articles,'nbr_realisation'=>$nbr_realisations,'nbr_member'=>$nbr_members));
    }

    private function countEntriesInArray($array){
        $i = 0;
        foreach($array as $line){
            $i++;
        }
        return $i;
    }
}
