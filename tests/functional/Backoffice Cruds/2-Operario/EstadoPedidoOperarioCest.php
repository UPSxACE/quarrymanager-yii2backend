<?php
require_once( __DIR__ . "/../1-Cliente/EstadoPedidoClienteCest.php");
class EstadoPedidoOperarioCest extends EstadoPedidoClienteCest
{
    public function _before(\FunctionalTester $I)
    {
        $I->amLoggedInAs(5);
        $I->amOnPage(['estado-pedido/']);
    }

    public function indexTest(\FunctionalTester $I)
    {
        $I->see('Estado Pedidos', 'h1');
    }

    public function createTest(\FunctionalTester $I){
        $I->click("Create Estado Pedido");
        $I->fillField(["name"=>"EstadoPedido[idEstado]"], "1");
        $I->fillField(["name"=>"EstadoPedido[idPedido]"], "1");
        $I->fillField(["name"=>"EstadoPedido[dataEstado]"], "2022-01-01 23:23:23");
        $I->click("Save");
        $I->See("1");
        $I->See("2022-01-01 23:23:23");
    }

    public function viewTest(\FunctionalTester $I){
        $I->amOnPage(['estado-pedido/view?id=1']);
        $I->See("1");
        $I->See("2022-04-22 23:17:13");
    }

    public function updateTest(\FunctionalTester $I)
    {
        $I->amOnPage(['estado-pedido/update?id=1']);
        $I->see('Update Estado');
        $I->fillField(["name"=>"EstadoPedido[idEstado]"], "2");
        $I->fillField(["name"=>"EstadoPedido[idPedido]"], "2");
        $I->fillField(["name"=>"EstadoPedido[dataEstado]"], "2022-01-01 23:23:23");
        $I->click("Save");
        $I->See("2");
        $I->See("2022-01-01 23:23:23");
    }
    public function deleteTest(\FunctionalTester $I){
        $I->amOnPage(['estado-pedido/delete?id=1']);
        $I->See("Estado Pedidos");
    }

    public function findModelFailTest(\FunctionalTester $I){
        $I->amOnPage(['estado-pedido/view?id=-1']);
        $I->canSeeResponseCodeIs(404);
    }
}