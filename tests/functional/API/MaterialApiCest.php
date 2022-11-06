<?php

class MaterialApiCest
{
    public function _before(\FunctionalTester $I){
        // Basic Auth Header
        // Authenticate as admin
        $I->haveHttpHeader("Authorization", "Basic ZEM5Vk9qbEdMU21zZzZaR2toN0UwREpLejhHMUs1OU86");
    }

    public function indexClienteTest(\FunctionalTester $I){
        // Basic Auth Header
        // Authenticate as cliente
        $I->haveHttpHeader("Authorization", "Basic SXV1b1QwOVREN3FNT1I0U283dlJjOHViRUxwWXZFd0U6");
        $I->sendAjaxGetRequest('/api/material');
        $I->seeResponseCodeIsClientError();
    }

    public function indexTest(\FunctionalTester $I)
    {
        $I->sendAjaxGetRequest('/api/material');
        $I->seeResponseCodeIsSuccessful();
        if(Yii::$app->getResponse()->content === "null"){
            throw new Exception("Content of the answer is null");
        }
    }

    public function listarTest(\FunctionalTester $I)
    {
        $I->sendAjaxGetRequest('/api/material/listar');
        $I->seeResponseCodeIsSuccessful();
        if(Yii::$app->getResponse()->content === "null"){
            throw new Exception("Content of the answer is null");
        }

        //codecept_debug($I->grabPageSource());
    }

    public function materialOptionsTest(\FunctionalTester $I)
    {
        $I->sendAjaxGetRequest('/api/material/material-options');
        $I->seeResponseCodeIsSuccessful();
        if(Yii::$app->getResponse()->content === "null"){
            throw new Exception("Content of the answer is null");
        }
    }

    public function findIdTest(\FunctionalTester $I)
    {
        $I->sendAjaxGetRequest('/api/material/find', array("id" => "1"));
        $I->seeResponseCodeIsSuccessful();
        if(Yii::$app->getResponse()->content === "null"){
            throw new Exception("Content of the answer is null");
        }

    }

    public function findPrefixoTest(\FunctionalTester $I)
    {
        $I->sendAjaxGetRequest('/api/material/find', ["prefixo" => "GRN"]);
        $I->seeResponseCodeIsSuccessful();
        if(Yii::$app->getResponse()->content === "null"){
            throw new Exception("Content of the answer is null");
        }
    }

    public function addTest(\FunctionalTester $I)
    {
        $I->sendAjaxPostRequest('/api/material/add', ["nome" => "areia", "prefixo" => "ARE"]);
        $I->seeResponseCodeIsSuccessful();
        if(Yii::$app->getResponse()->content === "null"){
            throw new Exception("Content of the answer is null");
        }
    }

    public function editTest(\FunctionalTester $I)
    {
        $I->sendAjaxRequest("PUT", '/api/material/editar', ["id" => "1", "nome" => "Areia"]);
        $I->seeResponseCodeIsSuccessful();
        if(Yii::$app->getResponse()->content === "null"){
            throw new Exception("Content of the answer is null");
        }
    }

    public function deletePrefixoTest(\FunctionalTester $I)
    {
        $I->sendAjaxPostRequest('/api/material/add', ["nome" => "areia", "prefixo" => "ARE"]);
        $I->sendAjaxRequest("DELETE", '/api/material/delete-material', ["prefixo" => "ARE"]);
        $I->seeResponseCodeIsSuccessful();
        if(Yii::$app->getResponse()->content === "null"){
            throw new Exception("Content of the answer is null");
        }
    }

    public function deleteIdTest(\FunctionalTester $I)
    {
        $I->sendAjaxPostRequest('/api/material/add', ["nome" => "areia", "prefixo" => "ARE"]);
        $response_content = json_decode(Yii::$app->getResponse()->content);
        $I->sendAjaxRequest("DELETE", '/api/material/delete-material', ["id" => $response_content->id]);
        $I->seeResponseCodeIsSuccessful();
        if(Yii::$app->getResponse()->content === "null"){
            throw new Exception("Content of the answer is null");
        }
    }
}
