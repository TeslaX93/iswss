<?php

use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Routing\Route;

$collection = new RouteCollection();

$collection->add('fee_index', new Route(
    '/',
    array('_controller' => 'AppBundle:Fee:index'),
    array(),
    array(),
    '',
    array(),
    array('GET')
));

$collection->add('fee_show', new Route(
    '/{id}/show',
    array('_controller' => 'AppBundle:Fee:show'),
    array(),
    array(),
    '',
    array(),
    array('GET')
));

$collection->add('fee_new', new Route(
    '/new',
    array('_controller' => 'AppBundle:Fee:new'),
    array(),
    array(),
    '',
    array(),
    array('GET', 'POST')
));

$collection->add('fee_edit', new Route(
    '/{id}/edit',
    array('_controller' => 'AppBundle:Fee:edit'),
    array(),
    array(),
    '',
    array(),
    array('GET', 'POST')
));

$collection->add('fee_pdf', new Route(
    '/pdf',
    array('_controller' => 'AppBundle:Fee:generate'),
    array(),
    array(),
    '',
    array(),
    array('GET', 'POST')
));

$collection->add('fee_delete', new Route(
    '/{id}/delete',
    array('_controller' => 'AppBundle:Fee:delete'),
    array(),
    array(),
    '',
    array(),
    array('DELETE')
));

return $collection;
