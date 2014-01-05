<?php

namespace Sicc\Bundle\AdminBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sicc\Bundle\AdminBundle\Entity\Fichier;
use Sicc\Bundle\AdminBundle\Form\FichierType;

/**
 * Fichier controller.
 *
 * @Route("/admin_fichier")
 */
class FichierController extends Controller
{

    /**
     * Lists all Fichier entities.
     *
     * @Route("/", name="admin_fichier")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('SiccAdminBundle:Fichier')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new Fichier entity.
     *
     * @Route("/", name="admin_fichier_create")
     * @Method("POST")
     * @Template("SiccAdminBundle:Fichier:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Fichier();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            //upload d'img
            //on définit le dossier ou envoyer les images
            $dir = "fichiers";

            //on recupère le nom original du fichier
            $nomBase = $form['url']->getData()->getClientOriginalName();
            //on découpe le nom du fichier pr recup l'extension
            $extension=strrchr($nomBase,'.');
            $extension=substr($extension,1) ;
            //on génère le nouveau nom du fichier
            $randNom = rand(0,1000000);
            $dateNom = time();
            $NewNom = 'pdf_'.$randNom.$dateNom.'.'.$extension;
            //chemin a stocker pour récupère l'image
            $pathImg = 'fichiers/'.$NewNom;
            //upload de l'image avec son nouveau nom
            $form['url']->getData()->move($dir, $NewNom);

            $entity->setUrl($NewNom);

            $em->persist($entity);
            $em->flush();


            return $this->redirect($this->generateUrl('admin_fichier_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
    * Creates a form to create a Fichier entity.
    *
    * @param Fichier $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(Fichier $entity)
    {
        $form = $this->createForm(new FichierType(), $entity, array(
            'action' => $this->generateUrl('admin_fichier_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Fichier entity.
     *
     * @Route("/new", name="admin_fichier_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Fichier();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Fichier entity.
     *
     * @Route("/{id}", name="admin_fichier_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SiccAdminBundle:Fichier')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Fichier entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Fichier entity.
     *
     * @Route("/{id}/edit", name="admin_fichier_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SiccAdminBundle:Fichier')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Fichier entity.');
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
    * Creates a form to edit a Fichier entity.
    *
    * @param Fichier $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Fichier $entity)
    {
        $form = $this->createForm(new FichierType(), $entity, array(
            'action' => $this->generateUrl('admin_fichier_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Fichier entity.
     *
     * @Route("/{id}", name="admin_fichier_update")
     * @Method("PUT")
     * @Template("SiccAdminBundle:Fichier:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SiccAdminBundle:Fichier')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Fichier entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            //upload d'img
            //on définit le dossier ou envoyer les images
            $dir = "fichiers";

            //on recupère le nom original du fichier
            $nomBase = $editForm['url']->getData()->getClientOriginalName();
            //on découpe le nom du fichier pr recup l'extension
            $extension=strrchr($nomBase,'.');
            $extension=substr($extension,1) ;
            //on génère le nouveau nom du fichier
            $randNom = rand(0,1000000);
            $dateNom = time();
            $NewNom = 'pdf_'.$randNom.$dateNom.'.'.$extension;
            //chemin a stocker pour récupère l'image
            $pathImg = 'fichiers/'.$NewNom;
            //upload de l'image avec son nouveau nom
            $editForm['url']->getData()->move($dir, $NewNom);

            $entity->setUrl($NewNom);

            $em->persist($entity);

            $em->flush();

            return $this->redirect($this->generateUrl('admin_fichier_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Fichier entity.
     *
     * @Route("/{id}", name="admin_fichier_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('SiccAdminBundle:Fichier')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Fichier entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('admin_fichier'));
    }

    /**
     * Creates a form to delete a Fichier entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_fichier_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
