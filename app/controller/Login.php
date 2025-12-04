<?php

namespace app\controller;

use app\database\builder\InsertQuery;
use app\database\builder\SelectQuery;

class Login extends Base
{
    public function login($request, $response)
    {
        try {
            $dadosTemplate = [
                'titulo' => 'Autenticação'
            ];
            return $this->getTwig()
                ->render($response, $this->setView('login'), $dadosTemplate)
                ->withHeader('Content-Type', 'text/html')
                ->withStatus(200);
        } catch (\Exception $e) {
            var_dump($e->getMessage());
            die;
        }
    }
    public function precadastro($request, $response)
    {
        try {
            #Captura os dados do form
            $form = $request->getParsedBody();
            $dadosUsuario = [
                'nome' => $form['nome'],
                'sobrenome' => $form['sobrenome'],
                'cpf' => $form['cpf'],
                'rg' => $form['rg'],
                'senha' => password_hash($form['senha'], PASSWORD_DEFAULT)
            ];
            $IsInseted = InsertQuery::table('usuario')->save($dadosUsuario);
            if (!$IsInseted) {
                return $this->SendJson($response, ['status' => false, 'msg' => 'Restrição', $IsInseted, 'id' => 0], 403);
            }
            $id = SelectQuery::select('id')->from('usuario')->order('id', 'desc')->fetch();
            $id_usuario = $id['id'];
            #Finalizar Cadastro
            #Inserimos o email
            $dadosContato = [
                'id_usuario' => $id_usuario,
                'tipo' => 'email',
                'contato' => $form['email'],
            ];
            InsertQuery::table('contato')->save($dadosContato);
            #Inserimos o celular
            $dadosContato = [
                'id_usuario' => $id_usuario,
                'tipo' => 'celular',
                'contato' => $form['celular']
            ];
            InsertQuery::table('contato')->save($dadosContato);
            #Inserimos o Whatsapp
            $dadosContato = [
                'id_usuario' => $id_usuario,
                'tipo' => 'whatsapp',
                'contato' => $form['whatsapp']
            ];
            InsertQuery::table('contato')->save($dadosContato);
            return $this->SendJson($response, ['status' => true, 'msg' => 'Cadastrado realizado com sucesso!', 'id' => $id_usuario], 201);
        } catch (\Exception $e) {
            return $this->SendJson($response, ['status' => true, 'msg' => 'Restrição:' .  $e->getMessage(), 'id' => 0], 500);
        }
    }
    public function autenticar($request, $response)
    {
        try {
            $form = $request->getParsedBody();
            if (!isset($form['login']) || empty($form['login'])) {
                return $this->SendJson($response, ['status' => false, 'msg' => 'Por favor informe o login', 'id' => 0], 403);
            }
            if (!isset($form['senha']) || empty($form['senha'])) {
                return $this->SendJson($response, ['status' => false, 'msg' => 'Por favor informe a senha', 'id' => 0], 403);
            }
            $user = SelectQuery::select()
            ->from('vw_usuario_contatos')
            ->where('cpf','=',$form['login'],'or')
            ->where('email','=',$form['login'],'or')
            ->where('celular','=',$form['login'],'or')
            ->where('whatsapp','=',$form['login'])
            ->fetch();
            if (!isset($user) || empty($user) || count($user) <= 0) {
                return $this->SendJson(
                    $response,
                    ['status' => false, 'msg' => 'Usuario ou senha inválidos!', 'id' => 0],
                    403
                );
            }
            if (!$user['ativo']) {
            return $this->SendJson(
                    $response,
                    ['status' => false, 'msg' => 'Por enquanto você ainda não tem permissão de acessar o sistema!', 'id' => 0],
                    403
                );
            }
        } catch (\Exception $e) {
                return $this->SendJson($response, ['status' => false, 'msg' => 'Restrição'. $e->getMessage(),'id' => 0], 500);
            }
        }
    }
