<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Schoolclass;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Schoolclass controller.
 *
 */
class SchoolclassController extends Controller
{
    /**
     * Lists all schoolclass entities.
     *
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        //$schoolclasses = $em->getRepository('AppBundle:Schoolclass')->findAll();

        $queryBuilder = $em->getRepository('AppBundle:Schoolclass')->createQueryBuilder('schoolclass');
        if ($request->query->getAlnum('filter')) {
            $queryBuilder
                ->where('schoolclass.number LIKE :title OR schoolclass.letter LIKE :title OR schoolclass.startyear LIKE :title')
                ->setParameter('title', '%' . $request->query->getAlnum('filter') . '%');
        }
        $query = $queryBuilder->getQuery();

        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $query, /* query NOT result */
            $request->query->getInt('page', 1)/*page number*/,
            10/*limit per page*/
        );


        $query2 = $em->createQuery('SELECT COUNT(student) AS licznosc FROM AppBundle:Student student GROUP BY student.idschoolclass');
        $howmanys = $query2->getResult();


        return $this->render('schoolclass/index.html.twig', array(
           // 'schoolclasses' => $schoolclasses,
            'pagination' => $pagination,
            'howmanys'=>$howmanys,

        ));
    }

    /**
     * Creates a new schoolclass entity.
     *
     */
    public function newAction(Request $request)
    {
        $schoolclass = new Schoolclass();
        $form = $this->createForm('AppBundle\Form\SchoolclassType', $schoolclass);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($schoolclass);
            $em->flush($schoolclass);

            return $this->redirectToRoute('schoolclass_show', array('id' => $schoolclass->getIdschoolclass()));
        }

        return $this->render('schoolclass/new.html.twig', array(
            'schoolclass' => $schoolclass,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a schoolclass entity.
     *
     */
    public function showAction(Schoolclass $schoolclass)
    {
        $deleteForm = $this->createDeleteForm($schoolclass);
        $em = $this->getDoctrine()->getManager();
        $query = $em->createQuery('SELECT student FROM AppBundle:Student student WHERE student.idschoolclass=:id')->setParameter('id',1);
        $students = $query->getResult();

        return $this->render('schoolclass/show.html.twig', array(
            'schoolclass' => $schoolclass,
            'students' => $students,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing schoolclass entity.
     *
     */
    public function editAction(Request $request, Schoolclass $schoolclass)
    {
        $deleteForm = $this->createDeleteForm($schoolclass);
        $editForm = $this->createForm('AppBundle\Form\SchoolclassType', $schoolclass);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('schoolclass_edit', array('id' => $schoolclass->getIdschoolclass()));
        }

        return $this->render('schoolclass/edit.html.twig', array(
            'schoolclass' => $schoolclass,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    public function generateAction() {
        $em = $this->getDoctrine()->getManager();
        $schoolclasses = $em->getRepository('AppBundle:Schoolclass')->findAll();
        $query = $em->createQuery('SELECT COUNT(student) AS licznosc FROM AppBundle:Student student GROUP BY student.idschoolclass');
        $howmanys = $query->getResult();
        $html = $this->renderView('schoolclass/pdf.html.twig',array('schoolclasses' => $schoolclasses, 'howmanys' => $howmanys));
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
     * Deletes a schoolclass entity.
     *
     */
    public function deleteAction(Request $request, Schoolclass $schoolclass)
    {
        $form = $this->createDeleteForm($schoolclass);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($schoolclass);
            $em->flush($schoolclass);
        }

        return $this->redirectToRoute('schoolclass_index');
    }

    /**
     * Creates a form to delete a schoolclass entity.
     *
     * @param Schoolclass $schoolclass The schoolclass entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Schoolclass $schoolclass)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('schoolclass_delete', array('id' => $schoolclass->getIdschoolclass())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
