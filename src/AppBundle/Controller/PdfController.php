<?php
/**
 * Created by PhpStorm.
 * User: Bartłomiej
 * Date: 9.02.2017
 * Time: 17:58
 */

namespace AppBundle\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class PdfController extends Controller
{

public function generateAction()
{
    $html = $this->renderView('pdf/pdf.html.twig');
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

}

