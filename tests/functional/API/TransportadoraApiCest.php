<?php

class TransportadoraApiCest{
    public function _before(\FunctionalTester $I){
        // Basic Auth Header
        // Authenticate as admin
        $I->haveHttpHeader("Authorization", "Basic ZEM5Vk9qbEdMU21zZzZaR2toN0UwREpLejhHMUs1OU86");
    }

    public function indexClienteTest(\FunctionalTester $I){
        // Basic Auth Header
        // Authenticate as cliente
        $I->haveHttpHeader("Authorization", "Basic SXV1b1QwOVREN3FNT1I0U283dlJjOHViRUxwWXZFd0U6");
        $I->sendAjaxGetRequest('/api/transportadora');
        $I->seeResponseCodeIsClientError();
    }

    public function indexTest(\FunctionalTester $I)
    {
        $I->sendAjaxGetRequest('/api/transportadora');
        $I->seeResponseCodeIsSuccessful();
        if(Yii::$app->getResponse()->content === "null"){
            throw new Exception("Content of the answer is null");
        }
    }

    public function listarTest(\FunctionalTester $I)
    {
        $I->sendAjaxGetRequest('/api/transportadora/listar');
        $I->seeResponseCodeIsSuccessful();
        if(Yii::$app->getResponse()->content === "null"){
            throw new Exception("Content of the answer is null");
        }

        //codecept_debug($I->grabPageSource());
    }

    public function findIdTest(\FunctionalTester $I)
    {
        $I->sendAjaxGetRequest('/api/transportadora/find', array("id" => "1"));
        $I->seeResponseCodeIsSuccessful();
        if(Yii::$app->getResponse()->content === "null"){
            throw new Exception("Content of the answer is null");
        }

    }

    public function addTest(\FunctionalTester $I)
    {
        $I->sendAjaxPostRequest('/api/transportadora/add', ["nome" => "NACEX"]);
        $I->seeResponseCodeIsSuccessful();
        if(Yii::$app->getResponse()->content === "null"){
            throw new Exception("Content of the answer is null");
        }
    }

    public function editTest(\FunctionalTester $I)
    {
        $I->sendAjaxRequest("PUT", '/api/transportadora/editar', ["id" => "1", "nome" => "NACEX"]);
        $I->seeResponseCodeIsSuccessful();
        if(Yii::$app->getResponse()->content === "null"){
            throw new Exception("Content of the answer is null");
        }
    }

    public function deleteIdTest(\FunctionalTester $I)
    {
        $I->sendAjaxPostRequest('/api/transportadora/add', ["nome" => "NACEX"]);
        $response_content = json_decode(Yii::$app->getResponse()->content);
        $I->sendAjaxRequest("DELETE", '/api/transportadora/delete-transportadora', ["id" => $response_content->id]);
        $I->seeResponseCodeIsSuccessful();
        if(Yii::$app->getResponse()->content === "null"){
            throw new Exception("Content of the answer is null");
        }
    }
}