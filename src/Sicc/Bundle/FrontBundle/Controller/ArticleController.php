<?php

namespace Sicc\Bundle\FrontBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sicc\Bundle\AdminBundle\Entity\Article;

class ArticleController extends Controller
{
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();


        $entities = $em->getRepository('SiccAdminBundle:Article')->findAll();
        return $this->render('SiccFrontBundle:Article:article.html.twig',array('articles'=>$entities));

    }

    public function focusAction($path)
    {
        $em = $this->getDoctrine()->getManager();

        $entityFocus = $em->getRepository('SiccAdminBundle:Article')->findOneByPath($path);
        $entity = $em->getRepository('SiccAdminBundle:Article')->findByIdDesc();

        return $this->render('SiccFrontBundle:Article:focus.html.twig',array('articles'=>$entity, 'focus'=>$entityFocus));
    }
}
