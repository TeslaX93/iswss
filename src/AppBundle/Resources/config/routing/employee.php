<?php

use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Routing\Route;

$collection = new RouteCollection();

$collection->add('employee_index', new Route(
    '/',
    array('_controller' => 'AppBundle:Employee:index'),
    array(),
    array(),
    '',
    array(),
    array('GET')
));

$collection->add('employee_show', new Route(
    '/{id}/show',
    array('_controller' => 'AppBundle:Employee:show'),
    array(),
    array(),
    '',
    array(),
    array('GET')
));

$collection->add('employee_new', new Route(
    '/new',
    array('_controller' => 'AppBundle:Employee:new'),
    array(),
    array(),
    '',
    array(),
    array('GET', 'POST')
));

$collection->add('employee_pdf', new Route(
    '/pdf',
    array('_controller' => 'AppBundle:Employee:generate'),
    array(),
    array(),
    '',
    array(),
    array('GET', 'POST')
));

$collection->add('employee_pdfem', new Route(
    '/{id}/pdfem',
    array('_controller' => 'AppBundle:Employee:generateem'),
    array(),
    array(),
    '',
    array(),
    array('GET', 'POST')
));

$collection->add('employee_edit', new Route(
    '/{id}/edit',
    array('_controller' => 'AppBundle:Employee:edit'),
    array(),
    array(),
    '',
    array(),
    array('GET', 'POST')
));

$collection->add('employee_delete', new Route(
    '/{id}/delete',
    array('_controller' => 'AppBundle:Employee:delete'),
    array(),
    array(),
    '',
    array(),
    array('DELETE')
));

return $collection;
