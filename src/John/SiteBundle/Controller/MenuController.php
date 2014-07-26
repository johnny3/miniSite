<?php

namespace John\SiteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class MenuController extends Controller {

    public function menuAction()
    {
        $manager = $this->getDoctrine()
                ->getManager();
        $withContact = true;
        $categoriesWithArticles = $manager->getRepository('JohnAdminBundle:Category')->getVisibleCategories($withContact);
        $contactCat = $manager->getRepository('JohnAdminBundle:Category')->getContactCategory();

        return $this->container->get('templating')
                        ->renderResponse('JohnSiteBundle:Menu:menu.html.twig', array(
                            'categoriesWithArticles'    => $categoriesWithArticles,
                            'contactCat'                => $contactCat
                                )
        );
    }

}
