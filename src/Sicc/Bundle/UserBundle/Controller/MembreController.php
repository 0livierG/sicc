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

        $userManager = $this->get('fos_user.user_manager');
        $entities=$userManager->findUsers();
        return array(
            'entities' =>$entities,
        );
    }
}
