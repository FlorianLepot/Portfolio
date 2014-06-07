<?php

namespace FL\FilesBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use FL\FilesBundle\Entity\Year;
use FL\FilesBundle\Form\YearType;

/**
 * Year controller.
 *
 * @Route("/admin/years")
 */
class AdminYearController extends Controller
{

    /**
     * Lists all Year entities.
     *
     * @Route("/", name="admin_years")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('FLFilesBundle:Year')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new Year entity.
     *
     * @Route("/", name="admin_years_create")
     * @Method("POST")
     * @Template("FLFilesBundle:AdminYear:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Year();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('admin_years_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
    * Creates a form to create a Year entity.
    *
    * @param Year $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(Year $entity)
    {
        $form = $this->createForm(new YearType(), $entity, array(
            'action' => $this->generateUrl('admin_years_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Year entity.
     *
     * @Route("/new", name="admin_years_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Year();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Year entity.
     *
     * @Route("/{id}", name="admin_years_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('FLFilesBundle:Year')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Year entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Year entity.
     *
     * @Route("/{id}/edit", name="admin_years_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('FLFilesBundle:Year')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Year entity.');
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
    * Creates a form to edit a Year entity.
    *
    * @param Year $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Year $entity)
    {
        $form = $this->createForm(new YearType(), $entity, array(
            'action' => $this->generateUrl('admin_years_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Year entity.
     *
     * @Route("/{id}", name="admin_years_update")
     * @Method("PUT")
     * @Template("FLFilesBundle:AdminYear:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('FLFilesBundle:Year')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Year entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('admin_years_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Year entity.
     *
     * @Route("/{id}", name="admin_years_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('FLFilesBundle:Year')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Year entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('admin_years'));
    }

    /**
     * Creates a form to delete a Year entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_years_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
