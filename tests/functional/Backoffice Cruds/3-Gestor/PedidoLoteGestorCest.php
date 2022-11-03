<?php
require_once( __DIR__ . "/../2-Operario/PedidoLoteOperarioCest.php");
class PedidoLoteGestorCest extends PedidoLoteOperarioCest
{
    public function _before(\FunctionalTester $I)
    {
        $I->amLoggedInAs(6);
        $I->amOnPage(['pedido-lote/']);
    }
}