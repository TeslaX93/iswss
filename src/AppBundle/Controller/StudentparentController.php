<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Studentparent;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Studentparent controller.
 *
 */
class StudentparentController extends Controller
{
    /**
     * Lists all studentparent entities.
     *
     */
    /*
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $studentparents = $em->getRepository('AppBundle:Studentparent')->findAll();

        return $this->render('studentparent/index.html.twig', array(
            'studentparents' => $studentparents,
        ));
    }
*/
    public function indexAction(Request $request)
    {


        $em = $this->getDoctrine()->getManager();

        //$students = $em->getRepository('AppBundle:Student')->findAll();
        $queryBuilder = $em->getRepository('AppBundle:Studentparent')->createQueryBuilder('studentparent');

        if ($request->query->getAlnum('filter')) {
            $queryBuilder
                ->where('studentparent.parentsurname LIKE :title OR studentparent.parentname LIKE :title OR studentparent.parentaddress LIKE :title OR studentparent.parentphone LIKE :title')
                ->setParameter('title', '%' . $request->query->getAlnum('filter') . '%');
        }
        $query = $queryBuilder->getQuery();

        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $query, /* query NOT result */
            $request->query->getInt('page', 1)/*page number*/,
            10/*limit per page*/
        );

        return $this->render('studentparent/index.html.twig', array(
            //'students' => $students,
            'pagination' => $pagination,
        ));
    }
    /**
     * Creates a new studentparent entity.
     *
     */
    public function newAction(Request $request)
    {
        $studentparent = new Studentparent();
        $form = $this->createForm('AppBundle\Form\StudentparentType', $studentparent);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($studentparent);
            $em->flush($studentparent);

            return $this->redirectToRoute('studentparent_show', array('id' => $studentparent->getIdstudentparent()));
        }

        return $this->render('studentparent/new.html.twig', array(
            'studentparent' => $studentparent,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a studentparent entity.
     *
     */
    public function showAction(Studentparent $studentparent)
    {
        $deleteForm = $this->createDeleteForm($studentparent);

        return $this->render('studentparent/show.html.twig', array(
            'studentparent' => $studentparent,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing studentparent entity.
     *
     */
    public function editAction(Request $request, Studentparent $studentparent)
    {
        $deleteForm = $this->createDeleteForm($studentparent);
        $editForm = $this->createForm('AppBundle\Form\StudentparentType', $studentparent);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('studentparent_edit', array('id' => $studentparent->getIdstudentparent()));
        }

        return $this->render('studentparent/edit.html.twig', array(
            'studentparent' => $studentparent,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    public function generateAction() {
        $em = $this->getDoctrine()->getManager();
        $studentparents = $em->getRepository('AppBundle:Studentparent')->findAll();
        $html = $this->renderView('studentparent/pdf.html.twig',array('studentparents' => $studentparents));
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

    public function generatespAction(Studentparent $studentparent) {
        $em = $this->getDoctrine()->getManager();
        //$students = $em->getRepository('AppBundle:Student')->findAll();
        $html = $this->renderView('studentparent/pdfshow.html.twig',array('studentparent' => $studentparent));
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
     * Deletes a studentparent entity.
     *
     */
    public function deleteAction(Request $request, Studentparent $studentparent)
    {
        $form = $this->createDeleteForm($studentparent);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($studentparent);
            $em->flush($studentparent);
        }

        return $this->redirectToRoute('studentparent_index');
    }

    /**
     * Creates a form to delete a studentparent entity.
     *
     * @param Studentparent $studentparent The studentparent entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Studentparent $studentparent)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('studentparent_delete', array('id' => $studentparent->getIdstudentparent())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
