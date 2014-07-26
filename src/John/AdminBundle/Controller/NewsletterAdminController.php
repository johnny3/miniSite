<?php

namespace John\AdminBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use John\AdminBundle\Entity\Newsletter;
use John\AdminBundle\Form\NewsletterType;
use Symfony\Component\HttpFoundation\Response;

/**
 * Newsletter controller.
 *
 * @Route("/newsletter_admin")
 */
class NewsletterAdminController extends Controller {

    /**
     * Lists all Newsletter entities.
     *
     * @Route("/", name="newsletter_admin")
     * @Template("JohnAdminBundle:Newsletter:index.html.twig")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('JohnAdminBundle:Newsletter')->findAll();

        return array(
            'entities' => $entities
        );
    }

    /**
     * Finds and displays a Newsletter entity.
     *
     * @Route("/{id}/show", name="newsletter_admin_show")
     * @Template("JohnAdminBundle:Newsletter:show.html.twig")
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('JohnAdminBundle:Newsletter')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Newsletter entity.');
        }

        return array(
            'entity' => $entity,
        );
    }
    
    /**
     * Send Newsletter.
     *
     * @Route("/send/{newsletterId}/{isTest}", name="newsletter_send")
     */
    public function sendNewsletter($newsletterId, $isTest = 1)
    {
        $em = $this->getDoctrine()->getManager();
        $newsletter = $em->getRepository('JohnAdminBundle:Newsletter')->find($newsletterId);
        $newletterArticles = $em->getRepository('JohnAdminBundle:NewsletterArticle')->getArticlesByPosition($newsletterId);
        $footerInfo = $em->getRepository('JohnSiteBundle:Info')->getInfo();
        $currentDate = new \DateTime(date('Y-m-d'));
        $month = $currentDate->format('F');
        $year = $currentDate->format('Y');

        $filetoOpen = $this->get('kernel')->getRootDir() . '/../web/uploads/newsletter/newsletter-sent-' . date('Ymd') . '.log';
	
        $fp = fopen($filetoOpen, 'a');
        
        if (1 == $isTest){
            // récupération de toutes les adresses de test avant validation
            $subscribers = $em->getRepository('JohnUserBundle:NewsletterSubscriberTest')->findActiveSubscribers();
        }
        else {
            // récupération de tous les inscrits actifs
            $subscribers = $em->getRepository('JohnUserBundle:NewsletterSubscriber')->findActiveSubscribers();
        }
        
        // envoi newsletter à chaque abonné actif
        foreach ($subscribers as $subscriberEmail) {
            $token = sha1(md5($subscriberEmail));
            $newsletter_browser_link = $this->generateUrl('newsletter_overview', array('id' => $newsletterId), true);
            $url_unsubscribe = $this->generateUrl('newslettersubscriber_unsubscribe', array('token' => $token, 'email' => $subscriberEmail), true);
            $content = $this->renderView('JohnAdminBundle:Newsletter:showMailOverview.html.twig', array(
                'url_unsubscribe' => $url_unsubscribe, 
                'newsletter_browser_link' => $newsletter_browser_link,
                'pm' => $newsletter->getPm()->getCalendar(),
                'newsletter' => $newsletter,
                'newsletter_articles' => $newletterArticles,
                'footerInfo' => $footerInfo,
                    ));

            $message = \Swift_Message::newInstance()
                    ->setSubject($newsletter->getMailObject())
                    ->setFrom(array('info@meditation-paris.org' => 'Centre Bouddhiste Kadampa John'))
                    ->setTo($subscriberEmail)
                    ->addPart($content, 'text/html')
                ;
            
            $this->container->get('mailer')->send($message);
            
            $line = date("Y-m-d H:i:s") . " email sent to subscriber_email: " . $subscriberEmail;

            if (false !== $fp) {
                fwrite($fp, date('d/m/Y H:i:s') . ";" . $line . "\n");
            }
        }
        
        fclose($fp);

        $message = "Newsletter envoyée !";

        return new Response($message);
    }
    
    

    /**
     * Displays a form to create a new Newsletter entity.
     *
     * @Route("/new", name="newsletter_admin_new")
     * @Template("JohnAdminBundle:Newsletter:new.html.twig")
     */
    public function newAction()
    {
        $entity = new Newsletter();
        $form = $this->createForm(new NewsletterType(), $entity);

        return array(
            'entity' => $entity,
            'form' => $form->createView(),
        );
    }

