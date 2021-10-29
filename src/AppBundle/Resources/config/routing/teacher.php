<?php

use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Routing\Route;

$collection = new RouteCollection();

$collection->add('teacher_index', new Route(
    '/',
    array('_controller' => 'AppBundle:Teacher:index'),
    array(),
    array(),
    '',
    array(),
    array('GET')
));

$collection->add('teacher_show', new Route(
    '/{id}/show',
    array('_controller' => 'AppBundle:Teacher:show'),
    array(),
    array(),
    '',
    array(),
    array('GET')
));

$collection->add('teacher_new', new Route(
    '/new',
    array('_controller' => 'AppBundle:Teacher:new'),
    array(),
    array(),
    '',
    array(),
    array('GET', 'POST')
));

$collection->add('teacher_edit', new Route(
    '/{id}/edit',
    array('_controller' => 'AppBundle:Teacher:edit'),
    array(),
    array(),
    '',
    array(),
    array('GET', 'POST')
));

$collection->add('teacher_pdf', new Route(
    '/pdf',
    array('_controller' => 'AppBundle:Teacher:generate'),
    array(),
    array(),
    '',
    array(),
    array('GET', 'POST')
));

$collection->add('teacher_delete', new Route(
    '/{id}/delete',
    array('_controller' => 'AppBundle:Teacher:delete'),
    array(),
    array(),
    '',
    array(),
    array('DELETE')
));

return $collection;
