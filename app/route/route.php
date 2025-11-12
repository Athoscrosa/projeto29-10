<?php

use app\controller\Home;
use app\controller\User;
use app\controller\Cliente;
use app\controller\Fornecedor;
use Slim\Routing\RouteCollectorProxy;

$app->get('/', Home::class . ':home');

$app->get('/home', Home::class . ':home');

$app->group('/usuario', function (RouteCollectorProxy $group) {
    $group->get('/lista', User::class . ':lista'); 
    $group->get('/cadastro', User::class . ':cadastro'); 
});

$app->group('/cliente', function (RouteCollectorProxy $group) {
    $group->get('/lista', cliente::class . ':lista'); 
    $group->get('/cadastro', cliente::class . ':cadastro'); 
});

$app->group('/fornecedor', function (RouteCollectorProxy $group) {
    $group->get('/lista', fornecedor::class . ':lista'); 
    $group->get('/cadastro', fornecedor::class . ':cadastro'); 
});