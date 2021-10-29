<?php

use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Routing\Route;

$collection = new RouteCollection();

$collection->add('schoolclass_index', new Route(
    '/',
    array('_controller' => 'AppBundle:Schoolclass:index'),
    array(),
    array(),
    '',
    array(),
    array('GET')
));

$collection->add('schoolclass_show', new Route(
    '/{id}/show',
    array('_controller' => 'AppBundle:Schoolclass:show'),
    array(),
    array(),
    '',
    array(),
    array('GET')
));

$collection->add('schoolclass_new', new Route(
    '/new',
    array('_controller' => 'AppBundle:Schoolclass:new'),
    array(),
    array(),
    '',
    array(),
    array('GET', 'POST')
));

$collection->add('schoolclass_edit', new Route(
    '/{id}/edit',
    array('_controller' => 'AppBundle:Schoolclass:edit'),
    array(),
    array(),
    '',
    array(),
    array('GET', 'POST')
));

$collection->add('schoolclass_pdf', new Route(
    '/pdf',
    array('_controller' => 'AppBundle:Schoolclass:generate'),
    array(),
    array(),
    '',
    array(),
    array('GET', 'POST')
));

$collection->add('schoolclass_delete', new Route(
    '/{id}/delete',
    array('_controller' => 'AppBundle:Schoolclass:delete'),
    array(),
    array(),
    '',
    array(),
    array('DELETE')
));

return $collection;
