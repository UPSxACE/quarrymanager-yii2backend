<?php

class LojaDashboardGestorCest{
    public function _before(\FunctionalTester $I)
    {
        $I->amLoggedInAs(6);
        $I->amOnPage(['dashboard/loja']);
    }

    public function indexTest(\FunctionalTester $I)
    {
        $I->see('Loja', 'h1');
    }

    public function createTest(\FunctionalTester $I){
        // Create a new Material and Product before the actual test begins
        $I->amOnPage(['dashboard/materiais']);
        $I->click('Novo Material');
        $I->fillField(["name"=>"Material[nome]"], "Rochedo");
        $I->fillField(["name"=>"Material[prefixo]"], "RCD");
        $I->click('Save');
        $I->seeRecord('app\models\Material', ["nome" => "Rochedo", "prefixo" => "RCD"]);

        $I->amOnPage(['dashboard/cores']);
        $I->click('Nova Cor');
        $I->fillField(["name"=>"Cor[nome]"], "Cristal");
        $I->fillField(["name"=>"Cor[prefixo]"], "CRS");
        $I->click('Save');
        $I->seeRecord('app\models\Cor', ["nome" => "Cristal", "prefixo" => "CRS"]);

        $I->amOnPage(['dashboard/produtos']);
        $I->click('Novo Produto');
        $I->selectOption('Produto[idMaterial]', array('text' => 'Rochedo'));
        $I->selectOption('Produto[idCor]', array('text' => 'Cristal'));
        $I->fillField(["name"=>"Produto[Res_Compressao]"], 5.23);
        $I->fillField(["name"=>"Produto[Res_Flexao]"], 7.75);
        $I->fillField(["name"=>"Produto[Massa_Vol_Aparente]"], 2);
        $I->fillField(["name"=>"Produto[Absorcao_Agua]"], 3.21);
        $I->click('Save');



        /*$I->haveHttpHeader("Authorization", "Basic ZEM5Vk9qbEdMU21zZzZaR2toN0UwREpLejhHMUs1OU86"); // authentication header, user: Admin

        $materialId = $I->createMaterial();
        codecept_debug("ABCD");
        codecept_debug($materialId);
        $materialId = $materialId->id;

        $corId = $I->createCor();
        $corId = $corId->id;

        // Create Test
        $I->haveHttpHeader("content_type", ["text/html; charset=UTF-8"]);
        $I->sendAjaxGetRequest("dashboard/novo-produto-loja"); */

        $I->amOnPage(["dashboard/loja"]);
        $I->click('Adicionar Produto à Loja');
        $I->selectOption('Produto[idProductToUpdate]', array('text' => 'Rochedo Cristal'));
        $I->attachFile('[name="Produto[imageFile]"][type="file"]', 'test-pic.png');
        $I->fillField(["name"=>"Produto[tituloArtigo]"], "Rochedo Cristal");
        $I->fillField(["name"=>"Produto[preco]"], "12.5");
        $I->fillField(["name"=>"Produto[descricaoProduto]"], "Aqui seria inserido uma suposta descrição.");
        $I->click('Save');
        $I->seeRecord('app\models\Produto', ['and',['tituloArtigo' => "Rochedo Cristal", "descricaoProduto" => "Aqui seria inserido uma suposta descrição."],"preco LIKE 12.5"]);
    }

}