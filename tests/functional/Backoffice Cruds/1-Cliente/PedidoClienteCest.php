<?php
require_once( __DIR__ . "/../PedidoCest.php");
class PedidoClienteCest extends PedidoCest
{
    public function _before(\FunctionalTester $I)
    {
        $I->amLoggedInAs(7);
        $I->amOnPage(['pedido/']);
    }

    public function indexTest(\FunctionalTester $I)
    {
        $I->see('Forbidden');
    }
}
