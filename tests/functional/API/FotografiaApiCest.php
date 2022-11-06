<?php
class FotografiaApiCest{
    public function _before(\FunctionalTester $I){
        // Basic Auth Header
        // Authenticate as admin
        $I->haveHttpHeader("Authorization", "Basic ZEM5Vk9qbEdMU21zZzZaR2toN0UwREpLejhHMUs1OU86");
    }

    public function indexClienteTest(\FunctionalTester $I){
        // Basic Auth Header
        // Authenticate as cliente
        $I->haveHttpHeader("Authorization", "Basic SXV1b1QwOVREN3FNT1I0U283dlJjOHViRUxwWXZFd0U6");
        $I->sendAjaxGetRequest('/api/fotografia');
        $I->seeResponseCodeIsClientError();
    }

    public function indexTest(\FunctionalTester $I)
    {
        $I->sendAjaxGetRequest('/api/fotografia');
        $I->seeResponseCodeIsSuccessful();
        if(Yii::$app->getResponse()->content === "null"){
            throw new Exception("Content of the answer is null");
        }
    }
}