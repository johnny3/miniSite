<?php

namespace John\AdminBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use John\AdminBundle\Entity\Info;
use John\AdminBundle\Form\InfoType;

/**
 * Info controller.
 *
 * @Route("/info_admin")
 */
class InfoAdminController extends Controller
{
    /**
     * Displays a form to edit an existing Info entity.
     *
     * @Route("/{id}/edit", name="info_admin_edit")
     * @Template("JohnAdminBundle:InfoAdmin:edit.html.twig")
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('JohnAdminBundle:Info')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Info entity.');
        }

        $editForm = $this->createForm(new InfoType(), $entity);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
        );
    }

    /**
     * Edits an existing Info entity.
     *
     * @Route("/{id}/update", name="info_admin_update")
     * @Method("POST")
     * @Template("JohnAdminBundle:InfoAdmin:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('JohnAdminBundle:Info')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Info entity.');
        }

        $editForm = $this->createForm(new InfoType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('info_admin_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
        );
    }
}
