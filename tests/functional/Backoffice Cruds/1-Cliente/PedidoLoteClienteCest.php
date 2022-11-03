<?php
require_once( __DIR__ . "/../PedidoLoteCest.php");
class PedidoLoteClienteCest extends PedidoLoteCest
{
    public function _before(\FunctionalTester $I)
    {
        $I->amLoggedInAs(7);
        $I->amOnPage(['pedido-lote/']);
    }

    public function indexTest(\FunctionalTester $I)
    {
        $I->see('Forbidden', 'h1');
    }
}