    /**
     * Creates a new Newsletter entity.
     *
     * @Route("/create", name="newsletter_admin_create")
     * @Method("POST")
     * @Template("JohnAdminBundle:Newsletter:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Newsletter();
        $form = $this->createForm(new NewsletterType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            foreach ($entity->getNewsletterarticles() as $articleNewsletter) {

                $fileValueForm = $articleNewsletter->file;

                if (!empty($fileValueForm)) {
                    $articleNewsletter->uploadProfilePicture();
                } else {
//                    $this->get('session')->getFlashBag()->add('notice', 'Vous n\'avez pas choisi de fichier.');
//                    return array(
//                        'entity' => $entity,
//                        'form' => $form->createView(),
//                    );
                    $articleNewsletter->setPicture('noimage.jpg'); 
                }
                
                if (NULL == $articleNewsletter->getPosition()) {
                    $this->get('session')->getFlashBag()->add('notice', 'Vous n\'avez pas indiqué de position.');
                    return array(
                        'entity' => $entity,
                        'edit_form' => $form->createView(),
                    );
                }

                $articleNewsletter->setNewsletter($entity);
                $em->persist($articleNewsletter);
            }

            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('newsletter_admin_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form' => $form->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Newsletter entity.
     *
     * @Route("/{id}/edit", name="newsletter_admin_edit")
     * @Template("JohnAdminBundle:Newsletter:edit.html.twig")
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('JohnAdminBundle:Newsletter')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Newsletter entity.');
        }

        $editForm = $this->createForm(new NewsletterType(), $entity);

        return array(
            'entity' => $entity,
            'edit_form' => $editForm->createView(),
        );
    }

    /**
     * Edits an existing Newsletter entity.
     *
     * @Route("/{id}/update", name="newsletter_admin_update")
     * @Method("POST")
     * @Template("JohnAdminBundle:Newsletter:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('JohnAdminBundle:Newsletter')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Newsletter entity.');
        }

        $editForm = $this->createForm(new NewsletterType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            
            foreach ($entity->getNewsletterarticles() as $articleNewsletter) {
                $fileValueForm = $articleNewsletter->file;
                
                if ((NULL !== $articleNewsletter->getPicture() && !empty($fileValueForm)) || (NULL === $articleNewsletter->getPicture() && !empty($fileValueForm)) ) {
                    $articleNewsletter->uploadProfilePicture();
                } elseif (NULL !== $articleNewsletter->getPicture() && empty($fileValueForm)) {
                    $articleNewsletter->setPicture($articleNewsletter->getPicture());
                } else {
//                    $this->get('session')->getFlashBag()->add('notice', 'Vous n\'avez pas choisi de fichier.');
//                    return array(
//                        'entity' => $entity,
//                        'edit_form' => $editForm->createView(),
//                    );
                   $articleNewsletter->setPicture('noimage.jpg');
                }
                
                if (NULL == $articleNewsletter->getPosition()) {
                    $this->get('session')->getFlashBag()->add('notice', 'Vous n\'avez pas indiqué de position.');
                    return array(
                        'entity' => $entity,
                        'edit_form' => $editForm->createView(),
                    );
                }
                
                $articleNewsletter->setNewsletter($entity);
                $em->persist($articleNewsletter);
            }

            $em->flush();

            return $this->redirect($this->generateUrl('newsletter_admin_show', array('id' => $id)));
        }

        return array(
            'entity' => $entity,
            'edit_form' => $editForm->createView(),
        );
    }

    /**
     * Deletes a Newsletter entity.
     *
     * @Route("/{id}/delete", name="newsletter_admin_delete")
     * @Method("GET")
     */
    public function deleteAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('JohnAdminBundle:Newsletter')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Newsletter entity.');
        }
        foreach ($entity->getNewsletterarticles() as $articleNewsletter) {
            $em->remove($articleNewsletter);
            $em->flush();
        }

        $em->remove($entity);
        $em->flush();

        return $this->redirect($this->generateUrl('newsletter_admin'));
    }
    
     /**
     * Finds and displays a Newsletter overview.
     *
     * @Route("/{id}/overview", name="newsletter_admin_overview")
     */
    public function showOverviewAction($id)
    {
        return $this->redirect($this->generateUrl('newsletter_overview', array('id' => $id)));
    }

}
