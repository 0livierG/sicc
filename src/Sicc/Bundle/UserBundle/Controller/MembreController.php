<?php

namespace Sicc\Bundle\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FOS\UserBundle\Model\UserManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class MembreController extends Controller
{
    /**
     * Lists all Membre fos entities.
     *
     * @Route("/", name="admin_membre")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        //return $this->render('SiccUserBundle:Membre:index.html.twig');7
        /*$userManager*/
        $userManager = $this->get('fos_user.user_manager');
        $entities=$userManager->findUsers();
       // var_dump($entities);
        return array(
            'entities' =>$entities,
        );
    }
}
