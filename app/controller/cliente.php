<?php

namespace app\controller;

class cliente extends Base
{
    public function lista($request, $response)
    {
        $dadosTemplate = [
            'titulo' => 'Cadastro de cliente'
        ];
        return $this->getTwig()
            ->render($response, $this->setView('listcliente'), $dadosTemplate)
            ->withHeader('Content-type', 'text/html')
            ->withStatus(200);
    }
    public function cadastro($request, $response)
    {
        $dadosTemplate = [
            'titulo' => 'Cadastro de cliente'
        ];
        return $this->getTwig()
            ->render($response, $this->setView('cliente'), $dadosTemplate)
            ->withHeader('Content-type', 'text/html')
            ->withStatus(200);
    }
}