<?php
require_once( __DIR__ . "/../1-Cliente/PedidoClienteCest.php");
class PedidoOperarioCest extends PedidoClienteCest
{
    public function _before(\FunctionalTester $I)
    {
        $I->amLoggedInAs(5);
        $I->amOnPage(['pedido/']);
    }

    public function indexTest(\FunctionalTester $I)
    {
        $I->see('Pedidos', 'h1');
    }

    public function createTest(\FunctionalTester $I){
        $I->click("Create Pedido");
        $I->fillField(["name"=>"Pedido[idUser]"], "5");
        $I->fillField(["name"=>"Pedido[idProduto]"], "2");
        $I->fillField(["name"=>"Pedido[desconto]"], "0.2");
        $I->fillField(["name"=>"Pedido[quantidade]"], "4.25");
        $I->fillField(["name"=>"Pedido[mensagem]"], "Ah, please, give me some of these.");
        $I->fillField(["name"=>"Pedido[dataHoraPedido]"], "2022-01-01 23:23:23");
        $I->click("Save");
        $I->See("4");
        $I->See("2");
        $I->See("0.2");
        $I->See("4.25");
        $I->See("Ah, please, give me some of these.");
        $I->See("2022-01-01 23:23:23");
    }

    public function viewTest(\FunctionalTester $I){
        $I->amOnPage(['pedido/view?id=1']);
        $I->See("7");
        $I->See("4");
        $I->See("50");
        $I->See("2022-04-22 23:17:13");
    }

    public function updateTest(\FunctionalTester $I)
    {
        $I->amOnPage(['pedido/update?id=1']);
        $I->see('Update Pedido');
        $I->fillField(["name"=>"Pedido[idUser]"], "5");
        $I->fillField(["name"=>"Pedido[idProduto]"], "2");
        $I->fillField(["name"=>"Pedido[desconto]"], "0.2");
        $I->fillField(["name"=>"Pedido[quantidade]"], "4.25");
        $I->fillField(["name"=>"Pedido[mensagem]"], "Ah, please, give me some of these.");
        $I->fillField(["name"=>"Pedido[dataHoraPedido]"], "2022-01-01 23:23:23");
        $I->click("Save");
        $I->See("4");
        $I->See("2");
        $I->See("0.2");
        $I->See("4.25");
        $I->See("Ah, please, give me some of these.");
        $I->See("2022-01-01 23:23:23");
    }

    public function deleteTest(\FunctionalTester $I){
        $I->amOnPage(['pedido/delete?id=1']);
        $I->See("Pedidos");
    }

    public function findModelFailTest(\FunctionalTester $I){
        $I->amOnPage(['pedido/view?id=-1']);
        $I->canSeeResponseCodeIs(404);
    }

}