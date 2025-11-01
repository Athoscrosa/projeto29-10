<?php

namespace app\controller;

class fornecedor extends Base
{
    public function lista($request, $response)
    {
        $dadosTemplate = [
            'titulo' => 'Cadastro de Fornecedor'
        ];
        return $this->getTwig()
            ->render($response, $this->setView('listfornecedor'), $dadosTemplate)
            ->withHeader('Content-type', 'text/html')
            ->withStatus(200);
    }
    public function cadastro($request, $response)
    {
        $dadosTemplate = [
            'titulo' => 'Cadastro de fornecedor'
        ];
        return $this->getTwig()
            ->render($response, $this->setView('fornecedor'), $dadosTemplate)
            ->withHeader('Content-type', 'text/html')
            ->withStatus(200);
    }
}