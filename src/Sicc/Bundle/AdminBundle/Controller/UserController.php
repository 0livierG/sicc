<?php

namespace Sicc\Bundle\AdminBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sicc\Bundle\UserBundle\Entity\Member;


/**
 * User controller.
 *
 * @Route("/User")
 */
class UserController extends Controller
{

    /**
     * Lists all Article entities.
     *
     * @Route("/", name="admin_user_index")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('SiccUserBundle:Member')->findAll();

        return array(
            'entities' => $entities,
        );
    }
}