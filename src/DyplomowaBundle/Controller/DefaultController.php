<?php

namespace DyplomowaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('DyplomowaBundle:Default:index.html.twig');
    }
}
