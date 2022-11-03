<?php
require_once( __DIR__ . "/../3-Gestor/PedidoLoteGestorCest.php");
class PedidoLoteAdminCest extends PedidoLoteGestorCest
{
    public function _before(\FunctionalTester $I)
    {
        $I->amLoggedInAs(1);
        $I->amOnPage(['pedido-lote/']);
    }

}