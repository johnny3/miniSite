<?php

namespace John\AdminBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use John\AdminBundle\Entity\SubCategory;
use John\AdminBundle\Form\SubCategoryType;

/**
 * SubCategory controller.
 *
 * @Route("/subcategory_admin")
 */
class SubCategoryAdminController extends Controller {

    /**
     * Lists all SubCategory entities.
     *
     * @Template("JohnAdminBundle:SubCategoryAdmin:list.html.twig")
     */
    public function listAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('JohnAdminBundle:Category')->getCategoryOrSubCategoryExceptContact();

        return array(
            'entities' => $entities,
        );
    }
    
    public function subCategoriesByCategoryWithPositionAction($category)
    {
        $subCategories = $this->getDoctrine()
                ->getRepository('JohnAdminBundle:SubCategory')
                ->getSubCategoriesByCategory($category);


        return $this->container->get('templating')
                        ->renderResponse('JohnAdminBundle:SubCategoryAdmin:subCategoriesByCategoryWithPosition.html.twig', array(
                            'subCategories' => $subCategories,
                                )
        );
    }

    /**
     * Lists all SubCategory entities.
     *
     * @Route("/list", name="subcategory_admin")
     * @Template("JohnAdminBundle:SubCategoryAdmin:index.html.twig")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('JohnAdminBundle:SubCategory')->getSubCategoriesByCategoryAndPositionOrder();

        return array(
            'entities' => $entities,
        );
    }

    /**
     * Finds and displays a SubCategory entity.
     *
     * @Route("/{id}/show", name="subcategory_admin_show")
     * @Template("JohnAdminBundle:SubCategoryAdmin:show.html.twig")
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('JohnAdminBundle:SubCategory')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find SubCategory entity.');
        }

        return array(
            'entity' => $entity,
        );
    }

    /**
     * Displays a form to create a new SubCategory entity.
     *
     * @Route("/new", name="subcategory_admin_new")
     * @Template("JohnAdminBundle:SubCategoryAdmin:new.html.twig")
     */
    public function newAction()
    {
        $entity = new SubCategory();
        $form = $this->createForm(new SubCategoryType(), $entity);

        return array(
            'entity' => $entity,
            'form' => $form->createView(),
        );
    }

    /**
     * Creates a new SubCategory entity.
     *
     * @Route("/create", name="subcategory_admin_create")
     * @Method("POST")
     * @Template("JohnAdminBundle:SubCategoryAdmin:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new SubCategory();
        $form = $this->createForm(new SubCategoryType(), $entity);
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

            return $this->redirect($this->generateUrl('subcategory_admin_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form' => $form->createView(),
        );
    }

    /**
     * Displays a form to edit an existing SubCategory entity.
     *
     * @Route("/{id}/edit", name="subcategory_admin_edit")
     * @Template("JohnAdminBundle:SubCategoryAdmin:edit.html.twig")
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('JohnAdminBundle:SubCategory')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find SubCategory entity.');
        }

        $editForm = $this->createForm(new SubCategoryType(), $entity);

        return array(
            'entity' => $entity,
            'edit_form' => $editForm->createView(),
        );
    }

    /**
     * Edits an existing SubCategory entity.
     *
     * @Route("/{id}/update", name="subcategory_admin_update")
     * @Method("POST")
     * @Template("JohnAdminBundle:SubCategoryAdmin:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('JohnAdminBundle:SubCategory')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find SubCategory entity.');
        }

        $editForm = $this->createForm(new SubCategoryType(), $entity);
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
                return $this->redirect($this->generateUrl('article_admin_edit', array('id' => $id)));
            } else {
                $entity->setPicture(NULL);
            }

            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('subcategory_admin_show', array('id' => $id)));
        }

        return array(
            'entity' => $entity,
            'edit_form' => $editForm->createView(),
        );
    }

    /**
     * Deletes a SubCategory entity.
     *
     * @Route("/{id}/delete", name="subcategory_admin_delete")
     */
    public function deleteAction($id)
    {

        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('JohnAdminBundle:SubCategory')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find SubCategory entity.');
        }

        $em->remove($entity);
        $em->flush();

        return $this->redirect($this->generateUrl('subcategory_admin'));
    }

}
