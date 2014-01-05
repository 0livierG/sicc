<?php

namespace Sicc\Bundle\AdminBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sicc\Bundle\AdminBundle\Entity\Realisation;
use Sicc\Bundle\AdminBundle\Form\RealisationType;

/**
 * Realisation controller.
 *
 * @Route("/admin_realisation")
 */
class RealisationController extends Controller
{

    /**
     * Lists all Realisation entities.
     *
     * @Route("/", name="admin_realisation")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('SiccAdminBundle:Realisation')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new Realisation entity.
     *
     * @Route("/", name="admin_realisation_create")
     * @Method("POST")
     * @Template("SiccAdminBundle:Realisation:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Realisation();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            //upload d'img
            //on définit le dossier ou envoyer les images
            $dir = "img/realisations";

            //on recupère le nom original du fichier
            $nomBase = $form['illustration']->getData()->getClientOriginalName();
            //on découpe le nom du fichier pr recup l'extension
            $extension=strrchr($nomBase,'.');
            $extension=substr($extension,1) ;
            //on génère le nouveau nom du fichier
            $randNom = rand(0,1000000);
            $dateNom = time();
            $NewNom = 'img_'.$randNom.$dateNom.'.'.$extension;
            //chemin a stocker pour récupère l'image
            $pathImg = 'img/realisations/'.$NewNom;
            //upload de l'image avec son nouveau nom
            $form['illustration']->getData()->move($dir, $NewNom);

            $entity->setIllustration($NewNom);

            $em->persist($entity);

            $em->flush();

            return $this->redirect($this->generateUrl('admin_realisation_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
    * Creates a form to create a Realisation entity.
    *
    * @param Realisation $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(Realisation $entity)
    {
        $form = $this->createForm(new RealisationType(), $entity, array(
            'action' => $this->generateUrl('admin_realisation_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Realisation entity.
     *
     * @Route("/new", name="admin_realisation_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Realisation();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Realisation entity.
     *
     * @Route("/{id}", name="admin_realisation_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SiccAdminBundle:Realisation')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Realisation entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Realisation entity.
     *
     * @Route("/{id}/edit", name="admin_realisation_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SiccAdminBundle:Realisation')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Realisation entity.');
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
    * Creates a form to edit a Realisation entity.
    *
    * @param Realisation $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Realisation $entity)
    {
        $form = $this->createForm(new RealisationType(), $entity, array(
            'action' => $this->generateUrl('admin_realisation_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Realisation entity.
     *
     * @Route("/{id}", name="admin_realisation_update")
     * @Method("PUT")
     * @Template("SiccAdminBundle:Realisation:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SiccAdminBundle:Realisation')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Realisation entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            //upload d'img
            //on définit le dossier ou envoyer les images
            $dir = "img/realisations";

            //on recupère le nom original du fichier
            $nomBase = $editForm['illustration']->getData()->getClientOriginalName();
            //on découpe le nom du fichier pr recup l'extension
            $extension=strrchr($nomBase,'.');
            $extension=substr($extension,1) ;
            //on génère le nouveau nom du fichier
            $randNom = rand(0,1000000);
            $dateNom = time();
            $NewNom = 'img_'.$randNom.$dateNom.'.'.$extension;
            //chemin a stocker pour récupère l'image
            $pathImg = 'img/realisations/'.$NewNom;
            //upload de l'image avec son nouveau nom
            $editForm['illustration']->getData()->move($dir, $NewNom);

            $entity->setIllustration($NewNom);

            $em->persist($entity);

            $em->flush();

            return $this->redirect($this->generateUrl('admin_realisation_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Realisation entity.
     *
     * @Route("/{id}", name="admin_realisation_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('SiccAdminBundle:Realisation')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Realisation entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('admin_realisation'));
    }

    /**
     * Creates a form to delete a Realisation entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_realisation_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
