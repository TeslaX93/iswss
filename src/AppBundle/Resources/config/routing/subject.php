<?php

use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Routing\Route;

$collection = new RouteCollection();

$collection->add('subject_index', new Route(
    '/',
    array('_controller' => 'AppBundle:Subject:index'),
    array(),
    array(),
    '',
    array(),
    array('GET')
));

$collection->add('subject_show', new Route(
    '/{id}/show',
    array('_controller' => 'AppBundle:Subject:show'),
    array(),
    array(),
    '',
    array(),
    array('GET')
));

$collection->add('subject_new', new Route(
    '/new',
    array('_controller' => 'AppBundle:Subject:new'),
    array(),
    array(),
    '',
    array(),
    array('GET', 'POST')
));

$collection->add('subject_edit', new Route(
    '/{id}/edit',
    array('_controller' => 'AppBundle:Subject:edit'),
    array(),
    array(),
    '',
    array(),
    array('GET', 'POST')
));

$collection->add('subject_pdf', new Route(
    '/pdf',
    array('_controller' => 'AppBundle:Subject:generate'),
    array(),
    array(),
    '',
    array(),
    array('GET', 'POST')
));

$collection->add('subject_delete', new Route(
    '/{id}/delete',
    array('_controller' => 'AppBundle:Subject:delete'),
    array(),
    array(),
    '',
    array(),
    array('DELETE')
));

return $collection;
