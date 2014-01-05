<?php

namespace Sicc\Bundle\FrontBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('SiccFrontBundle:Default:index.html.twig');
    }
}
