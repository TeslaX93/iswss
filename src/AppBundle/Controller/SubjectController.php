<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Subject;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Subject controller.
 *
 */
class SubjectController extends Controller
{
    /**
     * Lists all subject entities.
     *
     */
    /*
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $subjects = $em->getRepository('AppBundle:Subject')->findAll();

        return $this->render('subject/index.html.twig', array(
            'subjects' => $subjects,
        ));
    }
    */
    public function indexAction(Request $request)
    {


        $em = $this->getDoctrine()->getManager();

        //$students = $em->getRepository('AppBundle:Student')->findAll();
        $queryBuilder = $em->getRepository('AppBundle:Subject')->createQueryBuilder('subject');

        if ($request->query->getAlnum('filter')) {
            $queryBuilder
                ->where('subject.name LIKE :title')
                ->setParameter('title', '%' . $request->query->getAlnum('filter') . '%');
        }
        $query = $queryBuilder->getQuery();

        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $query, /* query NOT result */
            $request->query->getInt('page', 1)/*page number*/,
            10/*limit per page*/
        );

        return $this->render('subject/index.html.twig', array(
            //'students' => $students,
            'pagination' => $pagination,
        ));
    }

    /**
     * Creates a new subject entity.
     *
     */
    public function newAction(Request $request)
    {
        $subject = new Subject();
        $form = $this->createForm('AppBundle\Form\SubjectType', $subject);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($subject);
            $em->flush($subject);

            return $this->redirectToRoute('subject_show', array('id' => $subject->getIdsubject()));
        }

        return $this->render('subject/new.html.twig', array(
            'subject' => $subject,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a subject entity.
     *
     */
    public function showAction(Subject $subject)
    {
        $deleteForm = $this->createDeleteForm($subject);

        return $this->render('subject/show.html.twig', array(
            'subject' => $subject,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing subject entity.
     *
     */
    public function editAction(Request $request, Subject $subject)
    {
        $deleteForm = $this->createDeleteForm($subject);
        $editForm = $this->createForm('AppBundle\Form\SubjectType', $subject);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('subject_edit', array('id' => $subject->getIdsubject()));
        }

        return $this->render('subject/edit.html.twig', array(
            'subject' => $subject,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    public function generateAction() {
        $em = $this->getDoctrine()->getManager();
        $subjects = $em->getRepository('AppBundle:Subject')->findAll();
        $html = $this->renderView('subject/pdf.html.twig',array('subjects' => $subjects));
        //$html = $this->renderView('Employee/index.html.twig',array('employees'=> $employees));
        //$pageUrl = $this->generateUrl($this,array(),true);
        //$filename = sprintf('test-%s.pdf', date('Y-m-d'));

        return new Response(
            $this->get('knp_snappy.pdf')->getOutputFromHtml($html),
            //$this->get('knp_snappy.pdf')->getOutput($pageUrl),
            200,
            array(
                'Content-Type' => 'application/pdf',
                'Content-Disposition' => sprintf('attachment; filename="pdf.pdf"')
            )
        );
    }

    /**
     * Deletes a subject entity.
     *
     */
    public function deleteAction(Request $request, Subject $subject)
    {
        $form = $this->createDeleteForm($subject);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($subject);
            $em->flush($subject);
        }

        return $this->redirectToRoute('subject_index');
    }

    /**
     * Creates a form to delete a subject entity.
     *
     * @param Subject $subject The subject entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Subject $subject)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('subject_delete', array('id' => $subject->getIdsubject())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
