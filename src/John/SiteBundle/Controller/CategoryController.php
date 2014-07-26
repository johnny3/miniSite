<?php

namespace John\SiteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use John\AdminBundle\Entity\Category;

/**
 * Category controller.
 *
 * @Route("/category")
 */
class CategoryController extends Controller
{
    /**
     * Finds and displays a Category entity.
     *
     * @Route("/{slug}", name="category_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($slug)
    {
        $em = $this->getDoctrine()->getManager();

        $category = $em->getRepository('JohnAdminBundle:Category')->findOneBySlug($slug);

        if (!$category) {
            throw $this->createNotFoundException('Unable to find Category entity.');
        }

        $articles = $this->getDoctrine()
                ->getRepository('JohnAdminBundle:Article')
                ->getArticlesByCategory($category);

        $subCategories = $this->getDoctrine()
                ->getRepository('JohnAdminBundle:SubCategory')
                ->getSubCategoriesByCategory($category);

        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
                $articles, $this->get('request')->query->get('page', 1)/* page number */, 6/* limit per page */
        );

        $totalPages = ceil($pagination->getTotalItemCount() / $pagination->getItemNumberPerPage());

        if (!$subCategories) {
            // la catégorie n'a pas d'articles, on affiche son titre et son body
            if (!$articles) {
                return array(
                    'category' => $category
                );
            }
            // la catégorie a des articles, on affiche sa liste paginée d'articles
            else {
                return array(
                    'totalPages' => $totalPages,
                    'category' => $category,
                    'articles' => $pagination
                );
            }
        } else {
            // la catégorie n'a pas d'articles, donc on retourne simplement ses sous catégories
            if (!$articles) {
                return array(
                    'category' => $category,
                    'subCategories' => $subCategories
                );
            }
            // la catégorie a des articles
            else {
                return array(
                    'category' => $category,
                    'subCategories' => $subCategories,
                    'articles' => $pagination,
                    'totalPages' => $totalPages
                );
            }
        }

        return array(
            'category' => $category
        );
    }

}