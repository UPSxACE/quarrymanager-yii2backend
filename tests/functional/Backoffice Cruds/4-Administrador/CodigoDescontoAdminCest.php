<?php
require_once( __DIR__ . "/../3-Gestor/CodigoDescontoGestorCest.php");
class CodigoDescontoAdminCest extends CodigoDescontoGestorCest
{
    public function _before(\FunctionalTester $I)
    {
        $I->amLoggedInAs(1);
        $I->amOnPage(['codigo-desconto/']);
    }

}
