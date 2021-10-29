<?php

use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Routing\Route;

$collection = new RouteCollection();

$collection->add('student_index', new Route(
    '/',
    array('_controller' => 'AppBundle:Student:index'),
    array(),
    array(),
    '',
    array(),
    array('GET')
));

$collection->add('student_show', new Route(
    '/{id}/show',
    array('_controller' => 'AppBundle:Student:show'),
    array(),
    array(),
    '',
    array(),
    array('GET')
));

$collection->add('student_new', new Route(
    '/new',
    array('_controller' => 'AppBundle:Student:new'),
    array(),
    array(),
    '',
    array(),
    array('GET', 'POST')
));

$collection->add('student_edit', new Route(
    '/{id}/edit',
    array('_controller' => 'AppBundle:Student:edit'),
    array(),
    array(),
    '',
    array(),
    array('GET', 'POST')
));

$collection->add('student_pdf', new Route(
    '/pdf',
    array('_controller' => 'AppBundle:Student:generate'),
    array(),
    array(),
    '',
    array(),
    array('GET', 'POST')
));

$collection->add('student_pdfst', new Route(
    '/{id}/pdfst',
    array('_controller' => 'AppBundle:Student:generatest'),
    array(),
    array(),
    '',
    array(),
    array('GET', 'POST')
));

$collection->add('student_zasw', new Route(
    '/{id}/zasw',
    array('_controller' => 'AppBundle:Student:generatezasw'),
    array(),
    array(),
    '',
    array(),
    array('GET', 'POST')
));

$collection->add('student_legit', new Route(
    '/{id}/legit',
    array('_controller' => 'AppBundle:Student:generatelegit'),
    array(),
    array(),
    '',
    array(),
    array('GET', 'POST')
));

$collection->add('student_makedipl', new Route(
    '/{id}/makedipl',
    array('_controller' => 'AppBundle:Student:makedipl'),
    array(),
    array(),
    '',
    array(),
    array('GET', 'POST')
));

$collection->add('student_makediplu', new Route(
    '/{id}/makediplu',
    array('_controller' => 'AppBundle:Student:makediplu'),
    array(),
    array(),
    '',
    array(),
    array('GET', 'POST')
));

$collection->add('student_custom', new Route(
    '/{id}/custom/{templatepos}',
    array('_controller' => 'AppBundle:Student:generatecustom'),
    array(),
    array(),
    '',
    array(),
    array('GET', 'POST')
));

$collection->add('student_delete', new Route(
    '/{id}/delete',
    array('_controller' => 'AppBundle:Student:delete'),
    array(),
    array(),
    '',
    array(),
    array('DELETE')
));

return $collection;
