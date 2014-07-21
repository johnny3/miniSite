<?php

namespace John\SiteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use John\AdminBundle\Entity\Article;

/**
 * Article controller.
 *
 * @Route("/articles")
 */
class ArticleController extends Controller
{
    /**
     * Finds and displays a Article entity.
     *
     * @Route("/{slug}", name="article_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($slug)
    {
        $em = $this->getDoctrine()->getManager();

        $article = $em->getRepository('JohnAdminBundle:Article')->findOneBySlug($slug);

        if (!$article) {
            throw $this->createNotFoundException('Unable to find Article entity.');
        }

        return array(
            'article'      => $article,
        );
    }

}
