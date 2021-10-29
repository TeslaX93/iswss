<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Teacher;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Teacher controller.
 *
 */
class TeacherController extends Controller
{
    /**
     * Lists all teacher entities.
     *
     */
    /*
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $teachers = $em->getRepository('AppBundle:Teacher')->findAll();


        return $this->render('teacher/index.html.twig', array(
            'teachers' => $teachers,

        ));
    }
*/

    public function indexAction(Request $request)
    {


        $em = $this->getDoctrine()->getManager();

        //$students = $em->getRepository('AppBundle:Student')->findAll();
        $queryBuilder = $em->getRepository('AppBundle:Teacher')->createQueryBuilder('teacher');

        if ($request->query->getAlnum('filter')) {
            $queryBuilder
                ->where('teacher.idteacher LIKE :title')
                ->setParameter('title', '%' . $request->query->getAlnum('filter') . '%');
        }
        $query = $queryBuilder->getQuery();

        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $query, /* query NOT result */
            $request->query->getInt('page', 1)/*page number*/,
            10/*limit per page*/
        );

        return $this->render('teacher/index.html.twig', array(
            //'students' => $students,
            'pagination' => $pagination,
        ));
    }
    /**
     * Creates a new teacher entity.
     *
     */
    public function newAction(Request $request)
    {
        $teacher = new Teacher();
        $form = $this->createForm('AppBundle\Form\TeacherType', $teacher);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($teacher);
            $em->flush($teacher);

            return $this->redirectToRoute('teacher_show', array('id' => $teacher->getIdteacher()));
        }

        return $this->render('teacher/new.html.twig', array(
            'teacher' => $teacher,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a teacher entity.
     *
     */
    public function showAction(Teacher $teacher)
    {
        $deleteForm = $this->createDeleteForm($teacher);

        return $this->render('teacher/show.html.twig', array(
            'teacher' => $teacher,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing teacher entity.
     *
     */
    public function editAction(Request $request, Teacher $teacher)
    {
        $deleteForm = $this->createDeleteForm($teacher);
        $editForm = $this->createForm('AppBundle\Form\TeacherType', $teacher);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('teacher_edit', array('id' => $teacher->getIdteacher()));
        }

        return $this->render('teacher/edit.html.twig', array(
            'teacher' => $teacher,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    public function generateAction() {
        $em = $this->getDoctrine()->getManager();
        $teachers = $em->getRepository('AppBundle:Teacher')->findAll();
        $html = $this->renderView('teacher/pdf.html.twig',array('teachers' => $teachers));
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
     * Deletes a teacher entity.
     *
     */
    public function deleteAction(Request $request, Teacher $teacher)
    {
        $form = $this->createDeleteForm($teacher);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($teacher);
            $em->flush($teacher);
        }

        return $this->redirectToRoute('teacher_index');
    }

    /**
     * Creates a form to delete a teacher entity.
     *
     * @param Teacher $teacher The teacher entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Teacher $teacher)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('teacher_delete', array('id' => $teacher->getIdteacher())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
