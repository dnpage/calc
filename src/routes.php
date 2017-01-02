<?php

use \Slim\Http\Request;
use \Slim\Http\Response;

$app->get('/', 'HomeController:index');
$app->get('/calc', 'HomeController:calc');
$app->get('/specializedCalc1', 'HomeController:specializedCalc1');
$app->get('/specializedCalc2', 'HomeController:specializedCalc2');
