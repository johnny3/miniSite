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
class CategoryController extends Controller {

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

        $articles = $this->getDoctrine()
                ->getRepository('JohnAdminBundle:Article')
                ->getArticlesByCategory($category);

        $subCategories = $this->getDoctrine()
                ->getRepository('JohnAdminBundle:SubCategory')
                ->getSubCategoriesByCategory($category);
        
        if (!$category) {
            throw $this->createNotFoundException('Unable to find Category entity.');
        }

        // on affiche simplement le titre et le body de la catégorie
        if (!$subCategories && !$articles) {
            return array(
                'category' => $category
            );
        }

        // la catégorie en elle-même ne contient pas d'articles, 
        // mais est composée de sous-catégories
        elseif ($subCategories && !$articles) {
            return array(
                'category' => $category,
                'subCategories' => $subCategories
            );
        }
        
        // la catégorie en elle-même contient des articles, 
        // mais n'a aucune sous-catégorie
        elseif (!$subCategories && $articles) {
            return array(
                'category' => $category,
                'articles' => $articles,
            );
        } 

        return array(
            'category' => $category,
            'articles' => $articles,
            'subCategories' => $subCategories
        );
    }

}
