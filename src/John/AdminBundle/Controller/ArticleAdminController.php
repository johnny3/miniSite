<?php

namespace John\AdminBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use John\AdminBundle\Entity\Article;
use John\AdminBundle\Form\ArticleType;

/**
 * Article controller.
 *
 * @Route("/article_admin")
 */
class ArticleAdminController extends Controller
{
    /**
     * Lists all Article entities.
     *
     * @Route("/list", name="article_admin")
     * @Template("JohnAdminBundle:ArticleAdmin:index.html.twig")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('JohnAdminBundle:Article')->findAllBySubCategoryASCAndTitleASC();

        return array(
            'entities' => $entities,
        );
    }

    /**
     * Finds and displays a Article entity.
     *
     * @Route("/{id}/show", name="article_admin_show")
     * @Template("JohnAdminBundle:ArticleAdmin:show.html.twig")
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('JohnAdminBundle:Article')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Article entity.');
        }

        return array(
            'article' => $entity,
        );
    }

    /**
     * Displays a form to create a new Article entity.
     *
     * @Route("/new/{id}/{type}", name="article_admin_new")
     * @Template("JohnAdminBundle:ArticleAdmin:new.html.twig")
     */
    public function newAction($id, $type)
    {
        $entity = new Article();

        if (null != $id && null != $type) {
            if ('category' == $type) {
                $em = $this->getDoctrine()->getManager();
                $category = $em->getRepository('JohnAdminBundle:Category')->find($id);
                $entity->setCategory($category);
            }
            elseif ('subcategory' == $type) {
                $em = $this->getDoctrine()->getManager();
                $subCategory = $em->getRepository('JohnAdminBundle:SubCategory')->find($id);
                $entity->setSubCategory($subCategory);
            }
        }

        $form = $this->createForm(new ArticleType(), $entity);

        return array(
            'entity' => $entity,
            'form' => $form->createView(),
        );
    }

    /**
     * Creates a new Article entity.
     *
     * @Route("/create", name="article_admin_create")
     * @Method("POST")
     * @Template("JohnAdminBundle:ArticleAdmin:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Article();
        $form = $this->createForm(new ArticleType(), $entity);
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

            return $this->redirect($this->generateUrl('article_admin_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form' => $form->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Article entity.
     *
     * @Route("/{id}/edit", name="article_admin_edit")
     * @Template("JohnAdminBundle:ArticleAdmin:edit.html.twig")
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('JohnAdminBundle:Article')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Article entity.');
        }

        $editForm = $this->createForm(new ArticleType(), $entity);

        return array(
            'entity' => $entity,
            'edit_form' => $editForm->createView(),
        );
    }

    /**
     * Edits an existing Article entity.
     *
     * @Route("/{id}/update", name="article_admin_update")
     * @Method("POST")
     * @Template("JohnAdminBundle:ArticleAdmin:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('JohnAdminBundle:Article')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Article entity.');
        }

        $editForm = $this->createForm(new ArticleType(), $entity);
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

            return $this->redirect($this->generateUrl('article_admin_show', array('id' => $id)));
        }

        return array(
            'entity' => $entity,
            'edit_form' => $editForm->createView(),
        );
    }

    /**
     * Deletes a Article entity.
     *
     * @Route("/{id}/delete", name="article_admin_delete")
     */
    public function deleteAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('JohnAdminBundle:Article')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Article entity.');
        }

        $em->remove($entity);
        $em->flush();

        return $this->redirect($this->generateUrl('article_admin'));
    }

}