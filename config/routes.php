<?php
use Cake\Routing\Router;

Router::plugin(
    'Notes',
    ['path' => '/notes'],
    function ($routes) {
        $routes->fallbacks('DashedRoute');
    }
);
