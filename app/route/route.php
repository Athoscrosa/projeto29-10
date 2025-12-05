<?php

use app\controller\Home;
use app\controller\User;
use app\controller\Login;
use app\controller\Cliente;
use app\controller\Fornecedor;
use app\controller\Empresa;
use Slim\Routing\RouteCollectorProxy;

$app->get('/', Home::class . ':home');

$app->get('/home', Home::class . ':home');
$app->get('/login', Login::class . ':login');

$app->group('/login', function (RouteCollectorProxy $group) {
    $group->post('/precadastro', Login::class . ':precadastro');
    $group->post('/autenticar', Login::class . ':autenticar');
});

$app->group('/usuario', function (RouteCollectorProxy $group) {
    $group->get('/lista', User::class . ':lista');
    $group->get('/cadastro', User::class . ':cadastro');
    $group->get('/alterar/{id}', User::class . ':alterar');
    $group->post('/listuser', User::class . ':listuser');
    $group->post('/insert', User::class . ':insert');
    $group->post('/update', User::class . ':update');
});

$app->group('/cliente', function (RouteCollectorProxy $group) {
    $group->get('/lista', Cliente::class . ':lista');
    $group->get('/cadastro', Cliente::class . ':cadastro');
    $group->post('/insert', Cliente::class . ':insert');
    $group->post('/delete', Cliente::class . ':delete');
    $group->post('/listcliente', cliente::class . ':listcliente');
});

$app->group('/fornecedor', function (RouteCollectorProxy $group) {
    $group->get('/lista', Fornecedor::class . ':lista');
    $group->get('/cadastro', Fornecedor::class . ':cadastro');
    $group->post('/insert', Fornecedor::class . ':insert');
    $group->post('/delete', Fornecedor::class . ':delete');
    $group->post('/listfornecedor', Fornecedor::class . ':listfornecedor');
});

$app->group('/empresa', function (RouteCollectorProxy $group) {
    $group->get('/lista', Empresa::class . ':lista');
    $group->get('/cadastro', Empresa::class . ':cadastro');
    $group->post('/insert', Empresa::class . ':insert');
    $group->post('/delete', Empresa::class . ':delete');
    $group->post('/listempresa', empresa::class . ':listempresa');
});
