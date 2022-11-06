<?php

class AuthApiCest{
    public function _before(\FunctionalTester $I){
        // Basic Auth Header
        // Authenticate as admin
        //$I->haveHttpHeader("Authorization", "Basic ZEM5Vk9qbEdMU21zZzZaR2toN0UwREpLejhHMUs1OU86");
    }

    public function loginTest(\FunctionalTester $I){
        $I->sendAjaxPostRequest('/api/auth/login', ["email"=>"admin", "password" => "admin"]);
        $I->seeResponseCodeIsSuccessful();
        if(Yii::$app->getResponse()->content === "null"){
            throw new Exception("Content of the answer is null");
        }
    }

    public function failLoginTest(\FunctionalTester $I){
        $I->sendAjaxPostRequest('/api/auth/login', ["email"=>"admin", "password" => "admin1111"]);
        $I->seeResponseCodeIsClientError();
        if(Yii::$app->getResponse()->content === "null"){
            throw new Exception("Content of the answer is null");
        }
    }

    public function registerTest(\FunctionalTester $I){
        $I->sendAjaxPostRequest('/api/auth/register', ["username" => "test12345", "email"=>"test12345@gmail.com", "newPassword" => "tessssstttttt11111"]);
        $I->seeResponseCodeIsSuccessful();
        if(Yii::$app->getResponse()->content === "null"){
            throw new Exception("Content of the answer is null");
        }
    }

    public function checkPermissionFalseTest(\FunctionalTester $I){
        $I->sendAjaxGetRequest('/api/auth/check-permission',  ["permission"=>"operario"]);
        $I->seeResponseCodeIsSuccessful();
        if(Yii::$app->getResponse()->content === "null"){
            throw new Exception("Content of the answer is null");
        }
    }

    public function checkPermissionTrueTest(\FunctionalTester $I){
        // Basic Auth Header
        // Authenticate as admin
        $I->haveHttpHeader("Authorization", "Basic ZEM5Vk9qbEdMU21zZzZaR2toN0UwREpLejhHMUs1OU86");
        $I->sendAjaxGetRequest('/api/auth/check-permission',  ["permission"=>"operario"]);
        $I->seeResponseCodeIsSuccessful();
        if(Yii::$app->getResponse()->content === "null"){
            throw new Exception("Content of the answer is null");
        }
    }
}