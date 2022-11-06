<?php

class PedidoApiCest{
    public function _before(\FunctionalTester $I){
        // Basic Auth Header
        // Authenticate as admin
        $I->haveHttpHeader("Authorization", "Basic ZEM5Vk9qbEdMU21zZzZaR2toN0UwREpLejhHMUs1OU86");
    }

    public function indexClienteTest(\FunctionalTester $I){
        // Basic Auth Header
        // Authenticate as cliente
        $I->haveHttpHeader("Authorization", "Basic SXV1b1QwOVREN3FNT1I0U283dlJjOHViRUxwWXZFd0U6");
        $I->sendAjaxGetRequest('/api/pedido');
        $I->seeResponseCodeIsClientError();
    }

    public function indexTest(\FunctionalTester $I)
    {
        $I->sendAjaxGetRequest('/api/pedido');
        $I->seeResponseCodeIsSuccessful();
        if(Yii::$app->getResponse()->content === "null"){
            throw new Exception("Content of the answer is null");
        }
    }

    public function findIdTest(\FunctionalTester $I)
    {
        $I->sendAjaxGetRequest('/api/pedido/find', array("id" => "1"));
        $I->seeResponseCodeIsSuccessful();
        if(Yii::$app->getResponse()->content === "null"){
            throw new Exception("Content of the answer is null");
        }

    }

    public function findPedidosUtilizadorTest(\FunctionalTester $I)
    {
        $I->sendAjaxGetRequest('/api/pedido/find-pedidos-utilizador');
        $I->seeResponseCodeIsSuccessful();
        if(Yii::$app->getResponse()->content === "null"){
            throw new Exception("Content of the answer is null");
        }

    }

    public function addTest(\FunctionalTester $I)
    {
        $I->sendAjaxPostRequest('/api/pedido/add', ["idUser" => "1", "idProduto" => "1", "desconto" => "2.3", "codigo_desconto"=>"zzz", "quantidade" => "50", "mensagem" => "Olá.", "dataHoraPedido" => "2022-11-06 16:13:13"]);
        $I->seeResponseCodeIsSuccessful();
        if(Yii::$app->getResponse()->content === "null"){
            throw new Exception("Content of the answer is null");
        }
    }

    public function pedidoOrcamentoTest(\FunctionalTester $I)
    {
        $I->sendAjaxPostRequest('/api/pedido/pedido-orcamento', ["idProduto" => "1", "desconto" => "2.3", "codigo_desconto"=>"zzz", "quantidade" => "50", "mensagem" => "Olá."]);
        $I->seeResponseCodeIsSuccessful();
        if(Yii::$app->getResponse()->content === "null"){
            throw new Exception("Content of the answer is null");
        }
    }

    public function agendarRecolhaOptionsTest(\FunctionalTester $I)
    {
        $I->sendAjaxGetRequest('/api/pedido/agendar-recolha-options', ["idPedido" => "1"]);
        $I->seeResponseCodeIsSuccessful();
        if(Yii::$app->getResponse()->content === "null"){
            throw new Exception("Content of the answer is null");
        }
    }

    public function proximoEstadoTest(\FunctionalTester $I)
    {
        $I->sendAjaxGetRequest('/api/pedido/proximo-estado', ["idPedido" => "1"]);
        $I->seeResponseCodeIsSuccessful();
        if(Yii::$app->getResponse()->content === "null"){
            throw new Exception("Content of the answer is null");
        }
    }

    public function cancelarEncomendaTest(\FunctionalTester $I)
    {
        $I->sendAjaxGetRequest('/api/pedido/cancelar-encomenda', ["idPedido" => "1"]);
        $I->seeResponseCodeIsSuccessful();
        if(Yii::$app->getResponse()->content === "null"){
            throw new Exception("Content of the answer is null");
        }
    }
}