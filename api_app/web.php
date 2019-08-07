<?php
/**
 * Define routes:
 * [URL address, Request Method, Controller, Controller->Method]
 */
$routes = [
    ['products/api', 'GET', 'ProductsController', 'index'],
    ['products/api', 'POST', 'ProductsController', 'store'],
    ['products/api/{id}', 'GET', 'ProductsController', 'show'],
    ['products/api/{id}', 'PUT', 'ProductsController', 'update'],
    ['products/api/{id}', 'DELETE', 'ProductsController', 'destroy']
];