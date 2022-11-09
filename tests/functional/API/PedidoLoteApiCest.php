<?php

class PedidoLoteApiCest{
    public function _before(\FunctionalTester $I){
        // Basic Auth Header
        // Authenticate as admin
        $I->haveHttpHeader("Authorization", "Basic ZEM5Vk9qbEdMU21zZzZaR2toN0UwREpLejhHMUs1OU86");
    }

    public function indexClienteTest(\FunctionalTester $I){
        // Basic Auth Header
        // Authenticate as cliente
        $I->haveHttpHeader("Authorization", "Basic SXV1b1QwOVREN3FNT1I0U283dlJjOHViRUxwWXZFd0U6");
        $I->sendAjaxGetRequest('/api/pedido-lote');
        $I->seeResponseCodeIsClientError();
    }


    public function indexTest(\FunctionalTester $I)
    {
        $I->sendAjaxGetRequest('/api/pedido-lote');
        $I->seeResponseCodeIsSuccessful();
        if(Yii::$app->getResponse()->content === "null"){
            throw new Exception("Content of the answer is null");
        }
    }

    public function indexExpandTest(\FunctionalTester $I)
    {
        $I->sendAjaxGetRequest('/api/pedido-lote?expand=idTransportadora0');
        $I->seeResponseCodeIsSuccessful();
        if(Yii::$app->getResponse()->content === "null"){
            throw new Exception("Content of the answer is null");
        }
    }

    public function recolhasAgendadasTest(\FunctionalTester $I)
    {
        $I->sendAjaxGetRequest('/api/pedido-lote/recolhas-agendadas', ["id" => "1"]);
        $I->seeResponseCodeIsSuccessful();
        if(Yii::$app->getResponse()->content === "null"){
            throw new Exception("Content of the answer is null");
        }
    }

    public function agendarRecolhaTest(\FunctionalTester $I)
    {
        $I->sendAjaxPostRequest('/api/pedido-lote/agendar-recolha?idPedido=1', ["codigoLote" => "GRN_VRM_00001", "quantidade" => "100", "idTransportadora"=>"2"]);
        $I->seeResponseCodeIsSuccessful();
        if(Yii::$app->getResponse()->content === "null"){
            throw new Exception("Content of the answer is null");
        }
    }

    public function addTest(\FunctionalTester $I)
    {
        $I->sendAjaxPostRequest('/api/pedido-lote/add', ["idPedido" => "1", "codigoLote" => "MRM_AMR_00001", "quantidade" => "25", "idTransportadora" => "2"]);
        $I->seeResponseCodeIsSuccessful();
        if(Yii::$app->getResponse()->content === "null"){
            throw new Exception("Content of the answer is null");
        }
    }

    public function editTest(\FunctionalTester $I)
    {
        $I->sendAjaxRequest("PUT", '/api/pedido-lote/editar', ["id" => "1", "idPedido" => "1", "codigoLote" => "MRM_AMR_00001", "quantidade" => "25", "idTransportadora" => "2"]);
        $I->seeResponseCodeIsSuccessful();
        if(Yii::$app->getResponse()->content === "null"){
            throw new Exception("Content of the answer is null");
        }
    }

    public function deleteIdTest(\FunctionalTester $I)
    {
        $I->sendAjaxPostRequest('/api/pedido-lote/add', ["idPedido" => "1", "codigoLote" => "MRM_AMR_00001", "quantidade" => "25", "idTransportadora" => "2"]);
        $response_content = json_decode(Yii::$app->getResponse()->content);
        $I->sendAjaxRequest("DELETE", '/api/pedido-lote/delete-pedido-lote', ["id" => $response_content->id]);
        $I->seeResponseCodeIsSuccessful();
        if(Yii::$app->getResponse()->content === "null"){
            throw new Exception("Content of the answer is null");
        }
    }
}