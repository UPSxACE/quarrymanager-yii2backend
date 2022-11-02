<?php
require_once( __DIR__ . "/../3-Gestor/PedidoGestorCest.php");
class PedidoAdminCest extends PedidoGestorCest
{
    public function _before(\FunctionalTester $I)
    {
        $I->amLoggedInAs(1);
        $I->amOnPage(['pedido/']);
    }

}
