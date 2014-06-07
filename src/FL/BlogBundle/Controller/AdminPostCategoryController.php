<?php

namespace FL\BlogBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use FL\BlogBundle\Entity\PostCategory;
use FL\BlogBundle\Form\PostCategoryType;

/**
 * Admin Post Category controller.
 *
 * @Route("/admin/posts/categories")
 */
class AdminPostCategoryController extends Controller
{

    /**
     * Lists all PostCategory entities.
     *
     * @Route("/", name="admin_posts_categories")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('FLBlogBundle:PostCategory')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new PostCategory entity.
     *
     * @Route("/", name="admin_posts_categories_create")
     * @Method("POST")
     * @Template("FLBlogBundle:AdminPostCategory:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new PostCategory();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('admin_posts_categories'));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
    * Creates a form to create a PostCategory entity.
    *
    * @param PostCategory $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(PostCategory $entity)
    {
        $form = $this->createForm(new PostCategoryType(), $entity, array(
            'action' => $this->generateUrl('admin_posts_categories_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new PostCategory entity.
     *
     * @Route("/new", name="admin_posts_categories_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new PostCategory();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a PostCategory entity.
     *
     * @Route("/{id}", name="admin_posts_categories_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('FLBlogBundle:PostCategory')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find PostCategory entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing PostCategory entity.
     *
     * @Route("/{id}/edit", name="admin_posts_categories_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('FLBlogBundle:PostCategory')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find PostCategory entity.');
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
    * Creates a form to edit a PostCategory entity.
    *
    * @param PostCategory $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(PostCategory $entity)
    {
        $form = $this->createForm(new PostCategoryType(), $entity, array(
            'action' => $this->generateUrl('admin_posts_categories_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing PostCategory entity.
     *
     * @Route("/{id}", name="admin_posts_categories_update")
     * @Method("PUT")
     * @Template("FLBlogBundle:AdminPostCategory:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('FLBlogBundle:PostCategory')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find PostCategory entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('admin_posts_categories_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a PostCategory entity.
     *
     * @Route("/{id}", name="admin_posts_categories_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('FLBlogBundle:PostCategory')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find PostCategory entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('admin_posts_categories'));
    }

    /**
     * Deletes a Post entity.
     *
     * @Route("/{id}/delete", name="admin_posts_categories_delete_get")
     * @Method("GET")
     */
    public function deleteGetAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('FLBlogBundle:PostCategory')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find PostCategory entity.');
        }

        $em->remove($entity);
        $em->flush();

        return $this->redirect($this->generateUrl('admin_posts_categories'));
    }
    /**
     * Creates a form to delete a PostCategory entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_posts_categories_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
