<?php

namespace Acme\HelloBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Acme\HelloBundle\Entity\Medico;
use Acme\HelloBundle\Form\MedicoType;

/**
 * Medico controller.
 *
 */
class MedicoController extends Controller
{

    /**
     * Lists all Medico entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AcmeHelloBundle:Medico')->findAll();

        return $this->render('AcmeHelloBundle:Medico:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new Medico entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Medico();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('medico_show', array('id' => $entity->getId())));
        }

        return $this->render('AcmeHelloBundle:Medico:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a Medico entity.
     *
     * @param Medico $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Medico $entity)
    {
        $form = $this->createForm(new MedicoType(), $entity, array(
            'action' => $this->generateUrl('medico_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Medico entity.
     *
     */
    public function newAction()
    {
        $entity = new Medico();
        $form   = $this->createCreateForm($entity);

        return $this->render('AcmeHelloBundle:Medico:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Medico entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AcmeHelloBundle:Medico')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Medico entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('AcmeHelloBundle:Medico:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Medico entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AcmeHelloBundle:Medico')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Medico entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('AcmeHelloBundle:Medico:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Medico entity.
    *
    * @param Medico $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Medico $entity)
    {
        $form = $this->createForm(new MedicoType(), $entity, array(
            'action' => $this->generateUrl('medico_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Medico entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AcmeHelloBundle:Medico')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Medico entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('medico_edit', array('id' => $id)));
        }

        return $this->render('AcmeHelloBundle:Medico:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Medico entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AcmeHelloBundle:Medico')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Medico entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('medico'));
    }

    /**
     * Creates a form to delete a Medico entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('medico_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
