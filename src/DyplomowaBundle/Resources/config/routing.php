<?php

use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Routing\Route;

$collection = new RouteCollection();

$collection->add('dyplomowa_homepage', new Route('/', array(
    '_controller' => 'DyplomowaBundle:Default:index',
)));

return $collection;
