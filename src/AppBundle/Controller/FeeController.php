<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Fee;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Fee controller.
 *
 */
class FeeController extends Controller
{
    /**
     * Lists all fee entities.
     *
     */

    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        //$fees = $em->getRepository('AppBundle:Fee')->findAll();
        $queryBuilder = $em->getRepository('AppBundle:Fee')->createQueryBuilder('fee');

        if ($request->query->getAlnum('filter')) {
            $queryBuilder
                ->where('fee.name LIKE :title OR fee.feevalue LIKE :title')
                ->setParameter('title', '%' . $request->query->getAlnum('filter') . '%');
        }
        $query = $queryBuilder->getQuery();

        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $query, /* query NOT result */
            $request->query->getInt('page', 1)/*page number*/,
            10/*limit per page*/
        );


        $query2 = $em->createQuery('SELECT student FROM AppBundle:Student student');
        $students = $query2->getResult();

        return $this->render('fee/index.html.twig', array(
            //'fees' => $fees,
            'pagination' => $pagination,
            'students' => $students,
        ));
    }




    /**
     * Creates a new fee entity.
     *
     */
    public function newAction(Request $request)
    {
        $fee = new Fee();
        $form = $this->createForm('AppBundle\Form\FeeType', $fee);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($fee);
            $em->flush($fee);

            return $this->redirectToRoute('fee_show', array('id' => $fee->getIdfee()));
        }

        return $this->render('fee/new.html.twig', array(
            'fee' => $fee,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a fee entity.
     *
     */
    public function showAction(Fee $fee)
    {
        $deleteForm = $this->createDeleteForm($fee);

        return $this->render('fee/show.html.twig', array(
            'fee' => $fee,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing fee entity.
     *
     */
    public function editAction(Request $request, Fee $fee)
    {
        $deleteForm = $this->createDeleteForm($fee);
        $editForm = $this->createForm('AppBundle\Form\FeeType', $fee);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('fee_edit', array('id' => $fee->getIdfee()));
        }

        return $this->render('fee/edit.html.twig', array(
            'fee' => $fee,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    public function generateAction() {
        $em = $this->getDoctrine()->getManager();
        $fees = $em->getRepository('AppBundle:Fee')->findAll();
        $query = $em->createQuery('SELECT student FROM AppBundle:Student student');
        $students = $query->getResult();
        $html = $this->renderView('fee/pdf.html.twig',array('fees' => $fees, 'students' => $students));
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
     * Deletes a fee entity.
     *
     */
    public function deleteAction(Request $request, Fee $fee)
    {
        $form = $this->createDeleteForm($fee);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($fee);
            $em->flush($fee);
        }

        return $this->redirectToRoute('fee_index');
    }

    /**
     * Creates a form to delete a fee entity.
     *
     * @param Fee $fee The fee entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Fee $fee)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('fee_delete', array('id' => $fee->getIdfee())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
