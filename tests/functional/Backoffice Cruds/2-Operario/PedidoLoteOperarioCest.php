<?php
require_once( __DIR__ . "/../1-Cliente/PedidoLoteClienteCest.php");
class PedidoLoteOperarioCest extends PedidoLoteClienteCest
{
    public function _before(\FunctionalTester $I)
    {
        $I->amLoggedInAs(5);
        $I->amOnPage(['pedido-lote/']);
    }

    public function indexTest(\FunctionalTester $I)
    {
        $I->see('Pedido Lotes', 'h1');
    }

    public function viewTest(\FunctionalTester $I)
    {
        $I->amOnPage(['pedido-lote/view?id=1']);
        $I->see('3');
        $I->see('MRM_AMR_00001');
        $I->see('(not set)');
        $I->see('25');
        $I->see('1');
        $I->see('ABC-123');
        $I->see('2022-04-22 23:30:55');
    }

    public function createTest(\FunctionalTester $I)
    {
        $I->click('Create Pedido Lote');
        $I->fillField(["name"=>'PedidoLote[idPedido]'],1);
        $I->fillField(["name"=>'PedidoLote[codigoLote]'],"GRN_LRJ_00001");
        $I->fillField(["name"=>'PedidoLote[quantidade]'],10.25);
        $I->fillField(["name"=>'PedidoLote[idTransportadora]'],1);
        $I->fillField(["name"=>'PedidoLote[dataHoraRecolha]'],"2022-04-22 23:30:55");
        $I->click('Save', 'button');
    }

    public function updateTest(\FunctionalTester $I)
    {
        $I->amOnPage(['pedido-lote/update?id=1']);
        $I->fillField(["name"=>'PedidoLote[idPedido]'],1);
        $I->fillField(["name"=>'PedidoLote[codigoLote]'],"GRN_LRJ_00001");
        $I->fillField(["name"=>'PedidoLote[quantidade]'],10.25);
        $I->fillField(["name"=>'PedidoLote[idTransportadora]'],2);
        $I->fillField(["name"=>'PedidoLote[dataHoraRecolha]'],"2022-04-22 23:35:55");
        $I->click('Save', 'button');
    }


    public function deleteTest(\FunctionalTester $I){
        $I->amOnPage(['pedido-lote/delete?id=1']);
        $I->See("Pedido Lotes");
    }

    public function findModelFailTest(\FunctionalTester $I){
        $I->amOnPage(['pedido-lote/view?id=-1']);
        $I->canSeeResponseCodeIs(404);
    }

}