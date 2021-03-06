<?php

namespace John\SiteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use John\AdminBundle\Entity\SubCategory;

/**
 * SubCategory controller.
 *
 * @Route("/subcategory")
 */
class SubCategoryController extends Controller {

    /**
     * Finds and displays a SubCategory entity.
     *
     * @Route("/{slug}", name="subcategory_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($slug)
    {
        $em = $this->getDoctrine()->getManager();

        $subCategory = $em->getRepository('JohnAdminBundle:SubCategory')->findOneBySlug($slug);
        
        $articlesBySubCategory = $this->getDoctrine()
                ->getRepository('JohnAdminBundle:Article')
                ->getArticlesBySubCategory($subCategory);
        
        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
                $articlesBySubCategory, $this->get('request')->query->get('page', 1)/* page number */, 6/* limit per page */
        );

        $totalPages = ceil($pagination->getTotalItemCount() / $pagination->getItemNumberPerPage());

        if (!$subCategory) {
            throw $this->createNotFoundException('Unable to find SubCategory entity.');
        }

        // pas d'articles, on affiche son titre et son body
        if (!$articlesBySubCategory) {
            return array(
                'subCategory' => $subCategory,
            );
        }

        // sinon, on retourne sa liste paginée d'articles
        return array(
            'subCategory' => $subCategory,
            'articles' => $pagination,
            'totalPages' => $totalPages
        );
    }
    
    
    public function subCategoriesByCategoryWithPositionAction($slug)
    {
        $em = $this->getDoctrine()->getManager();

        $category = $em->getRepository('JohnAdminBundle:Category')->findOneBySlug($slug);
        
        $subCategories = $this->getDoctrine()
                ->getRepository('JohnAdminBundle:SubCategory')
                ->getSubCategoriesByCategory($category);

        if (!$category) {
            throw $this->createNotFoundException('Unable to find category entity.');
        }
        
        return $this->container->get('templating')
                        ->renderResponse('JohnAdminBundle:SubCategory:subCategoriesByCategoryWithPosition.html.twig', array(
                            'subCategories' => $subCategories,
                                )
        );
    }

}
