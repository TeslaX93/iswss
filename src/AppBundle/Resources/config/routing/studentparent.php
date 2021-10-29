<?php

use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Routing\Route;

$collection = new RouteCollection();

$collection->add('studentparent_index', new Route(
    '/',
    array('_controller' => 'AppBundle:Studentparent:index'),
    array(),
    array(),
    '',
    array(),
    array('GET')
));

$collection->add('studentparent_show', new Route(
    '/{id}/show',
    array('_controller' => 'AppBundle:Studentparent:show'),
    array(),
    array(),
    '',
    array(),
    array('GET')
));

$collection->add('studentparent_new', new Route(
    '/new',
    array('_controller' => 'AppBundle:Studentparent:new'),
    array(),
    array(),
    '',
    array(),
    array('GET', 'POST')
));

$collection->add('studentparent_edit', new Route(
    '/{id}/edit',
    array('_controller' => 'AppBundle:Studentparent:edit'),
    array(),
    array(),
    '',
    array(),
    array('GET', 'POST')
));

$collection->add('studentparent_pdf', new Route(
    '/pdf',
    array('_controller' => 'AppBundle:Studentparent:generate'),
    array(),
    array(),
    '',
    array(),
    array('GET', 'POST')
));

$collection->add('studentparent_pdfsp', new Route(
    '/{id}/pdfsp',
    array('_controller' => 'AppBundle:Studentparent:generatesp'),
    array(),
    array(),
    '',
    array(),
    array('GET', 'POST')
));

$collection->add('studentparent_delete', new Route(
    '/{id}/delete',
    array('_controller' => 'AppBundle:Studentparent:delete'),
    array(),
    array(),
    '',
    array(),
    array('DELETE')
));

return $collection;
