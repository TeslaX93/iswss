<?php

use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Routing\Route;

$collection = new RouteCollection();

$collection->add('grade_index', new Route(
    '/',
    array('_controller' => 'AppBundle:Grade:index'),
    array(),
    array(),
    '',
    array(),
    array('GET')
));

$collection->add('grade_show', new Route(
    '/{id}/show',
    array('_controller' => 'AppBundle:Grade:show'),
    array(),
    array(),
    '',
    array(),
    array('GET')
));

$collection->add('grade_new', new Route(
    '/new',
    array('_controller' => 'AppBundle:Grade:new'),
    array(),
    array(),
    '',
    array(),
    array('GET', 'POST')
));

$collection->add('grade_edit', new Route(
    '/{id}/edit',
    array('_controller' => 'AppBundle:Grade:edit'),
    array(),
    array(),
    '',
    array(),
    array('GET', 'POST')
));

$collection->add('grade_pdf', new Route(
    '/pdf',
    array('_controller' => 'AppBundle:Grade:generate'),
    array(),
    array(),
    '',
    array(),
    array('GET', 'POST')
));
/*
$collection->add('grade_ok', new Route(
    '/ok',
    array('_controller' => 'AppBundle:Grade:ok'),
    array(),
    array(),
    '',
    array(),
    array('GET', 'POST')
));
*/
$collection->add('grade_delete', new Route(
    '/{id}/delete',
    array('_controller' => 'AppBundle:Grade:delete'),
    array(),
    array(),
    '',
    array(),
    array('DELETE')
));

return $collection;
