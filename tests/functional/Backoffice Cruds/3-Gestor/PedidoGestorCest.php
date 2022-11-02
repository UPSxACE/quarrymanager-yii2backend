<?php
require_once( __DIR__ . "/../2-Operario/PedidoOperarioCest.php");
class PedidoGestorCest extends PedidoOperarioCest
{
    public function _before(\FunctionalTester $I)
    {
        $I->amLoggedInAs(6);
        $I->amOnPage(['pedido/']);
    }
}