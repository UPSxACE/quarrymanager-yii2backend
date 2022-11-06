<?php

class LoteApiCest{
    public function _before(\FunctionalTester $I){
        // Basic Auth Header
        // Authenticate as admin
        $I->haveHttpHeader("Authorization", "Basic ZEM5Vk9qbEdMU21zZzZaR2toN0UwREpLejhHMUs1OU86");
    }

    public function indexClienteTest(\FunctionalTester $I){
        // Basic Auth Header
        // Authenticate as cliente
        $I->haveHttpHeader("Authorization", "Basic SXV1b1QwOVREN3FNT1I0U283dlJjOHViRUxwWXZFd0U6");
        $I->sendAjaxGetRequest('/api/lote');
        $I->seeResponseCodeIsClientError();
    }

    public function indexTest(\FunctionalTester $I)
    {
        $I->sendAjaxGetRequest('/api/lote');
        $I->seeResponseCodeIsSuccessful();
        if(Yii::$app->getResponse()->content === "null"){
            throw new Exception("Content of the answer is null");
        }
    }

    public function listarTest(\FunctionalTester $I)
    {
        $I->sendAjaxGetRequest('/api/lote/listar');
        $I->seeResponseCodeIsSuccessful();
        if(Yii::$app->getResponse()->content === "null"){
            throw new Exception("Content of the answer is null");
        }

        //codecept_debug($I->grabPageSource());
    }

    public function novoLoteOptionsTest(\FunctionalTester $I)
    {
        $I->sendAjaxGetRequest('/api/lote/options-novo-lote');
        $I->seeResponseCodeIsSuccessful();
        if(Yii::$app->getResponse()->content === "null"){
            throw new Exception("Content of the answer is null");
        }
    }

    public function findCodigoLoteTest(\FunctionalTester $I)
    {
        $I->sendAjaxGetRequest('/api/lote/find', array("codigo_lote" => "GRN_LRJ_00001"));
        $I->seeResponseCodeIsSuccessful();
        if(Yii::$app->getResponse()->content === "null"){
            throw new Exception("Content of the answer is null");
        }

    }

    public function addTest(\FunctionalTester $I)
    {
        $I->sendAjaxPostRequest('/api/lote/add', ["idProduto" => "1", "idLocalArmazem" => "1", "idLocalExtracao"=>"1", "quantidade"=>"100"]);
        $I->seeResponseCodeIsSuccessful();
        if(Yii::$app->getResponse()->content === "null"){
            throw new Exception("Content of the answer is null");
        }
    }

    public function editTest(\FunctionalTester $I)
    {
        $I->sendAjaxRequest("PUT", '/api/lote/editar', ["codigo_lote" => "GRN_LRJ_00001", "idProduto" => "1", "idLocalArmazem" => "1", "idLocalExtracao"=>"1", "quantidade"=>"100"]);
        $I->seeResponseCodeIsSuccessful();
        if(Yii::$app->getResponse()->content === "null"){
            throw new Exception("Content of the answer is null");
        }
    }

    public function deleteIdTest(\FunctionalTester $I)
    {
        $I->sendAjaxPostRequest('/api/lote/add', ["idProduto" => "1", "idLocalArmazem" => "1", "idLocalExtracao"=>"1", "quantidade"=>"100"]);
        $response_content = json_decode(Yii::$app->getResponse()->content);
        $I->sendAjaxRequest("DELETE", '/api/lote/delete-lote', ["codigo_lote" => $response_content->codigo_lote]);
        $I->seeResponseCodeIsSuccessful();
        if(Yii::$app->getResponse()->content === "null"){
            throw new Exception("Content of the answer is null");
        }
    }
}