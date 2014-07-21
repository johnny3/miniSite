<?php

namespace John\SiteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use John\AdminBundle\Entity\Article;

class HomepageController extends Controller {

    /**
     * @Route("/accueil", name="homepage")
     * @Route("/")
     * @Template()
     */
    public function indexAction()
    {
        $manager = $this->getDoctrine()
                ->getManager();
        $categoriesWithArticles = $manager->getRepository('JohnAdminBundle:Category')->getCategoryOrSubCategoryWithArticles();


//        foreach ($categories as $category) {
//            $articles = $this->getDoctrine()
//                ->getRepository('JohnSiteBundle:Article')
//                ->getArticlesByCategoryOrSubCategory($category);
//            
//            if ($articles) {
//                $categoriesWithArticles[] = $category;
//            }
            
//            if ($category->getArticles()->count() > 0) {
//                $categoriesWithArticles[] = $category;
//            }
            
//       }
        
        
        
//        $categoryBodhiyuga = $manager->getRepository('JohnSiteBundle:Category')->findOneBySlug('bodhiyuga');
//        $categoryMusiqueFilms = $manager->getRepository('JohnSiteBundle:Category')->findOneBySlug('musiques-films');
//        $categoryMusiques = $manager->getRepository('JohnSiteBundle:SubCategory')->findOneBySlug('musiques');
//        $categoryFilms = $manager->getRepository('JohnSiteBundle:SubCategory')->findOneBySlug('films');
//        
//        $article7 = new Article();
//        $article7->setTitle('article 7');
//        $article7->setSubCategory($categoryMusiques);
//        $article7->setBody('<p>corps article 7</p><p>suite corps article 7</p>');
//
//        $article8 = new Article();
//        $article8->setTitle('article 8');
//        $article8->setSubCategory($categoryMusiques);
//        $article8->setBody('<p>corps article 8</p><p>suite corps article 8</p>');
//        
//        $article9 = new Article();
//        $article9->setTitle('article 9');
//        $article9->setSubCategory($categoryFilms);
//        $article9->setBody('<p>corps article 9</p><p>suite corps article 9</p>');
//
//        $article10 = new Article();
//        $article10->setTitle('article 10');
//        $article10->setSubCategory($categoryFilms);
//        $article10->setBody('<p>corps article 10</p><p>suite corps article 10</p>');
//        
//        $article11 = new Article();
//        $article11->setTitle('article 11');
//        $article11->setSubCategory($categoryFilms);
//        $article11->setBody('<p>corps article 11</p><p>suite corps article 11</p>');
//
//        $article12 = new Article();
//        $article12->setTitle('article 12');
//        $article12->setSubCategory($categoryFilms);
//        $article12->setBody('<p>corps article 12</p><p>suite corps article 12</p>');
//
//        // On la persiste
//        $manager->persist($article7);
//        $manager->persist($article8);
//        $manager->persist($article9);
//        $manager->persist($article10);
//        $manager->persist($article11);
//        $manager->persist($article12);
//
//        // On déclenche l'enregistrement
//        $manager->flush();
        
        
        
        
        
        
        
        

        return array(
            'categoriesWithArticles' => $categoriesWithArticles
        );
    }

}
