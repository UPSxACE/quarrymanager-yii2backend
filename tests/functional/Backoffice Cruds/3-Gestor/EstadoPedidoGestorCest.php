<?php
require_once( __DIR__ . "/../2-Operario/EstadoPedidoOperarioCest.php");
class EstadoPedidoGestorCest extends EstadoPedidoOperarioCest
{
    public function _before(\FunctionalTester $I)
    {
        $I->amLoggedInAs(6);
        $I->amOnPage(['estado-pedido/']);
    }
}