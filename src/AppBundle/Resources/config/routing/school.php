<?php

use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Routing\Route;

$collection = new RouteCollection();

$collection->add('school_index', new Route(
    '/',
    array('_controller' => 'AppBundle:School:index'),
    array(),
    array(),
    '',
    array(),
    array('GET')
));

$collection->add('school_show', new Route(
    '/{id}/show',
    array('_controller' => 'AppBundle:School:show'),
    array(),
    array(),
    '',
    array(),
    array('GET')
));

$collection->add('school_new', new Route(
    '/new',
    array('_controller' => 'AppBundle:School:new'),
    array(),
    array(),
    '',
    array(),
    array('GET', 'POST')
));

$collection->add('school_edit', new Route(
    '/{id}/edit',
    array('_controller' => 'AppBundle:School:edit'),
    array(),
    array(),
    '',
    array(),
    array('GET', 'POST')
));

$collection->add('school_pdf', new Route(
    '/pdf',
    array('_controller' => 'AppBundle:School:generate'),
    array(),
    array(),
    '',
    array(),
    array('GET', 'POST')
));

$collection->add('school_delete', new Route(
    '/{id}/delete',
    array('_controller' => 'AppBundle:School:delete'),
    array(),
    array(),
    '',
    array(),
    array('DELETE')
));

return $collection;
