<?php

namespace AppBundle\Controller;
use AppBundle\Entity\School;
use AppBundle\Entity\Student;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Finder\Finder;
use Doctrine\ORM\Tools\Pagination\Paginator;

use Doctrine\ORM\EntityRepository;

/**
 * Student controller.
 *
 */
class StudentController extends Controller
{
    /**
     * Lists all student entities.
     *
     */


    public function indexAction(Request $request)
    {


        $em = $this->getDoctrine()->getManager();

        //$students = $em->getRepository('AppBundle:Student')->findAll();
        $queryBuilder = $em->getRepository('AppBundle:Student')->createQueryBuilder('student');

        if ($request->query->getAlnum('filter')) {
            $queryBuilder
                ->where('student.surname LIKE :title OR student.name LIKE :title OR student.address LIKE :title OR student.city LIKE :title OR student.pesel LIKE :title OR student.phone LIKE :title OR student.email LIKE :title')
                ->setParameter('title', '%' . $request->query->getAlnum('filter') . '%');
        }
        $query = $queryBuilder->getQuery();

        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $query, /* query NOT result */
            $request->query->getInt('page', 1)/*page number*/,
            10/*limit per page*/
        );

        return $this->render('student/index.html.twig', array(
            //'students' => $students,
            'pagination' => $pagination,
        ));
    }

    /*
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $students = $em->getRepository('AppBundle:Student')->findAll()->setFirstResult(0)->setMaxResults(1);

        return $this->render('student/index.html.twig', array(
            'students' => $students,

        ));
    }
*/


    /**
     * Creates a new student entity.
     *
     */
    public function newAction(Request $request)
    {
        $student = new Student();
        $form = $this->createForm('AppBundle\Form\StudentType', $student);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($student);
            $em->flush($student);

            return $this->redirectToRoute('student_show', array('id' => $student->getIdstudent()));
        }

        return $this->render('student/new.html.twig', array(
            'student' => $student,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a student entity.
     *
     */
    public function showAction(Student $student)
    {
        $deleteForm = $this->createDeleteForm($student);

        //$dir    = 'student';
        //$array_files = scandir($dir);

        $finder = new Finder();
        //$finder->files()->in(__DIR__.'/../../../custom')->name('*.html.twig');
        $finder->files()->in($this->get('kernel')->getRootDir().'/../custom')->name('*.html.twig');
        $fnmonly = array();

        $array_files = iterator_to_array($finder);
        foreach($array_files as $fnm) {
            array_push($fnmonly,$fnm->getBasename());
        }


        return $this->render('student/show.html.twig', array(
            'student' => $student,
            'files' => $fnmonly,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing student entity.
     *
     */
    public function editAction(Request $request, Student $student)
    {
        $deleteForm = $this->createDeleteForm($student);
        $editForm = $this->createForm('AppBundle\Form\StudentType', $student);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('student_edit', array('id' => $student->getIdstudent()));
        }

        return $this->render('student/edit.html.twig', array(
            'student' => $student,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    public function generateAction() {
        $em = $this->getDoctrine()->getManager();
        $students = $em->getRepository('AppBundle:Student')->findAll();
        $html = $this->renderView('student/pdf.html.twig',array('students' => $students));
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
    public function generatestAction(Student $student) {
        $em = $this->getDoctrine()->getManager();
        //$students = $em->getRepository('AppBundle:Student')->findAll();
        $html = $this->renderView('student/pdfshow.html.twig',array('student' => $student));
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

    public function generatezaswAction(Student $student) {
        $em = $this->getDoctrine()->getManager();
        $sch = $em->getRepository('AppBundle:School')->find(1);
        $html = $this->renderView('student/zasw.html.twig',array('student' => $student, 'schoolid' => $sch));


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

    public function generatelegitAction(Student $student){
        $em = $this->getDoctrine()->getManager();

        $html = $this->renderView('student/legit.html.twig',array('student' => $student));
        $options = [
            'margin-top' => 0,
            'margin-left' => 0,
        ];

        return new Response(
            $this->get('knp_snappy.pdf')->getOutputFromHtml($html,$options),
            //$this->get('knp_snappy.pdf')->getOutput($pageUrl),
            200,
            array(
                'Content-Type' => 'application/pdf',
                'Content-Disposition' => sprintf('attachment; filename="pdf.pdf"')
            )
        );
    }


    /**
     * Deletes a student entity.
     *
     */
    public function deleteAction(Request $request, Student $student)
    {
        $form = $this->createDeleteForm($student);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($student);
            $em->flush($student);
        }

        return $this->redirectToRoute('student_index');
    }

    /**
     * Creates a form to delete a student entity.
     *
     * @param Student $student The student entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Student $student)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('student_delete', array('id' => $student->getIdstudent())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
    public function makediplAction(Student $student)
    {
        $em = $this->getDoctrine()->getManager();
        $query = $em->createQuery(
        'SELECT grade
        FROM AppBundle:Grade grade
        WHERE grade.idstudent = :id'
        )->setParameter('id',$student->getIdstudent());
        $res = $query->getResult();
        //dump($res);
        $query = $em->createQuery(
         'SELECT school
         FROM AppBundle:School school
         WHERE school.idschool = :id'
        )->setParameter('id',1);
        $schools = $query->getResult();
        $query = $em->createQuery(
            'SELECT schoolclass
            FROM AppBundle:Schoolclass schoolclass
            WHERE schoolclass.idschoolclass = :id'
        )->setParameter('id',$student->getIdschoolclass());
        $schoolclasses = $query->getResult();

        $options = [

        ];

        $html =  $this->renderView('student/swiad.html.twig',array(
            'grade'=>$res,
            'student'=>$student,
            'school'=>$schools,
            'schoolclass'=>$schoolclasses,

        ));
        return new Response(
            $this->get('knp_snappy.pdf')->getOutputFromHtml($html,$options),
            //$this->get('knp_snappy.pdf')->getOutput($pageUrl),
            200,
            array(
                'Content-Type' => 'application/pdf',
                'Content-Disposition' => sprintf('attachment; filename="pdf.pdf"')
            )
        );

    }
    public function makedipluAction(Student $student)
    {
        $em = $this->getDoctrine()->getManager();
        $query = $em->createQuery(
            'SELECT grade
        FROM AppBundle:Grade grade
        WHERE grade.idstudent = :id'
        )->setParameter('id',$student->getIdstudent());
        $res = $query->getResult();
        //dump($res);
        $query = $em->createQuery(
            'SELECT school
         FROM AppBundle:School school
         WHERE school.idschool = :id'
        )->setParameter('id',1);
        $schools = $query->getResult();

        $options = [

        ];

        $html =  $this->renderView('student/swiadu.html.twig',array(
            'grade'=>$res,
            'student'=>$student,
            'school'=>$schools,

        ));
        return new Response(
            $this->get('knp_snappy.pdf')->getOutputFromHtml($html,$options),
            //$this->get('knp_snappy.pdf')->getOutput($pageUrl),
            200,
            array(
                'Content-Type' => 'application/pdf',
                'Content-Disposition' => sprintf('attachment; filename="pdf.pdf"')
            )
        );

    }

 /* Generate CUSTOM action */

    public function generatecustomAction(Student $student, $templatepos) // string $templatePos
    {
        $em = $this->getDoctrine()->getManager();
        $query = $em->createQuery(
            'SELECT grade
        FROM AppBundle:Grade grade
        WHERE grade.idstudent = :id'
        )->setParameter('id',$student->getIdstudent());
        $res = $query->getResult();
        //dump($res);
        $query = $em->createQuery(
            'SELECT school
         FROM AppBundle:School school
         WHERE school.idschool = :id'
        )->setParameter('id',1);
        $schools = $query->getResult();
        $query = $em->createQuery(
            'SELECT schoolclass
            FROM AppBundle:Schoolclass schoolclass
            WHERE schoolclass.idschoolclass = :id'
        )->setParameter('id',$student->getIdschoolclass());
        $schoolclasses = $query->getResult();
        $query = $em->createQuery(
            'SELECT studentparent
        FROM AppBundle:Studentparent studentparent
        WHERE studentparent.idstudent = :id'
        )->setParameter('id',$student->getIdstudent());
        $studentparents = $query->getResult();
        $query = $em->createQuery(
            'SELECT fee
        FROM AppBundle:Fee fee
        WHERE fee.idstudent = :id'
        )->setParameter('id',$student->getIdstudent());
        $fees = $query->getResult();
        $options = [
            'margin-top' => 0,
            'margin-left' => 0,
            'margin-right' => 0,
            'margin-bottom' => 0,
        ];


        //$rendertemplate = "student/swiad.html.twig";
        $rendertemplate = '@customtpl/'.$templatepos;
        // = $templatePos;
        $html =  $this->renderView($rendertemplate,array(
            'grade'=>$res,
            'student'=>$student,
            'school'=>$schools,
            'schoolclass'=>$schoolclasses,
            'studentparent'=>$studentparents,
            'fee'=>$fees,
        ));
        return new Response(
            $this->get('knp_snappy.pdf')->getOutputFromHtml($html,$options),
            //$this->get('knp_snappy.pdf')->getOutput($pageUrl),
            200,
            array(
                'Content-Type' => 'application/pdf',
                'Content-Disposition' => sprintf('attachment; filename="pdf.pdf"')
            )
        );

    }



}
