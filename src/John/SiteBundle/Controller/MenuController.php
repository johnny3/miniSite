<?php

namespace John\SiteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class MenuController extends Controller {

    public function menuAction()
    {
        $manager = $this->getDoctrine()
                ->getManager();
        $categoriesWithArticles = $manager->getRepository('JohnAdminBundle:Category')->getCategoryOrSubCategoryWithArticles();

        return $this->container->get('templating')
                        ->renderResponse('JohnSiteBundle:Menu:menu.html.twig', array(
                            'categoriesWithArticles' => $categoriesWithArticles
                                )
        );
    }

}
