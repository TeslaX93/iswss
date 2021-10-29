<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Grade;
use AppBundle\Entity\Schoolclass;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Grade controller.
 *
 */
class GradeController extends Controller
{
    /**
     * Lists all grade entities.
     *
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        //$grades = $em->getRepository('AppBundle:Grade')->findAll();
        $queryBuilder = $em->getRepository('AppBundle:Grade')->createQueryBuilder('grade');

        if ($request->query->getAlnum('filter')) {
            $queryBuilder
                ->where('grade.grade LIKE :title')
                ->leftJoin('grade.idstudent','student')
                ->orWhere($queryBuilder->expr()->like('student.surname', ':title'))
                ->orWhere($queryBuilder->expr()->like('student.name', ':title'))
                ->setParameter('title', '%' . $request->query->getAlnum('filter') . '%');
        }
        $query = $queryBuilder->getQuery();

        $query2 = $em->createQuery('SELECT student FROM AppBundle:Student student');
        $students = $query2->getResult();


        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $query, /* query NOT result */
            $request->query->getInt('page', 1)/*page number*/,
            10/*limit per page*/
        );

        return $this->render('grade/index.html.twig', array(
            //'grades' => $grades,
            'pagination' => $pagination,
            'students' => $students,
        ));
    }
/*
    public function okAction()
    {
        $em = $this->getDoctrine()->getManager();

        $grades = $em->getRepository('AppBundle:Grade')->findAll();

        $query = $em->createQuery(
            'SELECT schoolclass
        FROM AppBundle:Schoolclass schoolclass
        '
        );
        $schoolclasses = $query->getResult();
        return $this->render('grade/ok.html.twig', array(
            'grades' => $grades,
            'schoolclasses' => $schoolclasses,
        ));
    }
*/
    /**
     * Creates a new grade entity.
     *
     */
    public function newAction(Request $request)
    {
        $grade = new Grade();
        $form = $this->createForm('AppBundle\Form\GradeType', $grade);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($grade);
            $em->flush($grade);

            return $this->redirectToRoute('grade_show', array('id' => $grade->getIdgrade()));
        }

        return $this->render('grade/new.html.twig', array(
            'grade' => $grade,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a grade entity.
     *
     */
    public function showAction(Grade $grade)
    {
        $deleteForm = $this->createDeleteForm($grade);

        return $this->render('grade/show.html.twig', array(
            'grade' => $grade,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing grade entity.
     *
     */
    public function editAction(Request $request, Grade $grade)
    {
        $deleteForm = $this->createDeleteForm($grade);
        $editForm = $this->createForm('AppBundle\Form\GradeType', $grade);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('grade_edit', array('id' => $grade->getIdgrade()));
        }

        return $this->render('grade/edit.html.twig', array(
            'grade' => $grade,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    public function generateAction() {
        $em = $this->getDoctrine()->getManager();
        $grades = $em->getRepository('AppBundle:Grade')->findAll();
        $query = $em->createQuery('SELECT student FROM AppBundle:Student student');
        $students = $query->getResult();
        $html = $this->renderView('grade/pdf.html.twig',array('grades' => $grades, 'students' => $students));
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
     * Deletes a grade entity.
     *
     */
    public function deleteAction(Request $request, Grade $grade)
    {
        $form = $this->createDeleteForm($grade);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($grade);
            $em->flush($grade);
        }

        return $this->redirectToRoute('grade_index');
    }

    /**
     * Creates a form to delete a grade entity.
     *
     * @param Grade $grade The grade entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Grade $grade)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('grade_delete', array('id' => $grade->getIdgrade())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
