<?php

namespace Sicc\Bundle\AdminBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Sicc\Bundle\AdminBundle\Entity\Diaporama;
use Sicc\Bundle\AdminBundle\Form\DiaporamaType;

/**
 * Diaporama controller.
 *
 */
class DiaporamaController extends Controller
{

    /**
     * Lists all Diaporama entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('SiccAdminBundle:Diaporama')->findAll();

        return $this->render('SiccAdminBundle:Diaporama:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new Diaporama entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Diaporama();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('admin_diaporama_show', array('id' => $entity->getId())));
        }

        return $this->render('SiccAdminBundle:Diaporama:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
    * Creates a form to create a Diaporama entity.
    *
    * @param Diaporama $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(Diaporama $entity)
    {
        $form = $this->createForm(new DiaporamaType(), $entity, array(
            'action' => $this->generateUrl('admin_diaporama_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Valider'));

        return $form;
    }

    /**
     * Displays a form to create a new Diaporama entity.
     *
     */
    public function newAction()
    {
        $entity = new Diaporama();
        $form   = $this->createCreateForm($entity);

        return $this->render('SiccAdminBundle:Diaporama:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Diaporama entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SiccAdminBundle:Diaporama')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Diaporama entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('SiccAdminBundle:Diaporama:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        ));
    }

    /**
     * Displays a form to edit an existing Diaporama entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SiccAdminBundle:Diaporama')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Diaporama entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('SiccAdminBundle:Diaporama:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Diaporama entity.
    *
    * @param Diaporama $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Diaporama $entity)
    {
        $form = $this->createForm(new DiaporamaType(), $entity, array(
            'action' => $this->generateUrl('admin_diaporama_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Valider'));

        return $form;
    }
    /**
     * Edits an existing Diaporama entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SiccAdminBundle:Diaporama')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Diaporama entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('admin_diaporama_edit', array('id' => $id)));
        }

        return $this->render('SiccAdminBundle:Diaporama:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Diaporama entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('SiccAdminBundle:Diaporama')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Diaporama entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('diaporama'));
    }

    /**
     * Creates a form to delete a Diaporama entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_diaporama_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
