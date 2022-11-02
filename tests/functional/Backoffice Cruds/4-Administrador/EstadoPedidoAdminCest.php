<?php
require_once( __DIR__ . "/../3-Gestor/EstadoPedidoGestorCest.php");
class EstadoPedidoAdminCest extends EstadoPedidoGestorCest
{
    public function _before(\FunctionalTester $I)
    {
        $I->amLoggedInAs(1);
        $I->amOnPage(['estado-pedido/']);
    }

}
