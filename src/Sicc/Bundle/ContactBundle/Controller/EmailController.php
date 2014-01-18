<?php

namespace Sicc\Bundle\ContactBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sicc\Bundle\ContactBundle\Entity\Email;
use Sicc\Bundle\ContactBundle\Form\EmailType;

/**
 * Email controller.
 *
 * @Route("/email")
 */
class EmailController extends Controller
{


    /**
     * Creates a new Email entity.
     *
     * @Route("/", name="email_create")
     * @Method("POST")
     * @Template("SiccContactBundle:Email:contact.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Email();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {

            $message = \Swift_Message::newInstance()
                ->setSubject('Mail envoyé depuis Sicc.fr')
                ->setFrom('enquiries@symblog.co.uk')
                ->setTo('thomaschvt@gmail.com')
                ->setBody($this->renderView('SiccContactBundle:Email:email.txt.twig', array('email' => $entity)));
            $this->get('mailer')->send($message);

            $this->get('session')->getFlashBag()->add('success', 'Votre demande de contact a bien été envoyée.');

            // Redirect - This is important to prevent users re-posting
            // the form if they refresh the page
            return $this->redirect($this->generateUrl('sicc_contact'));

        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
    * Creates a form to create a Email entity.
    *
    * @param Email $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(Email $entity)
    {
        $form = $this->createForm(new EmailType(), $entity, array(
            'action' => $this->generateUrl('sicc_contact_envoi'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Email entity.
     *
     * @Route("/new", name="sicc_contact_envoi")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Email();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }
}
