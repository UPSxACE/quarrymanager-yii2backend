<?php

class ProfileApiCest{
    public function _before(\FunctionalTester $I){
        // Basic Auth Header
        // Authenticate as admin
        $I->haveHttpHeader("Authorization", "Basic ZEM5Vk9qbEdMU21zZzZaR2toN0UwREpLejhHMUs1OU86");
    }

    public function indexClienteTest(\FunctionalTester $I){
        // Basic Auth Header
        // Authenticate as cliente
        $I->haveHttpHeader("Authorization", "Basic SXV1b1QwOVREN3FNT1I0U283dlJjOHViRUxwWXZFd0U6");
        $I->sendAjaxGetRequest('/api/profile');
        //$I->seeResponseCodeIsClientError();
        $I->seeResponseCodeIsSuccessful();
    }

    public function indexTest(\FunctionalTester $I)
    {
        $I->sendAjaxGetRequest('/api/profile');
        $I->seeResponseCodeIsSuccessful();
        if(Yii::$app->getResponse()->content === "null"){
            throw new Exception("Content of the answer is null");
        }
    }

    public function getProfileTest(\FunctionalTester $I)
    {
        $I->sendAjaxGetRequest('/api/profile/get-profile');
        $I->seeResponseCodeIsSuccessful();
        if(Yii::$app->getResponse()->content === "null"){
            throw new Exception("Content of the answer is null");
        }
    }

    public function getProfileDefinicoesTest(\FunctionalTester $I)
    {
        $I->sendAjaxGetRequest('/api/profile/get-profile-definicoes');
        $I->seeResponseCodeIsSuccessful();
        if(Yii::$app->getResponse()->content === "null"){
            throw new Exception("Content of the answer is null");
        }
    }

    public function editTest(\FunctionalTester $I)
    {
        $I->sendAjaxRequest("PUT", '/api/profile/editar', ["full_name" => "Miguel Rocha"]);
        $I->seeResponseCodeIsSuccessful();
        if(Yii::$app->getResponse()->content === "null"){
            throw new Exception("Content of the answer is null");
        }
    }

    public function editarDefinicoesTest(\FunctionalTester $I)
    {
        $I->sendAjaxRequest("PUT", '/api/profile/editar-definicoes-perfil', ["username" => "admin2", "email" => "admin2@gmail.com", "password" => "admin"]);
        $I->seeResponseCodeIsSuccessful();
        if(Yii::$app->getResponse()->content === "null"){
            throw new Exception("Content of the answer is null");
        }
    }

    public function editarDefinicoesFailTest(\FunctionalTester $I)
    {
        $I->sendAjaxRequest("PUT", '/api/profile/editar-definicoes-perfil', ["username" => "admin2", "email" => "admin2@gmail.com", "password" => "admin2"]);
        $I->seeResponseCodeIsClientError();
        if(Yii::$app->getResponse()->content === "null"){
            throw new Exception("Content of the answer is null");
        }
    }
}