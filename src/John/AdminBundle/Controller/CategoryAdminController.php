<?php

namespace John\AdminBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use John\AdminBundle\Entity\Category;
use John\AdminBundle\Form\CategoryType;

/**
 * Category controller.
 *
 * @Route("/category_admin")
 */
class CategoryAdminController extends Controller {

    /**
     * Lists all Category entities.
     *
     * @Template("JohnAdminBundle:CategoryAdmin:list.html.twig")
     */
    public function listAction()
    {
        $em = $this->getDoctrine()->getManager();

        $withContact = false;
        $entities = $em->getRepository('JohnAdminBundle:Category')->getVisibleCategories($withContact);

        return array(
            'entities' => $entities,
        );
    }
    
    /**
     * Lists all Category entities.
     *
     * @Route("/list", name="category_admin")
     * @Template("JohnAdminBundle:CategoryAdmin:index.html.twig")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('JohnAdminBundle:Category')->getCategoriesByPosition();

        return array(
            'entities' => $entities,
        );
    }

    /**
     * Finds and displays a Category entity.
     *
     * @Route("/{id}/show", name="category_admin_show")
     * @Template("JohnAdminBundle:CategoryAdmin:show.html.twig")
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('JohnAdminBundle:Category')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Category entity.');
        }

        return array(
            'entity' => $entity,
        );
    }

    /**
     * Displays a form to create a new Category entity.
     *
     * @Route("/new", name="category_admin_new")
     * @Template("JohnAdminBundle:CategoryAdmin:new.html.twig")
     */
    public function newAction()
    {
        $entity = new Category();
        $form = $this->createForm(new CategoryType(), $entity);

        return array(
            'entity' => $entity,
            'form' => $form->createView(),
        );
    }

    /**
     * Creates a new Category entity.
     *
     * @Route("/create", name="category_admin_create")
     * @Method("POST")
     * @Template("JohnAdminBundle:CategoryAdmin:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Category();
        $form = $this->createForm(new CategoryType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $isPictureValueForm = $form->getData()->getIsPicture();
            $fileValueForm = $form->getData()->file;

            if ($isPictureValueForm && !empty($fileValueForm)) {
                $entity->uploadProfilePicture();
            } elseif ($isPictureValueForm && empty($fileValueForm)) {
                $this->get('session')->getFlashBag()->add('error', 'Vous avez indiqué avoir une image principale mais n\'en avez pas sélectionnée.');
                return array(
                    'entity' => $entity,
                    'form' => $form->createView(),
                );
            } else {
                $entity->setPicture(NULL);
            }

            $em->persist($entity);

            $em->flush();

            return $this->redirect($this->generateUrl('category_admin_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form' => $form->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Category entity.
     *
     * @Route("/{id}/edit", name="category_admin_edit")
     * @Template("JohnAdminBundle:CategoryAdmin:edit.html.twig")
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('JohnAdminBundle:Category')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Category entity.');
        }

        $editForm = $this->createForm(new CategoryType(), $entity);

        return array(
            'entity' => $entity,
            'edit_form' => $editForm->createView(),
        );
    }

    /**
     * Edits an existing Category entity.
     *
     * @Route("/{id}/update", name="category_admin_update")
     * @Method("POST")
     * @Template("JohnAdminBundle:CategoryAdmin:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('JohnAdminBundle:Category')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Category entity.');
        }

        $editForm = $this->createForm(new CategoryType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $isPictureValueForm = $editForm->getData()->getIsPicture();
            $fileValueForm = $editForm->getData()->file;

            if ($isPictureValueForm && NULL !== $entity->getPicture() && !empty($fileValueForm)) {
                $entity->uploadProfilePicture();
            } elseif ($isPictureValueForm && NULL !== $entity->getPicture() && empty($fileValueForm)) {
                $entity->setPicture($entity->getPicture());
            } elseif ($isPictureValueForm && NULL === $entity->getPicture() && !empty($fileValueForm)) {
                $entity->uploadProfilePicture();
            } elseif ($isPictureValueForm && NULL === $entity->getPicture() && empty($fileValueForm)) {
                $this->get('session')->getFlashBag()->add('error', 'Vous avez indiqué avoir une image principale mais n\'en avez pas sélectionnée.');
                return $this->redirect($this->generateUrl('category_admin_edit', array('id' => $id)));
            } else {
                $entity->setPicture(NULL);
            }

            $em->persist($entity);

            $em->flush();

            return $this->redirect($this->generateUrl('category_admin_show', array('id' => $id)));
        }

        return array(
            'entity' => $entity,
            'edit_form' => $editForm->createView(),
        );
    }

    /**
     * Deletes a Category entity.
     *
     * @Route("/{id}/delete", name="category_admin_delete")
     */
    public function deleteAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('JohnAdminBundle:Category')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Category entity.');
        }

        $em->remove($entity);
        $em->flush();

        return $this->redirect($this->generateUrl('category_admin'));
    }
}
