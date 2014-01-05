<?php

namespace Sicc\Bundle\AdminBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sicc\Bundle\AdminBundle\Entity\GroupeMembre;
use Sicc\Bundle\AdminBundle\Form\GroupeMembreType;

/**
 * GroupeMembre controller.
 *
 * @Route("/admin_groupemembre")
 */
class GroupeMembreController extends Controller
{

    /**
     * Lists all GroupeMembre entities.
     *
     * @Route("/", name="admin_groupemembre")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('SiccAdminBundle:GroupeMembre')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new GroupeMembre entity.
     *
     * @Route("/", name="admin_groupemembre_create")
     * @Method("POST")
     * @Template("SiccAdminBundle:GroupeMembre:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new GroupeMembre();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('admin_groupemembre_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
    * Creates a form to create a GroupeMembre entity.
    *
    * @param GroupeMembre $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(GroupeMembre $entity)
    {
        $form = $this->createForm(new GroupeMembreType(), $entity, array(
            'action' => $this->generateUrl('admin_groupemembre_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new GroupeMembre entity.
     *
     * @Route("/new", name="admin_groupemembre_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new GroupeMembre();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a GroupeMembre entity.
     *
     * @Route("/{id}", name="admin_groupemembre_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SiccAdminBundle:GroupeMembre')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find GroupeMembre entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing GroupeMembre entity.
     *
     * @Route("/{id}/edit", name="admin_groupemembre_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SiccAdminBundle:GroupeMembre')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find GroupeMembre entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
    * Creates a form to edit a GroupeMembre entity.
    *
    * @param GroupeMembre $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(GroupeMembre $entity)
    {
        $form = $this->createForm(new GroupeMembreType(), $entity, array(
            'action' => $this->generateUrl('admin_groupemembre_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing GroupeMembre entity.
     *
     * @Route("/{id}", name="admin_groupemembre_update")
     * @Method("PUT")
     * @Template("SiccAdminBundle:GroupeMembre:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SiccAdminBundle:GroupeMembre')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find GroupeMembre entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('admin_groupemembre_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a GroupeMembre entity.
     *
     * @Route("/{id}", name="admin_groupemembre_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('SiccAdminBundle:GroupeMembre')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find GroupeMembre entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('admin_groupemembre'));
    }

    /**
     * Creates a form to delete a GroupeMembre entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_groupemembre_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
