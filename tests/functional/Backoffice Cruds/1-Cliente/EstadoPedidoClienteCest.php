<?php
require_once( __DIR__ . "/../EstadoPedidoCest.php");
class EstadoPedidoClienteCest extends EstadoPedidoCest
{
    public function _before(\FunctionalTester $I)
    {
        $I->amLoggedInAs(7);
        $I->amOnPage(['estado-pedido/']);
    }

    public function indexTest(\FunctionalTester $I)
    {
        $I->see('Forbidden', 'h1');
    }
}
